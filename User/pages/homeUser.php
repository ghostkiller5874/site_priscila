<?php 
   $pedido = MySql::conectar()->prepare("SELECT * FROM `tb_pedido` WHERE cliente_id=$_SESSION[identifica]");
   $pedido->execute();
   $pedido = $pedido->fetchAll();
?>
<section class="box-content">
   <h1><i class="fa fa-credit-card-alt"></i> Pedidos Realizados: <?php echo count($pedido)?></h1> 
   <div class="pedido-box">
   <?php 
            foreach($pedido as $key => $value){
               $produto = MySql::conectar()->prepare("SELECT * FROM `tb_produto.estoque` WHERE id=$value[produto_id]");
               $produto->execute();
               $produto = $produto->fetch();
         ?>
      <div class="pedido-wrapper w33" style="margin: 10px;">
         
         <div class="pedido-single">
            <img src="<?php echo INCLUDE_PATH_PERFIL?>uploads/<?php echo $produto['imagem']?>" alt="">
           
            <ul>
               <li><i class="fa fa-info"></i><h4> <?php echo $value['nome_produto']?></h4></li>
               <li><i class="fa fa-info"></i><h4> Descricao:</h4> <?php echo substr($produto['descricao'],0,50)?> </li>
               <li><i class="fa fa-info"></i><h4> Preço: R$</h4> <?php echo Painel::convertMoney($value['soma_cart'])?></li>
            </ul>
            
         </div>
         
      </div>
      <?php }?>
   </div>
</section>
