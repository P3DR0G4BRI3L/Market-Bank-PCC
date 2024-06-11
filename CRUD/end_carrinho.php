<?php
session_start();
// echo "<pre>";
// print_r($_SESSION['usuario']['carrinho']);

require_once '../model/carrinhoDAO.php';
require_once '../model/itensDAO.php';
require_once '../inc/cabecalho.php';

$carrinho = $_SESSION['usuario']['carrinho'];
$id_mercadocart = $_GET['id_mercado'] ?? 0;
?>

<div id="area-principal" style="width:700px">
    <div class="postagem end_carrinho">
        <table>
            <thead>
                <tr>
                    <th class="no-border">Produto</th>
                    <th class="no-border">Preço</th>
                    <th class="no-border">Quantidade</th>
                </tr>
            </thead>
            <tbody> <!-- Início do corpo da tabela -->
                <?php foreach($carrinho as $key => $produto): 
                     $id_mercado = $carrinho[$key]['id_mercado'];
                    // if($id_mercadocart==$id_mercado): ?>
                    <tr> <!-- Início de uma linha da tabela -->
                        <td class="no-border"><?= $produto['nome'] ?></td>
                        <td class="no-border"><?= number_format($produto['preco'], 2, ',', '.') ?> R$</td>
                        <td class="no-border"><?= $produto['quantidade'] ?></td>
                    </tr> <!-- Fim de uma linha da tabela -->
                <?php endforeach ?>
            </tbody> <!-- Fim do corpo da tabela -->
            <tfoot>
                <tr>
                    <td>Total:</td>
                    <td colspan="2">
                        <?php 
                        // Cálculo do total
                        $total = 0;
                        foreach ($carrinho as $produto) {
                            $total += $produto['quantidade'] * $produto['preco'];
                        }
                        echo number_format($total, 2, ',', '.') . " R$";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="no-border">
                        <form action="end_carrinho_form.php" method="POST">
                        <br>
                        <label for="descricao">Informações adicionais: <h6>Opcional</h6></label>
                        <input type="text" name="descricao">
                        <button class="button_padrao" type="submit">Finalizar</button>

                    </form></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
