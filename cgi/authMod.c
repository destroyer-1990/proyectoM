#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include<openssl/md5.h>
#include<sqlite3.h>

int contactaBase(char*,char*);
char *str2md5(const char*, int);

int main(int argc, char *argv[]){
	char *user_hash,*pass_hash;

	// Gerenamos los hashes de las cadenas enviadas por el usuario
	if(argc == 3){
		user_hash=str2md5(argv[1],strlen(argv[1]));
		pass_hash=str2md5(argv[2],strlen(argv[2]));
		// Verificamos los datos contra la base si los datos existen
		// regresamos el valor de 1
		if(contactaBase(user_hash,pass_hash))
			return 1;
	}

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
	char query[122];
	// Estructura para manipular las consultas
	sqlite3_stmt *stmt;

	// Creamos un apuntador para la conexion a la base
	sqlite3 *handle;

	// Realizamos la conexion a la base de datos
	retval = sqlite3_open("../database/mod2.db",&handle);

	if(retval){
		puts("No se pudo conectar con la base");
		return flag;
	}

	//puts("Conexion exitosa");

	strcpy(query,"SELECT user,pass FROM usuarios WHERE user='");
	strcat(query,usr);
	strcat(query,"' and pass ='");
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
			if(!(strcmp(usr,val1) || strcmp(pwd,val2)))
				flag++;
		}
		else if(retval == SQLITE_DONE)//si se han revisado rodos los registros rompemos
			break;					//el ciclo while
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
