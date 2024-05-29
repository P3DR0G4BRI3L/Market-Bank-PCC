<?php
require_once 'cadastro/cadastro.php';
require_once 'func/func.php';

session_start();



// se o usuario estiver logado, armazena o nome dele em $userlog, //se o tipo for dono, armazena o nome do mercado dentro de $mercName

if (usuarioEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);

}

// require 'inc/cabecalho.php';
?>
<!DOCTYPE html>
<html>

<head>
	<title>Market Bank </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="script/script.js"></script>

</head>

<body>

	<div id="area-cabecalho">

		<!-- só é mostrado se o usuario estiver logado -->
		<?php if (usuarioEstaLogado()): ?>

			<p class="aviso-login">Seja bem vindo&nbsp;<?= $userlog; ?></p>

			<!-- só mostra se for um mercado que estiver logado, mostra o nome do mercado -->
			<?php if (mercadoEstaLogado()): ?>
				<p class="aviso-login">Você está logado no mercado:&nbsp;<?= ucwords($_SESSION['usuario']['mercado']['nomeMerc']); ?></p>
			<?php endif ?>

		<?php endif ?>


		<!-- abertura postagem -->
		<div id="area-logo">
			<img src="home/img/logo.png" alt="logo">
		</div>
		<div id="area-menu">
			<a href="index.php">Home</a>

			<?php if (usuarioEstaLogado()): ?>
				<a href="home/mercados.php">Mercados</a>
			<?php endif ?>

			<a href="home/contato.php">Contato</a>
			<a href="home/fale.php">Fale Conosco</a>

			<div class="cadastro_login_right">
				<?php if (!usuarioEstaLogado()): ?>
					<a href="cadastro/cadastrar.php">Cadastrar</a>
					<a href="cadastro/login.php">Login</a>
				<?php endif ?>



				

				<?php if (clienteEstaLogado()): ?>
					<a href="cadastro/verMeuCliente.php">Visualizar perfil</a>
				<?php endif ?>

				<?php if (mercadoEstaLogado()): ?>
                    <a href="cadastro/verMeuMercado.php">Visualizar perfil</a>
                <?php endif ?>

				<?php if (usuarioEstaLogado()): ?>
					<a href="cadastro/logout.php" onclick="return confirm('Deseja realizar logout?');">Logout</a>
				<?php endif ?>

				<?php if(admEstaLogado()): ?>
                    <a href="CRUD/administrador.php">ADM</a>
                <?php endif ?>
                

			</div>


		</div>
	</div>

	<div id="area-principal">

		<div id="area-postagens">
			<!--Abertura postagem -->
			<div class="postagem">
				<h2>Bem vindo ao MarketBank, fique a vontade para descobrir os produtos em diferentes mercados de sua
					região.</h2>
				<span class="data-postagem">postado 20 março 2022</span>
				<img width="620px" src="home/img/img1.jpg">
				<p>
					Melhores mercados da região para seu conhecimento de produtos e diversos outras utilidades.
				</p>
				<a href="">Ver mais</a>
			</div>
			<!--// Fechamento postagem -->

			<!--Abertura postagem -->
			<div class="postagem">
				<h2>Explore.</h2>
				<span class="data-postagem">postado 10 março 2022</span>
				<img width="620px" src="home/img/img2.jpg">
				<p>
					O Market Bank foi criado na intenção de informar os clientes de produtos que os mesmos desejam.
				</p>
				<a href="">Ver mais</a>
			</div>
			<!--// Fechamento postagem -->
		</div>

		<div id="area-lateral">

			<div class="conteudo-lateral">
				<h3>Postagens recentes</h3>
				<div class="postagem-lateral">
					<p>O Market Bank é para você ter </p>
					<a href="">Ver mais</a>
				</div>

				<div class="postagem-lateral" style="border-bottom: none;">
					<p>Produtos em destaque</p>
					<a href="">Ver mais</a>
				</div>
			</div>

			<div class="conteudo-lateral">
				<h3>substituir</h3>

				<a href="">substituir</a><br>
				<a href="">substituir</a><br>
				<a href="">substituir</a><br>
				<a href="">substituir</a><br>
				<a href="">substituir</a><br>

			</div>



		</div>


		
		<?php require_once 'inc/rodape.php'; ?>