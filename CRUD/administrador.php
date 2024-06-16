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

<div class="wrapper">
<div id="area-principal">

    <!--Aberturac -->
    <div class="postagem home">
        <h2>Visualizar perfis</h2>
        <p>
        <div class="cadastro_option">
            <div class="login-box">

                <button class="button_padrao" onclick="window.location.href='../index.php'">Voltar</button>


                <button class="button_padrao" onclick="window.location.href = 'admcliente.php'">Cliente</button>
                <button class="button_padrao" onclick="window.location.href = 'admmercado.php'">Mercado</button>

                


                </form>
            </div>
        </div>
        </p>
    </div>
    </div>
    <!--// Fechamento postagem -->

    <!--Abertura postagem -->
   
    <!--// Fechamento postagem -->





<?php require_once '../inc/rodape.php'; ?>