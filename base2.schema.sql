CREATE TABLE usuarios(idusuario integer primary key AUTOINCREMENT, login varchar(25) not null unique, password text not null,orden varchar(255));
