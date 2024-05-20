<?php
require_once '../func/func.php';
require_once '../inc/cabecalhocadastro.php';
?>

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




		
		<?php require_once '../inc/rodape.php'; ?>