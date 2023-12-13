<?php verificaPermissaoPagina(0)?>
<?php
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $categoria = MySql::conectar()->prepare("SELECT * FROM `tb_categoria` WHERE id=?");
    $categoria->execute([$id]);
    $categoria = $categoria->fetch();
} else {
    Painel::alert('erro', 'É necessario passar um ID como parametro');
    die();
}
?>
<section class="box-content">
    <h2><i class="fa fa-pencil"></i> Editando a categoria - <b><?php echo $categoria['nome']; ?></b></h2>
    <form action="" method="post" enctype="multipart/form-data">
        <?php
        if (isset($_POST['acao'])) {
            $nome = $_POST['nome'];
            $imagem = $_FILES['imagem'];
            $imagemAtual = $_POST['imagem_atual'];
            $slug = Painel::generateSlug($_POST['nome']);


            if ($nome == '') {
                Painel::alert('erro', 'Campos vázios não são permitidos');
            } else {
                $verificar = MySql::conectar()->prepare("SELECT * FROM `tb_categoria` WHERE nome =?");
                $verificar->execute([$_POST['nome']]);
                if ($verificar->rowCount() == 1) {
                    Painel::alert('erro', 'Já existe uma categoria com este nome');
                } else {
                    if(Painel::imagemValida($imagem) == true || $imagem != ''){
                        Painel::deleteFile($imagemAtual);
                        $imagem = Painel::uploadFile($imagem);
                        $sql = MySql::conectar()->prepare("UPDATE `tb_categoria` SET nome = ?,slug=?, imagem=? WHERE id =$id");
                        $sql->execute([$nome, $slug,$imagem]);
                        Painel::alert('sucesso', 'Categoria atualizada com sucesso');

                    }else if(Painel::imagemValida($imagem) == false || $imagem == ''){
                        $sql = MySql::conectar()->prepare("UPDATE `tb_categoria` SET nome = ?,slug=? WHERE id =$id");
                        $sql->execute([$nome, $slug]);
                        Painel::alert('sucesso', 'Categoria atualizada com sucesso');
                    }else{
                        Painel::alert('erro','Algo de errado com a imagem');
                    }
                    
                }
            }
            $categoria = MySql::conectar()->prepare("SELECT * FROM `tb_categoria` WHERE id=?");
            $categoria->execute([$id]);
            $categoria = $categoria->fetch();
        }
        ?>
        <div class="form-group">
            <label for="">Nome da categoria:</label>
            <input type="text" name="nome" value="<?php echo $categoria['nome'] ?>">
        </div>
        <div class="form-group">
            <input type="file" name="imagem">
            <input type="hidden" name="imagem_atual" value="<?php echo $categoria['imagem'];?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Atualizar" name="acao">
        </div>
    </form>
</section>