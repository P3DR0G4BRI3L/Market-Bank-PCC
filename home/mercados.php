<?php

session_start();
function usuarioEstaLogado(): bool
{
    return isset($_SESSION['usuario']);
}
if (usuarioEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Mercados</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="script/script.js"></script>

</head>

<body>

    <div id="area-cabecalho">
        <?php if (usuarioEstaLogado()): ?>
            <p class="aviso-login">Seja bem vindo&nbsp;<?= $userlog; ?></p>
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

                <?php if (usuarioEstaLogado()): ?>
                    <a href="../cadastro/logout.php" onclick="return confirm('Deseja realizar logout?');">Logout</a>
                <?php endif ?>
            </div>

        </div>
    </div>

    <div id="area-principal">

        <div id="area-postagens">
            <!--Abertura postagem -->
            <div class="postagem">
                <h2>SuperCei.</h2>
                <span class="data-postagem">postado 20 março 2022</span>
                <img width="620px" src="img/img3.jpg">
                <p>
                    Setor Psul Qnp 14 Setor de comércios.
                </p>
                <a href="">Ver mais</a>
            </div>
            <!--// Fechamento postagem -->

            <!--Abertura postagem -->
            <div class="postagem">
                <h2>Veneza.</h2>
                <span class="data-postagem">postado 10 março 2022</span>
                <img width="620px" src="img/img4.jpg">
                <p>
                    Setor Pnorte Qnp 5 Setor de comércios.
                </p>
                <a href="">Ver mais</a>
            </div>
            <hr>
            <!--// Fechamento postagem -->

            <!--Abertura postagem -->
            <h2 class="postagem2">Sessões</h2>
            <div class="postagem" id="paes">
                <h2>Pães e Bolos</h2>
                <span class="data-postagem">postado 20 março 2022</span>
                <img width="400px" src="img/pao.jpg">

                <p>
                    Pães, Bolos e Queijos.
                </p>
                <a href="">Ver mais</a>
            </div>
            <div class="postagem" id="bebidas">
                <h2>Bebidas Alcoolicas.</h2>
                <span class="data-postagem">postado 20 março 2022</span>
                <img width="400px" src="img/img5.webp">

                <p>
                    Cervejas,Vinhos e Destilados.
                </p>
                <a href="">Ver mais</a>
            </div>
            <div class="postagem" id="bebidas2">
                <h2>Refrigerantes.</h2>
                <span class=" data-postagem">postado 10 março 2022</span>
                <img width="400px" src="img/img6.webp">
                <p>
                    Coca Cola, Sprite, Fanta, Cola etc.
                </p>
                <a href="">Ver mais</a>
            </div>
            <div class="postagem" id="fvl">
                <h2>Frutas, Legumes e Verduras.</h2>
                <span class="data-postagem">postado 10 março 2022</span>
                <img width="400px" src="img/img7.jpg">
                <p>
                    Maçã, Melancia, Berinjela, Alface etc.
                </p>
                <a href="">Ver mais</a>
            </div>
            <div class="postagem" id="limpeza">
                <h2 href="">Produtos de limpeza</h2>
                <span class="data-postagem">postado 10 março 2022</span>
                <img width="400px" src="img/img8.jpg">
                <p>
                    Vassouras, Desinfetantes, Sabão, Detergente etc.
                </p>
                <a href="">Ver mais</a>
            </div>
            <div class="postagem" id="frios">
                <h2>Congelados</h2>
                <span class="data-postagem">postado 10 março 2022</span>
                <img width="400px" src="img/img9.avif">
                <p>
                    Hamburguer, Lasanha, Pizza, Frango etc.
                </p>
                <a href="">Ver mais</a>
            </div>
            <!-- // Fechamento postagem -->
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
                <h3>Categorias/Sessões</h3>

                <a href="#paes">Pães e Bolos</a><br>
                <a href="#bebidas">Bebidas Alcoolicas</a><br>
                <a href="#bebidas2">Bebidas sem alcool</a><br>
                <a href="#limpeza">Limpeza</a><br>
                <a href="#fvl">Frutas/Legumes/Verduras</a><br>
                <a href="#frios">Congelados</a><br>

            </div>

        </div>


        <div id="rodape">
            &copy Todos os direitos reservados
        </div>

    </div>

</body>

</html>