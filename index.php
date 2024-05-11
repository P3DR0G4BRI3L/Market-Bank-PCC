<?php
session_start();
function usuarioEstaLogado():bool {
    return isset($_SESSION['usuario']);
}

if(usuarioEstaLogado()){
	$userlog=ucwords($_SESSION['usuario']['nome']);
	}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Market Bank Supermercados</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="script/script.js"></script>

</head>

<body>

	<div id="area-cabecalho">
	<?php if(usuarioEstaLogado()): ?>
<p class="aviso-login">Seja bem vindo&nbsp;<?= $userlog;  ?></p>
<?php endif ?>
		<!-- abertura postagem -->
		<div id="area-logo">
			<img src="home/img/logo.png" alt="logo">
		</div>
		<div id="area-menu">
			<a href="index.php">Home</a>

			 <?php if(usuarioEstaLogado()): ?>
				<a href="home/mercados.php">Mercados</a>
				 <?php endif ?> 

			<a href="home/contato.php">Contato</a>
			<a href="home/fale.php">Fale Conosco</a>
			
				<div class="cadastro_login_right">
				<?php if(!usuarioEstaLogado()): ?>
                <a href="cadastro/cadastrar.php">Cadastrar</a>
                <a href="cadastro/login.php">Login</a>
                <?php endif ?>

				<?php if(usuarioEstaLogado()): ?>
				<a href="cadastro/logout.php" onclick="return confirm('Deseja realizar logout?');">Logout</a>
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


		<div id="rodape">
		&copy Todos os direitos reservados
		</div>

	</div>

</body>

</html>