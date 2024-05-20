<?php 
session_start();
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';

//checa se é um mercado que está logado
if (usuarioEstaLogado() && $_SESSION['usuario']['tipo'] == 'dono') {

    
    $mercName = $_SESSION['usuario']['id_usuario'];
    $mercado = $conn->prepare("SELECT * FROM mercado WHERE id_dono = :mercName");
    $mercado->bindValue(':mercName',$mercName,PDO::PARAM_INT);
    $mercado->execute();
    $infmercado = $mercado->fetch();


}



$id_mercado = $infmercado['id_mercado'];
$id_dono = $infmercado['id_dono'];

//deleta o mercado do banco de dados
$deleteallprod = $conn->prepare("DELETE FROM produto WHERE id_mercado = :id_mercado ;");
$deleteallprod->bindValue(':id_mercado',$id_mercado,PDO::PARAM_INT);
$deleteallprod->execute();

//deleta todos os produtos vinculados a esse mercado
$deletemerc = $conn->prepare("DELETE FROM mercado WHERE id_mercado = :id_mercado AND id_dono = :id_dono;");
$deletemerc->bindValue(':id_mercado',$id_mercado,PDO::PARAM_INT);
$deletemerc->bindValue(':id_dono',$id_dono,PDO::PARAM_INT);
$deletemerc->execute();

$deleteuser = $conn->prepare("DELETE FROM usuario WHERE id_usuario = :id_dono ;");
$deleteuser->bindValue(':id_dono',$id_dono,PDO::PARAM_INT);
$deleteuser->execute();
if($deletemerc && $deleteallprod && $deleteuser){
echo "<script>
    alert('O mercado, seus produtos e seu login foram excluídos com sucesso');
    window.location.href='../cadastro/logout.php';
</script>";
}else{
    echo "<script>
    alert('ocorreu um erro');
    window.location.href='read-prod.php';
</script>";
    
}
// echo"<pre>";
// var_dump($_SESSION['usuario']);
// var_dump($infmercado);