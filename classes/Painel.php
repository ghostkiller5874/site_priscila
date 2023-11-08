<?php

class Painel
{
    public static $cargos = [
        '0'=>'Administrador',
        '1'=>'Normal'
    ];

    public static function logado(){
        return isset($_SESSION['login']) ? true : false;
    }

    public static function loggout(){
        setcookie('lembrar','true',time()-1,'/');
        session_destroy();
        header('Location: '.INCLUDE_PATH_PERFIL);
    }

    public static function loadJS($files, $page){
        $url = explode('/',@$_GET['url'])[0];
        
        if($page == $url){
            foreach($files as $key=>$value){
                echo '<script src="'.INCLUDE_PATH_PERFIL.'js/'.$value.'"></script>';
            }
        }
    }

    public static function verificaPermissao($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			echo 'style="display:none;"';
		}
	}

    public static function verificaPermissaoPagina($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			include('painel/pages/permissao_negada.php');
			die();
		}
    }

    public static function alert($tipo,$mensagem){
        if($tipo == 'sucesso'){
            echo $mensagem;
        }else if($tipo == 'erro'){
            echo $mensagem;
        }//estilizar depois
    }

    public static function redirect($url){
        echo '<script>location.href="'.$url.'"</script>';
        die();
    }
    

    
}