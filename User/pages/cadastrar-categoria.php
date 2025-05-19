<?php verificaPermissaoPagina(0) ?>
<section class="box-content">
    <h2><i class="fa fa-pencil"></i> Cadastrar Categoria e cor</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <?php
        if (isset($_POST['acao'])) {
            $categoria = $_POST['nome'];
            $cor = $_POST['nome_cor'];
            $imagem = $_FILES['imagem'];
            // var_dump([$categoria, $cor, $imagem]);
            $categoria_id = 0;

            if ($categoria == "") {
                Painel::alert('atencao', 'O campo de categoria esta vazio');
            } else {
                $verificar = MySql::conectar()->prepare("SELECT * FROM `tb_categoria` WHERE nome = ?");
                $verificar->execute([$categoria]);
                if ($verificar->rowCount() == 1) {
                    Painel::alert('erro', 'Já existe uma categoria com este nome');
                } else {
                        if(Painel::imagemValida($imagem) == false || $imagem == ""){ Painel::alert('erro','Imagem Invalida');
                        }else{
                        $image = Painel::uploadFile($imagem);
                        $slug = Painel::generateSlug($categoria);
                        $sql = MySql::conectar()->prepare("INSERT INTO `tb_categoria` VALUES (null,?,?,?)");

                        $sql->execute([$categoria, $image, $slug ]);
                        Painel::alert('sucesso', 'Cadastrou a categoria com sucesso');
                        // $categoria_id = $sql->lastInsertId();
                        // var_dump($sql, $categoria_id);
                    }
                }
            }

            // cadastro da cor
            $verificaCor = MySql::conectar()->prepare("SELECT * FROM `tb_cor` WHERE nome_cor=?");
            $verificaCor->execute([$_POST['nome_cor']]);
            if($verificaCor->rowCount() == 1){
                Painel::alert('erro','Está cor já existe no banco de dados');
            }else{
                if($cor != ""){
                    $corInsert = MySql::conectar()->prepare("INSERT INTO `tb_cor` VALUES(null,?)");
                    $corInsert->execute([$cor]);
                    Painel::alert('sucesso','Cor cadastrada com sucesso');
                }else{
                    Painel::alert('atencao','O campo de cor esta vazio');
                }
            }

        }
        
        ?>
        <div class="form-group">
            <label for="">Nome da categoria:</label>
            <input type="text" name="nome" >
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