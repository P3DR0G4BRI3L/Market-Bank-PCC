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
if(isset($_POST['updateperfil'])){

    
    $id_usuario = $_POST['updateperfil'];
 
    $infusuario = $usuarioDAO->getUsuarioById($id_usuario);    
}
    
require_once '../inc/cabecalho.php';//mostra o cabeçalhos
if(isset($_POST['nome'] , $_POST['email'] , $_POST['senha'])){
   $nome = $_POST['nome']  !=null ?$_POST['nome']   : "erro" ;
   $email = $_POST['email']!=null ?$_POST['email'] : "erro" ;
   $senha = $_POST['senha']!=null ?$_POST['senha'] : "erro" ;
   

    
        if($usuarioDAO->verificaEmailExisteAtt($email,$_SESSION['usuario']['email']))
        echo "<script>

            alert('O email inserido já está em uso');
                window.location.href='../cadastro/verMeuCliente.php';
            
        </script>";
    $id_usuario = $_SESSION['usuario']['id_usuario'];
if($usuarioDAO->atualizarUsuario($nome , $email , $senha , $id_usuario)){
    $_SESSION['usuario']['nome']=$_POST['nome'];
    $_SESSION['usuario']['email']=$_POST['email'];
    echo "<script>alert('Perfil alterado com sucesso')</script>";
    echo "<script>window.location.href='../cadastro/verMeuCliente.php'</script>";
     
}
   
}else{
    echo"alert('Ocorreu um erro')";
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
                            <input type="text" id="nome" name="nome" value="<?= $infusuario['nome'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                        </div>

                        <div class="input-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?= $infusuario['email']?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                        </div>

                        <div class="input-group">
                            <label for="senha">Senha:</label>
                            <input type="password" id="senha" name="senha" value="<?= $usuarioDAO->getSenhaById($infusuario['id_usuario']) ?>"
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