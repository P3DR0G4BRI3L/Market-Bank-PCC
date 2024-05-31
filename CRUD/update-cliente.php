<?php
session_start();
echo"<pre>";
// print_r($_SESSION['usuario']);
echo"</pre>";
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';
require_once '../model/usuarioDAO.php';

if (usuarioEstaLogado()) {
    $userlog = $_SESSION['usuario']['nome'];
}

$usuarioDAO = new usuarioDAO($conn);

    
require_once '../inc/cabecalho.php';//mostra o cabeçalhos
if(isset($_POST['nome'] , $_POST['email'])){
   $nome = $_POST['nome']   ;
   $email = $_POST['email'] ;
   $senha = $_POST['senha'] ?? $usuarioDAO->getSenhaById($_SESSION['usuario']['id_usuario']);  ;
   

    
        if($usuarioDAO->verificaEmailExisteAtt($email,$_SESSION['usuario']['email']))
        echo "<script>

            alert('O email inserido já está em uso');
                window.location.href='update-cliente.php';
            
        </script>";
    $id_usuario = $_SESSION['usuario']['id_usuario'];
if($usuarioDAO->atualizarUsuario($nome , $email , $senha , $id_usuario)){
    $_SESSION['usuario']['nome']=$_POST['nome'];
    $_SESSION['usuario']['email']=$_POST['email'];
    echo "<script>alert('Perfil alterado com sucesso')</script>";
    echo "<script>window.location.href='../cadastro/verMeuCliente.php'</script>";
     
}
   
}
?>
<div id="area-principal">
    <div id="area-postagens">
        <!--Aberturac -->
        <div class="postagem">
            <h2>Editar perfil</h2>
            <div class="container">
                <div class="login-box">
                    <form action="" method="POST">

                        <div class="input-group">
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" value="<?= $_SESSION['usuario']['nome'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                        </div>

                        <div class="input-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?= $_SESSION['usuario']['email']?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                        </div>

                        <div class="input-group">
                            <label for="senha">Senha:</label>
                            <input type="password" id="senha" name="senha" value="<?= $usuarioDAO->getSenhaById($_SESSION['usuario']['id_usuario']) ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                            <button type="button" id="mostrarSenha" onclick="mostrarsenha()">Mostrar Senha</button>
                        </div>
                        <button class="btn_left" onclick="window.history.back()">Voltar</button>
                        <button type="submit">Alterar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php    require_once '../inc/rodape.php';?>