<?php
session_start();
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';
require_once '../inc/cabecalho.php';
require_once '../model/filtroProdutoDAO.php';
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




$nome = $_POST['nomeFiltro'];
$id_mercado = $_SESSION['usuario']['mercado']['id_mercado'];

$filtroProdutoDAO = new filtroProdutoDAO($conn); 
if ($filtroProdutoDAO->inserirFiltro($nome, $id_mercado)) {

    echo "<script>
    alert('Categoria criada com sucesso');
    window.location.href='read-filtro.php';
</script>";
} else {
    echo "Erro de conexão" . $stmt->errorInfo();
}
$conn = null;
?>