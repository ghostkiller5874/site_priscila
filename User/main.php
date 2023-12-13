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
            </div><!--desktop-->

            <div class="top_menu_mobile">
                <div class="home_link_mobile">
                    <a class="hamburger"><i class="fa fa-bars"></i></a>
                </div>
                <div class="menu_mobile">
                <div class="botao-menu right"><i class="fa fa-bars"></i> PAINEL</div>
                    <ul>
                        <a href="<?php echo INCLUDE_PATH_PERFIL ?>"><li><i class="fa fa-home"></i> Home</li></a>
                        <a href="<?php echo INCLUDE_PATH ?>carrinho"><li><i class="fa fa-shopping-cart"></i> Carrinho</li></a>
                        <a href="<?php echo INCLUDE_PATH_PERFIL ?>?logout"><li><i class="fa fa-power-off desliga"></i> Sair</li></a>
                    </ul>
                </div>
                <div class="clear"></div>
            </div><!--mobile-->
        </div>
        <!--CORPO SIDEBAR-->
        <div class="main_body">

            <div class="sidebar_menu">
                <div class="inner__sidebar_menu">

                    <ul>
                        <a href="<?php echo INCLUDE_PATH ?>" class="img_mobile"><img src="<?php echo INCLUDE_PATH ?>images/logo2.png" title="Home" ></a>
                        <!--PAINEL DO USUARIO-->
                        <li>
                            <h4>Perfil</h4>
                            <a href="<?php echo INCLUDE_PATH_PERFIL?>editar-perfil" <?php selecionadoMenu('editar-perfil')?>>Editar Perfil</a>
                        </li>
                        <!--PAINEL DE CONTROLE-->
                        <li>
                            <h4 <?php verificaPermissaoMenu(0)?>>Categoria e cor</h4>
                            <a <?php selecionadoMenu('cadastrar-categoria')?><?php verificaPermissaoMenu(0)?> href="<?php echo INCLUDE_PATH_PERFIL ?>cadastrar-categoria">Cadastrar Categorias e cores</a>
                            <a <?php selecionadoMenu('gerenciar-categoria')?><?php verificaPermissaoMenu(0)?> href="<?php echo INCLUDE_PATH_PERFIL ?>gerenciar-categoria">Gerenciar Categorias</a>
                            <a <?php selecionadoMenu('lista-cores')?><?php verificaPermissaoMenu(0)?> href="<?php echo INCLUDE_PATH_PERFIL ?>lista-cores">Listagem de cores</a>
                        </li>
                        
                        <!--PAINEL DE CONTROLE

                        <li>
                            <h4 <?php verificaPermissaoMenu(0)?>>Usuários</h4>
                            <a <?php verificaPermissaoMenu(0)?> <?php selecionadoMenu('cadastrar-usuarios')?> href="<?php echo INCLUDE_PATH_PERFIL ?>cadastrar-usuarios">Cadastrar Usuarios</a>
                            <a <?php verificaPermissaoMenu(0)?> <?php selecionadoMenu('gestao-usuarios')?> href="<?php echo INCLUDE_PATH_PERFIL?>gestao-usuarios">Gestão de usuarios</a>
                            
                        </li>-->

                        <!--PAINEL DE CONTROLE-->
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
    <script src="<?php echo INCLUDE_PATH ?>js/jquery.mask.js"></script>
    <script src="<?php echo INCLUDE_PATH ?>js/helperMask.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFIL ?>js/sidebar.js"></script>
    <script src="<?php echo INCLUDE_PATH ?>js/constants.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFIL ?>js/ajax.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFIL ?>js/main.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFIL?>js/jquery.maskMoney.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFIL?>js/controleFinanceiro.js"></script>
    <script>
        $('.menu_mobile  .botao-menu').click(function() {
            //O que acontecera qndo clicar no botao menu
            var listaMenu = $('.menu_mobile ul');


            if (listaMenu.is(':hidden') == true) {
                let icone = $('.botao-menu').find('i');
                icone.removeClass('fa-bars');
                icone.addClass('fa-times');
                listaMenu.slideToggle();
            } else {
                let icone = $('.botao-menu').find('i');
                icone.removeClass('fa-times');
                icone.addClass('fa-bars');
                listaMenu.slideToggle();
            }
        });
    </script>

</body>

</html>