<?php
$categoria = MySql::conectar()->prepare("SELECT*FROM `tb_categoria`");
$categoria->execute();
$categoria = $categoria->fetchAll();

$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 10;
$inicio = ($paginaAtual * $porPagina) - $porPagina;

if (isset($_GET['categoria']) && $_GET['categoria'] != '') {
    $queryCategoria = (int)$_GET['categoria'];

    $produtos = MySql::conectar()->prepare("SELECT * FROM `tb_produto.estoque` ORDER BY categoria_id=$queryCategoria DESC LIMIT $inicio,$porPagina");
    $produtos->execute();
    $produtos = $produtos->fetchAll();
} else {
    $produtos = MySql::conectar()->prepare("SELECT * FROM `tb_produto.estoque` ORDER BY nome ASC LIMIT $inicio,$porPagina");
    $produtos->execute();
    $produtos = $produtos->fetchAll();
}


?>

<section>
    <div class="center">
        <!--
        <div class="box-acs">
            <div class="nav back"><p>&laquo;</p></div>
            <?php foreach ($categoria as $key => $value) { ?>
                <a href="<?php echo INCLUDE_PATH ?>?categoria=<?php echo $value['id'] ?>">
                    <div class="box-acs-single w33">
                        <div class=" imagem">
                            <img src="<?php echo INCLUDE_PATH_PERFIL ?>uploads/<?php echo $value['imagem']; ?>" alt="">
                            <h4><?php echo $value['nome']; ?></h4>
                        </div>
                    </div>
                </a>
            <?php } ?>
            <div class="nav forth"><p>&raquo;</p></div>
            <div class="clear"></div>
        </div>-->

        <div class="box_carrossel">
        <div class="nav back">
            <p>&laquo;</p>
        </div>
        <ul class="carrossel">
                <?php foreach($categoria as $key =>$value){?>
            <li class="item">
                <a href="<?php echo INCLUDE_PATH?>?categoria=<?php echo $value['id']?>">
                  <img src="<?php echo INCLUDE_PATH_PERFIL ?>uploads/<?php echo $value['imagem']; ?>" />
                    <h4><?php echo $value['nome']; ?></h4>  
                </a> 
            <li>
            <?php }?>
        </ul>
        <div class="nav forth">
            <p>&raquo;</p>
        </div>
        <div class="clear"></div>
    </div>
    </div>

    <div class="clear"></div>
</section>
<section>
    <div class="center">
        <?php
        foreach ($produtos as $key => $value) {
        ?>
            <div class="container">

                <div class="box-joia w30 left">
                    <?php if ($value['imagem'] != '') { ?>
                        <a href="<?php echo INCLUDE_PATH; ?>produto?id=<?php echo $value['id']; ?>"><img src="<?php echo INCLUDE_PATH_PERFIL ?>uploads/<?php echo $value['imagem']; ?>" alt=""></a>
                    <?php } else { ?>
                        <a href="<?php echo INCLUDE_PATH; ?>produto?id=<?php echo $value['id']; ?>"><img src="<?php echo INCLUDE_PATH ?>images/transferir.jpg" alt=""></a>
                    <?php } ?>

                </div>
                <div class="box-descricao w70 left">
                    <h2><a href="<?php echo INCLUDE_PATH; ?>produto?id=<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></a></h2>
                    <?php
                    $categoria_home = MySql::conectar()->prepare("SELECT * FROM `tb_categoria` WHERE id=$value[categoria_id]");
                    $categoria_home->execute();
                    $categoria_home = $categoria_home->fetch();
                    ?>

                    <p>Categoria: <b><?php echo ucfirst($categoria_home['nome']) ?></b></p>

                    <p>Por <b>R$ <?php echo $value['preco']; ?></b></p>

                    <?php
                    $cor = MySql::conectar()->prepare("SELECT * FROM `tb_cor` WHERE id=$value[cor_id]");
                    $cor->execute();
                    $cor = $cor->fetch();
                    ?>
                    <p style="margin-bottom: 8px;">Cor: <b><?php echo $cor['nome_cor']; ?></b></p>


                    <a class="comprar" href="<?php echo INCLUDE_PATH ?>produto?id=<?php echo $value['id']; ?>">Comprar</a>

                </div>


            </div>
        <?php } ?>
        <div class="clear"></div>
    </div>
    <div class="paginacao">
        <?php
        $carregaPages = MySql::conectar()->prepare("SELECT * FROM `tb_produto.estoque` ORDER BY nome ASC");
        $carregaPages->execute();
        $carregaPages = $carregaPages->fetchAll();
        $totalPaginas = ceil(count($carregaPages) / $porPagina);
        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($i == $paginaAtual)
                echo '<span><a href="' . INCLUDE_PATH . '?pagina=' . $i . '" class="active-page">' . $i . '</a></span>';
            else
                echo '<span><a href="' . INCLUDE_PATH . '?pagina=' . $i . '">' . $i . '</a></span>';
        } //caso de problema, colocar de volta a referencia a "home"
        ?>
    </div>
</section>