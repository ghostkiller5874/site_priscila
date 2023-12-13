<?php verificaPermissaoPagina(0)?>
<?php
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $produtos = MySql::conectar()->prepare("SELECT * FROM `tb_produto.estoque` WHERE id=?");
    $produtos->execute([$id]);
    $produtos = $produtos->fetch();
} else {
    Painel::alert('erro', 'É necessario passar um ID como parametro');
    die();
}

$categoria = MySql::conectar()->prepare("SELECT * FROM `tb_categoria`");
$categoria->execute();
$categoria = $categoria->fetchAll();

$cor = MySql::conectar()->prepare("SELECT * FROM `tb_cor`");
$cor->execute();
$cor = $cor->fetchAll();
?>
<section class="box-content">
    <h2><i class="fa fa-pencil"></i> Edição do produto - <b><?php echo $produtos['nome']; ?></b></h2>
    <form method="post" enctype="multipart/form-data">
        <?php 
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $desc = $_POST['descricao'];
                $categoria_id = $_POST['categoria_id'];
                $cor_id = $_POST['cor_id'];
                $largura = $_POST['largura'];
                $altura = $_POST['altura'];
                $comprimento = $_POST['comprimento'];
                $peso = $_POST['peso'];
                $quantidade = $_POST['quantidade'];
                $preco = Painel::formatarMoedaBd($_POST['preco']);
                $imagemAtual = $_POST['imagem_atual'];
                $imagem = $_FILES['imagem'];

                if(Painel::imagemValida($imagem) == true || $imagem != ''){
                    Painel::deleteFile($imagemAtual);
                    $imagem = Painel::uploadFile($imagem);
                    $sql = MySql::conectar()->prepare("UPDATE `tb_produto.estoque` SET nome=?, descricao=?, largura=?, altura=?, comprimento=?, peso=?, quantidade=?, preco=?, categoria_id=?, cor_id=?, imagem=?  WHERE id=$id");
                    $sql->execute([$nome,$desc,$largura,$altura,$comprimento,$peso,$quantidade,$preco,$categoria_id,$cor_id, $imagem]);

                    Painel::alert('sucesso','Produto atualizado com sucesso');

                }else if(Painel::imagemValida($imagem) == false){
                    Painel::alert('erro','Imagem invalida');
                }else{
                    Painel::alert('erro','Houve erro ao atualizar');
                }


                
                $produtos = MySql::conectar()->prepare("SELECT * FROM `tb_produto.estoque` WHERE id=?");
                $produtos->execute([$id]);
                $produtos = $produtos->fetch();
            }
        ?>
    <div class="form-group">
            <label>Nome do produto</label>
            <input type="text" name="nome" value="<?php echo $produtos['nome']?>">
        </div>
        <div class="form-group">
            <label for="">Descrição do Produto</label>
            <textarea name="descricao" style="resize: vertical;" ><?php echo $produtos['descricao'];?></textarea>
        </div>

        <div class="form-group">
            <label for="">Categoria:</label>
            <select name="categoria_id">
                <?php foreach ($categoria as $key => $value) { ?>
                    <option <?php if ($value['id'] == @$_POST['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id']; ?>"><?php echo $value['nome'] ?></option>
                <?php } ?>
                <select>
        </div>

        <div class="form-group">
            <label for="">Cor:</label>
            <?php foreach ($cor as $key => $value) { ?>   
                <input  type="checkbox" name="cor_id" value="<?php echo $value['id']?>" <?php if ($value['id'] == $produtos['cor_id']) echo 'checked'; ?>>
                <label style="display: inline; margin-right:8px;" for="<?php echo $value['id']?>"><?php echo $value['nome'];?></label>
            <?php } ?>
        </div>

        <div class="form-group">
            <label for="">Largura do produto:</label>
            <input type="number" name="largura" min="0" max="900" step="5" value="<?php echo $produtos['largura']?>">
        </div>
        <div class="form-group">
            <label for="">Altura do produto:</label>
            <input type="number" name="altura" min="0" max="900" step="5" value="<?php echo $produtos['altura']?>">
        </div>
        <div class="form-group">
            <label for="">Comprimento do produto:</label>
            <input type="number" name="comprimento" min="0" max="900" step="5" value="<?php echo $produtos['comprimento']?>">
        </div>
        <div class="form-group">
            <label for="">Peso do produto:</label>
            <input type="number" name="peso" min="0" max="900" step="5" value="<?php echo $produtos['peso']?>">
        </div>
        <div class="form-group">
            <label for="">Quantidade do produto:</label>
            <input type="number" name="quantidade" min="0" max="900" step="5" value="<?php echo $produtos['quantidade']?>">
        </div>
        <div class="form-group">
            <label for="">Preço do produto:</label>
            <input type="text" name="preco" value="<?php echo $produtos['preco']?>">
        </div>
        <div class="form-group">
            <input type="hidden" name="imagem_atual" value="<?php echo $produtos['imagem']?>">
            <input type="file" name="imagem">
        </div>

        <div class="form-group">
            <input type="submit" value="Atualizar" name="acao">
        </div>
    </form>

</section>