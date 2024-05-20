<?php
require_once 'cadastro.php';
require_once '../func/func.php';

session_start();




if (!usuarioEstaLogado()) {
    echo "<script>alert('Você não tem permissão para acessar essa página');</script>";
    echo "<script>window.location.href='../index.php';</script>";
}


if (usuarioEstaLogado()) { //USUARIO
    $userlog = $_SESSION['usuario']['nome'];
    if ($_SESSION['usuario']['tipo'] == 'cliente') {
        $id_usuario = $_SESSION['usuario']['id_usuario'];
        $usuario = $conn->prepare("SELECT * FROM usuario WHERE id_usuario = :id_usuario");
        $usuario->bindValue(':id_usuario',$id_usuario,PDO::PARAM_INT);
        $usuario->execute();
        $infusuario = $usuario->fetch();
        //armazena todas as informações do usuario logado na variavel $infusuario 
    }
}

if (usuarioEstaLogado()) { //  CLIENTE
    $userlog = $_SESSION['usuario']['nome'];
    if ($_SESSION['usuario']['tipo'] == 'cliente') {
        $id_cliente = $_SESSION['usuario']['id_usuario'];
        $cliente = $conn->prepare("SELECT * FROM cliente WHERE id_usuario = :id_cliente");
        $cliente->bindValue(':id_cliente',$id_cliente,PDO::PARAM_INT);
        $infcliente = $cliente->fetch();
        // armazena todas as informações do cliente logado na variavel $infusuario 
    
    }
}

require_once '../inc/cabecalho.php' ;
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
                <form action="../CRUD/update-cliente.php" method="POST" >
                    <input type="hidden" name="updateperfil" value="<?= $infusuario['id_usuario']; ?>">
                    <button class='btn_left' type="submit">Editar</button>
                </form>



                    <!-- redireciona  o usuario para para deletar o perfil -->
                    <form action="CRUD/delete-cliente.php" method="POST" onsubmit="return confirmarExclusaoCliente()">

                        <input type="hidden" name="deleteperfil" value="<?= $infusuario['id_usuario']; ?>"> <!-- input envia o id do usuario pra exclusão via post ocultamente -->

                        <input type="hidden" name="deletecliente" value="<?= $infcliente['id_usuario']; ?>"> <!-- input envia o id do cliente pra exclusão via post ocultamente -->

                        <button class='btn_left' type="submit">Excluir</button>
                    </form>
                    <button class='btn_left' type="submit" onclick="window.location.href='../index.php'">Voltar</button>



            </div>

            <?php require_once '../inc/rodape.php'; ?>