<?php verificaPermissaoPagina(0) ?>
<section class="box-content">
    <h2><i class="fa fa-pencil"></i> Cadastrar Categoria e cor</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <?php
        if (isset($_POST['acao'])) {
            $categoria = $_POST['nome'];
            $cor = $_POST['nome_cor'];
            $imagem = $_FILES['imagem'];

            if ($categoria == '') {
                //Painel::alert('erro', 'Campos vázios não são permitidos');
            } else {
                $verificar = MySql::conectar()->prepare("SELECT * FROM `tb_categoria` WHERE nome =?");
                $verificar->execute([$_POST['nome']]);
                if ($verificar->rowCount() == 1) {
                    Painel::alert('erro', 'Já existe uma categoria com este nome');
                } else {
                        if(Painel::imagemValida($imagem) == false || $imagem == ''){ Painel::alert('erro','Imagem Invalida');
                        }else{
                        $image = Painel::uploadFile($imagem);
                        $slug = Painel::generateSlug($categoria);
                        $sql = MySql::conectar()->prepare("INSERT INTO `tb_categoria` VALUES (null,?,?,?)");

                        $sql->execute([$categoria, $slug, $image]);
                        Painel::alert('sucesso', 'Cadastrou a categoria com sucesso');
                    }
                }
            }

            // cadastro da cor
            $verificaCor = MySql::conectar()->prepare("SELECT * FROM `tb_cor` WHERE nome=?");
            $verificaCor->execute([$_POST['nome_cor']]);
            if($verificaCor->rowCount() == 1){
                Painel::alert('erro','Está cor já existe no banco de dados');
            }else{
                $corInsert = MySql::conectar()->prepare("INSERT INTO `tb_cor` VALUES(null,?,0)");
                $corInsert->execute([$cor]);
                Painel::alert('sucesso','Cor cadastrada com sucesso');
            }
        }
        ?>
        <div class="form-group">
            <label for="">Nome da categoria:</label>
            <input type="text" name="nome">
        </div>
        <div class="form-group">
            <label for="">Insira uma cor:</label>
            <input type="text" name="nome_cor">
        </div>
        <div class="form-group">
			<input type="file" name="imagem"/>
		</div><!--form-group-->
        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar">
        </div>
    </form>
</section>