<?php

// Conexão com o banco de dados
require_once 'cadastro.php';
require_once '../model/usuarioDAO.php';
require_once '../model/mercadoDAO.php';
require_once '../model/infopagDAO.php';

if (isset($_POST['senha']) && strlen($_POST['senha']) > 16) {
    echo "<script>alert('Senha muito extensa, no máximo 16 caracteres');
    window.location.href='cadastrarCliente.php';
    </script>";
}

$nomeMerc = $_POST['nome_mercado'];
$regiaoadm = $_POST['regiaoadm'];
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

$usuarioDAO = new usuarioDAO($conn);
$mercadoDAO = new mercadoDAO($conn);
$infopagDAO = new infopagDAO($conn);

if ($mercadoDAO->verificaCNPJexiste($cnpj)) {
    echo "<script>
    alert('O CNPJ inserido já está cadastrado no sistema');
    window.location.href = 'cadastrarMercado.php';
    </script>";
    exit;
}
//verifica se ja existe esse email no banco de dados
if ($usuarioDAO->verificaEmailExiste($email)) {
    echo "<script>
            alert('O email inserido já está em uso');
            window.location.href = 'cadastrarMercado.php';
          </script>";
    exit;
}

if ($usuarioDAO->inserirUsuario($nome, $email, md5($senha), 'dono')) {

    $id_dono = $usuarioDAO->getIdUsuarioByEmail($email);

    if (!empty($id_dono)) {



        if ($mercadoDAO->inserirMercado($nomeMerc, $regiaoadm, $endereco, $horarioAbert, $horarioFecha, $telefone, $cnpj, $imagem, $descricao, $compras, $id_dono)) {
            if($compras == 'sim'){
                $id = $usuarioDAO->getIdUsuarioByEmail($email);
                echo "<script>alert('Cadastro realizado com sucesso!\nAgora só falta inserir as informações de pagamento');</script>";
                header("location:cadastroInfopag.php?id=$id");exit;
            }
            
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        } else {
            echo "erro ao cadastrar" . $stmt->errorInfo();
        }
        exit; // Certifique-se de sair do script após o redirecionamento
    }

}
$conn = null;
