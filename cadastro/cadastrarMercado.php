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
	<script>
        window.onload = function() {
            // Obtém a referência para o input específico
            var input = document.getElementById('senha');

            // Adiciona um ouvinte de eventos para o evento de foco (quando o input recebe o foco)
            input.addEventListener('focus', function() {
                // Rola a tela para baixo para o input específico
                this.scrollIntoView();
            });
        };
    </script>
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
						<form action="cadastroM.php" method="POST" enctype="multipart/form-data" >

							<div class="input-group">
								<label for="username">E-mail:</label>
								
								<input type="email" id="username" name="email"
									onkeydown="if(event.keyCode === 13) event.preventDefault()" placeholder="Insira seu email"required>
							</div>

							<div class="input-group">
								<label for="nome">Nome do proprietário:</label>
								<input type="text" id="nome" name="nome"
									onkeydown="if(event.keyCode === 13) event.preventDefault()" placeholder="Insira seu nome"required>
							</div>

							<div class="input-group">
								<label for="nome">Nome do Mercado:</label>
								<input type="text" id="nome" name="nome_mercado"
									onkeydown="if(event.keyCode === 13) event.preventDefault()" placeholder="Insira o nome do mercado" required>
							</div>

							<div class="input-group">
								<label for="cnpj">CNPJ:</label>
								<input type="text" id="cnpj" name="cnpj"
									onkeydown="if(event.keyCode === 13) event.preventDefault()" required placeholder="Insira seu CNPJ" maxlength="14">
							</div>

							<div class="input-group">
								<label for="endereco">Endereço:</label>
								<input type="text" id="endereco" name="endereco"
									onkeydown="if(event.keyCode === 13) event.preventDefault()" placeholder="Insira o endereço" required>
							</div>


							<div class="input-group">
								<label for="horarioFunc">Horário de abertura:&nbsp;</label>
								<input type="time" id="horarioFunc" name="horarioAbert"
									onkeydown="if(event.keyCode === 13) event.preventDefault()"  required>

								<label for="horarioFunc">Horário de fechamento:</label>
								<input type="time" id="horarioFunc" name="horarioFecha" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
							</div>


							<div class="input-group">
								<label for="telefone">Telefone:</label>
								<input type="tel" id="telefone" name="telefone" onkeydown="if(event.keyCode === 13) event.preventDefault()" required placeholder="Insira o telefone para contato"
								 maxlength="11">
							</div>

							<div class="input-group">
								<label for="senha">Senha:</label>
								<input type="password" id="senha" name="senha" onkeydown="if(event.keyCode === 13) event.preventDefault()" required placeholder="Insira sua senha">
							</div>

							<div class="input-group">
								<label for="imagem">Foto do supermercado:</label>
								<input type="file" id="imagem" name="imagem" onkeydown="if(event.keyCode === 13) event.preventDefault()" required placeholder="faça upload de uma foto do mercado">
							</div>

							<button class="btn_left" onclick="window.location.href='cadastrar.php'">Voltar</button>

							<button type="submit">Entrar</button>

						</form>
					</div>
				</div>
				</p>
			</div>
			
		</div>




		<div id="rodape">
			&copy Todos os direitos reservados
		</div>

	</div>

</body>

</html>