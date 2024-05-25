<?php
/*
esta pagina é responsavel por receber os dados do formulário inserido em 
cadastrarCliente.php, após receber os dados do formulário esses dados são
inseridos no banco de dados.
clienteDAO lida com a tabela cliente,e usuarioDAO lida com a tabela usuario
*/
// Conexão com o banco de dados
require_once 'cadastro.php' ;
require_once '../model/clienteDAO.php' ;
require_once '../model/usuarioDAO.php' ;

// Obtem os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];


$usuarioDAO = new usuarioDAO($conn);

//verifica se o email inserido na hora do cadastro já está cadastrado no sistema, se estiver retorna erro
if($usuarioDAO->verificaEmailExiste($email)){
    echo "<script>
            alert('O email inserido já está em uso');
            window.location.href = '../cadastro/cadastrarCliente.php';
          </script>";
                exit;
}

// Insere os dados na tabela de usuários
if ($usuarioDAO->inserirUsuario($nome,$email,$senha,'cliente')) {
    $clienteDAO = new clienteDAO($conn);
    
    $clienteDAO->inserirCliente($usuarioDAO->getIdUsuarioByEmail($email));//este trecho insere o usuario cliente na tabela cliente 
    echo "<script>
    alert('Cadastro realizado com sucesso');
    window.location.href = '../cadastro/login.php';
    </script>";exit;
}else{
    echo "Erro ao cadastrar" . $stmt->errorInfo();
}



$conn = null;