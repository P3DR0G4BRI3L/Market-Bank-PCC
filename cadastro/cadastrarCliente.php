<?php
/*
esta pagina é responsavel por receber os dados do formulário inserido em 
cadastrarCliente.php, após receber os dados do formulário esses dados são
inseridos no banco de dados.
clienteDAO lida com a tabela cliente,e usuarioDAO lida com a tabela usuario
*/
// Conexão com o banco de dados
require_once 'cadastro.php' ;
require_once '../model/clienteDAO.php' ;
require_once '../model/usuarioDAO.php' ;
require_once '../func/func.php';
$usuarioDAO = new usuarioDAO($conn);

// Obtem os dados do formulário
if($_SERVER['REQUEST_METHOD']==='POST' && $_POST['nome']&& $_POST['telefone']&& $_POST['email']&& $_POST['senha']&& $_POST['confirmasenha']){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
if(strlen($senha)>16){
    echo "<script>alert('Senha muito extensa, no máximo 16 caracteres');
    window.location.href='cadastrarCliente.php';
    </script>";
}
if($senha != $_POST['confirmasenha']){
    header('location:?confsenha=As senhas devem ser iguais!');
    exit;
}
if(strlen($telefone)!=11){
    header('location:?quant=O telefone deve ter 11 digitos');
    exit;
}


//verifica se o email inserido na hora do cadastro já está cadastrado no sistema, se estiver retorna erro
if($usuarioDAO->verificaEmailExiste($email)){
    header('location:?avisoemail=O email inserido já está em uso!');
    exit;
    }
    
// Insere os dados na tabela de usuários
if ($usuarioDAO->inserirUsuario($nome,$email,md5($senha),'cliente')) {
    $clienteDAO = new clienteDAO($conn);
    
    $clienteDAO->inserirCliente($usuarioDAO->getIdUsuarioByEmail($email),$telefone);//este trecho insere o usuario cliente na tabela cliente 
    echo "<script>
    alert('Cadastro realizado com sucesso');
    window.location.href = '../cadastro/login.php';
    </script>";exit;
}else{
    echo "Erro ao cadastrar" . $stmt->errorInfo();
}



$conn = null;
}




require_once '../inc/cabecalhocadastro.php'; //mostra o cabeçalho
?>

<div class="wrapper">
<div id="area-principal_cliente">
    <div id="area-postagens">
        <!--Aberturac -->
        <div class="postagem_cliente">
            <h2>Área de cadastro do cliente</h2>
            <div class="container">
                <div class="login-box">
                    <form action="" method="POST" onsubmit="return validartel();">

                        <div class="input-group">
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" placeholder="Insira seu nome" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                        </div>

                        <div class="input-group">
                        <?php if(isset($_GET['quant'])): ?> 
                                <h6><?=$_GET['quant'] ?></h6>
                                <?php endif ?>
                            <label for="telefone">Telefone:</label>
                            <input type="text" id="telefone" name="telefone" onkeydown="if(event.keyCode === 13) event.preventDefault()" required placeholder="Insira o telefone para contato" minlength="11" maxlength="11" oninput="restringirLetras(this)">
                        </div>

                        <div class="input-group">
                        <?php if(isset($_GET['avisoemail'])): ?> 
                                <h6><?= $_GET['avisoemail'] ?></h6>
                                <?php endif ?>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" placeholder="Insira seu email" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                        </div>
<br>
                        <label for="senha">Senha:</label>
                        <div class="inline">
                            <input type="password" id="senha" name="senha" placeholder="Insira sua senha " onkeydown="if(event.keyCode === 13) event.preventDefault()"  required maxlength="16">
                            <button type="button" id="mostrarSenha" onclick="mostrarsenha()"><span class="lnr lnr-eye"></span></button>
                        </div>

                        <label for="senha">Confirmar senha:</label>
                            <?php if(isset($_GET['confsenha'])): ?> 
                                <h6><?= $_GET['confsenha'] ?></h6>
                                <?php endif ?>
                        <div class="inline">
                            <input type="password" id="senha" name="confirmasenha" placeholder="Confirme sua senha " onkeydown="if(event.keyCode === 13) event.preventDefault()"  required maxlength="16">
                            <button type="button" id="mostrarSenha" onclick="mostrarsenha()"><span class="lnr lnr-eye"></span></button>
                        </div>
                        <button class="button_padrao" onclick="window.location.href='cadastrar.php'">Voltar</button>

                        <button class="button_padrao" type="submit">Cadastrar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php require_once '../inc/rodape.php'; ?>