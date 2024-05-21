<?php
require_once 'cadastro.php';
require_once '../func/func.php';


session_start();




if (!usuarioEstaLogado()) {
    echo "<script>alert(Você não tem permissão para acessar essa página);</script>";
    echo "<script>window.location.href='../index.php';</script>";
}

if (usuarioEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);

    if ($_SESSION['usuario']['tipo'] == 'dono') {
        $mercName = $_SESSION['usuario']['id_usuario'];
        $mercado=$conn->prepare("SELECT * FROM mercado WHERE id_dono = :id_dono");
        $mercado->bindValue(':id_dono',$mercName,PDO::PARAM_STR);
        $mercado->execute();
        $infmercado = $mercado->fetch();

    }
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


                echo "<h2>" . ucwords($infmercado['endereco']) . "</h2>"; //endereço do mercado

                echo "<h2>Aberto das " . date('H:i', strtotime($infmercado['horarioAbert'])) . "</h2>"; //endereço do mercado

                echo "<h2> Até as " . date('H:i', strtotime($infmercado['horarioFecha'])) . "</h2>"; //endereço do mercado
                
                echo "<h2> telefone para contato: " . formatarTelefone($infmercado['telefone']) . "</h2>";
  
                echo "<h2> CNPJ: " . formatarCNPJ($infmercado['cnpj']) . "</h2>";
?>
            <button class="btn_ud" onclick="window.location.href='../CRUD/update-mercado.php'">Editar</button>
            <button class="btn_ud" onclick="confirmarExclusaoMercado();">Excluir</button>

            <button class="btn_ud" onclick="window.location.href = '../CRUD/read-prod.php'"> Ver Produtos</button>
            <button class='btn_left' type="submit" onclick="window.location.href='../index.php'">Voltar</button>

        </div>

        <?php require_once '../inc/rodape.php'; ?>