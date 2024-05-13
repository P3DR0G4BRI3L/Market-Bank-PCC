<?php
require_once 'cadastro.php';

session_start();

function usuarioEstaLogado(): bool
{
    return isset($_SESSION['usuario']);
}
if (!usuarioEstaLogado()) {
    header('location:../index.php');
    exit;
}
function mercadoEstaLogado()
{
    return $_SESSION['usuario']['tipo'] == 'dono';
}
if (!usuarioEstaLogado()) {
    echo "<script>alert(Você não tem permissão para acessar essa página);</script>";
    echo "<script>window.location.href='../index.php';</script>";
}
if (usuarioEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);
}

if (usuarioEstaLogado()) {
    $userlog = $_SESSION['usuario']['nome'];
    if ($_SESSION['usuario']['tipo'] == 'cliente') {
        $clienteName = $_SESSION['usuario']['id_usuario'];
        $cliente = $conn->query("SELECT * FROM usuario WHERE id_usuario = '$clienteName'");
        $infcliente = $cliente->fetch_assoc();
        // 
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Mercados</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script>


        function confirmarExclusaoCliente() {
            // Exibe uma mensagem de confirmação
            if (confirm("Tem certeza que deseja excluir seu perfil?")) {
                // Se o usuário confirmar, redireciona para a página de exclusão
                window.location.href = 'CRUD/delete-cliente.php';
                return true;
            } else {
                // Se o usuário cancelar, retorna false
                return false;
            }
        }
    </script>
</head>

<body>

    <div id="area-cabecalho">

        <?php if (usuarioEstaLogado()): ?>

            <p class="aviso-login">Seja bem vindo&nbsp;<?= ucwords($userlog); ?></p>



        <?php endif ?>

        <!-- abertura postagem -->
        <div id="area-logo">
            <img src="../home/img/logo.png" alt="logo">
        </div>
        <div id="area-menu">
            <a href="../index.php">Home</a>

            <?php if (usuarioEstaLogado()): ?>
                <a href="../home/mercados.php">Mercados</a>
            <?php endif ?>

            <a href="../home/contato.php">Contato</a>
            <a href="../home/fale.php">Fale Conosco</a>





            <?php if (usuarioEstaLogado()): ?>
                <a href="verMeuCliente.php">Visualizar perfil</a>
            <?php endif ?>

            <?php if (usuarioEstaLogado()): ?>
                <a href="logout.php" onclick="return confirm('Deseja realizar logout?');">Logout</a>
            <?php endif ?>
        </div>

    </div>
    </div>
    <?php

    ?>
    <div id="area-principal">

        <div id="area-postagens">
            <!--Abertura postagem -->
            <div class="postagem">

                <h2>Seu nome: <?= ucwords($infcliente['nome']) ?></h2>
                <?php
                echo "<p>Seu email logado: " . $infcliente['email'] . "</p>";
                ?>


                <button class="btn_ud" onclick="window.location.href='editarMercado'">Editar</button>





                <form action="CRUD/delete-cliente.php" method="POST" onsubmit="return confirmarExclusaoCliente()">
                    <input type="hidden" name="deleteperfil" value="<?= $infcliente['id_usuario']; ?>">
                    <button class='btn_left' type="submit">Excluir</button>
                </form>
                <button class='btn_left' type="submit" onclick="window.location.href='../index.php'">Voltar</button>



            </div>

            <div id="rodape">
                &copy Todos os direitos reservados
            </div>

        </div>

</body>

</html>
<?php
?>