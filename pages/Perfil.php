<?php 
    if(isset($_GET['logout'])){
        Painel::loggout();
    }

    $sql = MySQL::conectar()->prepare("SELECT `email` FROM tb_usuario");
    $sql->execute();
    $info = $sql->fetch();
?>
<section>
        <div class="sidebar left" >
            <h4><i class="fa fa-user"></i></h4>
            <h4><i class="fa fa-bars"></i></h4>
            <h4><a href="<?php echo INCLUDE_PATH;?>login?logout"><i class="fa fa-power-off"></i></a></h4>
            <h4><?php echo $info['email'];?></h4>
            <ul>
                <li><a href="">Perfil</a></li>
                <li><a href="">Modo de Pagamento</a></li>
            </ul>
            <div class="clear"></div>
        </div>

        <div class="center">
            <div class="box-perfil">
            <h4><i class="fa fa-user"></i> Usuario Padrao</h4>
            

            <form action="" method="post">
                <div class="form-group">
                    <label for="">Nome:</label>
                    <input type="text" name="nome">
                </div>
                <div class="form-group">
                    <label for="">Email:</label>
                    <input type="text" name="email">
                </div>
                <div class="form-group">
                    <label for="">Telefone:</label>
                    <input type="text" name="telefone">
                </div>
                <div class="form-group">
                    <label for="">Endereço:</label>
                    <input type="text" name="endereco">
                </div>
                <div class="form-group">
                    <label for="">Bairro:</label>
                    <input type="text" name="bairro">
                </div>
                <div class="form-group">
                    <label for="">Cep:</label>
                    <input type="text" name="cep">
                </div>
                <div class="form-group">
                    
                    <input type="submit" name="acao" value="Enviar">
                </div>
                <div class="clear"></div>
            </form>
            </div>
            
        </div>
</section>