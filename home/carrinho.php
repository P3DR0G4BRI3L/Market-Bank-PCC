<?php

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


        <?php if (!empty($_SESSION['usuario']['carrinho'])) :
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
                <tbody>
                    <?php foreach ($carrinhoshow as $cart) : ?>
                        <tr>
                            <th>
                                <p><?= $cart['nome']  ?></p>
                            </th>

                            <th>
                                <?= $cart['quantidade'] ?>
                            </th>

                            

                            <th>
                                <p><?= $cart['preco']  ?></p>
                            </th>

                            <th>
                                <p><?= $cart['quantidade'] * $cart['preco']  ?></p>
                            </th>
                        </tr>
                    <?php endforeach ?>
                </tbody>


            </table>
            <button class='button_carrinho' onclick="window.location.href= '' ">Finalizar carrinho</button>

        <?php else : ?>

            <p class="prod_none">Ainda não foram inseridos produtos</p>





        <?php endif ?>
    </div>
</div>
<?php echo "<pre>";
print_r($_SESSION);
