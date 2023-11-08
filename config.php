<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$autoload = function ($class) {
    include('classes/' . $class . '.php');
};

spl_autoload_register($autoload);

//redirecinamento
define('INCLUDE_PATH', 'http://localhost/site_priscila/');
define('INCLUDE_PATH_PERFIL', INCLUDE_PATH . 'User/');


//Banco de Dados
define('HOST', 'localhost');
define('DATABASE', 'Projeto_tcc');
define('USER', 'root');
define('PASSWORD', '');


