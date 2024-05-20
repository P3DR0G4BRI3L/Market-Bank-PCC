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
function admEstaLogado()
{
    return isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo'] == 'administrador';
}

// redireciona  o usuario caso ele não esteja logado
function redirecionamento()
{
    if (!mercadoEstaLogado()) {
        echo "<script>window.history.back()</script>";
    }
}

function formatarTelefone($numero) {
   

    // Quebra o número em partes usando substr
    $ddd = substr($numero, 0, 2);         // DDD (2 dígitos)
    $prefixo = substr($numero, 2, 1);     // Prefixo (1 dígito)
    $parte1 = substr($numero, 3, 4);      // Primeira parte do número (4 dígitos)
    $parte2 = substr($numero, 7, 4);      // Segunda parte do número (4 dígitos)

    // Concatena as partes com os espaços e hífens necessários
    $numeroFormatado = $ddd . " " . $prefixo . " " . $parte1 . "-" . $parte2;

    return $numeroFormatado;
}
function formatarCNPJ($cnpj) {
    // Remove todos os caracteres não numéricos
    $cnpj = preg_replace('/\D/', '', $cnpj);

    // Verifica se o CNPJ tem exatamente 14 dígitos
    if (strlen($cnpj) != 14) {
        return "CNPJ inválido";
    }

    // Formata o CNPJ
    $cnpjFormatado = substr($cnpj, 0, 2) . '.' .
                     substr($cnpj, 2, 3) . '.' .
                     substr($cnpj, 5, 3) . '/' .
                     substr($cnpj, 8, 4) . '-' .
                     substr($cnpj, 12, 2);

    return $cnpjFormatado;
}