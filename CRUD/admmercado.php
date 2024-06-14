<?php
session_start();
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';
require_once '../model/administradorDAO.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';
require_once '../model/produtoDAO.php';
$produtoDAO = new produtoDAO($conn);
$usuarioDAO = new usuarioDAO($conn);
$mercadoDAO = new mercadoDAO($conn);
if ($_SESSION['usuario']['tipo'] != 'administrador') {
    header('location:../index.php');
}
if (admEstaLogado()) {
    $administradorDAO = new administradorDAO($conn);
    $allMercadoDono = $administradorDAO->getAllUsuarioByTipo('dono');
}
if (isset($_GET['id_mercado'])) {
    $id_mercado = $_GET['id_mercado'];
    if (
        $mercadoDAO->deleteAllItensByIdProdutos($produtoDAO->getAllProdutoByIdMercado($id_mercado)) &&

        $mercadoDAO->deleteAllCarrinhosByIdMercado($id_mercado) &&

        $mercadoDAO->deleteAllProdutosByMercado($id_mercado) &&

        $mercadoDAO->deleteAllPanfletosByMercado($id_mercado) &&

        $mercadoDAO->deleteAllfiltroProdutoByMercado($id_mercado) &&

        $mercadoDAO->deleteAllInfoPagByIdMercado($id_mercado)

    ) {

        if ($mercadoDAO->deleteMercadoByIdMercado($id_mercado)) {
            if ($usuarioDAO->excluirUsuario($mercadoDAO->getIdUsuarioByIdMercado($id_mercado))) {


                echo "<script>
                    alert('Mercado,produtos e panfletos excluídos com sucesso');window.location.href='admmercado.php'
                    </script>";
                exit;
            }
        }
    }
}



require_once '../inc/cabecalhocadastro.php';
?>
<div class="wrapper">
    <div id="area-principal">

        <div class="postagem home"><button class="button_padrao" onclick="window.location.href='administrador.php'">Voltar</button></div>
        <!--Aberturac -->
        <div class="postagem2">
            <h2 class="postagem_admtit">Administração Mercados</h2>
            <!-- <div class="cadastro_option">
        <div class="login-box"> -->
            <table>
                <caption>Mercados</caption>



                <thead>
                    <tr class="table_adm">
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Nome do Mercado</th>
                        <th>Região Administrativa</th>
                        <th>Imagem</th>
                        <th>Excluir</th>
                        <th>Editar</th>
                    </tr>
                </thead>

                <?php foreach ($allMercadoDono as $mercadoDono) : ?>
                    <tr>
                        <th><?= $mercadoDono['nome']; ?></th>
                        <th><?= $mercadoDono['email']; ?></th>
                        <th><?= $mercadoDono['nomeMerc']; ?></th>
                        <th><?= $mercadoDono['regiaoadm']; ?></th>
                        <th><img src="../cadastro/uploads/<?= $mercadoDono['imagem']; ?>" class="imagem" alt="foto mercadoDono"></th>

                        <th>

                            <a href="?id_mercado=<?= $mercadoDono['id_mercado'] ?>" onclick="return confirmarExclusaoClienteadm();">Excluir</a>

                        </th>
                        <th>

                            <a href="editmercadoadm.php?id_mercado=<?= $mercadoDono['id_mercado'] ?>&id_usuario=<?= $mercadoDono['id_usuario'] ?>">Editar</a>


                        </th>
                    </tr>



                <?php endforeach ?>
            </table>


            <!--// Fechamento postagem -->
        </div>
    </div>





    <?php require_once '../inc/rodape.php'; ?>