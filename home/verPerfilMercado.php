<?php
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';
session_start();

if (isset($_GET['id_mercado'])) {

    $_SESSION['usuario']['verMercado'] = $_GET['id_mercado'];
}

$mercadoDAO = new mercadoDAO($conn);

if (usuarioEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);

    $infmercado = $mercadoDAO->getMercadoById($_SESSION['usuario']['verMercado']);
}
require_once '../inc/cabecalho.php'; //mostra o cabeçalho

?>
<div class="wrapper"> 
<div id="area-principal">

    <div id="area-postagens">
        <!-- aqui deverá ser  o carrinho de compras -->

        <?php voceNaoTemPermissao(); ?>
        <div class="postagem">


            <h2><?= ucwords($infmercado['nomeMerc']) ?></h2>

            <img src="../cadastro/uploads/<?= $infmercado['imagem'] ?>" width="620px" alt="foto mercado">

            <h2><?= ucwords($infmercado['regiaoadm']) ?>

            <?= strtoupper($infmercado['endereco']) ?> </h2>

            <h2>Aberto das <?= date('H:i', strtotime($infmercado['horarioAbert'])) ?> </h2>

            <h2> Até as <?= date('H:i', strtotime($infmercado['horarioFecha'])) ?> </h2>

            <h2> Telefone para Contato: <?= formatarTelefone($infmercado['telefone']) ?> </h2>

            <h2>Descrição: <?= ($infmercado['descricao']) ?></h2>


            <form action="../CRUD/read-prodCliente.php" method="POST">
                <input type="hidden" name="id_mercado" value="<?= $infmercado['id_mercado'] ?>">
                <button type="submit" class="button_padrao">Ver produtos</button>
            </form>

            <form action="../CRUD/read-panf.php" method="POST">
                <input type="hidden" name="id_mercado" value="<?= $infmercado['id_mercado'] ?>">
                <button type="submit" class="button_padrao">Ver panfletos</button>
            </form>




        </div>
    </div>
    <?php if($infmercado['compras']=='sim' && clienteEstaLogado()): ?>
    <div id="area-lateral">
        <?php require_once 'carrinho.php'; ?>
        
        </div>
    <?php endif ?>

</div>

    <?php require_once '../inc/rodape.php'; ?>