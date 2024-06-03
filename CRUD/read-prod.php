<?php
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';
require_once '../model/produtoDAO.php';
require_once '../model/mercadoDAO.php';
session_start();
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
        <div class="postagem">

            <div class="login-box">
                <?php if (mercadoEstaLogado()): ?>
                    <button class='button_padrao' onclick="window.location.href='../cadastro/addprod.php' ">Adicionar produto</button>
                    <button class='button_padrao' onclick="window.location.href='../cadastro/verMeuMercado.php' ">Voltar</button>

                <?php endif ?>

                <?php if (clienteEstaLogado()): ?>
                    <h1>Produtos do mercado: <br><?=ucwords($infmercado['nomeMerc']);?></h1>
<form action="../home/verPerfilMercado.php"method="POST">
    <input type="hidden" name="id_mercado" value="<?= $id_mercado ?>">
                    <button class='button_padrao' onclick="window.location.href='../home/verPerfilMercado.php' ">Voltar</button>
    
</form>
                <?php endif ?>

            </div>
        </div>
        <!--lista os produtos, cada vez que o metodo fetch_all() é chamado ele armazena uma linha em $row e mostra dentro do laço while  -->
        <?php
        switch($_SESSION['usuario']['tipo']){
        //se for um mercado que estiver logado vai listar os produtos e disponibilizar exclusão e edição
        case 'dono':
            $produtos = $produtoDAO->getAllProdutoByIdMercado($_SESSION['usuario']['mercado']['id_mercado']);
            if (!empty($produtos)) {
                foreach ($produtos as $produto) { ?>
        <div class="postagem">

                         <div class="view_produto">
                            
                             <h2>  <?= ucwords($produto['nome']); ?> </h2>

                            <?php echo "<img src='../cadastro/uploads/" . $produto['fotoProduto'] . "  ' alt='Imagem do produto' width='300px'>"?>

                             <p> <?= number_format($produto['preco'], 2, ',', '.'); ?> reais</p>

                         </div>

                         <h2>Descrição: <?= $produto['descricao'] ?></h2>
            
            <div class="login-box">

                <form action="update-prod.php" method="POST">
                    <input type="hidden" name="updateprod" value="<?= $produto['id_produto']; ?>">
                    <button class='button_padrao' type="submit">Editar</button>
                </form>

                <form action="delete.php" method="POST" onsubmit="return confirmarExclusaoProduto()">
                    <input type="hidden" name="deleteprod" value="<?= $produto['id_produto']; ?>">
                    <input type="hidden" name="deletefile" value="<?= $produto['fotoProduto']; ?>">
                    <button class='button_padrao' type="submit">Excluir</button>
                </form>
            </div>


        </div>
        <?php }
            } else {
                echo "<div class='postagem'>
                    <h2>Ainda não foram inseridos produtos</h2>
                </div>";
            }
        break;


        case 'cliente' : 
        case 'administrador' : 
            if(empty($id_mercado) || isset($id_mercado)){
                voceNaoTemPermissao();
            }
            $produtos= $produtoDAO->getAllProdutoByIdMercado($id_mercado);

            if (!empty($produtos)) {
                foreach ($produtos as $produto) { ?>
        <div class="postagem">

            <?php
                        echo "<h2> " . $produto['nome'] . " </h2>"; //nome do produto
            
                        echo '<img src="../cadastro/uploads/' . $produto['fotoProduto'] . '" alt="Imagem do mercado" width="300px">';


                        echo "<h2>" . number_format($produto['preco'], 2, ',', '.') . " R$ </h2>" ;//preço do produto

                        echo "<h2>Descrição:" . $produto['descricao'] . "</h2>"; //descrição do produto
                            ?>
            <div class="login-box">
                <button class='button_padrao' onclick="window.location.href='../home/mercados.php' ">Voltar</button>
            </div>


        </div>
        <?php }
            } else {
                echo "<div class='postagem'>
                    <h2>Ainda não foram inseridos produtos</h2>
                </div>";

            }
        break;
    }?>
        <hr>
        <!--// Fechamento postagem -->


        <?php require_once '../inc/rodape.php'; ?>