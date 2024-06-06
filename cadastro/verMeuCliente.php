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




require_once '../inc/cabecalho.php';
?>

<div id="area-principal">

    <div id="area-postagens">
        <!--Abertura postagem -->
        <div class="postagem">

            <h2>Seu nome:
                <?= ucwords($_SESSION['usuario']['nome']) ?>
            </h2>
            <?php
            echo "<p>Seu email logado: " . $_SESSION['usuario']['email'] . "</p>";
            ?>

            <!-- redireciona  o usuario para para editar o perfil -->
            <form action="../CRUD/update-cliente.php">
                <input type="hidden" name="editperfil" value="editperfil">
                <button class='button_padrao' type="submit" >Editar Perfil</button>
            </form>

            <form action="../CRUD/update-cliente.php">
                <input type="hidden" name="alterarsenha">
                <button class='button_padrao' type="submit">Alterar Senha</button>
            </form>



            <!-- redireciona  o usuario para para deletar o perfil -->
            <form action="../CRUD/delete.php" method="POST" onsubmit="return confirmarExclusaoCliente()">
                <input type="hidden" name="deleteperfil" value="<?= $_SESSION['usuario']['id_usuario']; ?>">
                <!-- input envia o id do usuario pra exclusão via post ocultamente -->
                <button class='button_padrao btn_delete' type="submit">Excluir</button>
            </form>


            <button class='button_padrao' type="submit" onclick="window.location.href='../index.php'">Voltar</button>

        </div>
</div>
        <?php require_once '../inc/rodape.php'; ?>