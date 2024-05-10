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
			<a href="../home/mercados.php">Mercados</a>
			<a href="../home/sessoes.php">Sessões</a>
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
						<form action="" method="POST">

							<div class="input-group">
								<label for="username">E-mail:</label>
								<input type="email" id="username" name="username" required>
							</div>

							<div class="input-group">
								<label for="nome">Nome:</label>
								<input type="text" id="nome" name="nome" required>
							</div>
                            
                            <div class="input-group">
								<label for="cnpj">CNPJ:</label>
								<input type="text" id="cnpj" name="cnpj" required maxlength="14">
							</div>

							<div class="input-group">
								<label for="endereco">Endereço:</label>
								<input type="text" id="endereco" name="endereco" required>
							</div>
                            
							<div class="input-group">
                                <label for="horarioFunc">Horario de abertura:</label>
								<input type="time" id="horarioFunc" name="horarioFuncAbertura" required>

                                <label for="horarioFunc">Horario de fechamento:</label>
								<input type="time" id="horarioFunc" name="horarioFuncFecha" required>
							</div>

                            <div class="input-group">
								<label for="telefone">Telefone:</label>
								<input type="tel" id="telefone" name="telefone" required maxlength="11">
							</div>


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