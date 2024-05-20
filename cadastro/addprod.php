<?php
require_once 'cadastro.php';
require_once '../func/func.php';

session_start();


if(!usuarioEstaLogado()){
    header('location:../index.php');
    exit;
}

if (!usuarioEstaLogado()) {
    echo "<script>alert('Você não tem permissão para acessar essa página');</script>";
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


 require_once '../inc/cabecalho.php'; 
?>

    <?php
   
    ?>
    <div id="area-principal">

        <div id="area-postagens">
            <!--Abertura postagem -->
            <div class="postagem">

                <h2>Adicionar produto em:&nbsp;<?= $infmercado['nomeMerc'] ?></h2>
               

                <div class="container">
					<div class="login-box">
						<form action="../CRUD/create-prod.php" method="POST" enctype="multipart/form-data">
							
							<div class="input-group">
								<label for="nome">Nome do produto:</label>
								<input type="text" id="nome" name="nomeprod" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
							</div>
							
							<div class="input-group">
								<label for="preco">Preço:</label>
								<input type="number" id="preco" name="preco" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
							</div>
							
							<div class="input-group">
								<label for="senha">Foto do produto:</label>
								<input type="file" id="senha" name="imgprod" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
							</div>
							<button class="btn_left" onclick="window.location.href='../CRUD/read-prod.php'">Voltar</button>
							<button type="submit">Entrar</button>
						</form>
					</div>
				</div>
            </div>
            <!--// Fechamento postagem -->

            <!--Abertura postagem -->
           
            
            <?php require_once '../inc/rodape.php'; ?>