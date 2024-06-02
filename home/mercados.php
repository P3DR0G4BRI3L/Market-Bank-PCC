<?php
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';
session_start();

//verifica se tem algum usuário logado retorna true ou false


$mercadoDAO = new mercadoDAO($conn);


require_once '../inc/cabecalho.php';//mostra o cabeçalho
?>



    <div id="area-principal">

        <div id="area-postagens">


            <?php
            // o cabeçalho é mostrado em cima normal, porem, se a pessoa não estiver logada é criado uma div postagem e mostra pro usuário que ele não pode acessar essa pagina 
           voceNaoTemPermissao();

            ?>



            <!--Abertura postagem -->

            <!--lista os mercados, usando fetchAll no $result,  -->
            <?php if ($mercadoDAO->getAllMercados()) {
                $mercados=$mercadoDAO->getAllMercados();
                //  echo"<pre>"; print_r($mercados);exit; ?>                        
                <?php foreach ($mercados as $mercado  ) :  ?>
                    <div class="postagem">
                    
                        
                        
                         <h2><?= ucwords($mercado['nomeMerc'])?> </h2>
                

                         
                         <!-- <img src="../cadastro/uploads/ <?= $mercado['imagem'] ?>" alt="Imagem do mercado" width="620px"> -->
                         <?php echo '<img src="../cadastro/uploads/' . $mercado['imagem'] . '" alt="Imagem do mercado" width="620px">';?>

                         <h2><?= $mercado['regiaoadm'] ?> </h2>

                
                            
                        <?php if ($_SESSION['usuario']['tipo'] != 'dono'): ?>
                            <form action="verPerfilMercado.php" method="POST">
                                <input type="hidden" name="id_mercado" value="<?= $mercado['id_mercado']; ?>">

                                <button class='button_padrao' type="submit">Ver perfil</button>

                            </form>
                        <?php endif ?>
                    </div><?php endforeach ?>
                    <?php } ?>
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


        
       <?php require_once '../inc/rodape.php'; ?>