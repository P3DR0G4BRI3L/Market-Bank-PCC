<?php 
session_start();
require_once '../cadastro.php';

function usuarioEstaLogado(){
    return isset($_SESSION['usuario']);
}
if (usuarioEstaLogado() && $_SESSION['usuario']['tipo'] == 'dono') {

    
    $mercName = $_SESSION['usuario']['id_usuario'];
    $mercado = $conn->query("SELECT * FROM mercado WHERE id_dono = '$mercName'");
    $infmercado = $mercado->fetch_assoc();


}
$id_produto = $_POST['deleteprod'];
$id_mercado = $infmercado['id_mercado'];
$deleteprod = $conn->query("DELETE  FROM produto WHERE id_produto = '$id_produto' AND id_mercado = '$id_mercado';");
if($deleteprod){
echo "<script>
    alert('Produto deletado com sucesso');
    window.location.href='read-prod.php';
</script>";
}else{
    echo "<script>
    alert('ocorreu um erro');
    window.location.href='read-prod.php';
</script>";
    
}
echo"<pre>";
// var_dump($_SESSION['usuario']);
// var_dump($infmercado);