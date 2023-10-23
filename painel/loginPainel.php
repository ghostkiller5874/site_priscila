<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- estilização -->
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css">

    <title>Painel de controle</title>
</head>

<body>
    <section class="login">
        <div class="center">
            <div class="box-login">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Login:</label>
                        <input type="text" name="user">
                    </div>

                    <div class="form-group">
                        <label for="">Senha:</label>
                        <input type="password" name="senha">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="acao" value="Logar">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="lembrar" >
                        <label for="">lembrar-me</label>
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>

</html>