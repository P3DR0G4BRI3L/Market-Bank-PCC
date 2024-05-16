<?php
require_once 'cadastro.php';
require_once '../func/func.php';


session_start();


if(!usuarioEstaLogado()){
    header('location:../index.php');
    exit;
}

if (!usuarioEstaLogado()) {
    echo "<script>alert(Você não tem permissão para acessar essa página);</script>";
    echo "<script>window.location.href='../index.php';</script>";
}

if (usuarioEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);

    if ($_SESSION['usuario']['tipo'] == 'dono') {
        $mercName = $_SESSION['usuario']['id_usuario'];
        $mercado=$conn->prepare("SELECT * FROM mercado WHERE id_dono = :id_dono");
        $mercado->bindValue(':id_dono',$mercName,PDO::PARAM_STR);
        $mercado->execute();
        $infmercado = $mercado->fetch();

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
        if (confirm("Tem certeza que deseja excluir seu perfil como mercado?\n Todos os seus produtos serão excluídos")) {
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
                        <button class='btn_left' type="submit" onclick="window.location.href='../index.php'">Voltar</button>
                
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