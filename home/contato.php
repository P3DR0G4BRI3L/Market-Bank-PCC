<?php
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';

session_start();



require_once '../inc/cabecalho.php'; //mostra o cabeçalho
?>


<div class="wrapper">
<div id="area-principal">

    <!--Abertura postagem -->
    <div class="postagem home">
        <h2>Nos visite nas nossas redes sociais.</h2>
        <img src="img/img12.jpg" width="620px" alt="">
        <div class="social-links">
            <!-- Links para as redes sociais -->
            <a href="#" class="social-link">
                <img width="45px" src="img/facebook.jpeg" alt="Facebook">
            </a>
            <a href="#" class="social-link">
                <img width="45px" src="img/instagram.jpeg" alt="Instagram">
            </a>
            <a href="#" class="social-link">
                <img width="45px" src="img/twitter.jpeg" alt="Twitter">
            </a>
            <a href="#" class="social-link">
                <img width="45px" src="img/linkedin.jpeg" alt="LinkedIn">
            </a>

            <a href="#" class="social-link">
                <img width="45px" src="img/whatsapp.jpeg" alt="LinkedIn">
            </a>
        </div>
        <p>Siga-nos nas redes sociais para ficar por dentro das últimas novidades e atualizações.</p>
    </div>
</div>
<!--// Fechamento postagem -->



<?php require_once '../inc/rodape.php'; ?>