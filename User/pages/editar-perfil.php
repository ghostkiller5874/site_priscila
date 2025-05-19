<?php 

   
    $perfil = MySql::conectar()->prepare("SELECT * FROM `tb_cliente` WHERE id=$_SESSION[identifica]");
    $perfil->execute();
    $perfil = $perfil->fetch();
   
    $endereco = MySql::conectar()->prepare("SELECT * FROM `tb_endereco` WHERE id=?");
    $endereco->execute([$perfil['endereco_id']]);
    $endereco = $endereco->fetch();

    $pag = MySql::conectar()->prepare("SELECT * FROM `tb_modo.pagamento`");
    $pag->execute();
    $pag = $pag->fetchAll();

    $user = MySql::conectar()->prepare("SELECT * FROM `tb_usuario` WHERE user_id=? AND cargo <> 0");
    $user->execute([$perfil['id']]);
    $user = $user->fetch();

    $userADM= MySql::conectar()->prepare("SELECT * FROM `tb_usuario` WHERE user_id=0 || cargo=0");
    $userADM->execute();
    $userADM = $userADM->fetch();
?>
<?php 
    if($_SESSION['cargo'] == 1){
        //trocoar dps para apenas usuario comum
?>
<section class="box-content">
    <h2><i class="fa fa-pencil"></i> Editando as informações do <b><?= $perfil['nome']?></b></h2>

    <form  method="post" enctype="multipart/form-data">
        <?php 
            if(isset($_POST['editar'])){
                $query = '';
                $nome = $_POST['nome'];
                $telefone = $_POST['telefone'];
                $cpf = $_POST['cpf'];
                $sexo = $_POST['sexo'];
                //user
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                //endereco
                $cidade = $_POST['cidade'];
                $rua = $_POST['rua'];
                $bairro = $_POST['bairro'];
                $logradouro = $_POST['logradouro'];
                $estado = $_POST['estado'];
                //pagamento
                $modoPag = $_POST['pag_id'];
                
                //verificar existencia de algumas informações

                $verifica = MySql::conectar()->prepare("SELECT * FROM `tb_endereco` WHERE id=?");
                $verifica->execute([$perfil['id']]);
                if($verifica->rowCount() == 1){
                    $query = "UPDATE `tb_endereco` SET rua=?,bairro=?,logradouro=?,cidade=?,estado=?  WHERE id=$perfil[id]";
                }else{
                    $query= "INSERT INTO `tb_endereco` VALUES (null,?,?,?,?,?)  ";
                }
                $end = MySql::conectar()->prepare("$query");
                $end->execute([$rua,$bairro,$logradouro,$cidade,$estado]);
                $lastEndereco = ($verifica->rowCount() == 1)? $endereco['id'] : MySql::conectar()->LastInsertId();
                $sql = MySql::conectar()->prepare("UPDATE `tb_cliente` SET nome=?,telefone=?,cpf=?,sexo=?,endereco_id=?,pag_id=? WHERE id = $perfil[id]");
                $sexoFinal = ($sexo == $perfil['sexo'] && $perfil['sexo'] == 'Masculino') ? 'Masculino' : 'Feminino';
                $sql->execute(array($nome,$telefone,$cpf,$sexoFinal,$lastEndereco,$modoPag));
                $usuario = MySql::conectar()->prepare("UPDATE `tb_usuario` SET email=?,senha=? WHERE user_id=$perfil[id]");
                $usuario->execute([$email,$senha]);

                Painel::alert("sucesso","Atualização dos dados foi feita com sucesso");
            }
        ?>
        <div class="form-group">
            <label>Nome Completo:</label>
            <input type="text" name="nome" value="<?= ($perfil['nome'] ?? "");?>">
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="telefone" value="<?= ($perfil['telefone'] ?? "");?>">
        </div>
        <div class="form-group">
            <label>CPF:</label>
            <input type="text" name="cpf" value="<?= ($perfil['cpf'] ?? "");?>">
        </div>
        <div class="form-group">
            <label>Sexo:</label>
            <select name="sexo" >
                <option value="" ><?= $perfil['sexo']?></option>
                <option value="" ><?= "Feminino";?></option>
            </select>
        </div>
        <div class="form-group">
            <h4>Dados de Usuário</h4>
            <label>Email:</label>
            <input type="text" name="email" value="<?= ($user['email'] ?? ""); ?>">
            <label>Senha:</label>
            <input type="text" name="senha" value="<?= ($user['senha'] ?? ""); ?>">
        </div>
        <div class="form-group">
            <h4>Endereço</h4>
            <?php
                $verificaEndereco = MySql::conectar()->prepare("SELECT * FROM `tb_endereco` WHERE id=?");
                $verificaEndereco->execute([$perfil['id']]); 
                if($verificaEndereco->rowCount() == 1){
            ?>
            <label >Cidade:</label>
            <input type="text" name="cidade" value="<?= ($endereco['cidade'] ?? "");?>">
            <label>Rua:</label>
            <input type="text" name="rua" value="<?= ($endereco['rua'] ?? ""); ?>">
            <label>Bairro:</label>
            <input type="text" name="bairro" value="<?= ($endereco['bairro'] ?? "");?>">
            <label>Logradouro:</label>
            <input type="text" name="logradouro" value="<?= ($endereco['logradouro'] ?? "");?>">
            <label>Estado:</label>
            <input type="text" name="estado" value="<?= ($endereco['estado'] ?? "")?>">
            <?php }else{?>
            <label >Cidade:</label>
            <input type="text" name="cidade">
            <label>Rua:</label>
            <input type="text" name="rua">
            <label>Bairro:</label>
            <input type="text" name="bairro" >
            <label>Logradouro:</label>
            <input type="text" name="logradouro" >
            <label>Estado:</label>
            <input type="text" name="estado" >
            <?php }?>
        </div>

        <div class="form-group">
            <h4 style="margin-bottom: 8px;">Metodo de Pagamento: </h4>
            <?php foreach($pag as $key => $value){?>
                <input  type="radio" name="pag_id" value="<?= $value['id']?>" <?php if ($value['id'] == $perfil['pag_id']) echo 'checked'; ?>>
                <label style="display: inline; margin-right:8px;" for="<?= $value['id']?>"><?= $value['tipo'];?></label>
            <?php }?>
            
        </div>

        <div class="form-group">
            <input type="submit" value="Confirmar Alterações" name="editar">
        </div>
    </form>
</section>
<?php }else {?>
    <section class="box-content">
        <h2><i class="fa fa-pencil"></i> Editando informações do ADM</h2>
        <form method="post">
            <?php 
                if(isset($_POST['Atualizar_adm'])){
                    $email = $_POST['email_adm'];
                    $senha = $_POST['senha_adm'];

                    if($email == '' || $senha == ''){
                        Painel::alert('erro', 'Campos vazios não são permitidos');
                    }else{
                        $sql = MySql::conectar()->prepare("UPDATE `tb_usuario` SET email=?,senha=? WHERE cargo = 0 AND id=$_SESSION[identifica]");
                        $sql->execute([$email,$senha]);
                        Painel::alert('sucesso','ADM atualizado com sucesso');
                        $userADM = MySql::conectar()->prepare("SELECT * FROM `tb_usuario` WHERE cargo=0");
                        $userADM->execute();
                        $userADM = $userADM->fetch();
                    }
                }
            ?>
            <div class="form-group">
                <label>Email:</label>
                <input type="text" name="email_adm" value="<?= $userADM['email'];?>">
            </div>
            <div class="form-group">
                <label>Senha:</label>
                <input type="text" name="senha_adm" value="<?= $userADM['senha']?>">
            </div>
            <div class="form-group">
                <input type="submit" value="Atualizar" name="Atualizar_adm">
            </div>
        </form>
    </section>
<?php }?>