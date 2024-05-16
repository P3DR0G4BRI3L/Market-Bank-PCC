<?php
require_once '../func/func.php';
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

		</div>
	</div>

	<div id="area-principal">

		<div id="area-postagens">
			<!--Aberturac -->
			<div class="postagem">
				<h2>Login</h2>
				<p>
				<div class="container">
					<div class="login-box">
						<form action="logingeral.php" method="POST">
							
							<div class="input-group">
								<label for="email">Email:</label>
								<input type="email" id="email" name="email" onkeydown="if(event.keyCode === 13) event.preventDefault()" required autofocus>
							</div>
							
							<div class="input-group">
								<label for="senha">Senha:</label>
								<input type="password" id="senha" name="senha" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
							</div>
							<button class="btn_left" onclick="window.location.href='../index.php'">Voltar</button>
							<button type="submit">Entrar</button>
                            
						</form>
					</div>
				</div>
				</p>
			</div>
			<!--// Fechamento postagem -->

			
		</div>




		<div id="rodape">
			&copy Todos os direitos reservados
		</div>

	</div>

</body>

</html>