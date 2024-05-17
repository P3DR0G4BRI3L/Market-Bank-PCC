<?php
session_start();
require_once '../cadastro.php';
require_once '../../func/func.php';

if (usuarioEstaLogado()) {
    $userlog = $_SESSION['usuario']['nome'];
}
if (usuarioEstaLogado() && $_SESSION['usuario']['tipo'] == 'dono') {

    //armazena todas as informações do mercado logado em $infmercado
    $mercName = $_SESSION['usuario']['id_usuario'];
    $mercado = $conn->prepare("SELECT * FROM mercado WHERE id_dono = :mercName;");
    $mercado->bindValue(':mercName', $mercName, PDO::PARAM_INT);
    $mercado->execute();
    $infmercado = $mercado->fetch();
    


    $id_produto = $_POST['updateprod'];

    $stmt = $conn->prepare("SELECT * FROM produto WHERE id_produto = :id_produto");
    $stmt->bindValue(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt->execute();
    $infproduto = $stmt->fetch();

}
// var_dump($infmercado , $infproduto);

//update do produto, enviado post nomeprod , preco , imgprod





if (isset($_POST['nomeprod'], $_POST['preco']) && isset($_FILES['imgprod']) || isset($_POST['imgprod2'])) {

    if (isset($_FILES['imgprod']) &&  $_FILES['imgprod']['error'] === UPLOAD_ERR_OK) {
        // Diretório onde você deseja armazenar as imagens
        $diretorioDestino = 'C:\xampp\htdocs\Market-Bank\cadastro\uploads\\';
        
        // Nome do arquivo original
        $imagem = $_FILES['imgprod']['name'];
        
        // Caminho completo para onde o arquivo será movido
        $caminhoDestino = $diretorioDestino . $imagem;
        
        // Move o arquivo enviado para o diretório de destino
        if (move_uploaded_file($_FILES['imgprod']['tmp_name'], $caminhoDestino)) {
            echo "Arquivo enviado com sucesso.";
        } else {
            echo "Erro ao mover o arquivo para o diretório de destino.";
        }
    } else {
        echo "Erro no envio do arquivo: " . $_FILES['imgprod']['error'];
    }
    

    $fotoProduto = (isset($_FILES['imgprod'])) ? $_FILES['imgprod']['name'] : $_POST['imgprod2'];//se não for inserida nenhuma imagem no formulario a antiga permanece, caso contrario a nova entra
    $nomeprod = $_POST['nomeprod'];
    $preco = $_POST['preco'];
    $stmt = $conn->prepare("UPDATE produto SET nome = :nome , preco = :preco , fotoProduto = :fotoProduto WHERE id_produto = :id_produto");
    $stmt->bindValue(":nome",$nomeprod,PDO::PARAM_STR);
    $stmt->bindValue(":preco",$preco,PDO::PARAM_STR);
    $stmt->bindValue(":fotoProduto",$fotoProduto,PDO::PARAM_STR);
    $stmt->bindValue(":id_produto",$infproduto['id_produto'],PDO::PARAM_INT);

    if($stmt->execute() && $stmt->rowCount() > 0){
        echo "<script>
        alert('Produto editado com sucesso!');
        window.location.href='read-prod.php';
        </script>";
    }else{
        echo "<script>
        alert('Ocorreu um erro');
        //window.location.href='read-prod.php';
        </script>".$stmt->errorCode();
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Mercados</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../../css/cadastro.css">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <script src="script/script.js"></script>

</head>

<body>

    <div id="area-cabecalho"><!-- cabeçalho abertura-->

        <?php if (usuarioEstaLogado()): ?>

            <p class="aviso-login">Seja bem vindo&nbsp;<?= ucwords($userlog); ?></p>

            <!-- só mostra se for um mercado que estiver logado, mostra o nome do mercado -->
            <?php if (mercadoEstaLogado()): ?>
                <p class="aviso-login">Você está logado no mercado&nbsp;<?= $infmercado['nomeMerc']; ?></p>
            <?php endif ?>

        <?php endif ?>

        <!-- abertura postagem -->
        <div id="area-logo">
            <img src="../../home/img/logo.png" alt="logo">
        </div>
        <div id="area-menu">
            <a href="../index.php">Home</a>

            <?php if (usuarioEstaLogado()): ?>
                <a href="../home/mercados.php">Mercados</a>
            <?php endif ?>

            <a href="../home/contato.php">Contato</a>
            <a href="../home/fale.php">Fale Conosco</a>

            <?php if (mercadoEstaLogado()): ?>
                <a href="verMeuMercado.php">Visualizar perfil</a>
            <?php endif ?>

            <?php if (usuarioEstaLogado()): ?>
                <a href="logout.php" onclick="return confirm('Deseja realizar logout?');">Logout</a>
            <?php endif ?>
        </div>

    </div>

    <?php

    ?>
    <div id="area-principal">

        <div id="area-postagens">
            <!--Abertura postagem -->
            <div class="postagem">

                <h2>Editar produto <?= $infproduto['nome'] ?> :&nbsp;<?= $infmercado['nomeMerc'] ?></h2>


                <div class="container">
                    <div class="login-box">
                        <form action="" method="POST" enctype="multipart/form-data">

                            <div class="input-group">
                                <label for="nome">Nome do produto:</label>
                                <input type="text" id="nome" name="nomeprod" value="<?= $infproduto['nome'] ?>"
                                    onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                            </div>

                            <div class="input-group">
                                <label for="preco">Preço:</label>
                                <input type="number" id="preco" name="preco" value="<?= $infproduto['preco'] ?>"
                                    onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                            </div>

                            <div class="input-group">
                                <label for="senha">Foto do produto:</label>
                                <input type="file" id="senha" name="imgprod"
                                    onkeydown="if(event.keyCode === 13) event.preventDefault()">

                                <input type="hidden" name="imgprod2" value="<?= $infproduto['fotoProduto'] ?>">
                                <input type="hidden" name="updateprod" value="<?= $infproduto['id_produto'] ?>">

                            </div>
                            <button class="btn_left" onclick="window.history.back()'">Voltar</button>
                            <button type="submit">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--// Fechamento postagem -->

            <!--Abertura postagem -->


            <div id="rodape">
                &copy Todos os direitos reservados
            </div><?php  
echo "<pre>" ;
// print_r($infmercado);
var_dump($infproduto);
$conn = null;
?>
        </div>

</body>

</html>
