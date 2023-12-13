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
            <h4><?php echo count($usuariosOnline);?></h4>            
        </div>
        <div class="box-metrica-single">
            <h3>Total de Visitas</h3>
            <h4><?php echo $pegarVisitasTotais;?></h4>
        </div>
        <div class="box-metrica-single">
            <h3>Visitas Hoje</h3>
            <h4><?php echo $pegarVisitasHoje;?></h4>
        </div>
        <div class="box-metrica-single">
            <h3>Vendas Feitas</h3>
            <h4><?php echo count($vendas)?></h4>
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
            <div class="col"><span><?php echo $value['ip']?></span></div>
            <div class="col"><span><?php echo date('d/m/Y H:i:s',strtotime($value['ultima_acao']));?></span></div>
            <div class="clear"></div>
        </div><!--ROW-->
        <?php }?>
    </div><!--TABLE RESPONSIVE-->
</section><!--content-->

<section class="box-content">
    <h2><i class="fa fa-handshake-o"></i> Vendas Realizadas: <?php echo count($vendas)?></h2>
    <div class="pedido-box">
        <?php 
            foreach($vendas as $key => $value){
            $produto = MySql::conectar()->prepare("SELECT * FROM `tb_produto.estoque` WHERE id=$value[produto_id]");
            $produto->execute();
            $produto = $produto->fetch();
            
        ?>
        <div class="pedido-wrapper w33" style="margin: 10px;">
            <div class="pedido-single">
                <?php if($produto['imagem'] != ''){?>
                    <img src="<?php echo INCLUDE_PATH_PERFIL?>uploads/<?php echo $produto['imagem']?>" alt="">
                <?php }else{?>
                    <img src="<?php echo INCLUDE_PATH?>images/transferir.jpg" alt="">
                <?php }?>
                <ul>
                    <li><i class="fa fa-info"></i><h4> <?php echo $value['nome']?></h4></li>
                    <li><i class="fa fa-info"></i><h4> Descricao:</h4> <?php echo substr($produto['descricao'],0,50)?> </li>
                    <li><i class="fa fa-info"></i><h4> Preço: R$</h4> <?php echo Painel::convertMoney($value['valor'])?></li>
                    <li><i class="fa fa-info"></i><h4> Quantidade: </h4> <?php echo $value['quantidade']?> </li>
                    <li><i class="fa fa-info"></i><h4> Modo de Pagamento: </h4> <?php echo $value['pag_tipo']?> </li>
                </ul>
            </div>
            
        </div>
        <?php }?>
    </div>
</section>