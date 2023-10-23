<?php
if (isset($_COOKIE['lembrar'])) {
    $user = $_COOKIE['user'];
    $password = $_COOKIE['password'];
    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
    $sql->execute(array($user, $password));
    if ($sql->rowCount() == 1) {
        $info = $sql->fetch();
        $_SESSION['login'] = true;
        $_SESSION['user'] = $user;
        $_SESSION['password'] = $password;
        $_SESSION['cargo'] = $info['cargo'];
        $_SESSION['nome'] = $info['nome'];
        $_SESSION['img'] = $info['img'];
        Painel::redirect(INCLUDE_PATH_PAINEL);
    }
}
?>
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

                        if (isset($_POST['lembrar'])) {
                            setcookie('lembrar', true, time() + (60 * 60 * 24), '/');
                            setcookie('user', $user, time() + (60 * 60 * 24), '/');
                            setcookie('password', $password, time() + (60 * 60 * 24), '/');
                        }
                        Painel::redirect(INCLUDE_PATH . '/Perfil');
                    } else {
                        //Falhou
                        echo '<div class="erro-box"><i class="fa fa-times"></i> Usuário ou senha incorretos!</div>';
                    }
                }
                ?>
                <?php 
                $style = "";  
                    if(isset($_POST['acao']) && $_POST['acao'] == 'cad')
                ?>
                <div id="logar" <?php ?>>
                    <h3>Bem-vindo Novamente: </h3>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Digite seu e-mail...">
                    </div>
                    <div class="form-group">
                        <input type="password" name="senha" placeholder="Digite sua senha...">
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="lembrar">
                        <label for="">Lembrar-me</label>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Criar Conta">
                    </div>

                    <div class="form-group">
                        <input type="submit" name="acao" value="Logar">
                    </div>
                </div>

                <div id="cadastro" style="display: none;">
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
                        <input type="submit" name="acao" value="Logar">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="acao" value="Cadastrar">
                    </div>
                </div>
                <!--
                       
                    
                </form><!--formulario login -->

        </div>

    </div>
    <div style="height: 100px;"></div>
</section>