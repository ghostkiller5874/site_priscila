<?php verificaPermissaoPagina(0) ?>
<?php

$sql = MySql::conectar()->prepare("SELECT * FROM `tb_cor`");
$sql->execute();
$cor = $sql->fetchAll();

?>
<section class="box-content">
    <h2><i class="fa fa-id-card-o"></i> Cores Existentes</h2>
    <div class="wraper-table">

        <table>
            <?php
            if (isset($_GET['excluir'])) {
                $idExcluir = (int)$_GET['excluir'];

                MySql::conectar()->exec("DELETE FROM `tb_cor` WHERE id=$idExcluir");
                Painel::alert('sucesso', 'Cor deletada com sucesso');
            }
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_cor`");
            $sql->execute();
            $cor = $sql->fetchAll();

            ?>
            <tbody>
                <tr>
                    <td>Nome</td>
                    <td>#</td>
                    <td>#</td>

                </tr>
                <?php

                foreach ($cor as $key => $value) {

                ?>
                    <tr>
                        <td><?php echo $value['nome']; ?></td>
                        <td><a class="btn delete" href="<?php echo INCLUDE_PATH_PERFIL ?>lista-cores?excluir=<?php echo $value['id']; ?>" ><i class="fa fa-times"></i> Excluir</a></td>
                        <td><a href="<?php echo INCLUDE_PATH_PERFIL ?>editar-cor?id=<?php echo $value['id']; ?>" class="btn edit"><i class="fa fa-pencil"></i> Editar</a></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>
