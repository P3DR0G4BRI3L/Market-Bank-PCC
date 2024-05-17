<?php
session_start();
require_once 'cadastro.php';
require_once '../func/func.php';
// Conexão com o banco de dados



$email = $_POST['email'];
$senha = $_POST['senha'];



$resultado = $conn->prepare("SELECT * FROM `usuario` WHERE email = :email AND senha = :senha;");
$resultado->bindValue(':email',$email,PDO::PARAM_STR);
$resultado->bindValue(':senha',$senha,PDO::PARAM_STR);
$resultado->execute();

if($resultado && $resultado->rowCount()>0 ){//se a query der certo E resultado (que se torna um objeto se a query der certo) tiver mais de 0 linhas, 

$infoUser = $resultado->fetch(); //atribua todas as informações do usuario a variavel $infoUser, após isso, essa variavel se torna um array associativo com todas as informações do usuario
    $tipo= $infoUser['tipo']; //variavel $tipo, recebe o tipo do usuario
switch ($tipo) {

    case "cliente":
        if ($resultado->rowCount() > 0) {
            echo "<script>alert('Login realizado com sucesso');</script>";
            $_SESSION['usuario'] = $infoUser;//atribui todas as informações do usuario ao usuario de sessão
            header("Location:../index.php");
            exit;
        } else {
            $default = "Usuário ou senha incorretos";
        }
        break;





    case "dono":
        if ($resultado->rowCount() > 0) {
            echo "<script>alert('Login realizado com sucesso');</script>";
            $_SESSION['usuario'] = $infoUser;//atribui todas as informações do usuario ao usuario de sessão
            header("Location:../index.php");
            exit;
        } else {
            $default = "Usuário ou senha incorretos";
        }
        break;





    case "administrador":
        if ($resultado->rowCount() > 0) {
            echo "<script>alert('Login realizado com sucesso');</script>";
            $_SESSION['usuario'] = $infoUser;//atribui todas as informações do usuario ao usuario de sessão
            header("Location:../index.php");
            exit;
        } else {
            $default = "Usuário ou senha incorretos";
        }
        break;

}}else{

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
                 <?php if(isset($default)) echo"$default";//mostra usuario ou senha incorretos ?>
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