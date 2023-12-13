<?php verificaPermissaoPagina(0)?>
<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $cor = MySql::conectar()->prepare("SELECT * FROM `tb_cor` WHERE id=?");
        $cor->execute([$id]);
        $cor = $cor->fetch();
    }
?>
<section class="box-content">
    <h2><i class="fa fa-pencil"></i> Editando cor </h2>
    <form method="post">
        <?php 
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];

                $sql = MySql::conectar()->prepare("UPDATE `tb_cor` SET nome=? WHERE id=$id");
                $sql->execute([$nome]);
                Painel::alert('sucesso','Cor atualizada com sucesso');

                $cor = MySql::conectar()->prepare("SELECT * FROM `tb_cor` WHERE id=?");
                $cor->execute([$id]);
                $cor = $cor->fetch();
            }
        ?>
        <div class="form-group">
            <label>Nome da Cor</label>
            <input type="text" name="nome" value="<?php echo $cor['nome']?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Atualizar" name="acao">
        </div>
    </form>
</section>