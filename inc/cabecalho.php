<?php require_once '../func/func.php' ; 

?>
<!DOCTYPE html>

<html>

<head>
    <title>Market Bank</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../script/script.js"></script>

</head>

<body>
    <div id="area-cabecalho">
        <?php if (usuarioEstaLogado()): ?>

        <p class="aviso-login">Seja bem vindo&nbsp;<?= (usuarioEstaLogado()) ? ucwords($_SESSION['usuario']['nome']) : ''; ?></p>

        <?php endif ?>

        <?php if (mercadoEstaLogado()): ?>

        <p class="aviso-login">Você está logado no mercado:&nbsp;<?= ucwords($_SESSION['usuario']['mercado']['nomeMerc']); ?></p>

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

            <?php if (!usuarioEstaLogado()): ?>
                <a href="../home/mercados.php" onclick="alert('Realize o login primeiro');return false;">Mercados</a>

            <?php endif ?>

            <a href="../home/contato.php">Contato</a>

            <div class="cadastro_login_right">
                <?php if (!usuarioEstaLogado()): ?>
                <a href="../cadastro/cadastrar.php">Cadastrar</a>
                <a href="../cadastro/login.php">Login</a>
                <?php endif ?>




                <?php if (clienteEstaLogado()): ?>
                <a href="../cadastro/verMeuCliente.php">Visualizar perfil</a>
                <?php endif ?>

                <?php if (mercadoEstaLogado()): ?>
                <a href="../cadastro/verMeuMercado.php">Visualizar perfil</a>
                <?php endif ?>

                <?php if (usuarioEstaLogado()) : ?>
				<?php $aviso ='Deseja realizar logout?'?>
				<?php if (clienteEstaLogado() && !empty($_SESSION['usuario']['carrinho'])): ?>
				<?php $aviso ='Deseja realizar logout?\nTudo que está no carrinho vai ser excluído '?>
				<?php endif ?>

				<a href="../cadastro/logout.php" onclick='return confirm("<?=$aviso?>");'>Logout</a>

			<?php endif ?>

                <?php if(admEstaLogado()): ?>
                    <a href="../CRUD/administrador.php">ADM</a>
                <?php endif ?>

            </div>

        </div>
    </div>