<?php
require_once 'cadastro/cadastro.php';
require_once 'func/func.php';

session_start();



// se o usuario estiver logado, armazena o nome dele em $userlog, //se o tipo for dono, armazena o nome do mercado dentro de $mercName



// require 'inc/cabecalho.php';
?>
<!DOCTYPE html>
<html>

<head>
	<title>Market Bank </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="script/script.js"></script>
<style>
	img{
		border-radius: 5px;
	}
</style>
</head>

<body>

	<div id="area-cabecalho">

		<!-- só é mostrado se o usuario estiver logado -->
		<?php if (usuarioEstaLogado()): ?>

			<p class="aviso-login">Seja bem vindo&nbsp;<?= $_SESSION['usuario']['nome']; ?></p>

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

            <?php if (!usuarioEstaLogado()): ?>
                <a href="home/mercados.php" onclick="alert('Realize o login primeiro');return false;">Mercados</a>

            <?php endif ?>

			<a href="home/contato.php">Contato</a>

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
		<div class="postagem  index">
			<h2>Bem-vindo ao MarketBank</h2>
			<img src="home/img/img_home.jpg" alt="Exploração de Mercados">
			<p class="intro">
				Descubra os produtos mais frescos e as melhores ofertas nos mercados da sua região. 
				O MarketBank é o seu guia para explorar as diversas opções de compras perto de você, trazendo sempre o melhor em qualidade e preço.
			</p>
		</div>

		<div class="postagem  index">
			<h2>Explore Novos Horizontes</h2>
			<img  src="home/img/img_home2.jpg" alt="Exploração de Produtos">
			<p class="intro">
				No MarketBank, você tem o poder de explorar uma vasta gama de produtos e serviços oferecidos pelos mercados locais.
				 Seja para encontrar aquele ingrediente especial ou as melhores promoções, estamos aqui para ajudar você a fazer compras inteligentes e convenientes.
			</p>
		</div>
	</div>


		
		<?php require_once 'inc/rodape.php'; ?>