<?php
require_once 'cadastro.php';

session_start();

function usuarioEstaLogado(): bool
{
    return isset($_SESSION['usuario']);
}
if(!usuarioEstaLogado()){
    header('location:../index.php');
    exit;
}
function mercadoEstaLogado()
{
    return $_SESSION['usuario']['tipo'] == 'dono';
}
if (!usuarioEstaLogado()) {
    echo "<script>alert(Você não tem permissão para acessar essa página);</script>";
    echo "<script>window.location.href='../index.php';</script>";
}
if (usuarioEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);
}

if (usuarioEstaLogado()) {
    $userlog = $_SESSION['usuario']['nome'];
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
    <title>Mercados</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <style>
        
    </style>
</head>

<body>

    <div id="area-cabecalho">

        <?php if (usuarioEstaLogado()): ?>

            <p class="aviso-login">Seja bem vindo&nbsp;<?= $userlog; ?></p>

            <!-- só mostra se for um mercado que estiver logado, mostra o nome do mercado -->
            <?php if (mercadoEstaLogado()): ?>
                <p class="aviso-login">Você está logado no mercado&nbsp;<?= $infmercado['nomeMerc']; ?></p>
            <?php endif ?>

        <?php endif ?>

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



            <?php if (mercadoEstaLogado()): ?>
                <a href="addprod.php">Adicionar produto</a>
            <?php endif ?>

            <?php if (mercadoEstaLogado()): ?>
                <a href="verMeuMercado.php">Visualizar perfil</a>
            <?php endif ?>

            <?php if (usuarioEstaLogado()): ?>
                <a href="logout.php" onclick="return confirm('Deseja realizar logout?');">Logout</a>
            <?php endif ?>
        </div>

    </div>
    </div>
    <?php
   
    ?>
    <div id="area-principal">

        <div id="area-postagens">
            <!--Abertura postagem -->
            <div class="postagem">

                <h2><?= $infmercado['nomeMerc'] ?></h2>
                <?php
                echo '<img src="uploads/' . $infmercado['imagem'] . '" alt="Imagem do mercado" width="620px">';
                ?>

                <p>
                    <?= $infmercado['endereco'] ?>
                </p>
                        <button class="btn_ud" onclick="window.location.href='editarMercado'">Editar</button>
						<button class="btn_ud" onclick="window.location.href = 'excluirMercado.php'">Excluir</button>
                
            </div>
            <!--// Fechamento postagem -->

            <!--Abertura postagem -->
           
            <hr>
            <!--// Fechamento postagem -->

            <!--Abertura postagem -->
            <h2 class="postagem2">Sessões</h2>
            <div class="postagem" id="paes">
                <h2>Pães e Bolos</h2>
                <span class="data-postagem">postado 20 março 2022</span>
                <img width="400px" src="../home/img/pao.jpg">

                <p>
                    Pães, Bolos e Queijos.
                </p>
                <a href="">Ver mais</a>
            </div>
            <div class="postagem" id="bebidas">
                <h2>Bebidas Alcoolicas.</h2>
                <span class="data-postagem">postado 20 março 2022</span>
                <img width="400px" src="../home/img/img5.webp">

                <p>
                    Cervejas,Vinhos e Destilados.
                </p>
                <a href="">Ver mais</a>
            </div>
            <div class="postagem" id="bebidas2">
                <h2>Refrigerantes.</h2>
                <span class=" data-postagem">postado 10 março 2022</span>
                <img width="400px" src="../home/img/img6.webp">
                <p>
                    Coca Cola, Sprite, Fanta, Cola etc.
                </p>
                <a href="">Ver mais</a>
            </div>
            <div class="postagem" id="fvl">
                <h2>Frutas, Legumes e Verduras.</h2>
                <span class="data-postagem">postado 10 março 2022</span>
                <img width="400px" src="../home/img/img7.jpg">
                <p>
                    Maçã, Melancia, Berinjela, Alface etc.
                </p>
                <a href="">Ver mais</a>
            </div>
            <div class="postagem" id="limpeza">
                <h2 href="">Produtos de limpeza</h2>
                <span class="data-postagem">postado 10 março 2022</span>
                <img width="400px" src="../home/img/img8.jpg">
                <p>
                    Vassouras, Desinfetantes, Sabão, Detergente etc.
                </p>
                <a href="">Ver mais</a>
            </div>
            <div class="postagem" id="frios">
                <h2>Congelados</h2>
                <span class="data-postagem">postado 10 março 2022</span>
                <img width="400px" src="../home/img/img9.avif">
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
<?php
var_dump($_SESSION['usuario']);
?>