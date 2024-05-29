<?php

// Conexão com o banco de dados
require_once 'cadastro.php';
require_once '../model/usuarioDAO.php';
require_once '../model/mercadoDAO.php';


$nomeMerc = $_POST['nome_mercado'];
$regiaoadm = $_POST['regiaoadm'] ;
$endereco = $_POST['endereco'];
$horarioAbert = $_POST['horarioAbert'];
$horarioFecha = $_POST['horarioFecha'];
$telefone = $_POST['telefone'];
$imagem = ($_FILES['imagem']);
$cnpj = $_POST['cnpj'];
$descricao = $_POST['descricao'] ?? null;
$compras = $_POST['compras'];


$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

//verifica se ja existe esse email no banco de dados
$usuarioDAO = new usuarioDAO($conn);

if($usuarioDAO->verificaEmailExiste($email)){
    echo "<script>
            alert('O email inserido já está em uso');
            window.location.href = 'cadastrarMercado.php';
          </script>";
    exit;
}



if ($usuarioDAO->inserirUsuario($nome , $email, $senha, 'dono')) {
    
    $id_dono = $usuarioDAO->getIdUsuarioByEmail($email);

    if (!empty($id_dono)) {

        
    $mercadoDAO = new mercadoDAO($conn);
    
        if ($mercadoDAO->inserirMercado($nomeMerc,$regiaoadm,$endereco,$horarioAbert,$horarioFecha,$telefone,$cnpj,$imagem,$descricao,$compras,$id_dono)) {

            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
             echo "<script>window.location.href = 'login.php';</script>";

            }else{
                echo "erro ao cadastrar" . $stmt->errorInfo();
            }
            exit; // Certifique-se de sair do script após o redirecionamento
    }

}

$conn = null;
