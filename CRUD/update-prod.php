<?php
session_start();
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';

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





if (/*$_SERVER['REQUEST_METHOD'] === 'POST' &&*/ isset($_POST['nomeprod'], $_POST['preco'],$_POST['descricao'])) {

    $fotoProduto = $_POST['imgprod2'];//se não for inserida nenhuma imagem no formulario a antiga permanece, caso contrario a nova entra
    $nomeprod = $_POST['nomeprod'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];

    if (isset($_FILES['imgprod']) &&  $_FILES['imgprod']['error'] === UPLOAD_ERR_OK) {
        // Diretório onde você deseja armazenar as imagens
        $diretorioDestino = 'C:\xampp\htdocs\Market-Bank\cadastro\uploads\\';
        
        // Nome do arquivo original
        $fotoProduto = $_FILES['imgprod']['name'];
        
        // Caminho completo para onde o arquivo será movido
        $caminhoDestino = $diretorioDestino . $fotoProduto;
        
        // Move o arquivo enviado para o diretório de destino
        if (move_uploaded_file($_FILES['imgprod']['tmp_name'], $caminhoDestino)) {
            echo "Arquivo enviado com sucesso.";
        } else {
            echo "Erro ao mover o arquivo para o diretório de destino.";
        }
    } else {
        echo "Erro no envio do arquivo: " . $_FILES['imgprod']['error'];
    }
    

    // var_dump($infproduto['id_produto'], $fotoProduto, $nomeprod, $preco);exit;
    $stmt = $conn->prepare("UPDATE produto SET nome = :nome , preco = :preco , fotoProduto = :fotoProduto, descricao = :descricao  WHERE id_produto = :id_produto");
    $stmt->bindValue(":nome",$nomeprod,PDO::PARAM_STR);
    $stmt->bindValue(":preco",$preco,PDO::PARAM_STR);
    $stmt->bindValue(":fotoProduto",$fotoProduto,PDO::PARAM_STR);
    $stmt->bindValue(":descricao",$descricao,PDO::PARAM_STR);
    $stmt->bindValue(":id_produto",$infproduto['id_produto'],PDO::PARAM_INT);

    if($stmt->execute()){
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
require_once '../inc/cabecalho.php';
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
                            <input type="text" id="preco" name="preco" value="<?= $infproduto['preco'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required maxlength="7"
                                oninput="restringirLetras(this)">
                        </div>

                        <div class="input-group">

                            <picture>
                                <img src="../cadastro/uploads/<?= $infproduto['fotoProduto'] ?>" alt="foto do produto" width="100px" >
                                <legend>Imagem atual</legend>
                            </picture>
                            <label for="foto">Foto do produto: <h6>* escolha uma nova imagem se quiser trocar a atual</h6></label>
                            <input type="file" id="foto" name="imgprod"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()">

                            <input type="hidden" name="imgprod2" value="<?= $infproduto['fotoProduto'] ?>">
                            <input type="hidden" name="updateprod" value="<?= $infproduto['id_produto'] ?>">

                        </div>

                        <div class="input-group">
								<label for="descricao">Descrição: <h6>*opcional</h6></label>
								<input type="text" id="descricao" name="descricao" value="<?= $infproduto['descricao'] ?>" onkeydown="if(event.keyCode === 13) event.preventDefault()">
							</div>

                        <button type="submit" class="button_padrao btn_edit" >Salvar</button>
                    </form>
                </div>
            </div>
        </div>
        <!--// Fechamento postagem -->

        <!--Abertura postagem -->


        <?php require_once '../inc/rodape.php'; ?>