create database if not exists crudJaya;

use crudJaya;

alter database crudJaya character set utf8 collate utf8_general_ci;

-- create table tab-aluno nome, matricula, nota1, nota2, nota3
create table if not exists tab_dados (
    id_pessoa int not null auto_increment primary key,
    nome varchar(50), 
    cpf varchar(14), 
    email varchar(30)
    );
   