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
$username = $_POST['username'];
$password = $_POST['password'];


// Insere os dados na tabela de usuários
$sql = "INSERT INTO mercado (username, password) VALUES ('$username', '$password')";

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
