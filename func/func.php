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

function voceNaoTemPermissao(){
if (!usuarioEstaLogado()){//essa função mostra de forma mais amigavel pro usuario que ele não pode acessar essa página, essa função deve estar dentro das divs area-principal e area-postagens
    echo "
<div id='area-principal'>
    <div id='area-postagens'>
            
        <div class='postagem'>
        <link rel='stylesheet' href='../../css/cadastro.css'>
        <h2>Você não tem permissão para acessar essa página</h2>
        <h2>Realize o cadastro</h2>
        <div class='login-box'><button  class='button_padrao'
                onclick=\"window.location.href='../index.php' \">Voltar</button></div>
        
        </div>
        <div id='rodape'>
        &copy Todos os direitos reservados
        </div>
    </div>
</div>";
exit;

}}
function formatarData($data) {
    // Converte a data para o formato timestamp
    $timestamp = strtotime($data);
    
    // Formata a data para o formato desejado
    $data_formatada = date('d/m/Y', $timestamp);
    
    return $data_formatada;
}
function unidade($quantidade){
    if($quantidade>1){
        return "s" ;
    }
}

function formatarDataHora($dataHoraString) {
    // Converter para timestamp Unix usando strtotime()
    $timestamp = strtotime($dataHoraString);

    // Formatando a data e hora conforme necessário
    $formatted_date = date("d/m/Y H:i:s", $timestamp);

    return $formatted_date;
}

