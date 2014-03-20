#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include<openssl/md5.h>
#include<sqlite3.h>

#define MAXLEN 150
#define EXTRA 5
/* 4 for "data", 1 for "=" */
#define MAXINPUT MAXLEN+EXTRA+2

int contactaBase(char*,char*);
char *str2md5(const char*, int);
int indexOf(char,char*);
char* obtenDatos();

int main(void){
	char *user,*pass,*user_hash,*pass_hash;
	char *data;

	printf("%s%c%c\n","Content-Type:text/html;charset=iso-8859-1",13,10);
	puts("<TITLE>Response</TITLE>\n");


	//data = getenv("QUERY_STRING");
	data = obtenDatos();

	sscanf(data,"user=%s",user);
	pass = user+indexOf('=',user)+1;
	*(user+indexOf('&',user)) = '\0';
	
	// Generamos los hashes de las cadenas enviadas por el usuario
//	if(argc == 3){
		user_hash=str2md5(user,strlen(user));
		pass_hash=str2md5(pass,strlen(pass));
		// Verificamos los datos contra la base si los datos existen
		// regresamos el valor de 1

		//printf("%s,%s\n",user,pass);


		if(contactaBase(user_hash,pass_hash))
			return 1;
//	}
	
	//puts("\n");

	return 0;
}

char *str2md5(const char *str, int length) {
	int n;
	unsigned char digest[16];
	char *md5str = (char*)malloc(33);

	// Aplicamos la funcion de hash a la cadena
	MD5((unsigned char*)str, strlen(str), (unsigned char*)&digest);    

	// Generamos una cadena en formato hexadecimal a partir del arreglo de bytes
	for(n = 0; n < 16; n++)
	         sprintf(&md5str[n*2], "%02x", (unsigned int)digest[n]);

	//printf("%s\n",md5str);

	return md5str;
}

int contactaBase(char *usr, char* pwd){
	int retval,flag=0;
	//char query[122];
	char query[132];
	// Estructura para manipular las consultas
	sqlite3_stmt *stmt;

	// Creamos un apuntador para la conexion a la base
	sqlite3 *handle;

	// Realizamos la conexion a la base de datos
	//retval = sqlite3_open("../database/mod2.db",&handle);
	retval = sqlite3_open("/var/www/bdfrontend.db",&handle);
	//retval = sqlite3_open("/root/repos/ProyectoModulo2/proyectotonejo/bdfrontend.db",&handle);

	if(retval){
		puts("No se pudo conectar con la base");
		return flag;
	}

	//puts("Conexion exitosa");

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

	while(1){
		// Comprobamos el estado del registro
		retval = sqlite3_step(stmt);

		if(retval == SQLITE_ROW){
			// Guardamos los datos del usuario 
			const char *val1 = (const char*)sqlite3_column_text(stmt,0);// usuario
			const char *val2 = (const char*)sqlite3_column_text(stmt,1);// contrasena
			
			// Verificamos si son datos de un usuario valido
			if(!(strcmp(usr,val1) || strcmp(pwd,val2))){
				flag++;
				puts("<h1>Bienvenido</h1>\n");
//********************** Nota Modificar direccion ************************************
				puts("<form action=\"http://debian7proj.cloudapp.net\">");
//************************************************************************************
				puts("<div><input type=\"submit\" value=\"Continuar\"></div>");
				puts("</form>");

				break;
			}
		}
		else if(retval == SQLITE_DONE){//si se han revisado rodos los registros rompemos
			puts("<h1>Revise sus datos</h1>");
			puts("<form action=\"http://debian7proj.cloudapp.net/login.php\">");
			puts("<div><input type=\"submit\" value=\"Regresar\"></div>");
			puts("</form>");
			break;					//el ciclo while
		}
		else{
			puts("Se han presentado errores");
			break;
		}

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

	if(lenstr == NULL || sscanf(lenstr,"%ld",&len)!=1 || len > MAXLEN)
		printf("<P>Error in invocation - wrong FORM probably.");
	else
		fgets(input, len+1, stdin);

  	return input;
}
