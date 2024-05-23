<?php
session_start();
echo"<pre>";
// print_r($_SESSION['usuario']);
echo"</pre>";
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';

if (usuarioEstaLogado()) {
    $userlog = $_SESSION['usuario']['nome'];
}

if(isset($_POST['updateperfil'])){
    $id_usuario = $_POST['updateperfil'];
$stmt = $conn->prepare("SELECT * FROM usuario WHERE id_usuario = :id_usuario");
$stmt->bindValue(':id_usuario',$id_usuario,PDO::PARAM_INT);
if($stmt->execute()){
    $infusuario = $stmt->fetch();    
}}
    
require_once '../inc/cabecalho.php';//mostra o cabeçalhos
if(isset($_POST['nome'] , $_POST['email'] , $_POST['senha'])){
    $stmtverify=$conn->prepare("SELECT * FROM usuario WHERE email = :email");//verifica se existe um usuario com esse email na tabela
    $stmtverify->bindValue(':email',$_POST['email'],PDO::PARAM_STR);

    if($stmtverify->execute() && $stmtverify->rowCount()>0){
        $verify = $stmtverify->fetch();
        // var_dump($verify['email']);exit;
        // $verify2=$conn->prepare("SELECT * FROM ")        ;
        if($verify['email']!=$_SESSION['usuario']['email'])
        echo "<script>

            alert('O email inserido já está em uso');
                window.location.href='../cadastro/verMeuCliente.php';
            
        </script>";
    }
$stmt = $conn->prepare("UPDATE usuario SET nome = :nome , email = :email ,senha = :senha WHERE id_usuario = :id_usuario ");
$stmt->bindValue(':nome',$_POST['nome'],PDO::PARAM_STR);
$stmt->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
$stmt->bindValue(':senha',$_POST['senha'],PDO::PARAM_STR);
$stmt->bindValue(':id_usuario',$_SESSION['usuario']['id_usuario'],PDO::PARAM_INT);
if($stmt->execute()){
    $_SESSION['usuario']['nome']=$_POST['nome'];
    $_SESSION['usuario']['email']=$_POST['email'];
    $_SESSION['usuario']['senha']=$_POST['senha'];
    echo "<script>alert('Perfil alterado com sucesso')</script>";
    echo "<script>window.location.href='../cadastro/verMeuCliente.php'</script>";
    
}else{
    echo"alert('Ocorreu um erro')";
}
}?>
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
                            <input type="password" id="senha" name="senha" value="<?= $infusuario['senha'] ?>"
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