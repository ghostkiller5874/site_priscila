<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$autoload = function ($class) {
    include('classes/' . $class . '.php');
};

spl_autoload_register($autoload);

//redirecinamento
define('INCLUDE_PATH', 'http://localhost/site_priscila/');
define('INCLUDE_PATH_PERFIL', INCLUDE_PATH.'User/');
define('BASE_DIR_PERFIL',__DIR__.'/User');

//Banco de Dados
define('HOST', 'localhost');
define('DATABASE', 'site_tcc');
define('USER', 'root');
define('PASSWORD', '');



//FUNCOES DO PAINEL 
function selecionadoMenu($par){
    /*<i class="fa fa-angle-double-right" aria-hidden="true"></i>*/
    $url = explode('/',@$_GET['url'])[0];
    if($url == $par){
        echo 'class="active"';
    }
}

function verificaPermissaoMenu($permissao){
    if($_SESSION['cargo'] == $permissao){
        return;
    }else{
        echo 'style="display:none;"';
    }
}

function verificaPermissaoPagina($permissao){
    if($_SESSION['cargo'] == $permissao){
        return;
    }else{
        include('User/pages/permissao_negada.php');
        die();
    }
}

