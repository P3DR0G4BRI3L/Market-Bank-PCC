<?php
session_start();
$carrinho = $_SESSION['usuario']['carrinho'];
$carrinho = [];
$_SESSION['usuario']['carrinho'] = $carrinho;

//
//foreach ($carrinho as $key => $item) {
//    if ($item['id_mercado'] == $_SESSION['usuario']['verMercado']) {
//        unset($carrinho[$key]);
//        $_SESSION['usuario']['carrinho'] = $carrinho;
//        break;
//    }
//}
//
header('location:read-prodCliente.php');
exit;
