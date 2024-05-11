<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "marketbank";

$conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtem os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$tipo = 1 ;

// Insere os dados na tabela de usuários
$sql = "INSERT INTO usuario (nome, email, senha) 
VALUES 
('$nome', '$email', '$senha')";

if ($conn->query($sql) === TRUE) {
     // Usuário autenticado com sucesso
     echo "<script>alert('Cadastro realizado com sucesso!');</script>";
    echo "<script>window.location.href = '../index.php';</script>";
     exit; // Certifique-se de sair do script após o redirecionamento
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}


$conn->close();
?>
