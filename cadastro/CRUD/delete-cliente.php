<?php 
session_start();
require_once '../cadastro.php';

function usuarioEstaLogado(){
    return isset($_SESSION['usuario']);
}
if (usuarioEstaLogado() && $_SESSION['usuario']['tipo'] == 'cliente') {

    
    $clienteName = $_SESSION['usuario']['id_usuario'];
    $cliente = $conn->query("SELECT * FROM usuario WHERE id_usuario = '$clienteName'");
    $infusuario = $cliente->fetch_assoc();

    $clienteName = $_SESSION['usuario']['id_usuario'];
    $cliente = $conn->query("SELECT * FROM cliente WHERE id_usuario = '$clienteName'");
    $infcliente = $cliente->fetch_assoc();


}
$id_usuario = $_POST['deleteperfil'];
$id_cliente = $_POST['deletecliente'];

$deletecliente = $conn->query("DELETE  FROM cliente WHERE id_usuario = '$id_cliente'");
$deleteusuario = $conn->query("DELETE  FROM usuario WHERE id_usuario = '$id_usuario'");

if($deleteusuario && $deletecliente){
echo "<script>
    alert('Perfil deletado com sucesso');
    window.location.href='../logout.php';
    </script>";
}else{
    echo "<script>
    alert('ocorreu um erro');
    window.history.back();
</script>";
    
}
echo"<pre>";
var_dump($_SESSION['usuario']);
var_dump($infmercado);