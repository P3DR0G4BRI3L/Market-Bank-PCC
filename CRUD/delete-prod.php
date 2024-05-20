<?php 
session_start();
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';


if (usuarioEstaLogado() && $_SESSION['usuario']['tipo'] == 'dono') {

    
    $mercName = $_SESSION['usuario']['id_usuario'];
    $mercado = $conn->prepare("SELECT * FROM mercado WHERE id_dono = :mercName");
    $mercado->bindValue(':mercName',$mercName,PDO::PARAM_INT);
    $mercado->execute();
    $infmercado = $mercado->fetch();


}


$id_produto = $_POST['deleteprod'];
$id_mercado = $infmercado['id_mercado'];

$deleteprod = $conn->prepare("DELETE  FROM produto WHERE id_produto = :id_produto AND id_mercado = :id_mercado;");
$deleteprod->bindValue(':id_produto',$id_produto,PDO::PARAM_INT);
$deleteprod->bindValue(':id_mercado',$id_mercado,PDO::PARAM_INT);
$deleteprod->execute();

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