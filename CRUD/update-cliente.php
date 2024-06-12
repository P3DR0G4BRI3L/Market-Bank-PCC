<?php
session_start();
echo"<pre>";
// print_r($_SESSION['usuario']);
echo"</pre>";
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';
require_once '../model/usuarioDAO.php';
require_once '../model/clienteDAO.php';


$usuarioDAO = new usuarioDAO($conn);
$clienteDAO = new clienteDAO($conn);
$id_usuario = $_SESSION['usuario']['id_usuario'];
    

require_once '../inc/cabecalhocadastro.php';//mostra o cabeçalhos
if(isset($_POST['nome'] , $_POST['email'], $_POST['telefone'])){
    if(strlen($_POST['telefone'])!=11){
        header('location:?bah=O número deve conter 11 dígitos');exit;
    }
   $nome = $_POST['nome']   ;
   $email = $_POST['email'] ;
   $telefone = $_POST['telefone'] ;
   

    
        if($usuarioDAO->verificaEmailExisteAtt($email,$_SESSION['usuario']['email'])){
        header('location:?mess=O email inserido ja está em uso');
            exit;
    }

if($usuarioDAO->atualizarUsuario($nome , $email, $id_usuario) && $clienteDAO->atualizarCliente($id_usuario,$telefone)){
    
    $_SESSION['usuario']['nome']=$_POST['nome'];
    $_SESSION['usuario']['email']=$_POST['email'];
    $_SESSION['usuario']['telefone']=$_POST['telefone'];
    echo "<script>alert('Perfil alterado com sucesso')</script>";
    echo "<script>window.location.href='../cadastro/verMeuCliente.php'</script>";
     
}
   
}
?>
<div id="area-principal">
        <!--Aberturac -->
        <div class="postagem">
            <h2>Editar perfil</h2>
            <div class="container">
                <div class="login-box largura_menor">
                    <form action="" method="POST">

                        <div class="input-group">
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" value="<?= $_SESSION['usuario']['nome'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                        </div>

                        <div class="input-group">
                            <?php if(isset($_GET['mess'])): ?>
                                <h6><?= $_GET['mess'] ?></h6>
                            <?php endif ?>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?= $_SESSION['usuario']['email']?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                        </div>

                        <div class="input-group">
                        <?php if(isset($_GET['bah'])): ?>
                                <h6><?= $_GET['bah'] ?></h6>
                            <?php endif ?>
                            <label for="email">Telefone:</label>
                            <input type="tel" id="email" name="telefone" value="<?= $_SESSION['usuario']['telefone']?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" maxlength="11" required>
                        </div>

                        
                        <button type="button"class="button_padrao" onclick="window.location.href='../cadastro/verMeuCliente.php'">Voltar</button>
                        <button class="button_padrao btn_edit" type="submit">Alterar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php    require_once '../inc/rodape.php';?>