<?php 
session_start();
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';

if($_SESSION['usuario']['tipo'] != 'administrador'){
    
    header('location:../index.php');
    exit;

}

require_once '../inc/cabecalhocadastro.php';
?>
<div id="area-principal">

<div id="area-postagens">
    <!--Aberturac -->
    <div class="postagem">
        <h2>Visualizar perfis</h2>
        <p>
        <div class="cadastro_option">
            <div class="login-box">

                <button class="btn_left" onclick="window.history.back()">Voltar</button>


                <button onclick="window.location.href = 'admcliente.php'">Cliente</button>
                <button onclick="window.location.href = 'admmercado.php'">Mercado</button>

                


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





<?php require_once '../inc/rodape.php'; ?>