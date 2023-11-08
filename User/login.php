<?php
if (isset($_COOKIE['lembrar'])) {
    $user = $_COOKIE['email'];
    $password = $_COOKIE['senha'];
    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_usuario` WHERE email = ? AND senha = ?");
    $sql->execute(array($user, $password));
    if ($sql->rowCount() == 1) {
        $info = $sql->fetch();
        $_SESSION['login'] = true;
        $_SESSION['email'] = $user;
        $_SESSION['senha'] = $password;
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

    <link rel="icon" href="../favicon.ico" type="image/x-icon" />
    <!-- ESTILIZAÇÃO -->
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PERFIL; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/font-awesome.min.css">
    <style>
        html,
        body {
            background-color: rgba(253, 232, 233,0.6);
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
        .header1 ul li{
            padding: 3px 0;
            color: #333;
            font-size: 19px;
            font-weight: 500;
        }
        .header1 li:hover{
            color: #4d4d4d;
        }
        .header1 a{
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            padding: 0 8px;
        }
        .header1 i{
            display: inline;
        }
    </style>

    <title>Project #1</title>

<body>
    <header>
        <div class="center">
            <div class="container-header">
                <div class="header1">
                    <a href="<?php echo INCLUDE_PATH?>"><img src="<?php echo INCLUDE_PATH ?>images/logo2.png" title="Home"></a>
                    <ul>
                        <a href="<?php echo INCLUDE_PATH_PERFIL?>"><li><i class="fa fa-user"></i> Meu Perfil</li></a>
                        <a href="<?php echo INCLUDE_PATH?>carrinho"><li><i class="fa fa-shopping-cart"></i> Carrinho</li></a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </header>
    <section>
        <div class="center">
            <div class="box-login">
                <form action="" method="post">
                    <?php
                    if (isset($_POST['acao'])) {
                        $email = $_POST['email'];
                        $senha = $_POST['senha'];

                        $sql = MySQL::conectar()->prepare("SELECT * FROM `tb_usuario` WHERE email = ? AND senha = ?");
                        $sql->execute([$email, $senha]);

                        if ($sql->rowCount() == 1) {
                            $info = $sql->fetch();
                            //Logamos com sucesso.
                            $_SESSION['login'] = true;
                            $_SESSION['email'] = $email;
                            $_SESSION['senha'] = $senha;
                            $_SESSION['cargo'] = $info['cargo'];


                            Painel::redirect(INCLUDE_PATH_PERFIL);
                        } else {
                            //Falhou
                            echo '<div class="erro-box"><i class="fa fa-times"></i> Usuário ou senha incorretos!</div>';
                        }
                    }
                    ?>
                    <?php
                    if (isset($_GET['criar-conta']) == false || isset($_GET['logar']) == true) {
                    ?>
                        <div id="logar">
                            <h3>Bem-vindo Novamente: </h3>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Digite seu e-mail...">
                            </div>
                            <div class="form-group">
                                <input type="password" name="senha" placeholder="Digite sua senha...">
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
                    <?php } else { ?>
                        <?php
                        if (isset($_POST['acao'])) {
                            $nome = $_POST['nome'];
                            $telefone = $_POST['telefone'];
                            $mail = $_POST['email'];
                            $senha = $_POST['senha'];

                            $sql = MySQL::conectar()->prepare("INSERT INTO `` VALUES");
                            $sql->execute([]);
                        }
                        ?>
                        <div>
                            <h3>Faça seu cadastro: </h3>
                            <div class="form-group">
                                <input type="text" name="nome" placeholder="Nome Completo">
                            </div>
                            <div class="form-group">
                                <input type="text" name="telefone" placeholder="Telefone">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Seu melhor e-mail">
                            </div>
                            <div class="form-group">
                                <input type="password" name="senha" placeholder="Senha...">
                            </div>
                            <div class="form-group">
                                <input  type="checkbox" name="lembrar">
                                <label for="lembrar">Lembrar-me</label>
                            </div>
                            <div class="form-group">
                                <a href="<?php echo INCLUDE_PATH_PERFIL ?>?logar">Fazer Login</a>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="acao" value="Cadastrar-se">
                            </div>
                        </div>
                    <?php } ?>
            </div>

        </div>

    </section>
</body>

</html>