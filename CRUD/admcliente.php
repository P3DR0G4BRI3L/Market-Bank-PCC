<?php 
session_start();
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';

if($_SESSION['usuario']['tipo'] != 'administrador'){
    header('location:../index.php');
}

require_once '../inc/cabecalhocadastro.php';
?>
<div id="area-principal">

<div id="area-postagens">
    <!--Aberturac -->
    <div class="postagem">
        <h2>Administração clientes</h2>
        <p>
        <div class="cadastro_option">
            <div class="login-box">

                <button class="btn_left" onclick="window.history.back()">Voltar</button>

aqui deverá ser listado todos os clientes cadastrados no site e a possibilidade do administrador editar ou excluir esses clientes no formato de tabela

                


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