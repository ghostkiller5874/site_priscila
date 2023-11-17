<?php if (isset($_GET['logout'])) Painel::loggout(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FONTE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Open+Sans:wght@300;400;500&display=swap" rel="stylesheet"><!--Fonte Principal -->

    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PERFIL; ?>css/style.css" type="text/css">
    <link rel="icon" href="<?php echo INCLUDE_PATH?>favicon.ico" type="image/x-icon">


    <title>Area de Peril</title>
</head>

<body>
    
    <base base="<?php echo INCLUDE_PATH_PERFIL; ?>" />
    <!--O HEADER-->
    <div class="wrapper">

        <div class="top_navbar">

            <div class="logo">
                <a href="<?php echo INCLUDE_PATH ?>"><img src="<?php echo INCLUDE_PATH ?>images/logo2.png" title="Home"></a>
            </div>
            <div class="top_menu">
                <div class="home_link">
                    <a class="hamburger"><i class="fa fa-bars"></i></a>
                    <a href="<?php echo INCLUDE_PATH_PERFIL ?>" class="Home">
                        <span class="icon"><i class="fa fa-home"></i></span>
                        <span>Home</span>
                    </a>
                </div>
                <div class="right_info">
                    <div class="icon_wrap">
                        <div class="icon">
                            <a href="<?php echo INCLUDE_PATH ?>carrinho"><i class="fa fa-shopping-cart"></i> Carrinho</a>
                        </div>
                    </div>
                    <div class="icon_wrap">
                        <div class="icon">
                            <a href="<?php echo INCLUDE_PATH_PERFIL ?>?logout"><i class="fa fa-power-off desliga"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--CORPO SIDEBAR-->
        <div class="main_body">

            <div class="sidebar_menu">
                <div class="inner__sidebar_menu">

                    <ul>
                        <li>
                            <h4 <?php verificaPermissaoMenu(0)?>>Categorias</h4>
                            <a <?php selecionadoMenu('cadastrar-categoria')?><?php verificaPermissaoMenu(0)?> href="<?php echo INCLUDE_PATH_PERFIL ?>cadastrar-categoria">Cadastrar Categorias</a>
                            <a <?php selecionadoMenu('gerenciar-categoria')?><?php verificaPermissaoMenu(0)?> href="<?php echo INCLUDE_PATH_PERFIL ?>gerenciar-categoria">Gerenciar Categorias</a>
                        </li>
                        <li>
                            <h4>Clientes</h4>
                            <a <?php selecionadoMenu('cadastrar-clientes')?> href="<?php echo INCLUDE_PATH_PERFIL ?>cadastrar-clientes">Cadastrar Clientes</a>
                            
                        </li>
                        <li>
                            <h4 <?php verificaPermissaoMenu(0)?>>Produtos</h4>
                            <a <?php verificaPermissaoMenu(0)?> href="<?php echo INCLUDE_PATH_PERFIL?>cadastrar-produtos" <?php selecionadoMenu('cadastrar-produtos')?>>Cadastrar Produtos</a>
                            <a <?php verificaPermissaoMenu(0)?> href="<?php echo INCLUDE_PATH_PERFIL?>gerenciar-produtos" <?php selecionadoMenu('gerenciar-produtos')?>>Gestão de Produtos</a>
                        </li>
                    </ul>
                    <!--
                    <div class="hamburger">
                        <div class="inner_hamburger">
                            <span class="arrow">
                                <i class="fas fa-long-arrow-alt-left"></i>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </span>
                        </div>
                    </div>-->

                </div>
            </div>

            <!--CONTEUDO-->
            <div class="container">
                <!-- paginas do perfil -->
                <?php
                    Painel::carregarPagina();
                ?>
            </div>

        </div>
    </div>
    <script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFIL ?>js/sidebar.js"></script>
    <script src="<?php echo INCLUDE_PATH ?>js/constants.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFIL ?>js/ajax.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFIL ?>js/main.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFIL?>js/jquery.maskMoney.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFIL?>js/controleFinanceiro.js"></script>


</body>

</html>