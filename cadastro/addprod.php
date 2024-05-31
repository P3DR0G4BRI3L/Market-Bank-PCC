<?php
require_once 'cadastro.php';
require_once '../func/func.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';

session_start();


if(!usuarioEstaLogado()){
    header('location:../index.php');
    exit;
}







 require_once '../inc/cabecalho.php'; 
?>

    <?php
   
    ?>
    <div id="area-principal">

        <div id="area-postagens">
            <!--Abertura postagem -->
            <div class="postagem">

                <h2>Adicionar produto no mercado:&nbsp;<?= $_SESSION['usuario']['mercado']['nomeMerc'] ?></h2>
               

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
								<label for="foto">Foto do produto:</label>
								<input type="file" id="foto" name="imgprod" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
							</div>

							<div class="input-group">
								<label for="descricao">Descrição: <h6>*opcional</h6></label>
								<input type="text" id="descricao" name="descricao" onkeydown="if(event.keyCode === 13) event.preventDefault()">
							</div>

							<button type="submit" class="button_padrao btn_edit">Adicionar</button>
						</form>
					</div>
				</div>
            </div>
            <!--// Fechamento postagem -->

            <!--Abertura postagem -->
           
            
            <?php require_once '../inc/rodape.php'; ?>