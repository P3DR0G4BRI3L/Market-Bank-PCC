<?php
session_start();
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';
require_once '../model/produtoDAO.php';
require_once '../model/itensDAO.php';
require_once '../model/carrinhoDAO.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';


$usuarioDAO = new usuarioDAO($conn);
$mercadoDAO = new mercadoDAO($conn);
$carrinhoDAO = new carrinhoDAO($conn);
$produtoDAO = new produtoDAO($conn);
$itensDAO = new itensDAO($conn);

$carrinhos = $carrinhoDAO->getAllCarrinhoByIdCliente($_SESSION['usuario']['id_cliente']);
$carrinhos = array_reverse($carrinhos);


if (!clienteEstaLogado()) {
    echo "<script>alert('Você não tem permissão para acessar essa página');</script>";
    echo "<script>window.location.href='../index.php';</script>";
}




require_once '../inc/cabecalho.php';
?>
<div class="wrapper">
    <div id="area-principal">

        <!--Abertura postagem -->
        <div class="postagem ">
            <h2>Histórico de compras</h2>
            <button class='button_padrao' type="submit" onclick="window.location.href='../cadastro/verMeuCliente.php'">Voltar</button>
        </div>
        <?php if (!empty($carrinhos)) :  ?>
            <?php foreach ($carrinhos as $key => $carrinho) :
                $itens = $itensDAO->getAllItensByIdCarrinho($carrinho['id_carrinho']);
                $mercado = $mercadoDAO->getMercadoById($carrinho['id_mercado']);
                $dono = $usuarioDAO->getUsuarioByDono($mercado['id_dono']);
                $descricao = !empty($carrinho['descricao']) ? $carrinho['descricao'] : null;
                $total = 0;


            ?>
                <div class="postagem ">
                    <caption><?= formatarDataHora($carrinho['data_criacao']) ?></caption>

                    <table>
                        <thead>
                            <tr>
                                <th>Mercado</th>
                                <th>Contato</th>
                                <th>Informações adicionais</th>
                            </tr>
                        </thead>
                        <?php foreach ($itens as $key => $item) {
                            $produto = $produtoDAO->getProdutoById($item['id_produto']);
                            $total += $produto['preco'] * $item['quantidade'];
                        } ?>
                        <tbody>
                            <tr>
                                <td><a class="btn_edit" href="../home/verPerfilMercado.php?id_mercado=<?= $mercado['id_mercado'] ?>"><?= $mercado['nomeMerc'] ?></a></td>

                                <td><?= $mercado['telefone'] ?></td>

                                <td><?= $carrinho['descricao'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="inline">
                        <div class="center">
                            <picture>
                                <img src="../home/img/qrcode.png" alt="" width="200px">
                                <legend style="text-align:center;">Titular da conta:<?= $dono['nome'] ?><br>Valor Total:R$<?= number_format($total, 2, ',', '.') ?></legend>
                            </picture>
                        </div>
                    </div>
                    <h3>Produtos</h3>
                    <ul>
                        <?php foreach ($itens as $key => $item) :
                            $total = 0;
                            $produto = $produtoDAO->getProdutoById($item['id_produto']);
                        ?> <li>

                                <?= $produto['nome'] ?> - <?= $item['quantidade'] ?>
                                unidade<?= unidade($item['quantidade']) ?> - R$
                                <?= number_format($produto['preco'], 2, ',', '.'); ?> cada - Subtotal:R$ <?= number_format( $item['quantidade'] * $produto['preco'], 2, ',', '.'); ?>
                                <?php $total += $produto['preco'] * $item['quantidade']; ?>

                            </li>
                        <?php endforeach ?>
                    </ul>
                    <br><br>
                    <table>
                        <th>Status do pagamento</th>
                        <td><?= $carrinho['status'] ?></td>

                    </table>


                </div>
            <?php endforeach ?>
        <?php else : ?>
            <div class="postagem ">
                <h1>O histórico está vazio</h1>
            </div>
        <?php endif ?>

















    </div>
    <?php require_once '../inc/rodape.php'; ?>