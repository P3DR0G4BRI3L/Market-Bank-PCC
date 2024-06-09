<?php

require_once '../model/produtoDAO.php';
require_once '../model/filtroProdutoDAO.php';
require_once '../cadastro/cadastro.php';
$produtoDAO = new produtoDAO($conn);
$filtroProdutoDAO = new filtroProdutoDAO($conn);
$filtro = $filtroProdutoDAO->getFiltroById($_POST['verprodutosfiltro']);
$produtos = $produtoDAO->getAllProdutoByIdFiltro($_POST['verprodutosfiltro']);






require_once '../inc/cabecalho.php';
?>
<div id="area-principal">
    <div id="area-postagens">

        <div class="postagem">
            <h2>Categoria: <?= $filtro['nomeFiltro'] ?></h2>
            <button type="button" class="button_padrao" onclick="window.location.href='read-filtro.php'">Voltar</button>
        </div>
        <div class="postagem">
            
            <?php
            if(!empty($produtos)){
            foreach ($produtos as $produto) { ?>
                <div class="view_produto">

                                <h2>
                                    <?= ucwords($produto['nome']); ?>
                                </h2>

                                <img src="../cadastro/uploads/<?= $produto['fotoProduto']; ?>" alt='Imagem do produto' width='300px'>

                                

                            </div>
            <?php 
           
        } 
             }else{
                echo "<div class='view_produto'><h2>Ainda não foi adicionado nenhum produto</h2></div>";
            }
            ?>
        </div>

    </div>
</div>