<?php
verificaPermissaoPagina(0);
?>
<?php
$sql = MySql::conectar()->prepare("SELECT * FROM `tb_categoria`");
$sql->execute();
$categoria = $sql->fetchAll();

$cor = MySql::conectar()->prepare("SELECT * FROM `tb_cor`");
$cor->execute();
$cor = $cor->fetchAll();
?>
<section class="box-content">
    <h2><i class="fa fa-pencil"></i> Adicione um produto: </h2>
    <form method="post" enctype="multipart/form-data">
        
        <?php
        if (isset($_POST['acao'])) {
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $largura = $_POST['largura'];
            $altura = $_POST['altura'];
            $comprimento = $_POST['comprimento'];
            $peso = $_POST['peso'];
            $quantidade = $_POST['quantidade'];
            $preco = Painel::formatarMoedaBd($_POST['preco']);
            $categoria_id = $_POST['categoria_id'];
            $cor_id = $_POST['cor_id'];
            $imagem = $_FILES['imagem'];




            if (Painel::imagemValida($imagem) == false || $imagem == '') {
                Painel::alert('erro', 'Imagem invalida');
            } else {
                $imagem = Painel::uploadFile($imagem);
                $sql = MySql::conectar()->prepare("INSERT INTO `tb_produto.estoque` VALUES(null,?,?,?,?,?,?,?,?,?,?,?)");
                $sql->execute(array($nome, $descricao, $largura, $altura, $comprimento, $peso, $quantidade, $preco, $categoria_id,$cor_id,$imagem));
                
                Painel::alert('sucesso', 'Produto cadastrado com sucesso');
                Painel::redirect(INCLUDE_PATH_PERFIL.'cadastrar-produtos');
            }
        } // fazer testes
        ?>
        <div class="form-group">
            <label>Nome do produto</label>
            <input type="text" name="nome" placeholder="Camiseta preta" value="<?=($_POST['nome'] ?? "");?>">
        </div>
        <div class="form-group">
            <label for="">Descrição do Produto</label>
            <textarea name="descricao" style="resize: vertical;" placeholder="Camiseta preta manga longa slim"><?=($_POST['descricao'] ?? "");?></textarea>
        </div>
        <div class="form-group">
            <label for="">Categoria:</label>
            <select name="categoria_id">
                <?php foreach ($categoria as $key => $value) { ?>
                    <option <?php if ($value['id'] == @$_POST['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id']; ?>"><?php echo ($value['nome'] ?? "") ?></option>
                <?php } ?>
                <select>
        </div>
        <div class="form-group">
            <label for="">Cor:</label>
            
            <select name="cor_id">
                <?php foreach ($cor as $key => $value) { ?>   
                    <option <?php if ($value['id'] == @$_POST['cor_id']) echo 'selected'; ?> value="<?php echo $value['id']; ?>"><?php echo ($value['nome_cor'] ?? "") ?></option>
                <?php } ?>
                <select>
                 
                <!--<input type="checkbox" name="cor_id" value="<?php echo $value['id']?>">
                <label style="display: inline; margin-right:8px;" for="<?php echo $value['id']?>"><?php echo $value['nome'];?></label>-->
                
        </div>
        <div class="form-group">
            <label for="">Largura do produto:</label>
            <input type="number" name="largura" min="0" max="900" step="5" value="<?=($_POST['largura'] ?? 0);?>" >
        </div>
        <div class="form-group">
            <label for="">Altura do produto:</label>
            <input type="number" name="altura" min="0" max="900" step="5" value="<?=($_POST['altura'] ?? 0);?>">
        </div>
        <div class="form-group">
            <label for="">Comprimento do produto:</label>
            <input type="number" name="comprimento" min="0" max="900" step="5" value="<?=($_POST['comprimento'] ?? 0);?>" >
        </div>
        <div class="form-group">
            <label for="">Peso do produto:</label>
            <input type="number" name="peso" min="0" max="900" step="5" value="<?=($_POST['peso'] ?? 0);?>" >
        </div>
        <div class="form-group">
            <label for="">Quantidade do produto:</label>
            <input type="number" name="quantidade" min="0" max="900" step="5" value="<?=($_POST['quantidade'] ?? 0);?>" >
        </div>
        <div class="form-group">
            <label for="">Preço do produto:</label>
            <input type="text" name="preco" value="<?=($_POST['preco'] ?? "");?>">
        </div>
        <div class="form-group">
            <input type="file" name="imagem">
        </div>

        <div class="form-group">
            <input type="submit" value="Cadastrar" name="acao">
        </div>
    </form>
</section>