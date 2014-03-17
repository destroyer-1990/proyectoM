#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include<openssl/md5.h>
#include<sqlite3.h>

int contactaBase(char*,char*);
char *str2md5(const char*, int);

int main(int argc, char *argv[]){
	char *user_hash,*pass_hash;

	if(argc == 3){
		user_hash=str2md5(argv[1],strlen(argv[1]));
		pass_hash=str2md5(argv[2],strlen(argv[2]));
		if(contactaBase(user_hash,pass_hash))
			return 1;
	}

	puts("acabaron los hashes");


	return 0;
}

char *str2md5(const char *str, int length) {
	int n;
	MD5_CTX c;
	unsigned char digest[16];
	char *out = (char*)malloc(33);

	MD5_Init(&c);

	while (length > 0) {
		if (length > 512) 
			MD5_Update(&c, str, 512);
		else 
			MD5_Update(&c, str, length);
		
		length -= 512;
		str += 512;
	}

	MD5_Final(digest, &c);

	for (n = 0; n < 16; ++n)
		snprintf(&(out[n*2]), 16*2, "%02x", (unsigned int)digest[n]);

	return out;
}

int contactaBase(char *usr, char* pwd){

	int retval;

	// The number of queries to be handled,size of each query and pointer
	//int q_cnt = 5,q_size = 150,ind = 0;
	//char **queries = malloc(sizeof(char) * q_cnt * q_size);

	// A prepered statement for fetching tables
	sqlite3_stmt *stmt;

	// Create a handle for database connection, create a pointer to sqlite3
	sqlite3 *handle;

	// try to create the database. If it doesnt exist, it would be created
	// pass a pointer to the pointer to sqlite3, in short sqlite3**
	retval = sqlite3_open("../database/mod2.db",&handle);
	// If connection failed, handle returns NULL
	if(retval)
		printf("Database connection failed\n");
	//return -1;
	printf("Connection successful\n");

	char query[122];
	strcpy(query,"SELECT user,pass FROM usuarios WHERE user='");
	strcat(query,usr);
	strcat(query,"' and pass ='");
	strcat(query,pwd);
	strcat(query,"'");	

	

puts("query bien");	
	//ind++;
	//queries[ind++] = "SELECT * from usuarios";
	//retval = sqlite3_prepare_v2(handle,queries[ind-1],-1,&stmt,0);
	//retval = sqlite3_prepare_v2(handle,"SELECT user from usuarios",-1,&stmt,0);
	retval = sqlite3_prepare_v2(handle,query,strlen(query)+1,&stmt,NULL);
puts("ejecutando query");

	printf("%d",retval);

	if(retval)
		printf("Selecting data from DB Failed\n");

	// Read the number of rows fetched
	int cols = sqlite3_column_count(stmt);


	while(1){
		puts("empiezo");
			// fetch a row's status
		retval = sqlite3_step(stmt);

		puts("def cte sql");

	printf("<%d,%d,%d>\n",retval,SQLITE_ROW,SQLITE_DONE);
		if(retval == SQLITE_ROW){

			puts("aun imprimo");
			int col;
			// SQLITE_ROW means fetched a row

			printf(",%d\n",cols);
			// sqlite3_column_text returns a const void* , typecast it to const char*
				const char *val1 = (const char*)sqlite3_column_text(stmt,0);
				printf("%s\t",val1);
				const char *val2 = (const char*)sqlite3_column_text(stmt,1);
				printf("%s\t",val2);

	if(!(strcmp(usr,val1) || strcmp(pwd,val2))){
		puts("bienvenido");
	sqlite3_finalize(stmt);
	sqlite3_close(handle);
		return 1;
	}


			puts("\navance 1");

			printf("\n");
		}
		else if(retval == SQLITE_DONE){
			puts("a punto de romper");
		// All rows finished
		//printf("All rows fetched\n");
			break;
		}
		else
		// Some error encountered
			printf("Some error encountered\n");

		puts("repito");
	}

	puts("casi cerramos el changarro");

	sqlite3_finalize(stmt);


	puts("cerramos el changarro");

	sqlite3_close(handle);
		
	return 0;

}
