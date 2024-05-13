<?php 
session_start();
require_once '../cadastro.php';

function usuarioEstaLogado(){
    return isset($_SESSION['usuario']);
}

//checa se é um mercado que está logado
if (usuarioEstaLogado() && $_SESSION['usuario']['tipo'] == 'dono') {

    
    $mercName = $_SESSION['usuario']['id_usuario'];
    $mercado = $conn->query("SELECT * FROM mercado WHERE id_dono = '$mercName'");
    $infmercado = $mercado->fetch_assoc();


}



$id_mercado = $infmercado['id_mercado'];
$id_dono = $infmercado['id_dono'];

//deleta o mercado do banco de dados
$deleteallprod = $conn->query("DELETE FROM produto WHERE id_mercado = '$id_mercado' ;");

//deleta todos os produtos vinculados a esse mercado
$deletemerc = $conn->query("DELETE FROM mercado WHERE id_mercado = '$id_mercado' AND id_dono = '$id_dono';");

$deleteuser = $conn->query("DELETE FROM usuario WHERE id_usuario = '$id_dono' ;");

if($deletemerc && $deleteallprod && $deleteuser){
echo "<script>
    alert('O mercado, seus produtos e seu login foram excluídos com sucesso');
    window.location.href='../logout.php';
</script>";
}else{
    echo "<script>
    alert('ocorreu um erro');
    window.location.href='read-prod.php';
</script>";
    
}
echo"<pre>";
var_dump($_SESSION['usuario']);
var_dump($infmercado);