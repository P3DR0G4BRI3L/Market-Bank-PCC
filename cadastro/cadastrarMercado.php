<?php
require_once '../func/func.php';


require_once '../inc/cabecalhocadastro.php';//mostra o cabeçalho
?>


<div id="area-principal">

    <div id="area-postagens">
        <!--Aberturac -->
        <div class="postagem">
            <h2>Área de cadastro do mercado</h2>
            <p>
            <div class="container">
                <div class="login-box">
                    <form action="cadastroM.php" method="POST" enctype="multipart/form-data">

                        <div class="input-group">
                            <label for="username">E-mail:</label>

                            <input type="email" id="username" name="email"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira seu email" required>
                        </div>

                        <div class="input-group">
                            <label for="nome">Nome do proprietário:</label>
                            <input type="text" id="nome" name="nome"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira seu nome" required>
                        </div>

                        <div class="input-group">
                            <label for="nome">Nome do Mercado:</label>
                            <input type="text" id="nome" name="nome_mercado"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira o nome do mercado" required>
                        </div>

                        <div class="input-group">
                            <label for="cnpj">CNPJ:</label>
                            <input type="text" id="cnpj" name="cnpj"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required
                                placeholder="Insira seu CNPJ" minlength="14" maxlength="14"
                                oninput="restringirLetras(this)">
                        </div>

                        <div class="input-group">
                            <label for="regadmin">Região Administrativa:</label>
                            <select id="regadmin" name="regadmin" required>
                                <option value="" disabled selected>Selecione a região administrativa</option>
                                <option value="Brasília">Brasília</option>
                                <option value="Gama">Gama</option>
                                <option value="Taguatinga">Taguatinga</option>
                                <option value="Brazlândia">Brazlândia</option>
                                <option value="Sobradinho">Sobradinho</option>
                                <option value="Planaltina">Planaltina</option>
                                <option value="Paranoá">Paranoá</option>
                                <option value="Núcleo Bandeirante">Núcleo Bandeirante</option>
                                <option value="Ceilândia">Ceilândia</option>
                                <option value="Guará">Guará</option>
                                <option value="Cruzeiro">Cruzeiro</option>
                                <option value="Samambaia">Samambaia</option>
                                <option value="Santa Maria">Santa Maria</option>
                                <option value="São Sebastião">São Sebastião</option>
                                <option value="Recanto das Emas">Recanto das Emas</option>
                                <option value="Lago Sul">Lago Sul</option>
                                <option value="Riacho Fundo">Riacho Fundo</option>
                                <option value="Lago Norte">Lago Norte</option>
                                <option value="Candangolândia">Candangolândia</option>
                                <option value="Águas Claras">Águas Claras</option>
                                <option value="Riacho Fundo II">Riacho Fundo II</option>
                                <option value="Sudoeste/Octogonal">Sudoeste/Octogonal</option>
                                <option value="Varjão">Varjão</option>
                                <option value="Park Way">Park Way</option>
                                <option value="Scia (Estrutural)">Scia (Estrutural)</option>
                                <option value="Sobradinho II">Sobradinho II</option>
                                <option value="Jardim Botânico">Jardim Botânico</option>
                                <option value="Itapoã">Itapoã</option>
                                <option value="SIA">SIA</option>
                                <option value="Vicente Pires">Vicente Pires</option>
                                <option value="Fercal">Fercal</option>
                            </select>

                        </div><!--regadmin == Região administrativa-->

                        <div class="input-group">
                            <label for="endereco">Endereço:</label>
                            <input type="text" id="endereco" name="endereco"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira o endereço" required>
                        </div>

                        <div class="input-group">
                            <label for="descricao">Informações adicionais:<h6 style="color:red;">*Opcional</h6></label>
                            <input type="text" id="descricao" name="descricao"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira as Informações adicionais" >
                        </div>


                        <div class="input-group">
                            <label for="horarioFunc">Horário de abertura:&nbsp;</label>
                            <input type="time" id="horarioFunc" name="horarioAbert"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>

                            <label for="horarioFunc">Horário de fechamento:</label>
                            <input type="time" id="horarioFunc" name="horarioFecha"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                        </div>


                        <div class="input-group">
                            <label for="telefone">Telefone:</label>
                            <input type="text" id="telefone" name="telefone"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required
                                placeholder="Insira o telefone para contato" minlength="11" maxlength="11"
                                oninput="restringirLetras(this)">
                        </div>

                        <div class="input-group">
                            <label for="senha">Senha:</label>
                            <input type="password" id="senha" name="senha"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required
                                placeholder="Insira sua senha">
                            <button type="button" id="mostrarSenha" onclick="mostrarsenha()">Mostrar Senha</button>
                        </div>

                        <div class="input-group">
                            <label for="imagem">Foto do supermercado:</label>
                            <input type="file" id="imagem" name="imagem"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required
                                placeholder="faça upload de uma foto do mercado">
                        </div>

                        <button class="btn_left" onclick="window.location.href='cadastrar.php'">Voltar</button>

                        <button type="submit">Cadastrar</button>

                    </form>
                </div>
            </div>
            </p>
        </div>

    </div>





    <?php require_once '../inc/rodape.php'; ?>