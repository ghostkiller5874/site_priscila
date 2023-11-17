<?php verificaPermissaoPagina(0) ?>
<?php

$sql = MySQL::conectar()->prepare("SELECT * FROM `tb_categoria`");
$sql->execute();
$categoria = $sql->fetchAll();

?>
<section class="box-content">
    <h2><i class="fa fa-id-card-o"></i> Categorias Cadastradas</h2>
    <div class="wraper-table">
        <table>
            <?php
                if (isset($_GET['excluir'])) {
                    $idExcluir = (int)$_GET['excluir'];
                    $sql=MySQL::conectar()->prepare("SELECT imagem FROM `tb_categoria` WHERE id=$idExcluir");
                    $sql->execute();
                    @$imagem = $sql->fetch()['imagem'];
                
                    @unlink('uploads/'.$imagem);
                    
                    MySQL::conectar()->exec("DELETE FROM `tb_categoria` WHERE id=$idExcluir");
                    Painel::alert('sucesso','A categoria foi deletada com sucesso');
                }
            ?>
            <tbody>
                <tr>
                    <td>Nome</td>
                    <td>Imagem</td>
                    <td>#</td>
                    <td>#</td>

                </tr>
                <?php
                    
                foreach ($categoria as $key => $value) {
                     
                ?>
                    <tr>
                        <td><?php echo $value['nome']; ?></td>
                        <td><img src="<?php echo INCLUDE_PATH_PERFIL ?>uploads/<?php echo $value['imagem']; ?>"></td>
                        <td><a class="btn delete" href="<?php echo INCLUDE_PATH_PERFIL ?>gerenciar-categoria?excluir=<?php echo $value['id']; ?>" item_id="<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
                        <td><a href="<?php echo INCLUDE_PATH_PERFIL ?>editar-categoria?id=<?php echo $value['id']; ?>" class="btn edit"><i class="fa fa-pencil"></i> Editar</a></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>