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
    public static function convertMoney($valor){
        return number_format($valor,2,',','.');
    }
    public static function formatarMoedaBd($valor){
        $valor = str_replace('.','',$valor);
        $valor = str_replace(',','.',$valor);
        return $valor;
    }

    public static function generateSlug($str){
        $str = mb_strtolower($str);
        $str = preg_replace('/(â|á|ã)/', 'a', $str);
        $str = preg_replace('/(ê|é)/', 'e', $str);
        $str = preg_replace('/(í|Í)/', 'i', $str);
        $str = preg_replace('/(ú)/', 'u', $str);
        $str = preg_replace('/(ó|ô|õ|Ô)/', 'o',$str);
        $str = preg_replace('/(_|\/|!|\?|#)/', '',$str);
        $str = preg_replace('/( )/', '-',$str);
        $str = preg_replace('/ç/','c',$str);
        $str = preg_replace('/(-[-]{1,})/','-',$str);
        $str = preg_replace('/(,)/','-',$str);
        $str=strtolower($str);
        return $str;
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

    public static function carregarPagina(){
        if(isset($_GET['url'])){
            $url = explode('/',$_GET['url']);
            if(file_exists('pages/'.$url[0].'.php')){
                include('pages/'.$url[0].'.php');
            }else{
                //Página não existe!
                header('Location: '.INCLUDE_PATH_PERFIL);
            }
        }else{
            //fazer um " if " para separar a " home " do ADM e do Usuario
            include('pages/home.php');
        }
    }

    public static function alert($tipo,$mensagem){
        if($tipo == 'sucesso'){
            echo '<div class="box-alert sucesso"><i class="fa fa-check"></i> '.$mensagem.'</div>';
        }else if($tipo == 'erro'){
            echo '<div class="box-alert erro"><i class="fa fa-times"></i> '.$mensagem.'</div>';
        }else if($tipo == 'atencao'){
            echo '<div class="box-alert atencao"><i class="fa fa fa-exclamation-triangle"></i> '.$mensagem.'</div>';
        }//estilizar depois
    }

    public static function redirect($url){
        echo '<script>location.href="'.$url.'"</script>';
        die();
    }

    public static function imagemValida($imagem){
        if($imagem['type'] == 'image/jpeg' ||
            $imagem['type'] == 'image/jpg' ||
            $imagem['type'] == 'image/png'){

            $tamanho = intval($imagem['size']/1024);
            if($tamanho < 900)
                return true;
            else
                return false;
        }else{
            return false;
        }
    }
    public static function uploadFile($file){
        $formatoArquivo = explode('.',$file['name']);
        $imagemNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
        if(move_uploaded_file($file['tmp_name'],BASE_DIR_PERFIL.'/uploads/'.$imagemNome))
            return $imagemNome;
        else
            return false;
    }
    public static function deleteFile($file){
        @unlink('uploads/'.$file);
    }

    //banco de dados
    
    

    
}