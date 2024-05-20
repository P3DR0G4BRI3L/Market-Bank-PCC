<?php
session_start();
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';

if (usuarioEstaLogado()) {
    $userlog = $_SESSION['usuario']['nome'];
}

require_once '../inc/cabecalho.php';//mostra o cabeçalho
