<?php
require_once 'cadastro.php';
require_once '../func/func.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';

session_start();


if($_SESSION['usuario']['tipo']!='dono'){
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

                <h2>Adicionar categoria no mercado:&nbsp;<?= $_SESSION['usuario']['mercado']['nomeMerc'] ?></h2>
               

                <div class="container">
					<div class="login-box">
						<form action="../CRUD/create-filt.php" method="POST">
							
							<div class="input-group">
								<label for="nome">Nome da categoria:</label>
								<input type="text" id="nome" name="nomeFiltro" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
							</div>
							

							<button type="submit" class="button_padrao btn_edit">Adicionar</button>
						</form>
					</div>
				</div>
            </div>
            <!--// Fechamento postagem -->

            <!--Abertura postagem -->
           
            
            <?php require_once '../inc/rodape.php'; ?>