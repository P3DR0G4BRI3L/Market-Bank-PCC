<?php
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';

session_start();

if (usuarioEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);

    if ($_SESSION['usuario']['tipo'] == 'dono') {
        $mercName = $_SESSION['usuario']['id_usuario'];
        $mercado=$conn->prepare("SELECT * FROM mercado WHERE id_dono = :id_dono");
        $mercado->bindValue(':id_dono',$mercName,PDO::PARAM_INT);
        $mercado->execute();
        $infmercado = $mercado->fetch();

    }
}

require_once '../inc/cabecalho.php';//mostra o cabeçalho
?>


<div id="area-principal">

    <div id="area-postagens">
        <!--Abertura postagem -->
        <div class="postagem">
            <h2>Fale Conosco.</h2>
            <span class="data-postagem">postado 20 março 2022</span>
            <img width="620px" src="img/img10.webp">
            <p>
                Deixe sua sugestão, reclamação, agradecimento, fale conosco.
            </p>
            <a href="">Ver mais</a>
        </div>
        <!--// Fechamento postagem -->

        <!--Abertura postagem -->
        <div class="postagem">
            <h2>Agradecemos por visitar nossa página.</h2>
            <span class="data-postagem">postado 10 março 2022</span>
            <img width="620px" src="img/img11.jpg">
            <p>
                Fale conosco na caixa abaixo.
            </p>
            <a href="">Ver mais</a>
            <br>

            <input type="text" name="sugestao">

            <br>
            <input type="button" value="Enviar">
            <br>
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



    <?php require_once '../inc/rodape.php'; ?>