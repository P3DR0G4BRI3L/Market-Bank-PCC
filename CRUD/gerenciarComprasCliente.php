<?php
session_start();
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';
require_once '../model/produtoDAO.php';
require_once '../model/itensDAO.php';
require_once '../model/carrinhoDAO.php';
require_once '../model/mercadoDAO.php';

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

<div id="area-principal">

    <!--Abertura postagem -->
    <div class="postagem home">
        <h2>Histórico de compras</h2>
        <button class='button_padrao' type="submit" onclick="window.location.href='../cadastro/verMeuCliente.php'">Voltar</button>
    </div>
    <?php foreach ($carrinhos as $key => $carrinho) :
        $itens = $itensDAO->getAllItensByIdCarrinho($carrinho['id_carrinho']);
        $descricao = !empty($carrinho['descricao'])?$carrinho['descricao']:null;
        $total = 0;
    ?>
        <div class="postagem home">
            <table>
                <thead>
                    <tr>

                        <th><?= $carrinho['id_carrinho'] ?></th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Mercado</th>

                    </tr>
                </thead>
                <?php foreach ($itens as $key => $item) :
                    $produto = $produtoDAO->getProdutoById($item['id_produto']);
                    $mercado = $mercadoDAO->getMercadoById($produto['id_mercado']);
                ?>
                    <tbody>
                        <tr>

                            <td></td>
                            <td><?= $produto['nome'] ?></td>
                            <td><?= $produto['preco'] ?></td>
                            <td><?= $item['quantidade'] ?></td>
                            <td><?= $mercado['nomeMerc'] ?></td>

                        </tr>
                    </tbody>
                    <?php $total+=$produto['preco']*$item['quantidade']; ?>
                    <?php endforeach ?>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total:<?=$total?> R$</td>
                            <td><?=$carrinho['status']?></td>
                        </tr>
                    </tfoot>

            </table>
            <?php if(!empty($descricao)): ?>
            <p>Descrição: <?= $descricao; ?></p>
            <?php endif ?>

        </div>
    <?php endforeach ?>















</div>
<?php require_once '../inc/rodape.php'; ?>