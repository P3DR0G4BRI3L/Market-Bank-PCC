<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

</html>
<a?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../model/produtoDAO.php';
require_once '../cadastro/cadastro.php';
$produtoDAO = new produtoDAO($conn);
?>

<div class="carrinho">
    <h3>Carrinho</h3>
    <div class="postagem-lateral produto">


        <?php if (!empty($_SESSION['usuario']['carrinho'])):
            $carrinhoshow = array_values($_SESSION['usuario']['carrinho']);
        ?>
            <table>
                <thead>

                    <tr>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Preço unitário</th>
                        <th>Preço total</th>
                    </tr>
                </thead>
                <?php foreach ($carrinhoshow as $key => $cart) : ?>
                    <?php if ($cart['id_mercado'] == $_SESSION['usuario']['verMercado']) : ?>
                        <tbody>
                            <tr>
                                <td>
                                    <p><?= $cart['nome']  ?></p>
                                    </td>
                                    
                                    
                                    <td>
    
                                            <a href="../CRUD/del_carrinho.php?id_produto=<?= $cart['id_produto'] ?>"><i style="color:red;cursor:pointer;" class=" fas fa-minus"></i></a><!--deletar-->
                                            <?= $cart['quantidade'] ?>
                                            <a href="../CRUD/add_carrinho.php?id_produto=<?= $cart['id_produto'] ?>"><i style="color:green;cursor:pointer;" class="fas fa-plus"></i></a><!--adicionar-->
    
                                </td>



                                <td>
                                    <p><?= $cart['preco']  ?></p>
                                </td>

                                <td>
                                    <p><?= $cart['quantidade'] * $cart['preco']  ?></p>
                                </td>
                            </tr>
                        </tbody>
                    <?php else : ?>
                        <p class="prod_none">Ainda não foram inseridos produtos</p>
                    <?php exit;
                    endif ?>
                <?php endforeach ?>
                <tfoot>
                    <tr>
                        <th class="no-border"><a class='cart_end button_carrinho' href= "../CRUD/end_carrinho.php?id_mercado?<?=$_SESSION['usuario']['verMercado']?>" >Finalizar carrinho</a></th>
                        <th class="no-border"><a class='cart_del button_carrinho ' onclick="confirmarLimparCarrinho();">Limpar carrinho</a></th>

                        <th class="no-border"></th>
                        <th class="no-border"></th>
                    </tr>
                </tfoot>


            </table>


        <?php else : ?>

            <p class="prod_none">Ainda não foram inseridos produtos</p>

        <?php endif  ?>
    </div>
</div>