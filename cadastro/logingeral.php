<?php
session_start();
require_once 'cadastro.php';
require_once '../func/func.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';
// Conexão com o banco de dados



$email = $_POST['email'];
$senha = $_POST['senha'];



$usuarioDAO = new usuarioDAO($conn);
if ($usuarioDAO->login($email, $senha)) {
    
    $infoUser = $usuarioDAO->getUsuarioById($usuarioDAO->getIdUsuarioByEmail($email));

    switch ($infoUser['tipo']) {

        case "cliente":
            echo "<script>alert('Login realizado com sucesso');</script>";
            $_SESSION['usuario'] = $infoUser;//atribui todas as informações do usuario ao usuario de sessão
            echo"<script>window.location.href='../index.php'</script>";
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
                $infoUser;//atribui todas as informações do usuario ao usuario de sessão

                echo "<script>alert('Login realizado com sucesso');</script>";
                echo"<script>window.location.href='../index.php'</script>";
                exit;
            break;





        case "administrador":
                echo "<script>alert('Login realizado com sucesso');</script>";
                $_SESSION['usuario'] = $infoUser;//atribui todas as informações do usuario ao usuario de sessão
                echo"<script>window.location.href='../index.php'</script>";
                exit;
            break;

    }
} else {

    $default = "Usuário ou senha incorretos";

}


// echo"<pre>";
// var_dump($_SESSION['usuario']);
// var_dump($email);
// var_dump($senha);





?>
<!DOCTYPE html>
<html>

<head>
    <title>Market Bank Supermercados</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/cadastro.css">

</head>

<body>

    <div id="area-cabecalho">

        <!-- abertura postagem -->
        <div id="area-logo">
            <img src="../home/img/logo.png" alt="logo">
        </div>
        <div id="area-menu">
            <a href="../index.php">Home</a>

            <?php if (usuarioEstaLogado()): ?>
                <a href="mercados.php">Mercados</a>
            <?php endif ?>

            <a href="../home/contato.php">Contato</a>
            <a href="../home/fale.php">Fale Conosco</a>

        </div>
    </div>

    <div id="area-principal">

        <div id="area-postagens">
            <!--Aberturac -->

            <div class="postagem">
                <h2>
                    <?php if (isset($default))
                        echo "$default";//mostra usuario ou senha incorretos ?>
                </h2>
                <p>
                <div class="cadastro_option">
                    <div class="login-box">

                        <button class="btn_left" onclick="window.location.href='login.php'">Voltar</button>
                        <!--<button onclick="window.location.href = 'cadastrarCliente.php'">Cliente</button>
                        <button onclick="window.location.href = 'cadastrarMercado.php'">Mercado</button>
                        <br> -->


                        </form>
                    </div>
                </div>
                </p>
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




        <div id="rodape">
            &copy Todos os direitos reservados
        </div>

    </div>

</body>

</html>

<?php
$conn = null;
?>