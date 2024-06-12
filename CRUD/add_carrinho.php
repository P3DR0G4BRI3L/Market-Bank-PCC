<?php
session_start();
require_once '../model/produtoDAO.php';
require_once '../cadastro/cadastro.php';
$produtoDAO = new produtoDAO($conn);

$id_produto = $_GET['id_produto'] ?? 0;
if ($id_produto == 0) {
    echo "<script>alert('Produto não encontrado');window.location.href='read-prod.php'</script>";
}

if(empty($_SESSION['usuario']['carrinho'])){
    $_SESSION['usuario']['carrinho'] = [];
}

    $carrinho = $_SESSION['usuario']['carrinho']; 


$produto = $produtoDAO->getProdutoById($id_produto);

$achouItemCarrinho = false;
foreach($carrinho as $key => $item) {
    if ($item['id_produto'] == $id_produto) {
        $carrinho[$key]['quantidade'] += 1;
        $achouItemCarrinho = true;
        break;
    }
}    
if ($achouItemCarrinho == false) {
    $produto['quantidade'] = 1;
    $carrinho[] = $produto;
header("Location: read-prodCliente.php#$id_produto");
}
$_SESSION['usuario']['carrinho'] = $carrinho;
header("Location: read-prodCliente.php#$id_produto");
exit;

// header('location:../CRUD/read-prod.php?message=produto adicionado com sucesso');
