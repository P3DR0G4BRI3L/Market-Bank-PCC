<?php
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';
require_once '../model/produtoDAO.php';
require_once '../model/mercadoDAO.php';
require_once '../model/filtroProdutoDAO.php';
session_start();
$filtroProdutoDAO = new filtroProdutoDAO($conn);
$produtoDAO = new produtoDAO($conn);
$mercadoDAO = new mercadoDAO($conn);
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
    <div class="postagem home">

        <div class="login-box">
           
                <button class='button_padrao' onclick="window.location.href='../cadastro/verMeuMercado.php' ">Voltar</button>


            <?php if (clienteEstaLogado() || admEstaLogado()) : ?>
                <h1>Produtos do mercado: <br><?= ucwords($infmercado['nomeMerc']); ?>
                </h1>
                    <button class='button_padrao' onclick="window.location.href='../home/verPerfilMercado.php' ">Voltar</button>
                    <form action="" method="POST">
                                <input type="hidden" name="id_produto" value="<?= $produto['id_produto'] ?>">
                                <select name="filtroproduto" onchange="this.form.submit()">
                                    <option value="" selected disabled>Selecione uma categoria</option>
                                    <?php foreach ($allfiltros as $filtro) : ?>

                                        <option value="<?= $filtro['id_filtro'] ?>" <?= ($filtro['id_filtro'] == $produto['id_filtro']) ? 'selected' : '' ?>>
                                            <?= ucwords($filtro['nomeFiltro']) ?>
                                        </option>

                                    <?php endforeach ?>
                                </select>
                            </form>
            <?php endif ?>

            <?php if (admEstaLogado()) : ?>
                <h1>Produtos do mercado: <br><?= ucwords($infmercado['nomeMerc']); ?>
                </h1>
                <form action="../home/verPerfilMercado.php" method="POST">
                    <input type="hidden" name="id_mercado" value="<?= $id_mercado ?>">
                    <button class='button_padrao' onclick="window.location.href='../home/verPerfilMercado.php' ">Voltar</button>

                </form>
            <?php endif ?>

        </div>
    </div>









<?php 
if (empty($id_mercado) || isset($id_mercado)) {
                voceNaoTemPermissao();
            }
            $produtos = $produtoDAO->getAllProdutoByIdMercado($id_mercado);
            $mercado = $mercadoDAO->getMercadoById($id_mercado);
            if (!empty($produtos)) { ?>
                <div class="postagem postagem_produto flex home">
                    <?php foreach ($produtos as $produto) : ?>
                        <div class="view_produto" id="<?= $produto['id_produto'] ?>">

                            <h2> <?= $produto['nome'] ?> </h2>

                            <img src="../cadastro/uploads/<?= $produto['fotoProduto'] ?>" alt="Imagem do mercado" width="300px">


                            <h2> <?= number_format($produto['preco'], 2, ',', '.') ?> R$ </h2>
                            <?php if (!empty($produto['descricao'])) : ?>
                                <h3 class="descricao">Descrição
                                    <span class="mostrar"><?= $produto['descricao'] ?></span>
                                </h3>
                            <?php else : ?>
                                <h3 class="descricao ">Descrição
                                    <span class="mostrar">Este produto não possui descrição</span>
                                </h3>
                            <?php endif ?>

                            <?php if (clienteEstaLogado() && $mercado['compras'] == 'sim') : ?>
                                <a href="add_carrinho.php?id_produto=<?= $produto['id_produto'] ?>">Adicionar ao carrinho</a>
                            <?php endif ?>
                        </div>


                    <?php endforeach ?>
                </div>
                </div>


                <?php if($mercado['compras']=='sim'): ?>

                <div id="area-lateral">
                    <?php require_once '../home/carrinho.php'; ?>
                </div>

                <?php endif ?>

            <?php } else {
                echo "<div class='postagem'>
                <h2>Ainda não foram inseridos produtos</h2>
                </div>";
                }
                 ?>
            </div>
<!--// Fechamento postagem -->
<?php require_once '../inc/rodape.php'; ?>