<?php
session_start();
$carrinho = $_SESSION['usuario']['carrinho'];
$id_mercado = $_SESSION['usuario']['verMercado'];
$id_cliente = $_SESSION['usuario']['id_cliente'];
$descricao = $_POST['descricao'] ?? null;
require_once '../inc/cabecalho.php';
require_once '../model/carrinhoDAO.php';
require_once '../model/itensDAO.php';
require_once '../model/clienteDAO.php';
require_once '../cadastro/cadastro.php';

$carrinhoDAO = new carrinhoDAO($conn);
$clienteDAO = new clienteDAO($conn);
$itensDAO = new itensDAO($conn);

$boolANDid_mercado = $carrinhoDAO->inserirCarrinho($id_mercado, $id_cliente, 'pendente', $descricao);
if ($boolANDid_mercado[1] === TRUE) {

    foreach ($carrinho as $key => $item) {
        $true[] = $itensDAO->inserirItens($item['quantidade'], $boolANDid_mercado[0], $item['id_produto']);
    }
    foreach($true as $t){

        if($t){
            $count+=1;
        }
    }
    if($count === count($true)){
        $carrinho = [];
        $_SESSION['usuario']['carrinho'] = $carrinho;
        echo "<script>alert('Compra realizada com sucesso!');window.location.href='gerenciarComprasCliente.php';</script>";
    }
}
