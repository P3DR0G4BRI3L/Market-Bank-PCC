<?php
// Conexão com o banco de dados
require_once 'cadastro.php' ;

// Obtem os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];


//verifica se o email inserido na hora do cadastro já está cadastrado no sistema, se estiver retorna erro
$sqlverify = "SELECT * FROM usuario WHERE email = ':email';";
$result = $conn->prepare($sqlverify);
$result->bindValue(':email', $email,PDO::PARAM_STR);
if ($result->rowCount() > 0) {
    echo "<script>
             alert('O email inserido já está em uso');
             window.location.href = 'cadastrarCliente.php';
           </script>";
    exit;
}

// Insere os dados na tabela de usuários
$sql = "INSERT INTO usuario (nome, email, senha, tipo) VALUES (:nome, :email, :senha, 'cliente');";

$stmt=$conn->prepare($sql);
$stmt->bindValue(':nome',$nome,PDO::PARAM_STR);
$stmt->bindValue(':email',$email,PDO::PARAM_STR);
$stmt->bindValue(':senha',$senha,PDO::PARAM_STR);
$stmt->execute();

if ($stmt) {

    
    $infusuario = $conn->prepare("SELECT * FROM usuario WHERE email = :email ");
    $infusuario->bindValue(':email',$email,PDO::PARAM_STR);
    $id_usuario = $infusuario->fetch();
    $id_cliente = $id_usuario['id_usuario'];
    
    $sqlcliente = "INSERT INTO cliente (id_usuario) VALUES (:id_cliente);";
   
    $stmtc = $conn->prepare($sqlcliente);
    $stmtc->bindValue(':id_cliente',$id_cliente,PDO::PARAM_INT);
    $stmtc->execute();
    if ($stmtc){
        // Usuário autenticado com sucesso
        echo "<script>alert('Cadastro realizado com sucesso!');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
    exit; // Certifique-se de sair do script após o redirecionamento
} else {
    echo "Erro ao cadastrar: " . $stmt->errorInfo();
}

}
$conn = null;

