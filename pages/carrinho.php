<?php
$carrinho = MySql::conectar()->prepare("SELECT * FROM `tb_carrinho`");
$carrinho->execute();


$usuario = MySql::conectar()->prepare("SELECT * FROM `tb_cliente` WHERE id=$_SESSION[identifica]");
$usuario->execute();
$usuario = $usuario->fetch();
if($usuario['endereco_id'] != null || $usuario['endereco_id'] != ""){
    $endereco = MySql::conectar()->prepare("SELECT * FROM `tb_endereco` WHERE id=$usuario[endereco_id]");
    $endereco->execute();
    $endereco = $endereco->fetch();
}


$pag = MySql::conectar()->prepare("SELECT * FROM `tb_modo.pagamento` WHERE id=$usuario[pag_id]");
$pag->execute();
$pag = $pag->fetch();

//sessao
// $_SESSION['nome'] = $usuario['nome'];
// $_SESSION['cpf'] = $usuario['cpf'];
// @$_SESSION['endereco'] = $endereco['rua'];
// @$_SESSION['bairro'] = $endereco['bairro'];
// @$_SESSION['complemento'] = $endereco['logradouro'];
// @$_SESSION['cidade'] = $endereco['cidade'];
// @$_SESSION['estado'] = $endereco['estado'];
// $_SESSION['modoPagamento'] = $pag['tipo'];

?>
<?php
if (@$_SESSION['login'] == true && @$_SESSION['identifica'] != 0) {
?>
    <section >
    <?php var_dump($_SESSION['identifica']);?>
        <div class="center">
            <div class="box-carrinho">
                <div class="item-car w50 left">
                    <h4><i class="fa fa-shopping-basket"></i> Meu carrinho</h4>
                    <?php
                     if ($carrinho->rowCount() >= 1) { $carrinho = $carrinho->fetchAll();?>
                    <?php
                        $somaCart = 0;
                        foreach ($carrinho as $key => $value) {

                            $cartProduct = MySql::conectar()->prepare("SELECT * FROM `tb_produto.estoque` WHERE id=$value[compra_id]");
                            $cartProduct->execute();
                            $cartProduct = $cartProduct->fetch();

                            $categ = MySql::conectar()->prepare("SELECT * FROM `tb_categoria` WHERE id=$cartProduct[categoria_id]");
                            $categ->execute();
                            $categ = $categ->fetch();

                            $cor = MySql::conectar()->prepare("SELECT * FROM `tb_cor` WHERE id=$cartProduct[cor_id]");
                            $cor->execute();
                            $cor = $cor->fetch();


                        ?>
                            <form method="post" item_id="<?= $value['id'] ?>">
                                <?php
                                if (isset($_POST['limpar'])) {
                                    $item = $value['id'];
                                    $cart = $_POST['id_cart'];

                                    if ($item == $cart) {
                                        Painel::limparCart($item);
                                    }
                                    Painel::redirect(INCLUDE_PATH . 'carrinho');
                                }
                                ?>

                                <div class="content-item" item_id="<?php echo $value['id']; ?>">

                                    <div class="imagem-item w50 left">
                                        <?php $imagens = ($cartProduct['imagem'] == '') ? INCLUDE_PATH . 'images/transferir.jpg' : INCLUDE_PATH_PERFIL . 'uploads/' . $cartProduct['imagem']; ?>
                                        <img src="<?= $imagens ?>" alt="">
                                    </div>
                                    <div class="sobre-item left">
                                        <h5><?= $cartProduct['nome'] ?></h5>
                                        <h5>Categoria: <?= $categ['nome'] ?></h5>
                                        <h5>Cor: <?= $cor['nome_cor']; ?></h5>
                                        <h5>Valor R$ <b><?= Painel::convertMoney($cartProduct['preco'])  ?></b></h5>
                                        <h5>Quantidade: <b><?= $value['quantidade']; ?></b></h5>

                                    </div>

                                    <input type="hidden" name="id_cart" value="<?= $value['id']; ?>">
                                    <input type="submit" name="limpar" value="X">

                            </form>


                            <div class="clear"></div>
                        </div>

                        <?php
                            $nomeProduto = $cartProduct['nome'];
                            $categoriaProduto = $cartProduct['categoria_id'];
                            $corProduto = $cartProduct['cor_id'];
                            $idProduto = $cartProduct['id'];
                            $qntdItens = $value['quantidade'];
                            $somaCart += $cartProduct['preco'] *  $value['quantidade'];
                        } ?>
        <?php } else { ?>
            <h1 style="color:#ccc; text-align:center; margin: 50px 0;" ><i class="fa fa-shopping-cart" style="font-size: 38px;"></i> <br> Add ao Carrinho</h1>
        <?php 
            $somaCart = 0.00; 
            $nomeProduto = "";
            $categoriaProduto = 0;
            $corProduto = 0;
            $idProduto = 0;
            $qntdItens = 0;


            $button = 'display:none;';
        } ?>


            </div>
            <div class="info-car w50 right">
            <form  method="post">
                <?php
                $carrinho = MySql::conectar()->prepare("SELECT * FROM `tb_carrinho`");
                $carrinho->execute();

                if (isset($_POST['acao'])) {
                    if($carrinho->rowCount() == 0){
                        Painel::alert('erro','O Carrinho está Vázio.');
                    }else{
                        
                        Painel::finalizarCompra($nomeProduto,$categoriaProduto,$corProduto,$somaCart,$idProduto,$pag['id'],$qntdItens,$_SESSION['identifica']);
                        
                        Painel::alert('sucesso','Compra realizada com sucesso');
                        sleep(2);
                        Painel::redirect(INCLUDE_PATH . 'carrinho');
                    }
                        
                        
                    
                    
                }
                ?>
                <h4>Resumo da Compra</h4>
                <div class="info-resumo">
                    <ul>
                        <li>Nome Cliente: <b><?= ($usuario['nome'] ?? ""); ?></b></li>
                        <li>Cpf: <b><?= ($usuario['cpf'] ?? ""); ?></b></li>
                        <li>Endereço: <b><?= ($endereco['endereco'] ?? "") . ' ' . ($endereco['complemento'] ?? "") . ' - ' . ($endereco['bairro'] ?? "") . ' / ' . ($endereco['cidade'] ?? "") . ' - ' . ($endereco['estado'] ?? ""); ?></b></li>
                        <li>Metodo de Pagamento: <b><?= ($pag['tipo'] ?? ""); ?></b></li>
                        <li>Valor R$ <b><?= (Painel::convertMoney($somaCart) > 0) ? Painel::convertMoney($somaCart) : '0,00'; ?></b></li>

                    </ul>
                </div>
                
                    <input type="submit" name="acao" value="Finalizar Compra" >
                </form>
                
                
                <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>

        </div>
    </section>
<?php } else { ?>
    <section>
        <div class="center">
            <h2 style="text-align: center; margin:225px 0; text-transform: uppercase;">precisa estar logado para realizar a compra<br> <a style="color: #863E3F; border-bottom:1px solid #863E3F" href="<?= INCLUDE_PATH_PERFIL ?>">logue-se</a> antes</h2>

        </div>
    </section>
<?php } ?>