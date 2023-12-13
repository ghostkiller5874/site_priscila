<?php
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        
        $produto = MySql::conectar()->prepare("SELECT * FROM `tb_produto.estoque` WHERE id=?");
        $produto->execute([$id]);
        $produto = $produto->fetch();
    }else{
        Painel::redirect(INCLUDE_PATH);
    }
?>
<section>
    <div class="center">
        <!--    imagens passarem com click    -->
        <div class="box-produto">
            <div class="produto-content">
               <div class="produto-img w50 left">
                <?php if($produto['imagem'] != ''){?>
                    <img src="<?php echo INCLUDE_PATH_PERFIL?>uploads/<?php echo $produto['imagem'];?>" alt="">
                <?php }else{?>
                    <img src="<?php echo INCLUDE_PATH?>images/transferir.jpg" alt="">
                <?php }?>
                </div> 
                <div class="produto-comprar w50 left">
                    <p><?php echo $produto['nome']?><br><?php echo substr($produto['descricao'],0,100);?></p>
                    <form action="" method="post">
                        <?php 
                            if(isset($_POST['acao']) || isset($_POST['addCart'])){
                                $qntd_id = (int)$_POST['qntd_id'];

                                //MySql::conectar()->exec("UPDATE `tb_produto.estoque` SET quantidade=(quantidade - $qntd_id) WHERE id=$id");
                                
                                Painel::carrinhoAdd($id,$qntd_id,$_SESSION['identifica']);
                            }
                        ?>
                        <div class="form-group">
                        <p>Preço R$ <b><?php echo Painel::convertMoney($produto['preco'])?></b></p>
                        <?php
                            $cor = MySql::conectar()->prepare("SELECT * FROM `tb_cor` WHERE id=$produto[cor_id]");
                            $cor->execute();
                            $cor = $cor->fetch();
                        ?>
                            <p style="margin-bottom: 8px;">Cor: <b><?php echo $cor['nome']; ?></b></p>
                            
                        </div>
                        <div class="form-group">
                            <label for="">Quantidade:</label>
                            <select name="qntd_id" id="">
                                <?php for($i=1; $i <= $produto['quantidade']; $i++){?>
                                <option value="<?php echo $i;?>"><?php echo $i?></option>
                                <?php }?>
                            </select>
                            
                        </div>
                        
                        <div style="margin: 10px 0;">
                           <div class="form-group">
                            <input type="submit" name="addCart" value="Adicionar ao carrinho" >
                        </div>
                        <div class="form-group">
                            <input type="submit" name="acao" value="Comprar">
                        </div> 
                        </div>
                        
                    </form>
                    
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="produto-descricao">
                <h3>Descrição do Produto</h3>
                <p><?php echo $produto['descricao'];?></p>
            </div>
        </div>
    </div>
</section>