<?php
require_once 'cadastro.php';

session_start();

function usuarioEstaLogado(): bool
{
    return isset($_SESSION['usuario']);
}
if(!usuarioEstaLogado()){
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
    if ($_SESSION['usuario']['tipo'] == 'dono') {
        $mercName = $_SESSION['usuario']['id_usuario'];
        $mercado = $conn->query("SELECT * FROM mercado WHERE id_dono = '$mercName'");
        $infmercado = $mercado->fetch_assoc();

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
    function confirmarExclusaoMercado() {
        // Exibe uma mensagem de confirmação
        if (confirm("Tem certeza que deseja excluir este mercado?\n Todos os seus produtos serão excluídos")) {
            // Se o usuário confirmar, redireciona para a página de exclusão
            window.location.href = 'CRUD/delete-mercado.php';
        } else {
            // Se o usuário cancelar, não faz nada
            return false;
        }
    }
</script>
</head>

<body>

    <div id="area-cabecalho">

        <?php if (usuarioEstaLogado()): ?>

            <p class="aviso-login">Seja bem vindo&nbsp;<?= $userlog; ?></p>

            <!-- só mostra se for um mercado que estiver logado, mostra o nome do mercado -->
            <?php if (mercadoEstaLogado()): ?>
                <p class="aviso-login">Você está logado no mercado:&nbsp;<?= ucwords($infmercado['nomeMerc']); ?></p>
            <?php endif ?>

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
                <a href="verMeuMercado.php">Visualizar perfil</a>
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
<?php        if ($_SESSION['usuario']['tipo']=='cliente' || !usuarioEstaLogado()) { // se  for cliente ou alguem que não te login, é barrado
                ?>
                <div class="postagem">
                    <link rel="stylesheet" href="../css/cadastro.css">
                    <h2>Você não tem permissão para acessar essa página</h2>
                    

                    <div class="login-box"><button class='btn_left' onclick="window.location.href='../index.php'; ">Voltar</button></div>

                </div>
                <div id="rodape">
                    &copy Todos os direitos reservados
                </div>
                <?php
                exit;
            }?>
            <!--Abertura postagem -->
            <div class="postagem">
<?php
            echo "<h2> " . ucwords($infmercado['nomeMerc']) . " </h2>"; //nome do mercado
                
                echo '<img src="../cadastro/uploads/' . $infmercado['imagem'] . '" alt="Imagem do mercado" width="620px">';


                echo "<h2>" . ucwords($infmercado['endereco']) . "</h2>"; //endereço do mercado

                echo "<h2>Aberto das " . date('H:i', strtotime($infmercado['horarioFecha'])) . "</h2>"; //endereço do mercado

                echo "<h2> Até as " . date('H:i', strtotime($infmercado['horarioFecha'])) . "</h2>"; //endereço do mercado
                
                $telefone=$infmercado['telefone'];
                $telefone_ =  substr($telefone, 0, 2) . ' ' . substr($telefone, 2, 1) . ' ' . substr($telefone, 3, 4) . '-' . substr($telefone, 7);
                echo "<h2> telefone para contato: " . $telefone_ . "</h2>";

                $cnpj = $infmercado['cnpj'];//formata cnpj para aparecer barra e ponto
                $cnpj_ = $cnpj_formatado = substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
                 
                echo "<h2> CNPJ: " . $cnpj_ . "</h2>";
?>
                        <button class="btn_ud" onclick="window.location.href='editarMercado'">Editar</button>
						<button class="btn_ud" onclick="confirmarExclusaoMercado();">Excluir</button>

						<button class="btn_ud" onclick="window.location.href = 'CRUD/read-prod.php'"> Ver Produtos</button>

                
            </div>
          
        <div id="rodape">
            &copy Todos os direitos reservados
        </div>

    </div>

</body>

</html>
<?php
?>