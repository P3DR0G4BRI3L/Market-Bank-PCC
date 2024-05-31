<?php
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';
session_start();

//verifica se tem algum usuário logado retorna true ou false


$mercadoDAO = new mercadoDAO($conn);

if (usuarioEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);

    $infmercado = $mercadoDAO->getMercadoById($_POST['id_mercado']);
}
require_once '../inc/cabecalho.php'; //mostra o cabeçalho

?>

<div id="area-principal">

    <div id="area-postagens"><!-- aqui deverá ser  o carrinho de compras -->

        <div class="postagem">

            <h2><?= ucwords($infmercado['nomeMerc']) ?></h2>

            <img src="../cadastro/uploads/<?= $infmercado['imagem'] ?>" width="620px" alt="foto mercado">

            <h2></h2>

            <h2><?= strtoupper($infmercado['endereco']) ?> </h2>

            <h2>Aberto das <?= date('H:i', strtotime($infmercado['horarioAbert'])) ?> </h2>

            <h2> Até as <?= date('H:i', strtotime($infmercado['horarioFecha'])) ?> </h2>

            <h2> telefone para contato: <?= formatarTelefone($infmercado['telefone']) ?> </h2>

            <h2><?= ($infmercado['descricao']) ?></h2>

            <button type="submit" class="button_padrao">Ver produtos</button>
            <button type="submit" class="button_padrao">Ver panfleto/s</button>

        </div>
    </div>

    <div id="area-lateral">

        <div class="conteudo-lateral">
            <h3>Carrinho</h3>
        </div>

    </div>





    <?php require_once '../inc/rodape.php'; ?>