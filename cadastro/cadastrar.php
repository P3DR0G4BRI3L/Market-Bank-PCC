<?php
require_once '../func/func.php';
session_start();


require_once '../inc/cabecalhocadastro.php';//mostra o cabeçalho
?>



<div id="area-principal">

        <div class="postagem">
            <h2>Área de cadastro</h2>
            <div class="cadastro_option">
                <div class="login-box">

                    <button class="button_padrao" onclick="window.location.href= '../index.php' ">Voltar</button>


                    <button class="button_padrao" onclick="window.location.href = 'cadastrarCliente.php'">Cliente</button>
                    <button class="button_padrao" onclick="window.location.href = 'cadastrarMercado.php'">Mercado</button>

                    <br>


                </div>
            </div>
        </div>

        





    <?php require_once '../inc/rodape.php'; ?>