<?php verificaPermissaoPagina(0)?>
<section class="box-content">
    <h2><i class="fa fa-barcode"></i> Produtos Cadastrados</h2>
    <div class="busca">
        <form action="" method="post">
        <h4><i class="fa fa-search"></i> Qual produto está procurando? :</h4>
            <div class="form-group">
                <input type="text" name="busca" placeholder="Procure por nome ou descrição">
                <input type="submit" value="Buscar" name="pesquisar">
                <div class="clear"></div>
            </div>
        </form>
    </div><!-- busca -->
    
    <div class="boxes">
        <?php 
            if(isset($_GET['excluir'])){
                $idExcluir = (int)$_GET['excluir'];
                
                $sql = MySql::conectar()->prepare("SELECT imagem FROM `tb_produto.estoque` WHERE id=$idExcluir");
                $sql->execute();
                @$imagem = $sql->fetch()['imagem'];

                @unlink('uploads/'.$imagem);

                MySql::conectar()->exec("DELETE FROM `tb_produto.estoque` WHERE id=$idExcluir");

                Painel::alert('sucesso','Produto excluido com sucesso');
            }
            if(isset($_POST['atualizar'])){
                $quantAtual = $_POST['qntd'];
                $produto_id = $_POST['produto_id'];
                if($quantAtual <= 0){
                    Painel::alert('erro','Não pode inserir 0 ou qualquer valor abaixo dele');
                }else{
                    MySql::conectar()->exec("UPDATE `tb_produto.estoque` SET quantidade=$quantAtual WHERE id=$produto_id");
                    Painel::alert('sucesso','Quantidade atualizada com sucesso');
                }
                
            }
        ?>
        <?php 
           $query = "";
           if (isset($_POST['pesquisar'])) {
               $busca = $_POST['busca'];
               $query = " WHERE (nome LIKE '%$busca%' OR descricao LIKE '%$busca%')";
           }
           /*
           if ($query == '') {
               $query2 = " WHERE quantidade > 0";
           } else {
               $query2 = " AND quantidade > 0";
           }*/

            $produtos = MySql::conectar()->prepare("SELECT * FROM `tb_produto.estoque` $query");
            $produtos->execute();
            $produtos = $produtos->fetchAll();

            foreach($produtos as $value){
            $categoria = MySql::conectar()->prepare("SELECT nome FROM `tb_categoria` WHERE id=$value[categoria_id]");
            $categoria->execute();
            $categoria = $categoria->fetch()['nome'];
        ?>
        <div class="box-single-wrapper w33">
            <div class="box-single">
                <div class="topo-box">
                    <?php if($value['imagem'] == ''){?>
                    <h2><i class="fa fa-user"></i></h2>
                    <?php }else{?>
                    <img src="<?php echo INCLUDE_PATH_PERFIL?>uploads/<?php echo $value['imagem'];?>" >
                    <?php }?>
                </div>
                <div class="body-box">
                    <p><b><i class="fa fa-info"></i> Nome do produto:</b> <?php echo $value['nome']?></p>
                    <p><b><i class="fa fa-info"></i> Descrição do produto:</b> <?php echo substr($value['descricao'],0,200);?></p>
                    <p><b><i class="fa fa-info"></i> Largura (cm):</b> <?php echo $value['largura']?></p>
                    <p><b><i class="fa fa-info"></i> Altura (cm):</b> <?php echo $value['altura']?></p>
                    <p><b><i class="fa fa-info"></i> Comprimento (cm):</b> <?php echo $value['comprimento']?></p>
                    <p><b><i class="fa fa-info"></i> Peso (g):</b> <?php echo $value['peso']?></p>
                    <p><b><i class="fa fa-info"></i> Quantidade:</b> <form action="" method="post">
                        <input type="hidden" name="produto_id" value="<?php echo $value['id'];?>">
                        <input type="number" name="qntd" step="5" min="0" max="900" value="<?php echo $value['quantidade']?>">
                        <input type="submit" value="Atualizar" name="atualizar">
                    </form></p>
                    <p><b><i class="fa fa-info"></i> Categoria:</b> <?php echo $categoria;?></p>
                    <p><b><i class="fa fa-info"></i> Preço: R$ </b> <?php echo $value['preco'];?></p>

                    <div class="group-btn">
                        <a href="<?php echo INCLUDE_PATH_PERFIL?>gerenciar-produtos?excluir=<?php echo $value['id'];?>" class="btn delete"><i class="fa fa-times"></i> Excluir</a>
                        <a href="<?php echo INCLUDE_PATH_PERFIL?>editar-produto?id=<?php echo $value['id'];?>" class="btn edit"><i class="fa fa-pencil"></i> Editar</a>
                    </div>
                    
                    
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <?php }?>
    </div><!-- box produto -->

</section>