<?php 
    verificaPermissaoPagina(0);
?>
<?php 
    $sql = MySQL::conectar()->prepare("SELECT * FROM `tb_categoria`");
    $sql->execute();
    $categoria = $sql->fetchAll();
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

                $sucesso = true;
                if ($_FILES['imagem']['name'][0] != '') {
                    for ($i = 0; $i < $amountFiles; $i++) {
                        $imagemAtual = [
                            'type' => $_FILES['imagem']['type'][$i],
                            'size' => $_FILES['imagem']['size'][$i]
                        ];
    
                        if (Painel::imagemValida($imagemAtual) == false) {
                            $sucesso = false;
                            Painel::alert('erro', 'Uma das imagens selecionadas é invalida');
                            break;
                        }
                    }
                } else {
                    $sucesso = false;
                    Painel::alert('erro', 'Você precisa selecionar pelo menos uma imagem');
                }

                if($sucesso == true){
                    for ($i = 0; $i < $amountFiles; $i++) {
                        $imagemAtual = [
                            'tmp_name' => $_FILES['imagem']['tmp_name'][$i],
                            'name' => $_FILES['imagem']['name'][$i]
                        ];
                        $imagens[] = Painel::uploadFile($imagemAtual);
                    }
                    $sql = MySQL::conectar()->prepare("INSERT INTO `tb_produto.estoque` VALUES(null,?,?,?,?,?,?,?,?)");
                    $sql->execute(array($nome,$descricao,$largura,$altura,$comprimento,$peso,$quantidade,$preco));
                    $lastId = MySQL::conectar()->LastInsertId();
                    foreach($imagens as $key => $value){
                        $updateImagens = MySQL::conectar()->prepare("INSERT INTO `tb_produto.estoque_imagens` VALUES (null,?,?)");
                        $updateImagens->execute([$lastId, $value]);
                    }
                    Painel::alert('sucesso','Produto cadastrado com sucesso');
                }else{
                    Painel::alert('erro', 'Não foi possivel cadastrar este produto. <br>Por favor tente novamente');
                }
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
            <label for="">Categoria:</label>
            <select name="categorias">
                <?php foreach($categoria as $key => $value){?>
                    <option value=""><?php echo $value['nome']?></option>
                <?php } ?>
            <select>
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