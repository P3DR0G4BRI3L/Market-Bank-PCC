<div id="area-lateral">
    <div class="carrinho">
        <h3>Carrinho</h3>
        <div class="postagem-lateral produto">
             

        <?php if(!empty($_SESSION['usuario']['carrinho'])):?>


            <?php else: ?>

            <p class="prod_none">Ainda não foram inseridos produtos</p>
            
            
            
            
            
            <?php endif ?>
        </div>
    </div>
</div>