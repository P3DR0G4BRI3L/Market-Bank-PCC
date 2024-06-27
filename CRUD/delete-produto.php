<?php
require_once '../model/produtoDAO.php';
require_once '../cadastro/cadastro.php';
$produtoDAO = new produtoDAO($conn);


if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['deleteprod'], $_POST['deletefile'])) {

$deletefoto = "../cadastro/uploads/";

$imagemPath = $deletefoto . $_POST['deletefile'];
if (file_exists($imagemPath)) {
    unlink($imagemPath);
}

$id_produto = $_POST['deleteprod'];
if ($produtoDAO->excluirproduto($id_produto)) {
    echo "<script>
    alert('Produto excluído com sucesso');
    window.location.href='../CRUD/read-prod.php';
    </script>";
    exit;
}
}