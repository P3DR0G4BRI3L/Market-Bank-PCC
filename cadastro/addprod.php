<?php
require_once 'cadastro.php';
require_once '../func/func.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';

session_start();


if (!mercadoEstaLogado()) {
	header('location:../index.php');
	exit;
}







require_once '../inc/cabecalho.php';
?>

<?php

?>
<div id="area-principal">

	<!--Abertura postagem -->
	<div class="postagem add_prod">

		<h2>Adicionar produto no mercado:<br><strong><?= $_SESSION['usuario']['mercado']['nomeMerc'] ?></strong></h2>


		<div class="container">
			<div class="login-box">
				<form action="../CRUD/create-prod.php" method="POST" enctype="multipart/form-data">

					<div class="input-group">
						<label for="nome">Nome do produto:</label>
						<input type="text" id="nome" name="nomeprod" placeholder="Insira o nome do produto" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
					</div>

					<div class="input-group preco">
						<label for="preco">Preço:</label>
						<input type="text" id="preco" name="preco" placeholder="Insira o preço do produto" onkeyup="formatarPreco(this)" required>
					</div>

					<div class="input-group">
						<label for="foto">Foto do produto</label>
						<label for="foto">
							<img class="icon_prod" src="../home/img/download-icon.jpeg" width="30px" title="Faça upload da foto do produto">
						</label>
						<div class="custom-file-upload">
							<input type="file" id="foto" name="imgprod" onchange="displayFileName()" required>
						</div>
					</div>
					<div id="fileNameDisplay"></div>



			</div>

			<div class="input-group">
				<label for="descricao">Descrição: <h6>*opcional</h6></label>
				<input type="text" id="descricao" name="descricao" placeholder="Insira a unidade de medida do produto ou alguma informação adicional" onkeydown="if(event.keyCode === 13) event.preventDefault()">
			</div>

			<button type="submit" class="button_padrao btn_edit">Adicionar</button>
			</form>
		</div>
	</div>
</div>
</div>
<!--// Fechamento postagem -->

<!--Abertura postagem -->


<?php require_once '../inc/rodape.php'; ?>