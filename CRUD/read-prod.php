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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filtroproduto'], $_POST['id_produto'])) {
    $filtroProdutoDAO->inserirFiltroProduto(($_POST['filtroproduto']=="NULL")?NULL:$_POST['filtroproduto'], $_POST['id_produto']);
}
require_once '../inc/cabecalho.php'; ?>


<div id="area-principal">

    <div class="postagem home">
        <button type="button" class="button_padrao" onclick="window.location.href='../cadastro/addprod.php'">Adicionar produto</button>
        <button type="button" class="button_padrao" onclick="window.location.href='../cadastro/verMeuMercado.php'">Voltar</button>
    </div>

    <?php
    // o cabeçalho é mostrado em cima normal, porem, se a pessoa não estiver logada é criado uma div postagem e mostra pro usuário que ele não pode acessar essa pagina 
    voceNaoTemPermissao();


    

   
            $produtos = $produtoDAO->getAllProdutoByIdMercado($_SESSION['usuario']['mercado']['id_mercado']);
            $allfiltros = $filtroProdutoDAO->getAllFiltroByIdMercado($_SESSION['usuario']['mercado']['id_mercado']);
            if (!empty($produtos)) {
                foreach ($produtos as $produto) { ?>
                    <div class="postagem home ">

                        <div class="view_produto center">

                            <h2>
                                <?= ucwords($produto['nome']); ?>
                            </h2>

                            <img src="../cadastro/uploads/<?= $produto['fotoProduto']; ?>" alt='Imagem do produto' width='300px'>

                            <p>
                                <?= number_format($produto['preco'], 2, ',', '.'); ?> reais
                            </p>

                        </div>

                        <h2>Descrição:
                            <?= $produto['descricao'] ?>
                        </h2>

                        <div class="login-box">

                            <form action="update-prod.php" method="POST">
                                <input type="hidden" name="updateprod" value="<?= $produto['id_produto']; ?>">
                                <button class='button_padrao' type="submit">Editar</button>
                            </form>

                            <form action="delete-produto.php" method="POST" onsubmit="return confirmarExclusaoProduto()">
                                <input type="hidden" name="deleteprod" value="<?= $produto['id_produto']; ?>">
                                <input type="hidden" name="deletefile" value="<?= $produto['fotoProduto']; ?>">
                                <button class='button_padrao' type="submit">Excluir</button>
                            </form>

<h3 style="border-radius: 10px;">Adicionar categoria no produto</h3>
                            <form action="" method="POST">
                                <input type="hidden" name="id_produto" value="<?= $produto['id_produto'] ?>">
                                <select name="filtroproduto" onchange="this.form.submit()">
                                    <option value="" selected disabled>Selecione uma categoria</option>
                                    <!-- <option value="" >Nenhuma</option> -->
                                    <option value="NULL" <?= (empty($produto['id_filtro']))?'selected':'' ?> >Nenhuma</option>
                                    <?php foreach ($allfiltros as $filtro) : ?>

                                        <option value="<?= $filtro['id_filtro'] ?>" <?= ($filtro['id_filtro'] == $produto['id_filtro']) ? 'selected' : '' ?>>
                                            <?= ucwords($filtro['nomeFiltro']) ?>
                                        </option>

                                    <?php endforeach ?>
                                </select>
                            </form>

                        </div>
                        </div>
                        

                <?php }
            } else {
                echo "<div class='postagem home'>
                    <h2>Ainda não foram inseridos produtos</h2>
                </div>";
            }
            ?>


       
            </div>
<!--// Fechamento postagem -->
<?php require_once '../inc/rodape.php'; ?>