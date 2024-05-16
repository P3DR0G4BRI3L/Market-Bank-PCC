<?php 
session_start();
require_once '../cadastro.php';
require_once '../../func/func.php';

if (usuarioEstaLogado() && $_SESSION['usuario']['tipo'] == 'dono') {

    //armazena todas as informações do mercado logado em $infmercado
    $mercName = $_SESSION['usuario']['id_usuario'];
    $mercado = $conn->prepare("SELECT * FROM mercado WHERE id_dono = :mercName");
    $mercado_>bindValue(':mercName',$mercName,PDO::PARAM_INT);

    $infmercado = $mercado->fetch();


}
$id_produto = $_POST['updateprod'];
$id_mercado = $infmercado['id_mercado'];

$updateprod = $conn->query("UPDATE produto SET nome = null , ';");

if($updateprod){
echo "<script>
    alert('Produto alterado com sucesso');
    window.location.href='read-prod.php';
</script>";
}else{
    echo "<script>
    alert('ocorreu um erro');
    window.location.href='read-prod.php';
</script>";
    
}
echo"<pre>";
// var_dump($_SESSION['usuario']);
// var_dump($infmercado);
//separação cima update, baixo inputs/formulario
?>
<?php
require_once '../cadastro.php';

session_start();

//verifica se tem algum usuário logado retorna true ou false






if (usuarioEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);
    $id_produto = $_POST['updateprod'];
    if ($_SESSION['usuario']['tipo'] == 'dono') {
        $id_produto = $_POST['updateprod'];
        
        $mercado = $conn->prepare("SELECT * FROM produto WHERE id_produto = :id_produto");
        $mercado->bindValue(':id_produto',$id_produto,PDO::PARAM_INT);
        $infproduto = $mercado->fetch();

    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Mercados</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <script>


function confirmarExclusaoMercado() {
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

            <p class="aviso-login">Seja bem vindo&nbsp;<?= $userlog; ?></p>

            <?php if (mercadoEstaLogado()): ?>

                <p class="aviso-login">Você está logado no mercado:&nbsp;<?= ucwords($infmercado['nomeMerc']); ?></p>

            <?php endif ?>
        <?php endif ?>
        <!-- abertura postagem -->
        <div id="area-logo">
            <img src="../../home/img/logo.png" alt="logo">
        </div>
        <div id="area-menu">
            <a href="../index.php">Home</a>

            <?php if (usuarioEstaLogado()): ?>
                <a href="../../home/mercados.php">Mercados</a>
            <?php endif ?>

            <a href="../../home/contato.php">Contato</a>
            <a href="../../home/fale.php">Fale Conosco</a>

            <div class="cadastro_login_right">
                <?php if (!usuarioEstaLogado()): ?>
                    <a href="../cadastro/cadastrar.php">Cadastrar</a>
                    <a href="../cadastro/login.php">Login</a>
                <?php endif ?>





                <?php if (mercadoEstaLogado()): ?>
                    <a href="../verMeuMercado.php">Visualizar perfil</a>
                <?php endif ?>

                <?php if (usuarioEstaLogado()): ?>
                    <a href="../logout.php" onclick="return confirm('Deseja realizar logout?');">Logout</a>
                <?php endif ?>
            </div>

        </div>
    </div>



    <div id="area-principal">

        <div id="area-postagens">


            <?php
            // o cabeçalho é mostrado em cima normal, porem, se a pessoa não estiver logada é criado uma div postagem e mostra pro usuário que ele não pode acessar essa pagina 
            if (!usuarioEstaLogado()) {
                ?>
                <div class="postagem">
                    <link rel="stylesheet" href="../../css/cadastro.css">
                    <h2>Você não tem permissão para acessar essa página</h2>
                    <h2>Realize o cadastro</h2>

                    <div class="login-box"><button class='btn_left'
                            onclick="window.location.href='../../index.php' ">Voltar</button></div>

                </div>
                <div id="rodape">
                    &copy Todos os direitos reservados
                </div>
                <?php
                exit;
            }

            ?>


            <?php
            if(mercadoEstaLogado()){
            $id_mercado = $infmercado['id_mercado'];
            $result = $conn->query("SELECT * FROM produto WHERE id_mercado = '$id_mercado' ;");
            }
            ?>

            <!--Abertura postagem -->
            <div class="postagem">

                <div class="login-box">
                    <?php if (mercadoEstaLogado()): ?>
                        <button class='btn_left' onclick="window.location.href='../verMeuMercado.php' ">Voltar</button>
                        <button class='btn_left' onclick="window.location.href='../addprod.php' ">Adicionar produto</button>
                    <?php endif ?>

                    <?php if (clienteEstaLogado()): ?>
                        <button class='btn_left' onclick="window.location.href='../../home/mercados.php' ">Voltar</button>
                    <?php endif ?>

                </div>
            </div>
            <!--lista os produtos, cada vez que o metodo fetch_all() é chamado ele armazena uma linha em $row e mostra dentro do laço while  -->
            <?php 
            if(mercadoEstaLogado()){
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch()) { ?>
                    <div class="postagem">

                        <?php
                        echo "<h2> " . $row['nome'] . " </h2>"; //nome do produto
                
                        echo '<img src="../uploads/' . $row['fotoProduto'] . '" alt="Imagem do mercado" width="620px">';


                        echo "<p>" . $row['preco'] . " reais</p>" //preço do produto
               
                            ?>
                        <div class="login-box">
 
                            <form action="update-prod.php" method="POST">
                                <button class='btn_left' type="submit">Editar</button>
                            </form>

                            <form action="delete-prod.php" method="POST" onsubmit="return confirmarExclusaoMercado()">
                    <input type="hidden" name="deleteprod" value="<?= $row['id_produto']; ?>">
                    <button class='btn_left' type="submit">Excluir</button>
                </form>
                        </div>


                    </div>
                <?php }
            } else {
                echo "<div class='postagem'>
                    <h2>Ainda não foram inseridos produtos</h2>
                </div>";
            }} 
            if(clienteEstaLogado()){
                $id_mercado = $_POST['id_mercado'];
               $result= $conn->query("SELECT * FROM produto WHERE id_mercado = '$id_mercado' ");
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch()) { ?>
                    <div class="postagem">

                        <?php
                        echo "<h2> " . $row['nome'] . " </h2>"; //nome do produto
                
                        echo '<img src="../uploads/' . $row['fotoProduto'] . '" alt="Imagem do mercado" width="620px">';


                        echo "<h2>" .number_format($row['preco'], 2, ',', '.')  . " R$ </h2>" //preço do produto
                
                            ?>
                        <div class="login-box">
                        <button class='btn_left' onclick="window.location.href='../../home/mercados.php' ">Voltar</button>
                        </div>


                    </div>
                <?php }
            } else {
                echo "<div class='postagem'>
                    <h2>Ainda não foram inseridos produtos</h2>
                </div>";

            }} ?>
            <hr>
            <!--// Fechamento postagem -->


            <div id="rodape">
                &copy Todos os direitos reservados
            </div>

        </div>

</body>

</html>
<?php
?>