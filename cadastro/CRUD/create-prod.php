
<?php
session_start();
 require_once '../../func/func.php';
 require_once '../cadastro.php';
 // o cabeçalho é mostrado em cima normal, porem, se a pessoa não estiver logada é criado uma div postagem e mostra pro usuário que ele não pode acessar essa pagina 
 if (!usuarioEstaLogado()) {
     




//verifica se tem algum usuário logado retorna true ou false








//armazena as informações do mercado em $infmercado

?>
<!DOCTYPE html>
<html>

<head>
    <title>Mercados</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <script src="script/script.js"></script>

</head>

<body>

    <div id="area-cabecalho">
        <?php if (usuarioEstaLogado()): ?>

            <p class="aviso-login">Seja bem vindo&nbsp;<?= $userlog; ?></p>

            <?php if (mercadoEstaLogado()): ?>

                <p class="aviso-login">Você está logado no mercado:&nbsp;<?= $infmercado['nomeMerc']; ?></p>

            <?php endif ?>
        <?php endif ?>
        <!-- abertura postagem -->
        <div id="area-logo">
            <img src="../../home/img/logo.png" alt="logo">
        </div>
        <div id="area-menu">
            <a href="../index.php">Home</a>

            <?php if (usuarioEstaLogado()): ?>
                <a href="mercados.php">Mercados</a>
            <?php endif ?>

            <a href="contato.php">Contato</a>
            <a href="fale.php">Fale Conosco</a>

            <div class="cadastro_login_right">
                <?php if (!usuarioEstaLogado()): ?>
                    <a href="../cadastro/cadastrar.php">Cadastrar</a>
                    <a href="../cadastro/login.php">Login</a>
                <?php endif ?>





                <?php if (mercadoEstaLogado()): ?>
                    <a href="../cadastro/verMeuMercado.php">Visualizar perfil</a>
                <?php endif ?>

                <?php if (usuarioEstaLogado()): ?>
                    <a href="../logout.php" onclick="return confirm('Deseja realizar logout?');">Logout</a>
                <?php endif ?>
            </div>

        </div>
    </div>



    <div id="area-principal">

        <div id="area-postagens"></div>









     <div class="postagem">
         <link rel="stylesheet" href="../../css/cadastro.css">
         <h2>Você não tem permissão para acessar essa página</h2>
         <h2>Realize o cadastro</h2>

         <div class="login-box"><button class='btn_left' onclick="window.location.href='../../index.php' ">Voltar</button></div>

      </div>
     <div id="rodape">
         &copy Todos os direitos reservados
     </div>
     </div>
     </div>
     <?php
     exit;
 }

 







if ($_FILES['imgprod']['error'] === UPLOAD_ERR_OK) {
    // Diretório onde você deseja armazenar as imagens
    $diretorioDestino = 'C:\xampp\htdocs\Market-Bank\cadastro\uploads\\';

    // Nome do arquivo original
    $imagem = $_FILES['imgprod']['name'];

    // Caminho completo para onde o arquivo será movido
    $caminhoDestino = $diretorioDestino . $imagem;

    // Move o arquivo enviado para o diretório de destino
    if (move_uploaded_file($_FILES['imgprod']['tmp_name'], $caminhoDestino)) {
        
    } else {
        echo "Erro ao mover o arquivo para o diretório de destino.";
    }
} else {
    echo "Erro no envio do arquivo: " . $_FILES['imgprod']['error'];
}

// i
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

$nome = $_POST['nomeprod'];
$preco = $_POST['preco'];
$fotoProduto = $_FILES['imgprod']['name'];
$id_mercado = $infmercado['id_mercado'];

$sqlprod = "INSERT INTO produto (nome, preco, fotoProduto, id_mercado) VALUES (:nome, :preco, :fotoProduto, :id_mercado);";

$stmt = $conn->prepare($sqlprod);
$stmt->bindValue(':nome',$nome,PDO::PARAM_STR);
$stmt->bindValue(':preco',$preco,PDO::PARAM_INT);
$stmt->bindValue(':fotoProduto',$fotoProduto,PDO::PARAM_STR);
$stmt->bindValue(':id_mercado',$id_mercado,PDO::PARAM_INT);
$stmt->execute();

if($stmt){

echo "<script>
    alert('Produto cadastrado com sucesso');
    window.location.href='read-prod.php';
</script>";
}else{
    echo "Erro de conexão". $stmt->errorInfo();
}
$conn = null;