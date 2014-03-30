/*
*	Flores Avila Oscar Ivan
*/

#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include<openssl/md5.h>
#include<sqlite3.h>
#include"defs.h"
#include<regex.h>
#include<fcntl.h>

// Estructura para almacenar los datos de un usuario
struct par{
	char* llave;
	char* valor;
};

int contactaBase(char*,char*);
char *str2md5(const char*);
int indexOf(char,char*);
char* obtenDatos();
void setPar(struct par* p,char* s);
char* generaToken(void);
char* escribeToken(char*);

int main(void){
	char *user,*pass,*pass_hash;
	char *data;
	struct par p1,p2;
	char *ap1,*ap2;
	regex_t regex;

	// Obtenemos los datos enviados por POST
	puts("Content-Type:text/html;charset=utf-8");
	data = obtenDatos();

	ap1=strtok(data,"&");
	ap2=strtok(NULL,"&");

	// Almacenamos los datos del usuarios en un par ordenado
	setPar(&p1,ap1);
	setPar(&p2,ap2);

	// Verificamos si los datos del usuario cumplen con las caracteristicas definidas
	regcomp(&regex,"^[a-z0-9]+$",REG_EXTENDED);
	if(regexec(&regex,p1.valor,0,NULL,0) || regexec(&regex,p2.valor,0,NULL,0)){
		puts(RECHAZADO);
		return 0;
	}

	// Revisamos el orden en que los datos fueron enviados, asi como el nombre de
	// los campos
	if(!(strcmp(p1.llave,"user") && strcmp(p2.llave,"pass"))){
		user=p1.valor;
		pass=p2.valor;
	}else if(!(strcmp(p1.llave,"pass") && strcmp(p2.llave,"user"))){
		user=p2.valor;
		pass=p1.valor;
	}else{
		// Si no cumple las condiciones es rechazada la peticion
		puts(RECHAZADO);
		return 0;
	}

	// Generamos el hash de la contrasena
	pass_hash=str2md5(pass);

	// Verificamos los datos contra la base si los datos existen
	// regresamos el valor de 1
	if(contactaBase(user,pass_hash))
			return 1;

	return 0;
}

char *str2md5(const char *str) {
	int n;
	unsigned char digest[16];
	char *md5str = (char*)malloc(33);

	// Aplicamos la funcion de hash a la cadena
	MD5((unsigned char*)str, strlen(str), (unsigned char*)&digest);    

	// Generamos una cadena en formato hexadecimal a partir del arreglo de bytes
	for(n = 0; n < 16; n++)
	         sprintf(&md5str[n*2], "%02x", (unsigned int)digest[n]);

	return md5str;
}

int contactaBase(char *usr, char* pwd){
	int retval,flag=0;
	char query[132];

	// Estructura para manipular las consultas
	sqlite3_stmt *stmt;

	// Creamos un apuntador para la conexion a la base
	sqlite3 *handle;

	// Realizamos la conexion a la base de datos
	retval = sqlite3_open(DIR_DATABASE,&handle);

	if(retval){
		puts("No se pudo conectar con la base");
		return flag;
	}

	strcpy(query,"SELECT login,password FROM usuarios WHERE login='");
	strcat(query,usr);
	strcat(query,"' and password ='");
	strcat(query,pwd);
	strcat(query,"'");	

	// Realizamos la consulta
	retval = sqlite3_prepare_v2(handle,query,strlen(query)+1,&stmt,NULL);

	if(retval){
		puts("No se ha podido contactar la base");
		return flag;
	}

	retval=sqlite3_step(stmt);
	
	switch(retval){
		case SQLITE_ROW:
			// Verificamos si son datos de un usuario valido
			if(!(strcmp(usr,sqlite3_column_text(stmt,0)) || strcmp(pwd,sqlite3_column_text(stmt,1)))){
				char* token = escribeToken(usr);
				char* aux=(char*)malloc(strlen(usr)+strlen(token)+strlen(ACEPTADO)+14);
				strcpy(aux,ACEPTADO);
				strcat(aux,"?user=");
				strcat(aux,usr);
				strcat(aux,"&token=");
				strcat(aux,token);
				strcat(aux,"\n\n");
				puts(aux);
				}
			break;
		case SQLITE_DONE:
			puts(RECHAZADO);
			break;
	}

	// Liberamos la memoria de la estructura usada para el query
	sqlite3_finalize(stmt);
	// Cerramos la conexion con la base de datos
	sqlite3_close(handle);
		
	return flag;

}

int indexOf(char c, char* str){
    int i;

	for(i=0;i<strlen(str);i++)
        if(*(str+i) == c)
          return i;
    return -1; 
}

char* obtenDatos(){
    char *lenstr;
	char* input=(char*)malloc(MAXINPUT*sizeof(char));
	long len;

	lenstr = getenv("CONTENT_LENGTH");

	if(!(lenstr == NULL || sscanf(lenstr,"%ld",&len)!=1 || len > MAXLEN))
		fgets(input, len+1, stdin);

  	return input;
}

void setPar(struct par* p,char* s){
	// Almacenamos los datos del usuario en la estructura recibida
	p->llave=strtok(s,"=");
	char *aux=strtok(NULL,"=");
	if(aux != NULL)
		p->valor=aux;
	else
		p->valor="";
}

char* generaToken(void){
	char *str = (char*)malloc(33);
	int i;
	int randomSrc = open("/dev/random", O_RDONLY);
	unsigned long seed[2];

	read(randomSrc , seed, 2 * sizeof(long) );
	close(randomSrc);
	sprintf(str,"%lu",seed);

	for(i=0;i<13;i++)
		str=str2md5(str);

	return str;
}

char* escribeToken(char* nombre){
	char* str = (char*)malloc(strlen(nombre)+strlen(ALMACEN)+1);
	char* token;
	strcpy(str,ALMACEN);
	strcat(str,nombre);
	
	// Generamos el archivo que contiene el token de sesion de un usuarios
	FILE *ap=fopen(str,"w");
	// Generamos el token
	token = generaToken();
    fprintf(ap,"%s",token);
    fclose(ap);

	// Regresamoe el valor del token recien generado
	return token;
}
