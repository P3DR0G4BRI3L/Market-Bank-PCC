<?php
function usuarioEstaLogado(): bool
{
	return isset($_SESSION['usuario']);
}
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

			<?php if (usuarioEstaLogado()): ?>
				<a href="mercados.php">Mercados</a>
			<?php endif ?>

			<a href="../home/contato.php">Contato</a>
			<a href="../home/fale.php">Fale Conosco</a>

		</div>
	</div>

	<div id="area-principal">

		<div id="area-postagens">
			<!--Aberturac -->
			<div class="postagem">
				<h2>Área de cadastro do mercado</h2>
				<p>
				<div class="container">
					<div class="login-box">
						<form action="cadastroM.php" method="POST">

							<div class="input-group">
								<label for="username">E-mail:</label>
								<input type="email" id="username" name="email"
									onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
							</div>

							<div class="input-group">
								<label for="nome">Nome:</label>
								<input type="text" id="nome" name="nome"
									onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
							</div>

							<div class="input-group">
								<label for="cnpj">CNPJ:</label>
								<input type="text" id="cnpj" name="cnpj"
									onkeydown="if(event.keyCode === 13) event.preventDefault()" required maxlength="14">
							</div>

							<div class="input-group">
								<label for="endereco">Endereço:</label>
								<input type="text" id="endereco" name="endereco"
									onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
							</div>


							<div class="input-group">
								<label for="horarioFunc">Horário de abertura:&nbsp;</label>
								<input type="time" id="horarioFunc" name="horarioAbert"
									onkeydown="if(event.keyCode === 13) event.preventDefault()" required>

								<label for="horarioFunc">Horário de fechamento:</label>
								<input type="time" id="horarioFunc" name="horarioFecha" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
							</div>


							<div class="input-group">
								<label for="telefone">Telefone:</label>
								<input type="tel" id="telefone" name="telefone" onkeydown="if(event.keyCode === 13) event.preventDefault()" required maxlength="11">
							</div>

							<div class="input-group">
								<label for="senha">Senha:</label>
								<input type="password" id="senha" name="senha" onkeydown="if(event.keyCode === 13) event.preventDefault()" required maxlength="11">
							</div>

							<button class="btn_left" onclick="window.history.back()">Voltar</button>

							<button type="submit">Entrar</button>

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