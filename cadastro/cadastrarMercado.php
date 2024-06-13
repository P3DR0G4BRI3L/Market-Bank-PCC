<?php
require_once '../func/func.php';
require_once 'cadastro.php';
require_once '../model/usuarioDAO.php';
require_once '../model/mercadoDAO.php';
require_once '../model/infopagDAO.php';
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['nome'], $_POST['nome_mercado'], $_POST['cnpj'], $_POST['endereco'], $_POST['horarioAbert'], $_POST['horarioFecha'],
$_POST['telefone'],$_POST['regiaoadm'],$_POST['compras'])){
if (isset($_POST['senha']) && strlen($_POST['senha']) > 16) {
    echo "<script>alert('Senha muito extensa, no máximo 16 caracteres');
    window.location.href='cadastrarCliente.php';
    </script>";
}
if($_POST['senha']!=$_POST['confirmarsenha']){
    header('location:?mess=As senhas devem ser iguais');
}

$nomeMerc = $_POST['nome_mercado'];
$regiaoadm = $_POST['regiaoadm'];
$endereco = $_POST['endereco'];
$horarioAbert = $_POST['horarioAbert'];
$horarioFecha = $_POST['horarioFecha'];
$telefone = $_POST['telefone'];
$imagem = ($_FILES['imagem']);
$cnpj = $_POST['cnpj'];
$descricao = $_POST['descricao'] ?? null;
$compras = $_POST['compras'];


$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$usuarioDAO = new usuarioDAO($conn);
$mercadoDAO = new mercadoDAO($conn);
$infopagDAO = new infopagDAO($conn);

if ($mercadoDAO->verificaCNPJexiste($cnpj)) {
    echo "<script>
    alert('O CNPJ inserido já está cadastrado no sistema');window.location.href='cadastrarMercado.php';
    </script>";
    exit;
}
//verifica se ja existe esse email no banco de dados
if ($usuarioDAO->verificaEmailExiste($email)) {
    echo "<script>
            alert('O email inserido já está em uso');window.location.href='cadastrarMercado.php';
          </script>";
    exit;
}

if ($usuarioDAO->inserirUsuario($nome, $email, md5($senha), 'dono')) {

    $id_dono = $usuarioDAO->getIdUsuarioByEmail($email);

    if (!empty($id_dono)) {



        if ($mercadoDAO->inserirMercado($nomeMerc, $regiaoadm, $endereco, $horarioAbert, $horarioFecha, $telefone, $cnpj, $imagem, $descricao, $compras, $id_dono)) {
            if($compras == 'sim'){
                $id = $usuarioDAO->getIdUsuarioByEmail($email);
                echo "<script>alert('Cadastro realizado com sucesso!\nAgora só falta inserir as informações de pagamento');</script>";
                header("location:cadastroInfopag.php?id=$id");exit;
            }
            
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        } else {
            echo "erro ao cadastrar" . $stmt->errorInfo();
        }
        exit; // Certifique-se de sair do script após o redirecionamento
    }

}}


require_once '../inc/cabecalhocadastro.php'; //mostra o cabeçalho
?>


<div id="area-principal">

    <!--Aberturac -->
    <div class="postagem">
        <h2>Área de cadastro do mercado</h2>
        <div class="login-box">
            <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validarquant();">

                <div class="input-group">
                    <label for="username">E-mail:</label>

                    <input type="email" id="username" name="email" onkeydown="if(event.keyCode === 13) event.preventDefault()" placeholder="Insira seu email" required>
                </div>

                <div class="input-name">
                    <label for="nomeprop">Nome do proprietário:</label>
                    <input type="text" id="nomeprop" name="nome" onkeydown="if(event.keyCode === 13) event.preventDefault()" placeholder="Insira seu nome" required>

                    <label for="nomemerc">Nome do Mercado:</label>
                    <input type="text" id="nomemerc" name="nome_mercado" onkeydown="if(event.keyCode === 13) event.preventDefault()" placeholder="Insira o nome do mercado" required>
                </div>

                <div class="input-group">
                    <label for="cnpj">CNPJ:</label>
                    <input type="text" id="cnpj" name="cnpj" onkeydown="if(event.keyCode === 13) event.preventDefault()" required placeholder="Insira seu CNPJ" minlength="14" maxlength="14" oninput="restringirLetras(this)">
                </div>

                <div class="input-endereco">
                    <label for="regiaoadm">Região Administrativa:</label>
                    <select id="regiaoadm" name="regiaoadm" required>
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

                    <!--regadmin == Região administrativa-->

                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" onkeydown="if(event.keyCode === 13) event.preventDefault()" placeholder="Insira o endereço" required>
                </div>

                <div class="input-group">
                    <label for="descricao">Informações adicionais:<h6>*Opcional</h6></label>
                    <input type="text" id="descricao" name="descricao" onkeydown="if(event.keyCode === 13) event.preventDefault()" placeholder="Insira as Informações adicionais">
                </div>


                <div class="input-time">
                    <label for="horarioFunc">Horário de abertura:&nbsp;</label>
                    <input type="time" id="horarioFunc" name="horarioAbert" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>

                    <label for="horarioFunc">Horário de fechamento:</label>
                    <input type="time" id="horarioFunc" name="horarioFecha" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                </div>


                <div class="input-group">
                    
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" onkeydown="if(event.keyCode === 13) event.preventDefault()" required placeholder="Insira o telefone para contato" minlength="11" maxlength="11" oninput="restringirLetras(this)">
                </div>

                <label for="senha">Senha:</label>
                <?php if(isset($_GET['mess'])): ?>
                    <h6><?= $_GET['mess'] ?></h6>
                <?php endif ?>
                <div class="inline merc">
                    <input type="password" id="senha" name="senha" onkeydown="if(event.keyCode === 13) event.preventDefault()" required placeholder="Insira sua senha">
                    <button type="button" id="mostrarSenha" onclick="mostrarsenha()"><span class="lnr lnr-eye"></span></button>

                </div>
                <label for="senha">Confirmar senha:</label>
                <div class="inline merc">
                    <input type="password" id="senha" name="confirmarsenha" onkeydown="if(event.keyCode === 13) event.preventDefault()" required placeholder="Insira sua senha">
                    <button type="button" id="mostrarSenha" onclick="mostrarsenha()"><span class="lnr lnr-eye"></span></button>

                </div>

                <div class="input-group">
                    <label for="foto">Foto do mercado</label>
                    <label for="foto">
                        <img class="icon_prod" src="../home/img/download-icon.jpeg" width="50px" title="Faça upload da foto do mercado"></label>
                    <div class="custom-file-upload">
                        <input type="file" id="foto" name="imagem" onkeydown="if(event.keyCode === 13) event.preventDefault()" onchange="displayFileName()" required>
                    </div>


                </div>

                <div class="input-compra">
                    <label for="compras">Deseja fornecer compras pelo site?&nbsp;&nbsp;&nbsp;</label>
                    <input type="radio" id="compras" name="compras" value="sim" onchange="compras()" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                    <p>Sim</p>

                    <input type="radio" id="compras" name="compras" value="nao" onchange="compras()" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                    <p>Não</p>

                </div>

                <button class="button_padrao" onclick="window.location.href='cadastrar.php'">Voltar</button>

                <button class="button_padrao" type="submit">Cadastrar</button>

            </form>
        </div>
    </div>
</div>






<?php require_once '../inc/rodape.php'; ?>