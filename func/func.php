<?php

//verifica se tem um usuario logado
function usuarioEstaLogado(): bool
{
    return isset($_SESSION['usuario']);
}

//verifica se tem um cliente logado
function clienteEstaLogado()
{

    return isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo'] == 'cliente';
}
//verifica se um mercado está logado
function mercadoEstaLogado()
{
    return isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo'] == 'dono';
}

// redireciona  o usuario caso ele não esteja logado
function redirecionamento()
{
    if (!mercadoEstaLogado()) {
        echo "<script>window.history.back()</script>";
    }
}

function armazenainfoMercado()
{
    if (usuarioEstaLogado() && $_SESSION['usuario']['tipo'] == 'dono') {

        require_once '../cadastro/cadastro.php';
        $mercName = $_SESSION['usuario']['id_usuario'];
        $mercado = $conn->query("SELECT * FROM mercado WHERE id_dono = '$mercName'");
        return $mercado->fetch_assoc();


    }
}