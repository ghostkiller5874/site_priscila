<section>
    <div class="center">
        <div class="box-carrinho">
            <div class="item-car w50 left">
                <h4><i class="fa fa-shopping-basket"></i> Meu carrinho</h4>
                <?php for($o=0;$o < 3;$o++){?>
                <div class="content-item">
                    <div class="imagem-item w50 left">
                        <img src="<?php echo INCLUDE_PATH ?>images/pulseira.jpg" alt="">
                    </div>
                    <div class="sobre-item left">
                       <h5><?php echo "Pulseira";?></h5>
                       <h5><?php echo "Bijuteria";?></h5>
                       <h5><?php echo "dourado";?></h5>
                       <h5>Valor <b><?php echo "R$ 50,00"?></b></h5>
                       <form action="" method="post">
                        <select name="" id="">
                            <?php 
                            $qntd = 5;
                            for($i=1;$i<=$qntd;$i++){?>
                            <option value=""><?php echo $i;?></option>
                            <?php }?>
                        </select>
                       </form>
                       
                    </div>
                    <button>X</button>
                    <div class="clear"></div>
                </div>
                <?php }?>
                
                <?php 
                    $sql = MySQL::conectar()->prepare("SELECT * FROM `tb_usuario`");
                    $sql->execute();

                    $info = $sql->fetch();
                
                ?>

            </div>
            <div class="info-car w50 right">
                <h4>Resumo da Compra</h4>
                <div class="info-resumo">
                    <ul>
                        <li>Nome Cliente: <b><?php echo $info['email'];?></b></li>
                        <li>Cpf: <b><?php echo "015.256.325-85";?></b></li>
                        <li>Endereço: <b><?php echo "Rua josé lindo rego";?></b></li>
                        <li>Metodo de Pagamento: <b><?php echo "Cartão de credito";?></b></li>
                        <li>Valor <b><?php $val = 50*3;echo "R$ $val,00"?></b></li>
                    </ul>
                </div>
                <button>Finalizar Compra</button>
                <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>
    </div>
</section>