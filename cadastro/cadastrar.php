<?php
require_once '../func/func.php';
session_start()
?>
<!DOCTYPE html>
<html>

<head>
	<title>Market Bank Supermercados</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/cadastro.css">

</head>

<body>

	<div id="area-cabecalho">

		<!-- abertura postagem -->
		<div id="area-logo">
			<img src="../home/img/logo.png" alt="logo">
		</div>
		<div id="area-menu">
			<a href="../index.php">Home</a>

			<?php if(usuarioEstaLogado()): ?>
            <a href="mercados.php">Mercados</a>
             <?php endif ?> 
			 
			<a href="../home/contato.php">Contato</a>
			<a href="../home/fale.php">Fale Conosco</a>

			<div class="cadastro_login_right">
                <?php if (!usuarioEstaLogado()): ?>
                    <a href="../cadastro/cadastrar.php">Cadastrar</a>
                    <a href="../cadastro/login.php">Login</a>
                <?php endif ?> </div>

		</div>
	</div>

	<div id="area-principal">

		<div id="area-postagens">
			<!--Aberturac -->
			<div class="postagem">
				<h2>Área de cadastro</h2>
				<p>
				<div class="cadastro_option">
					<div class="login-box">

						<button class="btn_left" onclick="window.history.back()">Voltar</button>

						
						<button onclick="window.location.href = 'cadastrarCliente.php'">Cliente</button>
						<button onclick="window.location.href = 'cadastrarMercado.php'">Mercado</button>

						<br>
						

						</form>
					</div>
				</div>
				</p>
			</div>
			<!--// Fechamento postagem -->

			<!--Abertura postagem -->
			<div class="postagem">
				<h2>Explore.</h2>
				<span class="data-postagem">postado 10 março 2022</span>
				<p>
					O Market Bank foi criado na intenção de informar os clientes de produtos que os mesmos desejam.
				</p>
				<a href="">Ver mais</a>
			</div>
			<!--// Fechamento postagem -->
		</div>




		<div id="rodape">
			&copy Todos os direitos reservados
		</div>

	</div>

</body>

</html>