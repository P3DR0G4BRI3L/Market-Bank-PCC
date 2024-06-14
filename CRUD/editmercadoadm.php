<?php
session_start();
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';
if(!admEstaLogado()){
    header('location:../index.php');
    exit;
}
$mercadoDAO = new mercadoDAO($conn);
$usuarioDAO = new usuarioDAO($conn);
$mercado = $mercadoDAO->getMercadoById($_GET['id_mercado']);
$usuario = $usuarioDAO->getUsuarioById($_GET['id_usuario']);
$cnpjatual = $mercado['cnpj'];
$emailatual = $usuario['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['nome'], $_POST['nomeMerc'], $_POST['cnpj'], $_POST['endereco'], $_POST['horarioAbert'], $_POST['horarioFecha'],
$_POST['telefone'],$_POST['regiaoadm'],$_POST['compras']) ) {

    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $nomeMerc = $_POST['nomeMerc'];
    $cnpj = $_POST['cnpj'];
    $endereco = $_POST['endereco'];
    $horarioAbert = $_POST['horarioAbert'];
    $horarioFecha = $_POST['horarioFecha'];
    $telefone = $_POST['telefone'];
    $imagem = isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0  ? $mercadoDAO->lidarImagem($_FILES['imagem']) :$mercado['imagem'];
    $descricao = $_POST['descricao'] ?? null;
    $compras = $_POST['compras'];
    $regiaoadm = $_POST['regiaoadm'];




    if($mercadoDAO->verificaCNPJexisteAtt($cnpj,$cnpjatual)){
        echo "<script>

        alert('O CNPJ inserido já está cadastrado no sistema');
            window.location.href='update-mercado.php';
        
    </script>";
    }

    if($usuarioDAO->verificaEmailExisteAtt($email,$emailatual)){
        echo "<script>

        alert('O email inserido já está em uso');
            window.location.href='update-mercado.php';
        
    </script>";
    }
    $attUser = $usuarioDAO->atualizarUsuario($nome,$email,$_GET['id_usuario']);
    
    $attMercado = $mercadoDAO->atualizarMercado($nomeMerc,$regiaoadm,$endereco,$horarioAbert,$horarioFecha,$telefone,$cnpj,$imagem,$descricao,$compras,$_GET['id_mercado']);

    
    
   
    if( $attUser && $attMercado){ 
        echo " <script>alert('Mercado editado com sucesso');
        window.location.href='../CRUD/admmercado.php';
        </script> ";
    }else{
        
        echo " <script>alert('falha ao editar o mercado');
        window.location.href='../CRUD/admmercado.php';
        </script> ";
    }

}
require_once '../inc/cabecalho.php';
?><br>
<div id="area-principal ">

        <!--Aberturac -->
        <div class="postagem home">
            <h2>Editar mercado ADM</h2>
            
            <div class="container">
                <div class="login-box">
                    <form action="" method="POST" enctype="multipart/form-data"  onsubmit="return validarquant();">

                        <div class="input-group">
                            <label for="username">E-mail:</label>

                            <input type="email" id="username" name="email" value="<?= $usuario['email'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira seu email" required>
                        </div>

                        <div class="input-group">
                            <label for="nome">Nome do proprietário:</label>
                            <input type="text" id="nome" name="nome" value="<?= $usuario['nome'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira seu nome" required>
                        </div>

                        <div class="input-group">
                            <label for="nome">Nome do Mercado:</label>
                            <input type="text" id="nome" name="nomeMerc" value="<?= $mercado['nomeMerc'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira o nome do mercado" required>
                        </div>

                        <div class="input-group">
                            <label for="cnpj">CNPJ:</label>
                            <input type="text" id="cnpj" name="cnpj" value="<?= $mercado['cnpj'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required
                                placeholder="Insira seu CNPJ" minlength="14" maxlength="14"
                                oninput="restringirLetras(this)">
                        </div>

                        <div class="input-endereco">
                            <?php $regiaoadm = $mercado['regiaoadm']; ?>
                            <label for="regiaoadm">Região Administrativa:</label>
                            <select id="regiaoadm" name="regiaoadm" required>
                                <option value="" disabled selected>Selecione a região administrativa</option>
                                <option value="Brasília" <?= $regiaoadm=="Brasília" ? 'selected':'' ?> >Brasília</option>
                                <option value="Gama" <?= $regiaoadm=="Gama" ? 'selected':'' ?> >Gama</option>
                                <option value="Taguatinga" <?= $regiaoadm=="Taguatinga" ? 'selected':'' ?> >Taguatinga</option>
                                <option value="Brazlândia" <?= $regiaoadm=="Brazlândia" ? 'selected':'' ?> >Brazlândia</option>
                                <option value="Sobradinho" <?= $regiaoadm=="Sobradinho" ? 'selected':'' ?> >Sobradinho</option>
                                <option value="Planaltina" <?= $regiaoadm=="Planaltina" ? 'selected':'' ?> >Planaltina</option>
                                <option value="Paranoá" <?= $regiaoadm=="Paranoá" ? 'selected':'' ?> >Paranoá</option>
                                <option value="Núcleo Bandeirante" <?= $regiaoadm=="Núcleo Bandeirante"? 'selected':'' ?>>Núcleo Bandeirante</option>
                                <option value="Ceilândia" <?= $regiaoadm=="Ceilândia" ? 'selected':'' ?> >Ceilândia</option>
                                <option value="Guará" <?= $regiaoadm=="Guará" ? 'selected':'' ?> >Guará</option>
                                <option value="Cruzeiro" <?= $regiaoadm=="Cruzeiro" ? 'selected':'' ?> >Cruzeiro</option>
                                <option value="Samambaia" <?= $regiaoadm=="Samambaia" ? 'selected':'' ?> >Samambaia</option>
                                <option value="Santa Maria" <?= $regiaoadm=="Santa Maria"? 'selected':'' ?> >Santa Maria</option>
                                <option value="São Sebastião" <?= $regiaoadm=="São Sebastião"? 'selected':'' ?> >São Sebastião</option>
                                <option value="Recanto das Emas"<?= $regiaoadm=="Recanto das Emas" ? 'selected':'' ?> >Recanto das Emas</option>
                                <option value="Lago Sul" <?= $regiaoadm=="Lago Sul"? 'selected':'' ?> >Lago Sul</option>
                                <option value="Riacho Fundo" <?= $regiaoadm=="Riacho Fundo"? 'selected':'' ?> >Riacho Fundo</option>
                                <option value="Lago Norte" <?= $regiaoadm=="Lago Norte"? 'selected':'' ?> >Lago Norte</option>
                                <option value="Candangolândia" <?= $regiaoadm=="Candangolândia" ? 'selected':'' ?> >Candangolândia</option>
                                <option value="Águas Claras" <?= $regiaoadm=="Águas Claras"? 'selected':'' ?> >Águas Claras</option>
                                <option value="Riacho Fundo II"  <?= $regiaoadm== "Riacho Fundo II" ? 'selected':''== '' ?> >Riacho Fundo II</option>
                                <option value="Sudoeste/Octogonal" <?= $regiaoadm=="Sudoeste/Octogonal"? 'selected':'' ?> >Sudoeste/Octogonal</option>
                                <option value="Varjão" <?= $regiaoadm=="Varjão" ? 'selected':'' ?> >Varjão</option>
                                <option value="Park Way" <?= $regiaoadm=="Park Way"? 'selected':'' ?> >Park Way</option>
                                <option value="Scia (Estrutural)" <?= $regiaoadm=="Scia (Estrutural)"? 'selected':'' ?> >Scia (Estrutural)</option>
                                <option value="Sobradinho II" <?= $regiaoadm=="Sobradinho II"? 'selected':'' ?> >Sobradinho II</option>
                                <option value="Jardim Botânico" <?= $regiaoadm=="Jardim Botânico"? 'selected':'' ?> >Jardim Botânico</option>
                                <option value="Itapoã" <?= $regiaoadm=="Itapoã" ? 'selected':'' ?> >Itapoã</option>
                                <option value="SIA" <?= $regiaoadm=="SIA" ? 'selected':'' ?> >SIA</option>
                                <option value="Vicente Pires" <?= $regiaoadm=="Vicente Pires"? 'selected':'' ?> >Vicente Pires</option>
                                <option value="Fercal" <?= $regiaoadm=="Fercal" ? 'selected':'' ?> >Fercal</option>
                            </select>

                        <div class="input-group">
                            <label for="endereco">Endereço:</label>
                            <input type="text" id="endereco" name="endereco" value="<?= $mercado['endereco'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira o endereço" required>
                        </div>

                        <div class="input-group">
                            <label for="descricao">Informações adicionais:<h6>*Opcional</h6></label>
                            <input type="text" id="descricao" name="descricao" value="<?= $mercado['descricao'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira as Informações adicionais" >
                        </div>


                        <div class="input-group">
                            <label for="horarioFunc">Horário de abertura:&nbsp;</label>
                            <input type="time" id="horarioFunc" name="horarioAbert"
                                value="<?= date('H:i' , strtotime($mercado['horarioAbert'])) ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>

                            <label for="horarioFunc">Horário de fechamento:</label>
                            <input type="time" id="horarioFunc" name="horarioFecha"
                                value="<?= date('H:i' , strtotime($mercado['horarioFecha'])) ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                        </div>


                        <div class="input-group">
                            <label for="telefone">Telefone:</label>
                            <input type="text" id="telefone" name="telefone" value="<?= $mercado['telefone'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required
                                placeholder="Insira o telefone para contato" minlength="11" maxlength="11"
                                oninput="restringirLetras(this)">
                        </div>

                        

                        <div class="input-group">

                            <picture>
                                <img src="../cadastro/uploads/<?= $mercado['imagem'] ?>" alt="foto do mercado"
                                    width="100px">
                                <legend>Imagem atual</legend>
                            </picture>

                            <label for="imagem">Foto do supermercado: <h6>* escolha uma nova imagem
                                    se quiser trocar a atual</h6></label>
                            <input type="file" id="imagem" name="imagem"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="faça upload de uma foto do mercado">
                        </div>


                        <div class="input-compra inline">
                            <label for="compras">Deseja fornecer compras pelo site?&nbsp;&nbsp;&nbsp;</label>
                            <input type="radio" id="compras" name="compras" value="sim" onkeydown="if(event.keyCode === 13) event.preventDefault()" required
                            <?=$mercado['compras'] == 'sim' ?'checked' : ''?>>
                            <p>Sim</p> &nbsp;&nbsp;&nbsp;

                            <input type="radio" id="compras" name="compras" value="nao" onkeydown="if(event.keyCode === 13) event.preventDefault()" required <?=$mercado['compras'] == 'nao' ?'checked' : ''?> >
                            <p> Não </p>

                        </div>


                        <button type="submit" class="button_padrao btn_edit" >Salvar</button>

                    </form>
                </div>
            </div>
            
        </div>
        </div>

    <?php require_once '../inc/rodape.php'; ?>