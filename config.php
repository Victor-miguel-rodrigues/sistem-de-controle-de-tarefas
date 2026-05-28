<?php 



define("NOME_SITE", 'SISTEMA DE GERENCIAMENTO DE TAREFAS');
define('VERSAO',1.0);
define("URL_DESENVOLVIMENTO", 'http://localhost');

define("host", "Host");
define('user' , 'UsernameDB');
define('password', 'PassWordDb');
define('db' , 'NameDB');




$connect = mysqli_connect(host,user,password,db);

if(mysqli_connect_error()){
    echo mysqli_connect_error();
}

