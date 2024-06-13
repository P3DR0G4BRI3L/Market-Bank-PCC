<?php
session_start();
require_once '../inc/cabecalho.php';
require_once '../cadastro/cadastro.php';
require_once '../model/mercadoDAO.php';
require_once '../model/infopagDAO.php';

$mercadoDAO = new mercadoDAO($conn);
$infopagDAO = new infopagDAO($conn);

$infopag = (!$infopagDAO->getInfopagByIdMercado($_SESSION['usuario']['mercado']['id_mercado'])) ? ['tipo'=>'cnpj']:$infopagDAO->getInfopagByIdMercado($_SESSION['usuario']['mercado']['id_mercado']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['infopag'])) {
    switch ($_POST['infopag']) {

        case 'cnpj':
            if ($infopagDAO->atualizarInfoPag($_SESSION['usuario']['mercado']['id_mercado'], $_POST['infopag'], $_SESSION['usuario']['mercado']['cnpj'])) {
                echo "<script>alert('Editado com sucesso');window.location.href='../cadastro/verMeuMercado.php' </script>";
            }

            break;

        case 'telefone':
            if ($infopagDAO->atualizarInfoPag($_SESSION['usuario']['mercado']['id_mercado'], $_POST['infopag'], $_SESSION['usuario']['mercado']['telefone'])) {
                echo "<script>alert('Editado com sucesso');window.location.href='../cadastro/verMeuMercado.php' </script>";
            }

            break;

        case 'email':
            if ($infopagDAO->atualizarInfoPag($_SESSION['usuario']['mercado']['id_mercado'], $_POST['infopag'], $_SESSION['usuario']['mercado']['email'])) {
                echo "<script>alert('Editado com sucesso');window.location.href='../cadastro/verMeuMercado.php' </script>";
            }

            break;
    }
}





?>
<div class="wrapper">
    <div id="area-principal">
        <div class="postagem home">
            <button type="button" class="button_padrao" onclick="window.location.href='../cadastro/verMeuMercado.php'">Voltar</button>
        </div>
        <div class="postagem home">
            <h2>Forma de pagamento</h2>
            <form action="" method="POST">
                <select name="infopag" id="infopag">

                    <option value="telefone" <?= ($infopag['tipo'] == 'telefone') ? 'selected' : ''  ?>>Telefone</option>
                    <option value="cnpj" <?= ($infopag['tipo'] == 'cnpj') ? 'selected' : ''  ?>>CNPJ</option>
                    <option value="email" <?= ($infopag['tipo'] == 'email') ? 'selected' : ''  ?>>Email</option>

                </select>
                <button type="submit" class="button_padrao btn_edit">Salvar</button>
            </form>
        </div>
    </div>

    <?php require_once '../inc/rodape.php'; ?>