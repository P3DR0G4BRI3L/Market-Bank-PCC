<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    $id_produto = $_GET['id_produto'] ?? 0;
    if($id_produto==0){
        echo "<script>alert('Produto não encontrado')</script>";
    }
    $carrinho = $_SESSION['usuario']['carrinho'];
    foreach ($carrinho as $key => $item) {
        if($item['id_produto']==$id_produto && $item['quantidade']>1){
            $carrinho[$key]['quantidade'] -= 1;    
        }
        elseif ($item['id_produto'] == $id_produto && $item['quantidade']==1){
            unset($carrinho[$key]);
            }
        $_SESSION['usuario']['carrinho'] = $carrinho;
}


header('location:read-prodCliente.php');
exit;

