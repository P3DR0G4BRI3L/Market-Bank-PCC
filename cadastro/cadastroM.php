<?php

// Conexão com o banco de dados
require_once 'cadastro.php';
require_once '../model/usuarioDAO.php';
require_once '../model/mercadoDAO.php';





//este trecho if cuida para que a imagem seja copiada para a pasta cadastro/uploads no servidor local e o caminho fique armazenado no banco de dados
// Verifica se o arquivo foi enviado com sucesso
if ($_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    // Diretório onde você deseja armazenar as imagens
    $diretorioDestino = 'C:\xampp\htdocs\Market-Bank\cadastro\uploads\\';
    
    // Nome do arquivo original
    $imagem = $_FILES['imagem']['name'];
    
    // Caminho completo para onde o arquivo será movido
    $caminhoDestino = $diretorioDestino . $imagem;
    
    // Move o arquivo enviado para o diretório de destino
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
        //Arquivo enviado com sucesso.
    } else {
        echo "Erro ao mover o arquivo para o diretório de destino.";
    }
} else {
    echo "Erro no envio do arquivo: " . $_FILES['imagem']['error'];
}

$nomeMerc = $_POST['nome_mercado'];
$regiaoadm = $_POST['regiaoadm'] ;
$endereco = $_POST['endereco'];
$horarioAbert = $_POST['horarioAbert'];
$horarioFecha = $_POST['horarioFecha'];
$telefone = $_POST['telefone'];
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

       //esse metodo do $getid retorna um array associativo baseado na ultima query feita, em *LEIA TUDO: ela consultou a tabela usuarios
        
        //insere os dados na tabela mercado
    $mercadoDAO = new mercadoDAO($conn);
    
        if ($mercadoDAO->inserirMercado($nomeMerc,$regiaoadm,$endereco,$horarioAbert,$horarioFecha,$telefone,$cnpj,$imagem,$descricao,$compras,$id_dono)) {

            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
             echo "<script>window.location.href = 'login.php';</script>";

            }
            exit; // Certifique-se de sair do script após o redirecionamento
    }

}

$conn = null;
