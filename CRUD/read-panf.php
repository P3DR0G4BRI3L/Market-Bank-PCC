<?php
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';
require_once '../model/mercadoDAO.php';
require_once '../model/panfletoDAO.php';
session_start();
$id_mercado = $_SESSION['usuario']['verMercado'] ?? '';


//armazena as informações do mercado em $infmercado





require_once '../inc/cabecalho.php'; ?>


<div id="area-principal">



    <?php
    voceNaoTemPermissao();
    ?>
    <!--Abertura postagem -->
    <div class="postagem home">

        <div class="login-box">
            <?php if (mercadoEstaLogado()) : ?>
                <button class='button_padrao' onclick="window.location.href='create-panf.php' ">Adicionar panfleto</button>

                <button class='button_padrao' onclick="window.location.href='../cadastro/verMeuMercado.php' ">Voltar</button>

            <?php endif ?>
            <?php if (!mercadoEstaLogado()) : ?>
                <form action="../home/verPerfilMercado.php" method="POST">
                    <input type="hidden" name="id_mercado" value="<?= $id_mercado ?>">
                    <button class='button_padrao' onclick="window.location.href='../home/verPerfilMercado.php' ">Voltar</button>
                </form>
            <?php endif ?>
        </div>
    </div>
    <!--lista os produtos, cada vez que o metodo fetch_all() é chamado ele armazena uma linha em $row e mostra dentro do laço while  -->
    <?php
    $panfletoDAO = new panfletoDAO($conn);

    switch ($_SESSION['usuario']['tipo']) {
            //se for um mercado que estiver logado vai listar os produtos e disponibilizar exclusão e edição
        case 'dono':
            $panfletos = $panfletoDAO->getAllPanfletoByIdMercado($_SESSION['usuario']['mercado']['id_mercado']);
            if (!empty($panfletos)) {
                foreach ($panfletos as $panfleto) : ?>
                    <div class="postagem home">
                        <?php //print_r($panfletos);exit; 
                        ?>


                        <img src="../cadastro/uploads/<?= $panfleto['foto'] ?>" alt="Imagem do panfleto" width="300px">

                        <h2> Validade: <?= formatarData($panfleto['validade']) ?> </h2>



                        <h2>Descrição:<?= $panfleto['descricao'] ?> </h2>


                        <div class="login-box">

                            <form action="update-panf.php" method="POST">
                                <input type="hidden" name="id_panfleto" value="<?= $panfleto['id_panfleto']; ?>">
                                <button class='button_padrao' type="submit">Editar</button>
                            </form>

                            <form action="delete.php" method="POST" onsubmit="return confirmarExclusaoPanfleto()">
                                <input type="hidden" name="deletepanf" value="<?= $panfleto['id_panfleto']; ?>">
                                <input type="hidden" name="deletefilepanf" value="<?= $panfleto['foto']; ?>">
                                <button class='button_padrao' type="submit">Excluir</button>
                            </form>
                        </div>


                    </div>
                <?php endforeach ?>
                <?php
            } else {
                echo "<div class='postagem home'>
                    <h2>Ainda não foram inseridos panfletos</h2>
                </div>";
            }
            break;


        case 'cliente':
        case 'administrador':
            if (empty($id_mercado) || isset($id_mercado)) {
                voceNaoTemPermissao();
            }
            $panfletos = $panfletoDAO->getAllpanfletoByIdMercado($id_mercado);
            if (!empty($panfletos)) {
                foreach ($panfletos as $panfleto) { ?>
                    <div class="postagem home">
                        <?php //print_r($panfletos);exit; 
                        ?>


                        <img src="../cadastro/uploads/<?= $panfleto['foto'] ?>" alt="Imagem do panfleto" width="300px">

                        <h2> <?= formatarData($panfleto['validade']) ?> </h2>



                        <h2>Descrição:<?= $panfleto['descricao'] ?> </h2>


                        <div class="login-box">
                            <button class='button_padrao' onclick="window.location.href='../home/mercados.php' ">Voltar</button>
                        </div>


                    </div>
    <?php }
            } else {
                echo "<div class='postagem home'>
                    <h2>Ainda não foram inseridos panfletos</h2>
                    </div>";
            }
            break;
    } ?>
</div>


<?php require_once '../inc/rodape.php'; ?>