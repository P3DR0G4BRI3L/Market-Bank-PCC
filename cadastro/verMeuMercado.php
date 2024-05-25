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
            echo "<h2> " . ucwords($infmercado['nomeMerc']) . " </h2>"; //nome do mercado
                
                echo '<img src="uploads/' . $infmercado['imagem'] . '" alt="Imagem do mercado" width="620px">';


                echo "<h2>" . ucwords($infmercado['regiaoadm']) . "</h2>"; //endereço do mercado

                echo "<h2>" . ucwords($infmercado['endereco']) . "</h2>"; //endereço do mercado

                echo "<h2>Aberto das " . date('H:i', strtotime($infmercado['horarioAbert'])) . "</h2>"; //endereço do mercado

                echo "<h2> Até as " . date('H:i', strtotime($infmercado['horarioFecha'])) . "</h2>"; //endereço do mercado
                
                echo "<h2> telefone para contato: " . formatarTelefone($infmercado['telefone']) . "</h2>";
  
                echo "<h2> CNPJ: " . formatarCNPJ($infmercado['cnpj']) . "</h2>";

                echo "<h2> Descrição: " . $infmercado['descricao'] . "</h2>";

                echo "<h2> Compras: " . ucwords($infmercado['compras']) . "</h2>";
?>
            <button class="btn_ud" onclick="window.location.href='../CRUD/update-mercado.php'">Editar</button>
            <button class="btn_ud" onclick="confirmarExclusaoMercado();">Excluir</button>

            <button class="btn_ud" onclick="window.location.href = '../CRUD/read-prod.php'"> Ver Produtos</button>
            <button class='btn_left' type="submit" onclick="window.location.href='../index.php'">Voltar</button>

        </div>

        <?php require_once '../inc/rodape.php'; ?>