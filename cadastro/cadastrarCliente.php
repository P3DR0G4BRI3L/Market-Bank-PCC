<?php
require_once '../func/func.php';


require_once '../inc/cabecalhocadastro.php';//mostra o cabeçalho
?>


<div id="area-principal">

    <div id="area-postagens">
        <!--Aberturac -->
        <div class="postagem">
            <h2>Área de cadastro do cliente</h2>
            <div class="container">
                <div class="login-box">
                    <form action="cadastroC.php" method="POST">

                        <div class="input-group">
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                        </div>

                        <div class="input-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                        </div>

                        <div class="input-group">
                            <label for="senha">Senha:</label>
                            <input type="password" id="senha" name="senha"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                        </div>
                        <button class="btn_left" onclick="window.history.back()">Voltar</button>
                        <button type="submit">Entrar</button>
                    </form>
                </div>
            </div>
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

    < <?php require_once '../inc/rodape.php'; ?>