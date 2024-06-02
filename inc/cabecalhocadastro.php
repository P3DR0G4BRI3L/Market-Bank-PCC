<!DOCTYPE html>
<html>

<head>
	<title>Market Bank </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/cadastro.css">
	<script src="../script/script.js"></script>
	<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">


</head>

<body>

	<div id="area-cabecalho">
		<?php if (usuarioEstaLogado()) : ?>

			<p class="aviso-login">Seja bem vindo&nbsp;<?= (usuarioEstaLogado()) ? ucwords($_SESSION['usuario']['nome']) : ''; ?></p>

			<?php if (mercadoEstaLogado()) : ?>

				<p class="aviso-login">Você está logado no mercado:&nbsp;<?= ucwords($_SESSION['usuario']['mercado']['nomeMerc']); ?></p>

			<?php endif ?>
		<?php endif ?>
		<!-- abertura postagem -->
		<div id="area-logo">
			<img src="../home/img/logo.png" alt="logo">
		</div>
		<div id="area-menu">
			<a href="../index.php">Home</a>

			<?php if (usuarioEstaLogado()) : ?>
				<a href="../home/mercados.php">Mercados</a>
			<?php endif ?>

			<a href="../home/contato.php">Contato</a>
			<a href="../home/fale.php">Fale Conosco</a>

			<?php if (usuarioEstaLogado()) : ?>
				<a href="../cadastro/logout.php" onclick="return confirm('Deseja realizar logout?');">Logout</a>
			<?php endif ?>

			<?php if (admEstaLogado()) : ?>
				<a href="../CRUD/administrador.php">ADM</a>
			<?php endif ?>
		</div>
	</div>