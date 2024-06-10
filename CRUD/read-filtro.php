<?php
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';
require_once '../model/produtoDAO.php';
require_once '../model/mercadoDAO.php';
require_once '../model/filtroProdutoDAO.php';
session_start();
$produtoDAO = new produtoDAO($conn);
$mercadoDAO = new mercadoDAO($conn);
$filtroProdutoDAO = new filtroProdutoDAO($conn);
$id_mercado = $_SESSION['usuario']['verMercado'] ?? '';
$infmercado = $mercadoDAO->getMercadoById($id_mercado);

require_once '../inc/cabecalho.php'; ?>


<div id="area-principal">

    <div id="area-postagens">


        <?php
        // o cabeçalho é mostrado em cima normal, porem, se a pessoa não estiver logada é criado uma div postagem e mostra pro usuário que ele não pode acessar essa pagina 
        voceNaoTemPermissao();



        ?>

        <!--Abertura postagem -->
        <div class="postagem">

            <div class="login-box">
                <?php if (mercadoEstaLogado()): ?>
                    <button class='button_padrao' onclick="window.location.href='../cadastro/addfiltro.php' ">Adicionar
                        categoria</button>
                    <button class='button_padrao'
                        onclick="window.location.href='../cadastro/verMeuMercado.php' ">Voltar</button>

                <?php endif ?>

                <?php if (clienteEstaLogado()): ?>
                    <h1>Produtos do mercado: <br><?= ucwords($infmercado['nomeMerc']); ?>
                    </h1>
                    <form action="../home/verPerfilMercado.php" method="POST">
                        <input type="hidden" name="id_mercado" value="<?= $id_mercado ?>">
                        <button class='button_padrao'
                            onclick="window.location.href='../home/verPerfilMercado.php' ">Voltar</button>

                    </form>
                <?php endif ?>

            </div>
        </div>
        <!--lista os produtos, cada vez que o metodo fetch_all() é chamado ele armazena uma linha em $row e mostra dentro do laço while  -->
        <?php
       
           
                $filtros = $filtroProdutoDAO->getAllFiltroByIdMercado($_SESSION['usuario']['mercado']['id_mercado']);
                if (!empty($filtros)) {
                    foreach ($filtros as $filtro) { ?>
                        <div class="postagem">

                            

                                <h2 style="text-align:center;">
                                    <?= ucwords($filtro['nomeFiltro']); ?>
                                </h2>


                            
                            
                            
                            <div class="login-box">

                                <form action="update-filtro.php" method="POST">
                                    <input type="hidden" name="updatefiltro" value="<?= $filtro['id_filtro']; ?>">
                                    <button class='button_padrao' type="submit">Editar</button>
                                </form>

                                <form action="delete.php" method="POST" onsubmit="return confirmarExclusaoProduto()">
                                    <input type="hidden" name="deletefiltro" value="<?= $filtro['id_filtro']; ?>">
                                    <button class='button_padrao' type="submit">Excluir</button>
                                </form>

                                <form action="read-prod-filtro.php" method="POST">
                                    <input type="hidden" name="verprodutosfiltro" value="<?= $filtro['id_filtro']; ?>">
                                    <button class='button_padrao' type="submit">Ver produtos da categoria</button>
                                </form>
                            </div>


                        </div>
                    <?php }
                } else {
                    echo "<div class='postagem'>
                    <h2>Ainda não foram inseridos categorias</h2>
                </div>";
                }
               ?>
    <!--// Fechamento postagem -->

