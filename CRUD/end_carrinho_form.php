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

$trueorfalse = $carrinhoDAO->inserirCarrinho($id_mercado,$id_cliente,'aberto',$descricao);
if($trueorfalse[1]===TRUE){
    
    foreach ($carrinho as $key => $item) {
        $itensDAO->inserirItens($item['quantidade'],$trueorfalse[0],$item['id_produto']);
    
}}