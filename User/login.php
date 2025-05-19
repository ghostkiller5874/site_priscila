<?php
if (isset($_COOKIE['lembrar'])) {
    $email = $_COOKIE['email'];
    $senha = $_COOKIE['senha'];
    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_usuario` WHERE email = ? AND senha = ?");
    $sql->execute(array($email, $senha));
    if ($sql->rowCount() == 1) {
        $info = $sql->fetch();
        $_SESSION['login'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['cargo'] = $info['cargo'];
        Painel::redirect(INCLUDE_PATH_PERFIL);
    }
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

    <link rel="icon" href="<?php echo INCLUDE_PATH ?>favicon.ico" type="image/x-icon" />
    <!-- ESTILIZAÇÃO -->
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PERFIL; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/font-awesome.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            background-color: rgba(253, 232, 233, 0.6);
            overflow-y: hidden;
        }

        header {
            width: 100%;
            background-color: #f7acb0;
            height: 100px;
            border-bottom: 2px solid #863e3f;
        }

        .clear {
            clear: both;
        }

        .right {
            float: right;
        }

        .container-header {
            width: 100%;
            padding: 10px 5px;
        }

        .header1 img {
            width: 140px;
            height: 80px;
            float: left;
        }

        .header1 ul {
            margin: 20px 20px 0 0;
            float: right;
            list-style-type: none;
        }

        .header1 ul li {
            padding: 3px 0;
            color: #333;
            font-size: 19px;
            font-weight: 500;
        }

        .header1 li:hover {
            color: #4d4d4d;
        }

        .header1 a {
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            padding: 0 8px;
        }

        .header1 i {
            display: inline;
        }

        .mobile-mod {
            display: none;
        }

        @media screen and (max-width:425px) {
            .header1 ul {
                display: none;
            }

            .mobile-mod {
                display: block;
                width: 100%;
            }

            .botao-menu {
                font-size: 22px;
                color: white;
                position: absolute;
                top: 30px;
                left: 90%;
            }

            .mobile-mod ul {
                display: none;
            }

            .mobile-mod ul h4 {
                text-align: center;
                padding: 20px 0;
                font-size: 15px;
                background-color: white;
                padding: 15px 0;
            }

            .mobile-mod ul h4:first-of-type {
                border-bottom: 1px solid #f7acb0;
            }

        }
        @media screen and (max-height: 710px) {
            section .box-login{
                position: absolute;
                top: calc(50% + 50px);
            }
        }
    </style>

    <title>Project #1</title>

<body>
    <header>
        <div class="center">
            <div class="container-header">
                <div class="header1">
                    <a href="<?php echo INCLUDE_PATH ?>"><img src="<?php echo INCLUDE_PATH ?>images/logo2.png" title="Home"></a>
                    <ul>
                        <a href="<?php echo INCLUDE_PATH_PERFIL ?>">
                            <li><i class="fa fa-user"></i> Meu Perfil</li>
                        </a>
                        <a href="<?php echo INCLUDE_PATH ?>carrinho">
                            <li><i class="fa fa-shopping-cart"></i> Carrinho</li>
                        </a>
                    </ul>

                </div><!--HEADER1-->
                <div class="mobile-mod right">
                    <div class="botao-menu right"><i class="fa fa-bars"></i></div>
                    <ul>
                        <li><a href="<?php echo INCLUDE_PATH_PERFIL ?>">
                                <h4><i class="fa fa-user"></i> Meu Perfil</h4>
                            </a></li>
                        <li><a href="<?php echo INCLUDE_PATH ?>carrinho">
                                <h4><i class="fa fa-shopping-cart"></i> Carrinho</h4>
                            </a></li>
                    </ul>

                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="clear"></div>
    </header>
    <?php
    if (isset($_GET['criar-conta']) == false || isset($_GET['logar']) == true) {


    ?>
        <section>
            <div class="center">
                <div class="box-login">
                    <form action="" method="post">
                        <?php
                        if (isset($_POST['acao'])) {
                            $email = $_POST['email'];
                            $senha = $_POST['senha'];

                            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_usuario` WHERE email = ? AND senha = ?");
                            $sql->execute([$email, $senha]);

                            if ($sql->rowCount() == 1) {
                                $info = $sql->fetch();
                                //Logamos com sucesso.
                                $_SESSION['login'] = true;
                                $_SESSION['email'] = $email;
                                $_SESSION['senha'] = $senha;
                                $_SESSION['identifica'] = $info['id'];
                                $_SESSION['cargo'] = $info['cargo'];
                                if (isset($_POST['lembrar'])) {
                                    setcookie('lembrar', true, time() + (60 * 60 * 24), '/');
                                    setcookie('email', $email, time() + (60 * 60 * 24), '/');
                                    setcookie('senha', $senha, time() + (60 * 60 * 24), '/');
                                }

                                Painel::redirect(INCLUDE_PATH_PERFIL);
                            } else {
                                //Falhou
                                echo '<div class="erro-box"><i class="fa fa-times"></i> Usuário ou senha incorretos!</div>';
                            }
                        }
                        ?>
                        <div id="logar">
                            <h3>Bem-vindo Novamente: </h3>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Digite seu e-mail..." required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="senha" placeholder="Digite sua senha..." required>
                            </div>

                            <div class="form-group">
                                <input type="checkbox" name="lembrar">
                                <label for="lembrar">Lembrar-me</label>
                            </div>
                            <div class="form-group">
                                <a href="<?php echo INCLUDE_PATH_PERFIL ?>?criar-conta">Criar conta</a>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="acao" value="Logar">
                            </div>
                        </div>

                </div>

            </div>

        </section>

    <?php } else { ?>
        <section>
            <div class="center">
                <div class="box-login">
                    <form action="" method="post">
                        <?php
                        if (isset($_POST['cadastro'])) {

                            $nome = $_POST['nome'];
                            $telefone = $_POST['telefone'];
                            $cpf = $_POST['cpf'];
                            $sexo = $_POST['sexo'];
                            $mail = $_POST['email'];
                            $senha = $_POST['senha'];
                            $cargo = 1;



                            $verificar = MySql::conectar()->prepare("SELECT * FROM `tb_usuario` WHERE email =?");
                            $verificar->execute([$_POST['email']]);
                            if ($verificar->rowCount() == 1) {
                                Painel::alert('erro', 'Este email já foi registrado');
                            } else {
                                $sql_cliente = MySql::conectar()->prepare("INSERT INTO `tb_cliente` VALUES (null,?,?,?,?,?,?)");
                                $tipoFinal = ($sexo == 'masculino') ? "Masculino" : "Feminino";
                                $sql_cliente->execute([$nome, $telefone, $cpf, $tipoFinal,null,1]);

                                $userID = MySql::conectar()->lastInsertId();
                                var_dump($userID);
                                $sql_usuario = MySql::conectar()->prepare("INSERT INTO `tb_usuario` VALUES (null,?,?,?,?)");
                                
                                $sql_usuario->execute(array($mail, $senha, $cargo, $userID));

                                $_SESSION['identifica'] = $userID;

                                $logado = MySql::conectar()->prepare("SELECT * FROM `tb_usuario` WHERE email = ? AND senha = ?");
                                $logado->execute([$mail, $senha]);
                                if ($logado->rowCount() == 1) {
                                    $info = $logado->fetch();
                                    //Logamos com sucesso.
                                    $_SESSION['login'] = true;
                                    $_SESSION['email'] = $mail;
                                    $_SESSION['senha'] = $senha;
                                    $_SESSION['cargo'] = $info['cargo'];
                                    $_SESSION['identifica'] = $userID;
                                    if (isset($_POST['lembrar'])) {
                                        setcookie('lembrar', true, time() + (60 * 60 * 24), '/');
                                        setcookie('email', $email, time() + (60 * 60 * 24), '/');
                                        setcookie('senha', $senha, time() + (60 * 60 * 24), '/');
                                    }

                                    Painel::redirect(INCLUDE_PATH_PERFIL);
                                }
                            }
                        }
                        ?>
                        <h3>Faça seu cadastro: </h3>
                        <div class="form-group">
                            <input type="text" name="nome" placeholder="Digite seu Nome completo" requiered>
                        </div>
                        <div class="form-group">
                            <input type="text" name="telefone" placeholder="Digite seu número de telefone" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="cpf" placeholder="Digite seu CPF" required>
                        </div>
                        <div class="form-group">
                            <label for="" style="display: block;">Informe seu sexo: </label>
                            <select name="sexo" id="">
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Digite seu e-mail..." required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="senha" placeholder="Digite sua senha..." required>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="lembrar">
                            <label for="lembrar">Lembrar-me</label>
                        </div>
                        <div class="form-group">
                            <a href="<?php echo INCLUDE_PATH_PERFIL ?>?logar">Fazer Login</a>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="cadastro" value="Cadastrar-se">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    <?php } ?>
    <script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH ?>js/jquery.mask.js"></script>
    <script src="<?php echo INCLUDE_PATH ?>js/helperMask.js"></script>
    <script>
        $('.mobile-mod  .botao-menu').click(function() {
            //O que acontecera qndo clicar no botao menu
            var listaMenu = $('.mobile-mod ul');


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