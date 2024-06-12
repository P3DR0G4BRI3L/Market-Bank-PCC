<?php
session_start();
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';
require_once '../inc/cabecalho.php';
require_once '../model/produtoDAO.php';
// o cabeçalho é mostrado em cima normal, porem, se a pessoa não estiver logada é criado uma div postagem e mostra pro usuário que ele não pode acessar essa pagina 
if ($_SESSION['usuario']['tipo']!='dono') {
    ?>




<div id="area-principal">

    <div id="area-postagens"></div>

    <div class="postagem">
        <link rel="stylesheet" href="../../css/cadastro.css">
        <h2>Você não tem permissão para acessar essa página</h2>
        <h2>Realize o cadastro</h2>

        <div class="login-box"><button class='btn_left'
                onclick="window.location.href='../../index.php' ">Voltar</button></div>

    </div>
    <?php require_once '../inc/rodape.php'; 
    exit;
}



$nome = $_POST['nomeprod'];
$preco = str_replace(',','.',$_POST['preco']);
$fotoProduto = $_FILES['imgprod'];
$descricao = $_POST['descricao'] ?? null  ;
$id_mercado = $_SESSION['usuario']['mercado']['id_mercado'];

$produtoDAO = new ProdutoDAO($conn); 
if ($produtoDAO->inserirProduto($nome, $preco, $fotoProduto,$descricao, $id_mercado)) {

    echo "<script>
    alert('Produto cadastrado com sucesso');
    window.location.href='read-prod.php';
</script>";
} else {
    echo "Erro de conexão" . $stmt->errorInfo();
}
$conn = null;
?>