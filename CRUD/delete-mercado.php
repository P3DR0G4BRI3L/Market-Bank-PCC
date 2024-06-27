<?php

session_start();
require_once '../cadastro/cadastro.php';
require_once '../model/mercadoDAO.php';
require_once '../model/produtoDAO.php';
require_once '../model/usuarioDAO.php';
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['deletemercado'])) { //deleta o mercado e tudo relacionado a ele

    $mercadoDAO = new mercadoDAO($conn);
    $produtoDAO = new produtoDAO($conn);
    $usuarioDAO = new usuarioDAO($conn);

    $deletefoto = "../cadastro/uploads/";
    $imagemPath = $deletefoto . $_SESSION['usuario']['mercado']['imagem'];
    if (file_exists($imagemPath)) {
        unlink($imagemPath);
    }

    $id_mercado = $_SESSION['usuario']['mercado']['id_mercado'];
    if (
        $mercadoDAO->deleteAllItensByIdProdutos($produtoDAO->getAllProdutoByIdMercado($id_mercado)) &&

        $mercadoDAO->deleteAllCarrinhosByIdMercado($id_mercado) &&

        $mercadoDAO->deleteAllProdutosByMercado($id_mercado) &&

        $mercadoDAO->deleteAllPanfletosByMercado($id_mercado) &&

        $mercadoDAO->deleteAllfiltroProdutoByMercado($id_mercado) &&

        $mercadoDAO->deleteAllInfoPagByIdMercado($id_mercado)

    ) {

        if ($mercadoDAO->deleteMercadoById($_SESSION['usuario']['id_usuario'])) {
            if ($usuarioDAO->excluirUsuario($_SESSION['usuario']['id_usuario'])) {


                session_destroy();
                echo "<script>
            alert('Mercado,produtos e panfletos excluídos com sucesso');
            window.location.href='../index.php';
            </script>";
                exit;
            }
        }
    }
}else{
    echo"
<script> window.history.back() </script>
    ";
}