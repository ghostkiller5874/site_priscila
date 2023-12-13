<?php  include('config.php');?>
<?php Site::updateUsuarioOnline();?>
<?php Site::contador();?>

<?php 
    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_usuario`");
    $sql->execute();
    $sql = $sql->fetch();

    $_SESSION['identifica'] = $sql['user_id'];
?>
<?php
 $carrinho = MySql::conectar()->prepare("SELECT `quantidade` FROM `tb_carrinho` WHERE user_id=$_SESSION[identifica]");
 $carrinho->execute();
 $carrinho = $carrinho->fetchAll();
 $amount = 0;
 
 for($i=0;$i <= count($carrinho);$i++){
    $amount+=$i;
 }
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- FONTE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Open+Sans:wght@300;400;500&display=swap" rel="stylesheet"><!--Fonte Principal -->

    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <!-- ESTILIZAÇÃO -->
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css/style.css" >
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css/font-awesome.min.css">

    <title>Project #1</title>
</head>
<body>
    <?php   
        $url = isset($_GET['url']) ? $_GET['url'] : 'home';
    ?>
    <bases bases="<?php echo INCLUDE_PATH; ?>" />
    <header>
        <div class="center">
            <div class="box-header">
                <!--fazer menu mobile-->
                <div class="box-logo w50 left">
                    <a href="<?php echo INCLUDE_PATH?>" style="cursor:pointer;"><img src="<?php echo INCLUDE_PATH?>images/logo2.png" alt=""></a>
                </div> 
                <div class="box-conta w50 left">
                    
                    <h4><a href="<?php echo INCLUDE_PATH_PERFIL;?>"><i class="fa fa-user"> Minha conta</i></a></h4>
                    
                    <h4><a href="<?php echo INCLUDE_PATH?>carrinho"><i class="fa fa-shopping-cart"> Carrinho <?php echo ($amount <= 0)? ' ' : '('.$amount.')';?></i></a></h4>
                    
                </div>

                <div class="box-conta-mobile right">
                    <div class="botao-menu-mobile"><i class="fa fa-bars"></i></div>
                    <ul>
                        <li><h4><a href="<?php echo INCLUDE_PATH_PERFIL?>"><i class="fa fa-user"> Minha conta</i></a></h4></li>
                        <li><h4><a href="<?php echo INCLUDE_PATH?>carrinho"><i class="fa fa-shopping-cart"> Carrinho <?php echo ($amount <= 0)? ' ' : '('.$amount.')';?></i></a></h4></li>
                    </ul>   
                </div>
                
                <div class="clear"></div>
            </div>
        </div>
    </header>

    <?php 
        if(file_exists('pages/'.$url.'.php') ){
            include('pages/'.$url.'.php');
        }else{
            $pagina404 = true;
            include('pages/404.php');
        }
    ?>
    
    <footer <?php if(isset($pagina404) && $pagina404 == true) echo 'class="fixed"'; ?>>
        <div class="center">
            <div class="container-footer">
                <div class="footer-logo w50 left">
                    <img src="<?php echo INCLUDE_PATH?>images/logo2.png" alt="">
                </div> 
                <div class="footer-info w50 right">
                    <ul>
                        <li>CONTATO: 62 999467442</li>
                        <li>EMAIL: pl.acessorios@gmail.com</li>
                        <li>Uruana - Goiás - Brasil</li>
                    </ul>
                </div>
                
            </div>
            <div class="clear"></div>
            <p>Todos dos direitos reservados</p>
        </div>
        
    </footer>
    <script src="<?php echo INCLUDE_PATH?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH?>js/constants.js"></script>
    <script src="<?php echo INCLUDE_PATH?>js/jquery.ajaxform.js"></script>
    <script src="<?php echo INCLUDE_PATH?>js/scripts.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFIL?>js/main.js"></script>
</body>
</html>