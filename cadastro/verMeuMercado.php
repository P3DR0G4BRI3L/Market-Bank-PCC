<?php
require_once 'cadastro.php';
require_once '../func/func.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';


session_start();




if (!usuarioEstaLogado()) {
    echo "<script>alert('Você não tem permissão para acessar essa página');</script>";
    echo "<script>window.location.href='../index.php';</script>";
}
$usuarioDAO = new usuarioDAO($conn);

if (mercadoEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);

       $mercadoDAO = new mercadoDAO($conn);
       $infmercado = $mercadoDAO->getMercadoByIdUsuario($_SESSION['usuario']['id_usuario']);
        


}

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
            <button class="btn_ud" onclick="window.location.href='../CRUD/update-mercado.php'">Editar</button>
            <button class="btn_ud" onclick="confirmarExclusaoMercado();">Excluir</button>

            <button class="btn_ud" onclick="window.location.href = '../CRUD/read-prod.php'"> Ver Produtos</button>
            <button class='btn_left' type="submit" onclick="window.location.href='../index.php'">Voltar</button>

        </div>

        <?php require_once '../inc/rodape.php'; ?>