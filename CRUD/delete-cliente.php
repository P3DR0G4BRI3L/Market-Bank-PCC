<?php
session_start();
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';


if (usuarioEstaLogado() && $_SESSION['usuario']['tipo'] == 'cliente') {


    $id_usuario = $_SESSION['usuario']['id_usuario'];
    $cliente = $conn->prepare("SELECT * FROM usuario WHERE id_usuario = :id_usuario");
    $cliente->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $cliente->execute();
    $infusuario = $cliente->fetch();

    $id_cliente = $_SESSION['usuario']['id_usuario'];
    $cliente = $conn->prepare("SELECT * FROM cliente WHERE id_usuario = :id_cliente");
    $cliente->bindValue(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $cliente->execute();
    $infcliente = $cliente->fetch();




}
$id_usuario = $_POST['deleteperfil'];
$id_cliente = $_POST['deletecliente'];




$deletecliente = $conn->prepare("DELETE  FROM cliente WHERE  id_usuario = :id_usuario ");
$deletecliente->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
$deletecliente->execute();

$deleteusuario = $conn->prepare("DELETE  FROM usuario WHERE id_usuario = :id_usuario");
$deleteusuario->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
$deleteusuario->execute();


if ($deletecliente) {

    echo "<script>
    alert('Perfil deletado com sucesso');
    window.location.href='../logout.php';
    </script>";
} else {
    echo "<script>
    alert('ocorreu um erro');
    window.history.back();
</script>";

}
$conn = null;