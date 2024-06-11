<?php
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';
session_start();

//verifica se tem algum usuário logado retorna true ou false


$mercadoDAO = new mercadoDAO($conn);
$_SESSION['usuario']['verMercado']=null;

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
                

                         
                         <img src="../cadastro/uploads/<?= $mercado['imagem'] ?>" alt="Imagem do mercado" width="620px">

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
           
            <!-- // Fechamento postagem -->
        </div>

        <div id="area-lateral">
         

            <div class="conteudo-lateral">
                <h3>Filtrar regiões</h3>

               <select name="filtroRegiao" id="" onchange="this.form.submit()">
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

            </div>

        </div>


        
       <?php require_once '../inc/rodape.php'; ?>