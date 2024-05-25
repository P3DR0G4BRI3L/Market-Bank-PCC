<?php
require_once 'cadastro.php';
require_once '../func/func.php';
require_once '../model/usuarioDAO.php';
require_once '../model/clienteDAO.php';

session_start();




if (!clienteEstaLogado()) {
    echo "<script>alert('Você não tem permissão para acessar essa página');</script>";
    echo "<script>window.location.href='../index.php';</script>";
}


if (clienteEstaLogado()) { //USUARIO
    $userlog = $_SESSION['usuario']['nome'];

    $id_usuario = $_SESSION['usuario']['id_usuario'];
    $usuarioDAO = new usuarioDAO($conn);//cria um objeto cliente 
    $usuarioDAO->getUsuarioById($id_usuario);
    $infusuario = $usuarioDAO->getUsuarioById($id_usuario);//retorna um array associativo com o nome das colunas
    //armazena todas as informações do usuario logado na variavel $infusuario 


    $id_cliente = $_SESSION['usuario']['id_usuario'];
    $clienteDAO = new clienteDAO($conn);
    $infcliente = $clienteDAO->getClienteById($id_cliente);
    // armazena todas as informações do cliente logado na variavel $infcliente 


}

require_once '../inc/cabecalho.php';
?>

<div id="area-principal">

    <div id="area-postagens">
        <!--Abertura postagem -->
        <div class="postagem">

            <h2>Seu nome: <?= ucwords($infusuario['nome']) ?></h2>
            <?php
            echo "<p>Seu email logado: " . $infusuario['email'] . "</p>";
            ?>

            <!-- redireciona  o usuario para para editar o perfil -->
            <form action="../CRUD/update-cliente.php" method="POST">
                <input type="hidden" name="updateperfil" value="<?= $infusuario['id_usuario']; ?>">
                <button class='btn_left' type="submit">Editar</button>
            </form>



            <!-- redireciona  o usuario para para deletar o perfil -->
            <form action="../CRUD/delete-cliente.php" method="POST" onsubmit="return confirmarExclusaoCliente()">

                <input type="hidden" name="deleteperfil" value="<?= $infusuario['id_usuario']; ?>">
                <!-- input envia o id do usuario pra exclusão via post ocultamente -->

                <input type="hidden" name="deletecliente" value="<?= $infcliente['id_usuario']; ?>">
                <!-- input envia o id do cliente pra exclusão via post ocultamente -->

                <button class='btn_left' type="submit">Excluir</button>
            </form>
            <button class='btn_left' type="submit" onclick="window.location.href='../index.php'">Voltar</button>



        </div>

        <?php require_once '../inc/rodape.php'; ?>