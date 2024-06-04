<?php
require_once 'cadastro.php';
require_once '../func/func.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';


session_start();




if (!mercadoEstaLogado()) {
    echo "<script>alert('Você não tem permissão para acessar essa página');</script>";
    echo "<script>window.location.href='../index.php';</script>";
}
$usuarioDAO = new usuarioDAO($conn);


require_once '../inc/cabecalho.php' ;
?>
<div id="area-principal">

    <div id="area-postagens">

        <!--Abertura postagem -->
        <div class="postagem">
            <?php
            echo "<h2> " . ucwords($_SESSION['usuario']['mercado']['nomeMerc']) . " </h2>"; //nome do mercado
                
                echo '<img src="uploads/' . $_SESSION['usuario']['mercado']['imagem'] . '" alt="Imagem do mercado" width="620px">';


                echo "<h2>" . ucwords($_SESSION['usuario']['mercado']['regiaoadm']) . "</h2>"; //endereço do mercado

                echo "<h2>" . ucwords($_SESSION['usuario']['mercado']['endereco']) . "</h2>"; //endereço do mercado

                echo "<h2>Aberto das " . date('H:i', strtotime($_SESSION['usuario']['mercado']['horarioAbert'])) . "</h2>"; //endereço do mercado

                echo "<h2> Até as " . date('H:i', strtotime($_SESSION['usuario']['mercado']['horarioFecha'])) . "</h2>"; //endereço do mercado
                
                echo "<h2> telefone para contato: " . formatarTelefone($_SESSION['usuario']['mercado']['telefone']) . "</h2>";
  
                echo "<h2> CNPJ: " . formatarCNPJ($_SESSION['usuario']['mercado']['cnpj']) . "</h2>";

                echo "<h2> Descrição: " . $_SESSION['usuario']['mercado']['descricao']. "</h2>";

                echo "<h2> Compras: " . ucwords(($_SESSION['usuario']['mercado']['compras'])=='nao'?'não':'sim') . "</h2>";
?>
            <button class="button_padrao btn_edit" onclick="window.location.href='../CRUD/update-mercado.php'">Editar</button>

            <form action="../CRUD/delete.php" method="POST" onsubmit="return confirmarExclusaoMercado();">
                <input type="hidden" name="deletemercado" value="<?= $_SESSION['usuario']['mercado']['id_mercado'] ?>">
                <button type="submit" class="button_padrao btn_delete">Excluir</button>
            </form>

            <button class="button_padrao" onclick="window.location.href = '../CRUD/read-prod.php'">Produtos</button>

            <button class="button_padrao" onclick="window.location.href = '../CRUD/read-filtro.php' ">Categoria de produtos</button>

            <button class="button_padrao" onclick="window.location.href = '../CRUD/read-panf.php' ">Panfletos</button>
            
            <button class='button_padrao btn_left' type="submit" onclick="window.location.href='../index.php'">Voltar</button>

        </div>

        <?php require_once '../inc/rodape.php'; ?>