<?php
require_once '../func/func.php';
require_once '../inc/cabecalhocadastro.php';

session_start();
require_once 'cadastro.php';
require_once '../func/func.php';
require_once '../model/mercadoDAO.php';
require_once '../model/clienteDAO.php';
require_once '../model/usuarioDAO.php';
// Conexão com o banco de dados

if (usuarioEstaLogado()) {
    header('location:../index.php');
}
if (isset($_POST['email'], $_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $default = null;


    $usuarioDAO = new usuarioDAO($conn);
    $clienteDAO = new clienteDAO($conn);
    if ($usuarioDAO->login($email, md5($senha))) {

        $infoUser = $usuarioDAO->getUsuarioById($usuarioDAO->getIdUsuarioByEmail($email));
        $infoCliente = $clienteDAO->getClienteById($usuarioDAO->getIdUsuarioByEmail($email));

        switch ($infoUser['tipo']) {

            case "cliente":
                $_SESSION['usuario'] = [
                    'id_usuario' => $infoUser['id_usuario'],
                    'telefone' => $infoCliente['telefone'],
                    'email' => $infoUser['email'],
                    'nome' => $infoUser['nome'],
                    'tipo' => $infoUser['tipo'], //atribui todas as informações do usuario ao usuario de sessão
                    'verMercado' => '',
                    'carrinho' => []
                ];

                echo "<script>alert('Login realizado com sucesso');</script>";
                echo "<script>window.location.href='../index.php'</script>";
                exit;
                break;





            case "dono":
                $mercadoDAO = new mercadoDAO($conn);
                $infmercado = $mercadoDAO->getMercadoByIdUsuario($infoUser['id_usuario']);
                $_SESSION['usuario'] = [
                    'id_usuario' => $infoUser['id_usuario'],
                    'email' => $infoUser['email'],
                    'nome' => $infoUser['nome'],
                    'tipo' => $infoUser['tipo'],

                    'mercado' => [
                        'horarioAbert' => $infmercado['horarioAbert'],
                        'horarioFecha' => $infmercado['horarioFecha'],
                        'id_mercado' => $infmercado['id_mercado'],
                        'regiaoadm' => $infmercado['regiaoadm'],
                        'descricao' => $infmercado['descricao'],
                        'nomeMerc' => $infmercado['nomeMerc'],
                        'endereco' => $infmercado['endereco'],
                        'telefone' => $infmercado['telefone'],
                        'id_dono' => $infmercado['id_dono'],
                        'compras' => $infmercado['compras'],
                        'imagem' => $infmercado['imagem'],
                        'cnpj' => $infmercado['cnpj']
                    ]
                ];

                echo "<script>alert('Login realizado com sucesso');</script>";
                echo "<script>window.location.href='../index.php'</script>";
                exit;
                break;





            case "administrador":
                echo "<script>alert('Login realizado com sucesso');</script>";
                $_SESSION['usuario'] = $infoUser; //atribui todas as informações do usuario ao usuario de sessão
                echo "<script>window.location.href='../index.php'</script>";
                exit;
                break;
        }
    } else {

        $default = "Usuário ou senha incorretos";
    }
}
?>

<div id="area-principal">

    
        <!--Aberturac -->
        <div class="postagem">
            <h2>Login</h2>
            <div class="container">
                <div class="login-box largura_menor">
                    <?php if (isset($default)) : ?>
                        <h6><?= $default ?></h6>
                    <?php endif ?>
                    <form action="" method="POST">

                        <div class="input-group email">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" onkeydown="if(event.keyCode === 13) event.preventDefault()" required autofocus>
                        </div>

                        <div class="input-group senha">
                            <label for="senha">Senha:</label>

                            <div class="inline">
                                <input type="password" id="senha" name="senha" onkeydown="if(event.keyCode === 13) event.preventDefault()" maxlength="16" required>
                                <button type="button" id="mostrarSenha" onclick="mostrarsenha()"><span class="lnr lnr-eye"></span></button>

                            </div>
                        </div>
                        <button type="button" class="button_padrao" onclick="window.location.href='../index.php'">Voltar</button>
                        <button class="button_padrao" type="submit">Entrar</button>

                    </form>
                </div>
            </div>
        </div>
        <!--// Fechamento postagem -->


   

</>



<?php require_once '../inc/rodape.php'; ?>