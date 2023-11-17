<?php 
    verificaPermissaoPagina(0);
?>
<section class="box-content">
    <h2><i class="fa fa-pencil"></i> Adicione um produto: </h2>
    <form method="post" enctype="multipart/form-data">
        <?php 
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $descricao = $_POST['descricao'];
                $largura = $_POST['largura'];
                $altura = $_POST['altura'];
                $comprimento = $_POST['comprimento'];
                $peso = $_POST['peso'];
                $quantidade = $_POST['quantidade'];
                $preco = Painel::formatarMoedaBd($_POST['preco']);
                $imagens = array();
                $amountFiles = count($_FILES['imagem']['name']);
            }
        ?>
        <div class="form-group">
            <label >Nome do produto</label>
            <input type="text" name="nome" placeholder="Camiseta preta">
        </div>
        <div class="form-group">
            <label for="">Descrição do Produto</label>
            <textarea name="descricao" style="resize: vertical;" placeholder="Camiseta preta manga longa slim"></textarea>
        </div>
        <div class="form-group">
            <label for="">Largura do produto:</label>
            <input type="number" name="largura" min="0" max="900" step="5" value="0">
        </div>
        <div class="form-group">
            <label for="">Altura do produto:</label>
            <input type="number" name="altura" min="0" max="900" step="5" value="0">
        </div>
        <div class="form-group">
            <label for="">Comprimento do produto:</label>
            <input type="number" name="comprimento" min="0" max="900" step="5" value="0">
        </div>
        <div class="form-group">
            <label for="">Peso do produto:</label>
            <input type="number" name="peso" min="0" max="900" step="5" value="0">
        </div>
        <div class="form-group">
            <label for="">Quantidade do produto:</label>
            <input type="number" name="quantidade" min="0" max="900" step="5" value="0">
        </div>
        <div class="form-group">
            <label for="">Preço do produto:</label>
            <input type="text" name="preco" >
        </div>
        <div class="form-group">
            <input type="file" name="imagens[]" multiple>
        </div>

        <div class="form-group">
            <input type="submit" value="Cadastrar" name="acao">
        </div>
    </form>
</section>