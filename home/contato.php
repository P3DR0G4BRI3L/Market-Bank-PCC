<?php
require_once '../cadastro/cadastro.php';
session_start();
function usuarioEstaLogado()
{
    return isset($_SESSION['usuario']);
}
if (usuarioEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);
}
function mercadoEstaLogado()
{
    if (isset($_SESSION['usuario'])) {
        return $_SESSION['usuario']['tipo'] == 'dono';
    }
}
function clienteEstaLogado()
{
	if (isset($_SESSION['usuario'])) {
		return $_SESSION['usuario']['tipo'] == 'cliente';
	}
}
if (usuarioEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);
    if ($_SESSION['usuario']['tipo'] == 'dono') {
        $mercName = $_SESSION['usuario']['id_usuario'];
        $mercado = $conn->query("SELECT * FROM mercado WHERE id_dono = '$mercName'");
        $infmercado = $mercado->fetch_assoc();

    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Contato</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="script/script.js"></script>

</head>

<body>

    <div id="area-cabecalho">

        <?php if (usuarioEstaLogado()): ?>
            <p class="aviso-login">Seja bem vindo&nbsp;<?= $userlog; ?></p>

            <?php if (mercadoEstaLogado()): ?>
                <p class="aviso-login">Você está logado no mercado:&nbsp;<?= $infmercado['nomeMerc']; ?></p>
            <?php endif ?>

        <?php endif ?>

        <!-- abertura postagem -->
        <div id="area-logo">
            <img src="img/logo.png" alt="logo">
        </div>

        <div id="area-menu">
            <a href="../index.php">Home</a>

            <?php if (usuarioEstaLogado()): ?>
                <a href="mercados.php">Mercados</a>
            <?php endif ?>

            <a href="contato.php">Contato</a>
            <a href="fale.php">Fale Conosco</a>

            <div class="cadastro_login_right">
                <?php if (!usuarioEstaLogado()): ?>
                    <a href="../cadastro/cadastrar.php">Cadastrar</a>
                    <a href="../cadastro/login.php">Login</a>
                <?php endif ?>


                <?php if (clienteEstaLogado()): ?>
					<a href="../cadastro/verMeuCliente.php">Visualizar perfil</a>
				<?php endif ?>
                

                <?php if (mercadoEstaLogado()): ?>
                    <a href="../cadastro/verMeuMercado.php">Visualizar perfil</a>
                <?php endif ?>

                <?php if (usuarioEstaLogado()): ?>
                    <a href="../cadastro/logout.php" onclick=" return confirm('Deseja realizar logout?');">Logout</a>
                <?php endif ?>
            </div>

        </div>
    </div>

    <div id="area-principal">

        <div id="area-postagens">
            <!--Abertura postagem -->
            <div class="postagem">
                <h2>Nos visite nas nossas redes sociais.
                    <br>
                    Telefone : 6195392-8374
                </h2>
                <span class="data-postagem">postado 20 março 2022</span>
                <img width="620px" src="img/img12.jpg">
                <p>
                    Nossas redes sociais
                </p>
                <a href="">Ver mais</a>
                <br>
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">E-mail</a>
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