<?php 
    $usuariosOnline = Painel::listarUsuariosOnline();

    $pegarVisitasTotais = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
    $pegarVisitasTotais->execute();
    $pegarVisitasTotais = $pegarVisitasTotais->rowCount();

    $pegarVisitasHoje = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia=?");
    $pegarVisitasHoje->execute([date('Y-m-d')]);
    $pegarVisitasHoje = $pegarVisitasHoje->rowCount();
?>

<?php

    $vendas = MySql::conectar()->prepare("SELECT * FROM `tb_pedido`");
    $vendas->execute();
    $vendas = $vendas->fetchAll();
?>
<section class="box-content">
    <h2><i class="fa fa-home"></i> Painel de Controle ADM</h2>
    <div class="box-metricas">
        <div class="box-metrica-single">
            <h3>Usuários Online</h3>
            <h4><?= count($usuariosOnline);?></h4>            
        </div>
        <div class="box-metrica-single">
            <h3>Total de Visitas</h3>
            <h4><?= $pegarVisitasTotais;?></h4>
        </div>
        <div class="box-metrica-single">
            <h3>Visitas Hoje</h3>
            <h4><?= $pegarVisitasHoje;?></h4>
        </div>
        <div class="box-metrica-single">
            <h3>Vendas Feitas</h3>
            <h4><?= count($vendas)?></h4>
        </div>
        <div class="clear"></div>
    </div>
</section>

<section class="box-content">
    <h2><i class="fa fa-rocket"></i> Usuários Online no Site</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col"><span>Ip</span></div>
            <div class="col"><span>Última ação</span></div>
            <div class="clear"></div>
        </div><!--ROW-->
        <?php 
            foreach($usuariosOnline as $key => $value){
        ?>
        <div class="row">
            <div class="col"><span><?= $value['ip']?></span></div>
            <div class="col"><span><?= date('d/m/Y H:i:s',strtotime($value['ultima_acao']));?></span></div>
            <div class="clear"></div>
        </div><!--ROW-->
        <?php }?>
    </div><!--TABLE RESPONSIVE-->
</section><!--content-->

<section class="box-content">
    <h2><i class="fa fa-handshake-o"></i> Vendas Realizadas: <?= count($vendas)?></h2>
    <div class="pedido-box">
        <?php 
            foreach($vendas as $key => $value){
            $produto = MySql::conectar()->prepare("SELECT * FROM `tb_produto.estoque` WHERE id=$value[produto_id]");
            $produto->execute();
            $produto = $produto->fetch();

            $modoPag = MySql::conectar()->prepare("SELECT tipo FROM `tb_modo.pagamento` WHERE id=$value[modo_pag]");
            $modoPag->execute();
            $modoPag = $modoPag->fetch();
            
        ?>
        <div class="pedido-wrapper w33" style="margin: 10px;">
            <div class="pedido-single">
                <?php if($produto['imagem'] != ''){?>
                    <img src="<?= INCLUDE_PATH_PERFIL?>uploads/<?= $produto['imagem']?>" alt="">
                <?php }else{?>
                    <img src="<?= INCLUDE_PATH?>images/transferir.jpg" alt="">
                <?php }?>
                <ul>
                    <li><i class="fa fa-info"></i><h4> <?= $value['nome_produto']?></h4></li>
                    <li><i class="fa fa-info"></i><h4> Descricao:</h4> <?= substr($produto['descricao'],0,50)?> </li>
                    <li><i class="fa fa-info"></i><h4> Preço: R$</h4> <?= Painel::convertMoney($value['soma_cart'])?></li>
                    <li><i class="fa fa-info"></i><h4> Quantidade: </h4> <?= $value['quantidade']?> </li>
                    <li><i class="fa fa-info"></i><h4> Modo de Pagamento: </h4> <?= $modoPag['tipo'];?> </li>
                </ul>
            </div>
            
        </div>
        <?php }?>
    </div>
</section>