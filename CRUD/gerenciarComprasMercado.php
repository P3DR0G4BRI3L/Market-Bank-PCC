<?php
session_start();
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';
require_once '../model/produtoDAO.php';
require_once '../model/itensDAO.php';
require_once '../model/carrinhoDAO.php';
require_once '../model/mercadoDAO.php';
require_once '../model/infopagDAO.php';
require_once '../model/usuarioDAO.php';


$usuarioDAO = new usuarioDAO($conn);
$infopagDAO = new infopagDAO($conn);
$mercadoDAO = new mercadoDAO($conn);
$carrinhoDAO = new carrinhoDAO($conn);
$produtoDAO = new produtoDAO($conn);
$itensDAO = new itensDAO($conn);

$carrinhos = $carrinhoDAO->getAllCarrinhoByIdMercado($_SESSION['usuario']['mercado']['id_mercado']);
$carrinhos = array_reverse($carrinhos);


if (!mercadoEstaLogado()) {
    echo "<script>alert('Você não tem permissão para acessar essa página');</script>";
    echo "<script>window.location.href='../index.php';</script>";
}

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['id_carrinho'],$_POST['status'])){
    if($carrinhoDAO->atualizarStatusByIdCarrinho($_POST['status'],$_POST['id_carrinho'])){
        header('location:?mess=Atualizado com sucesso'); }
}


require_once '../inc/cabecalho.php';
?>

<div class="wrapper">
    <div id="area-principal">

        <!--Abertura postagem -->
        <div class="postagem ">
            <h2>Histórico de compras</h2>
            <button class='button_padrao' type="submit" onclick="window.location.href='../cadastro/verMeuMercado.php'">Voltar</button>
            <?php if(isset($_GET['mess'])): ?>
                
                <div class="inline center align ">  <h2><a class="button_padrao" href="?">&times;</a></h2>  <h4><?= $_GET['mess'] ?></h4></div>
                
            <?php endif ?>
        </div>
        <?php if (!empty($carrinhos)) :  ?>
            <?php foreach ($carrinhos as $key => $carrinho) :
                $itens = $itensDAO->getAllItensByIdCarrinho($carrinho['id_carrinho']);
                $mercado = $mercadoDAO->getMercadoById($carrinho['id_mercado']);
                $descricao = !empty($carrinho['descricao']) ? $carrinho['descricao'] : null;
                $cliente = $usuarioDAO->getUsuarioEclienteByIdCliente($carrinho['id_cliente']);
                $total = 0;


            ?>


                <div class="postagem ">
                    <caption><?= formatarDataHora($carrinho['data_criacao']) ?></caption>

                    <table>
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Contato</th>
                                <th>Valor total</th>
                                <th>Informações adicionais</th>
                            </tr>
                        </thead>
                        <?php foreach ($itens as $key => $item) {
                            $produto = $produtoDAO->getProdutoById($item['id_produto']);
                            $total += $produto['preco'] * $item['quantidade'];
                        } ?>
                        <tbody>
                            <tr>
                                <td><?= $cliente['nome'] ?></td>

                                <td><?= $cliente['telefone'] ?></td>

                                <td>R$<?= number_format($total, 2, ',', '.') ?></td>

                                <td class="quebra"><?= $carrinho['descricao'] ?></td>

                            </tr>
                        </tbody>
                    </table>

                    <br>
                        <h3>Produtos</h3>
                    <ul>
                        <?php foreach ($itens as $key => $item) :
                            $total = 0;
                            $produto = $produtoDAO->getProdutoById($item['id_produto']);
                        ?>
                            <li>

                                <?= $produto['nome'] ?> - <?= $item['quantidade'] ?>
                                unidade<?= unidade($item['quantidade']) ?> - R$
                                <?= number_format($produto['preco'], 2, ',', '.'); ?> cada - Subtotal:R$ <?= number_format($item['quantidade'] * $produto['preco'],2,',','.') ?>
                                <?php $total += $produto['preco'] * $item['quantidade']; ?>

                            </li>
                        <?php endforeach ?>
                    </ul>
                    <br>

                    <table>
                        <tr>
                            <th>Status do pagamento</th>

                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="id_carrinho" value="<?=$carrinho['id_carrinho']?>">
                                    <select name="status" id="status" onchange="this.form.submit()">
                                        <option value="pendente"<?=($carrinho['status']=='pendente')?'selected':''?>> Pendente</option>
                                        <option value="finalizado"<?=($carrinho['status']=='finalizado')?'selected':''?>> Finalizado</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    </table>




                </div>
            <?php endforeach ?>
        <?php else : ?>
            <div class="postagem home">
                <h1>O histórico está vazio</h1>
            </div>
        <?php endif ?>