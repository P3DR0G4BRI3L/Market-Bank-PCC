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
$endereco = $_POST['endereco'];
$horarioAbert= $_POST['horarioAbert'];
$horarioFecha= $_POST['horarioFecha'];
$telefone = $_POST['telefone'];
$cnpj = $_POST['cnpj'];


$email = $_POST['email'];
$senha = $_POST['senha'];
$tipo = 3;

// Insere os dados na tabela de usuários
$sql = "INSERT INTO mercado (nome, endereco, horarioAbert, horarioFecha, telefone, cnpj)
 VALUES
  ('$nome', '$endereco', '$horarioAbert', '$horarioFecha', '$telefone', '$cnpj' );";

$sqlUser="INSERT INTO usuario (nome, email, senha, tipo)
VALUES
('$nome', '$email', '$senha', '$tipo')
;";
if ($conn->query($sqlUser) === TRUE && $conn->query($sql) === TRUE) {
     // Usuário autenticado com sucesso
     echo "<script>alert('Cadastro realizado com sucesso!');</script>";
    echo "<script>window.location.href = '../index.php';</script>";
     exit; // Certifique-se de sair do script após o redirecionamento
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}


$conn->close();
?>
