<?php
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';
session_start();


//armazena as informações do mercado em $infmercado
if (usuarioEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);

    if ($_SESSION['usuario']['tipo'] == 'dono') {
        $mercName = $_SESSION['usuario']['id_usuario'];
        $mercado = $conn->prepare("SELECT * FROM mercado WHERE id_dono = :id_dono");
        $mercado->bindValue(':id_dono', $mercName, PDO::PARAM_STR);
        $mercado->execute();
        $infmercado = $mercado->fetch();

    }
}
require_once '../inc/cabecalho.php'; ?>


<div id="area-principal">

    <div id="area-postagens">


        <?php
        // o cabeçalho é mostrado em cima normal, porem, se a pessoa não estiver logada é criado uma div postagem e mostra pro usuário que ele não pode acessar essa pagina 
        if (!usuarioEstaLogado()) {
            ?>
        <div class="postagem">
            <link rel="stylesheet" href="../../css/cadastro.css">
            <h2>Você não tem permissão para acessar essa página</h2>
            <h2>Realize o cadastro</h2>

            <div class="login-box"><button class='btn_left'
                    onclick="window.location.href='../index.php' ">Voltar</button></div>

        </div>
        <div id="rodape">
            &copy Todos os direitos reservados
        </div>
        <?php
            exit;
        }

        ?>


        <?php
        if (mercadoEstaLogado()) {
            $id_mercado = $infmercado['id_mercado'];
            $result = $conn->prepare("SELECT * FROM produto WHERE id_mercado = :id_mercado ;");
            $result->bindValue(':id_mercado', $id_mercado, PDO::PARAM_INT);
            $result->execute();
        }
        ?>

        <!--Abertura postagem -->
        <div class="postagem">

            <div class="login-box">
                <?php if (mercadoEstaLogado()): ?>
                <button class='btn_left' onclick="window.location.href='../cadastro/verMeuMercado.php' ">Voltar</button>
                <button class='btn_left' onclick="window.location.href='../cadastro/addprod.php' ">Adicionar
                    produto</button>
                <?php endif ?>

                <?php if (clienteEstaLogado()): ?>
                <button class='btn_left' onclick="window.location.href='../home/mercados.php' ">Voltar</button>
                <?php endif ?>

            </div>
        </div>
        <!--lista os produtos, cada vez que o metodo fetch_all() é chamado ele armazena uma linha em $row e mostra dentro do laço while  -->
        <?php
        $tipo = $_SESSION['usuario']['tipo'];
        switch($tipo){
        //se for um mercado que estiver logado vai listar os produtos e disponibilizar exclusão e edição
        case 'dono'; 
            if ($result->rowCount() > 0) {
                $produtos = $result->fetchAll();
                foreach ($produtos as $produto) { ?>
        <div class="postagem">

            <?php
                        echo "<h2> " . $produto['nome'] . " </h2>"; //nome do produto
            
                        echo '<img src="../cadastro/uploads/' . $produto['fotoProduto'] . '" alt="Imagem do produto" width="300px">';


                        echo "<p>" . $produto['preco'] . " reais</p>" //preço do produto
            
                            ?>
            <div class="login-box">

                <form action="update-prod.php" method="POST">
                    <input type="hidden" name="updateprod" value="<?= $produto['id_produto']; ?>">
                    <button class='btn_left' type="submit">Editar</button>
                </form>

                <form action="delete-prod.php" method="POST" onsubmit="return confirmarExclusaoProduto()">
                    <input type="hidden" name="deleteprod" value="<?= $produto['id_produto']; ?>">
                    <button class='btn_left' type="submit">Excluir</button>
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
            $id_mercado = $_POST['id_mercado'];

            $result = $conn->prepare("SELECT * FROM produto WHERE id_mercado = :id_mercado ");
            $result->bindValue(':id_mercado', $id_mercado, PDO::PARAM_INT);
            $result->execute();

            if ($result->rowCount() > 0) {
                $produtos = $result->fetchAll();
                foreach ($produtos as $produto) { ?>
        <div class="postagem">

            <?php
                        echo "<h2> " . $produto['nome'] . " </h2>"; //nome do produto
            
                        echo '<img src="../cadastro/uploads/' . $produto['fotoProduto'] . '" alt="Imagem do mercado" width="300px">';


                        echo "<h2>" . number_format($produto['preco'], 2, ',', '.') . " R$ </h2>" //preço do produto
            
                            ?>
            <div class="login-box">
                <button class='btn_left' onclick="window.location.href='../home/mercados.php' ">Voltar</button>
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