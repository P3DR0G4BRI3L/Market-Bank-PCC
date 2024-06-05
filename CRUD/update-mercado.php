<?php
session_start();
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';
if($_SESSION['usuario']['tipo']!='dono'){
    header('location:../index.php');
    exit;
}
$usuarioDAO = new usuarioDAO($conn);
       $mercadoDAO = new mercadoDAO($conn);
       $mercadoDAO = new mercadoDAO($conn);
       $infmercado = $mercadoDAO->getMercadoByIdUsuario($_SESSION['usuario']['id_usuario']);
$mercadoDAO = new mercadoDAO($conn);
       $infmercado = $mercadoDAO->getMercadoByIdUsuario($_SESSION['usuario']['id_usuario']);

if (/*$_SERVER['REQUEST_METHOD'] === 'POST' &&*/ isset($_POST['email'], $_POST['nome'], $_POST['nomeMerc'], $_POST['cnpj'], $_POST['endereco'], $_POST['horarioAbert'], $_POST['horarioFecha'],
 $_POST['telefone'], $_POST['senha'],$_POST['regiaoadm'],$_POST['compras']) ) {

    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $nomeMerc = $_POST['nomeMerc'];
    $cnpj = $_POST['cnpj'];
    $endereco = $_POST['endereco'];
    $horarioAbert = $_POST['horarioAbert'];
    $horarioFecha = $_POST['horarioFecha'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $imagem = isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0  ? $mercadoDAO->lidarImagem($_FILES['imagem']) :$_SESSION['usuario']['mercado']['imagem'];
    $descricao = $_POST['descricao'] ?? null;
    $compras = $_POST['compras'];
    $regiaoadm = $_POST['regiaoadm'];




    if($mercadoDAO->verificaCNPJexisteAtt($cnpj,$_SESSION['usuario']['mercado']['cnpj'])){
        echo "<script>

        alert('O CNPJ inserido já está cadastrado no sistema');
            window.location.href='update-mercado.php';
        
    </script>";
    }

    if($usuarioDAO->verificaEmailExisteAtt($email,$_SESSION['usuario']['email'])){
        echo "<script>

        alert('O email inserido já está em uso');
            window.location.href='update-mercado.php';
        
    </script>";
    }
    $attUser = $usuarioDAO->atualizarUsuario($nome,$email,$senha,$_SESSION['usuario']['id_usuario']);
    
    $attMercado = $mercadoDAO->atualizarMercado($nomeMerc,$regiaoadm,$endereco,$horarioAbert,$horarioFecha,$telefone,$cnpj,$imagem,$descricao,$compras,$_SESSION['usuario']['mercado']['id_mercado']);

    
    
   
    if( $attUser && $attMercado){ 
        $user = $usuarioDAO->getUsuarioByDono($_SESSION['usuario']['mercado']['id_dono']);
        $mercado = $mercadoDAO->getMercadoByIdUsuario($_SESSION['usuario']['id_usuario']);

        $_SESSION['usuario'] = [
            'id_usuario' => $user['id_usuario'],
            'email' => $user['email'],
            'nome' => $user['nome'],
            'tipo' => $user['tipo'],

            'mercado' => [
                'horarioAbert' => $mercado['horarioAbert'],
                'horarioFecha' => $mercado['horarioFecha'],
                'id_mercado' => $mercado['id_mercado'],
                'regiaoadm' => $mercado['regiaoadm'],
                'descricao' => $mercado['descricao'],
                'nomeMerc' => $mercado['nomeMerc'],
                'endereco' => $mercado['endereco'],
                'telefone' => $mercado['telefone'],
                'id_dono' => $mercado['id_dono'],
                'compras' => $mercado['compras'],
                'imagem' => $mercado['imagem'],
                'cnpj' => $mercado['cnpj']
            ]
        ];
        
        

        echo " <script>alert('Mercado editado com sucesso');
        window.location.href='../cadastro/verMeuMercado.php';
        </script> ";
    }

}
require_once '../inc/cabecalho.php';
?>
<div id="area-principal">

    <div id="area-postagens">
        <!--Aberturac -->
        <div class="postagem">
            <h2>Editar mercado</h2>
            
            <div class="container">
                <div class="login-box">
                    <form action="" method="POST" enctype="multipart/form-data"  onsubmit="return validarquant();">

                        <div class="input-group">
                            <label for="username">E-mail:</label>

                            <input type="email" id="username" name="email" value="<?= $_SESSION['usuario']['email'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira seu email" required>
                        </div>

                        <div class="input-group">
                            <label for="nome">Nome do proprietário:</label>
                            <input type="text" id="nome" name="nome" value="<?= $_SESSION['usuario']['nome'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira seu nome" required>
                        </div>

                        <div class="input-group">
                            <label for="nome">Nome do Mercado:</label>
                            <input type="text" id="nome" name="nomeMerc" value="<?= $_SESSION['usuario']['mercado']['nomeMerc'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira o nome do mercado" required>
                        </div>

                        <div class="input-group">
                            <label for="cnpj">CNPJ:</label>
                            <input type="text" id="cnpj" name="cnpj" value="<?= $_SESSION['usuario']['mercado']['cnpj'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required
                                placeholder="Insira seu CNPJ" minlength="14" maxlength="14"
                                oninput="restringirLetras(this)">
                        </div>

                        <div class="input-endereco">
                            <label for="regiaoadm">Região Administrativa:</label>
                            <select id="regiaoadm" name="regiaoadm" required>
                                <option value="" disabled selected>Selecione a região administrativa</option>
                                <option value="Brasília" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Brasília" ? 'selected':'' ?> >Brasília</option>
                                <option value="Gama" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Gama" ? 'selected':'' ?> >Gama</option>
                                <option value="Taguatinga" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Taguatinga" ? 'selected':'' ?> >Taguatinga</option>
                                <option value="Brazlândia" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Brazlândia" ? 'selected':'' ?> >Brazlândia</option>
                                <option value="Sobradinho" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Sobradinho" ? 'selected':'' ?> >Sobradinho</option>
                                <option value="Planaltina" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Planaltina" ? 'selected':'' ?> >Planaltina</option>
                                <option value="Paranoá" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Paranoá" ? 'selected':'' ?> >Paranoá</option>
                                <option value="Núcleo Bandeirante" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Núcleo Bandeirante"? 'selected':'' ?>>Núcleo Bandeirante</option>
                                <option value="Ceilândia" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Ceilândia" ? 'selected':'' ?> >Ceilândia</option>
                                <option value="Guará" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Guará" ? 'selected':'' ?> >Guará</option>
                                <option value="Cruzeiro" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Cruzeiro" ? 'selected':'' ?> >Cruzeiro</option>
                                <option value="Samambaia" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Samambaia" ? 'selected':'' ?> >Samambaia</option>
                                <option value="Santa Maria" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Santa Maria"? 'selected':'' ?> >Santa Maria</option>
                                <option value="São Sebastião" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="São Sebastião"? 'selected':'' ?> >São Sebastião</option>
                                <option value="Recanto das Emas"<?= $_SESSION['usuario']['mercado']['regiaoadm']=="Recanto das Emas" ? 'selected':'' ?> >Recanto das Emas</option>
                                <option value="Lago Sul" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Lago Sul"? 'selected':'' ?> >Lago Sul</option>
                                <option value="Riacho Fundo" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Riacho Fundo"? 'selected':'' ?> >Riacho Fundo</option>
                                <option value="Lago Norte" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Lago Norte"? 'selected':'' ?> >Lago Norte</option>
                                <option value="Candangolândia" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Candangolândia" ? 'selected':'' ?> >Candangolândia</option>
                                <option value="Águas Claras" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Águas Claras"? 'selected':'' ?> >Águas Claras</option>
                                <option value="Riacho Fundo II"  <?= $_SESSION['usuario']['mercado']['regiaoadm']== "Riacho Fundo II" ? 'selected':''== '' ?> >Riacho Fundo II</option>
                                <option value="Sudoeste/Octogonal" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Sudoeste/Octogonal"? 'selected':'' ?> >Sudoeste/Octogonal</option>
                                <option value="Varjão" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Varjão" ? 'selected':'' ?> >Varjão</option>
                                <option value="Park Way" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Park Way"? 'selected':'' ?> >Park Way</option>
                                <option value="Scia (Estrutural)" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Scia (Estrutural)"? 'selected':'' ?> >Scia (Estrutural)</option>
                                <option value="Sobradinho II" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Sobradinho II"? 'selected':'' ?> >Sobradinho II</option>
                                <option value="Jardim Botânico" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Jardim Botânico"? 'selected':'' ?> >Jardim Botânico</option>
                                <option value="Itapoã" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Itapoã" ? 'selected':'' ?> >Itapoã</option>
                                <option value="SIA" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="SIA" ? 'selected':'' ?> >SIA</option>
                                <option value="Vicente Pires" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Vicente Pires"? 'selected':'' ?> >Vicente Pires</option>
                                <option value="Fercal" <?= $_SESSION['usuario']['mercado']['regiaoadm']=="Fercal" ? 'selected':'' ?> >Fercal</option>
                            </select>

                        <div class="input-group">
                            <label for="endereco">Endereço:</label>
                            <input type="text" id="endereco" name="endereco" value="<?= $_SESSION['usuario']['mercado']['endereco'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira o endereço" required>
                        </div>

                        <div class="input-group">
                            <label for="descricao">Informações adicionais:<h6>*Opcional</h6></label>
                            <input type="text" id="descricao" name="descricao" value="<?= $_SESSION['usuario']['mercado']['descricao'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira as Informações adicionais" >
                        </div>


                        <div class="input-group">
                            <label for="horarioFunc">Horário de abertura:&nbsp;</label>
                            <input type="time" id="horarioFunc" name="horarioAbert"
                                value="<?= date('H:i' , strtotime($_SESSION['usuario']['mercado']['horarioAbert'])) ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>

                            <label for="horarioFunc">Horário de fechamento:</label>
                            <input type="time" id="horarioFunc" name="horarioFecha"
                                value="<?= date('H:i' , strtotime($_SESSION['usuario']['mercado']['horarioFecha'])) ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                        </div>


                        <div class="input-group">
                            <label for="telefone">Telefone:</label>
                            <input type="text" id="telefone" name="telefone" value="<?= $_SESSION['usuario']['mercado']['telefone'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required
                                placeholder="Insira o telefone para contato" minlength="11" maxlength="11"
                                oninput="restringirLetras(this)">
                        </div>

                        <div class="input-group">
                            <label for="senha">Senha:</label>
                            <input type="password" id="senha" name="senha" value="<?= $usuarioDAO->getSenhaById($_SESSION['usuario']['id_usuario']) ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required
                                placeholder="Insira sua senha">
                            <button type="button" class="button_padrao" id="mostrarSenha" onclick="mostrarsenha()">Mostrar Senha</button>
                        </div>

                        <div class="input-group">

                            <picture>
                                <img src="../cadastro/uploads/<?= $_SESSION['usuario']['mercado']['imagem'] ?>" alt="foto do mercado"
                                    width="100px">
                                <legend>Imagem atual</legend>
                            </picture>

                            <label for="imagem">Foto do supermercado: <h6>* escolha uma nova imagem
                                    se quiser trocar a atual</h6></label>
                            <input type="file" id="imagem" name="imagem"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="faça upload de uma foto do mercado">
                        </div>


                        <div class="input-compra">
                            <label for="compras">Deseja fornecer compras pelo site?&nbsp;&nbsp;&nbsp;</label>
                            <input type="radio" id="compras" name="compras" value="sim" onkeydown="if(event.keyCode === 13) event.preventDefault()" required
                            <?=$_SESSION['usuario']['mercado']['compras'] == 'sim' ?'checked' : ''?>>
                            <p>Sim</p>

                            <input type="radio" id="compras" name="compras" value="nao" onkeydown="if(event.keyCode === 13) event.preventDefault()" required <?=$_SESSION['usuario']['mercado']['compras'] == 'nao' ?'checked' : ''?> >
                            <p>Não</p>

                        </div>


                        <button type="submit" class="button_padrao btn_edit" >Salvar</button>

                    </form>
                </div>
            </div>
            
        </div>

    </div>
    <?php require_once '../inc/rodape.php'; ?>