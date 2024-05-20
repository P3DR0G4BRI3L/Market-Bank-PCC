<!DOCTYPE html>
<html>

<head>
	<title>Market Bank Supermercados</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/cadastro.css">
	<script src="../script/script.js"></script>


</head>

<body>

	<div id="area-cabecalho">

		<!-- abertura postagem -->
		<div id="area-logo">
			<img src="../home/img/logo.png" alt="logo">
		</div>
		<div id="area-menu">
			<a href="../index.php">Home</a>

			<?php if (usuarioEstaLogado()): ?>
				<a href="../home/mercados.php">Mercados</a>
			<?php endif ?>

			<a href="../home/contato.php">Contato</a>
			<a href="../home/fale.php">Fale Conosco</a>

		</div>
	</div>