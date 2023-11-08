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


    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>


    <title>Area de Peril</title>
</head>

<body>
    <!--O HEADER-->
    <div class="wrapper">

        <div class="top_navbar">
            <div class="logo">
                <a href="<?php echo INCLUDE_PATH ?>"><img src="<?php echo INCLUDE_PATH?>images/logo2.png" title="Home"></a>
            </div>
            <div class="top_menu">
                <div class="home_link">
                    <a href="<?php echo INCLUDE_PATH_PERFIL?>">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span>Home</span>
                    </a>
                </div>
                <div class="right_info">
                    <div class="icon_wrap">
                        <div class="icon">
                            <a href="<?php echo INCLUDE_PATH_PERFIL ?>?logout"><i class="fas fa-power-off desliga"></i></a>
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
                            <a href="#">
                                <span class="icon">
                                    <i class="fas fa-border-all"></i></span>
                                <span class="list">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="active">
                                <span class="icon"><i class="fas fa-chart-pie"></i></span>
                                <span class="list">Charts</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon"><i class="fas fa-address-book"></i></span>
                                <span class="list">Contact</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon"><i class="fas fa-address-card"></i></span>
                                <span class="list">About</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon"><i class="fab fa-blogger"></i></span>
                                <span class="list">Blogs</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon"><i class="fas fa-map-marked-alt"></i></span>
                                <span class="list">Maps</span>
                            </a>
                        </li>
                    </ul>

                    <div class="hamburger">
                        <div class="inner_hamburger">
                            <span class="arrow">
                                <i class="fas fa-long-arrow-alt-left"></i>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            <!--CONTEUDO-->
            <div class="container">
                <!-- paginas do perfil -->
                <?php include('pages/teste.php');?>
            </div>

        </div>
    </div>
    <script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH_PERFIL ?>js/sidebar.js"></script>
    

</body>

</html>