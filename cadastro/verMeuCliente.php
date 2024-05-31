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

            <h2>Seu nome: <?= ucwords($_SESSION['usuario']['nome']) ?></h2>
            <?php
            echo "<p>Seu email logado: " . $_SESSION['usuario']['email'] . "</p>";
            ?>

            <!-- redireciona  o usuario para para editar o perfil -->
                <button class='button_padrao' type="submit" onclick="window.location.href='../CRUD/update-cliente.php'">Editar</button>
            



            <!-- redireciona  o usuario para para deletar o perfil -->
            <form action="../CRUD/delete-cliente.php" method="POST" onsubmit="return confirmarExclusaoCliente()">

                <input type="hidden" name="deleteperfil" value="<?= $_SESSION['usuario']['id_usuario']; ?>">
                <!-- input envia o id do usuario pra exclusão via post ocultamente -->

                <input type="hidden" name="deletecliente" value="<?= $_SESSION['usuario']['id_usuario']; ?>">
                <!-- input envia o id do cliente pra exclusão via post ocultamente -->

                <button class='button_padrao' type="submit">Excluir</button>
            </form>
            <button class='button_padrao' type="submit" onclick="window.location.href='../index.php'">Voltar</button>



        </div>

        <?php require_once '../inc/rodape.php'; ?>