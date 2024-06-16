<?php
session_start();
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';
require_once '../model/usuarioDAO.php';
require_once '../model/clienteDAO.php';
require_once '../model/administradorDAO.php';

if (!admEstaLogado()) {
    header('location:../index.php');
}
$usuarioDAO = new usuarioDAO($conn);
$clienteDAO = new clienteDAO($conn);
$administradorDAO = new administradorDAO($conn);
$allcliente = $administradorDAO->getAllUsuarioByTipo('cliente');

if(isset($_GET['id_usuario'])){
    $id_usuario = $_GET['id_usuario'];
    if($clienteDAO->deleteClienteById($id_usuario)){
        if($usuarioDAO->excluirUsuario($id_usuario)){
            echo "<script>
            alert('usuário excluído com sucesso');window.location.href='admcliente.php';
            </script>";
        }
    }
}


require_once '../inc/cabecalhocadastro.php';
?>
<div class="wrapper">
<div id="area-principal">

        <!--Aberturac -->
        <div class="postagem">
            <h2>Administração clientes</h2>
            <!-- <div class="cadastro_option">
            <div class="login-box"> -->
            <table class="center">
            <caption>Mercados</caption>



            <thead>
                <tr class="table_adm">
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Excluir</th>
                    <th>Editar</th>
                </tr>
            </thead>

            <?php foreach ($allcliente as $cliente): ?>
                <tr>
                    <th><?= $cliente['nome']; ?></th>
                    <th><?= $cliente['email']; ?></th>
                    <th><?= $cliente['telefone']; ?></th>

                    <th>

                    <a class="button_padrao btn_delete" href="?id_usuario=<?= $cliente['id_usuario'] ?>" onclick="confirmarExclusaoClienteadm();">Excluir</a>
                    
                    </th>

                    <th>
                        
                        <a class="button_padrao btn_edit" href="editclienteadm.php?id_cliente=<?= $cliente['id_cliente'] ?>">Editar</a>

                        
                    </th>
                </tr>



            <?php endforeach ?>
        </table>
            <button class="button_padrao" onclick="window.location.href='administrador.php'">Voltar</button>






            <!-- </div>
        </div> -->
        </div>
        </div>
        <!--// Fechamento postagem -->





    <?php require_once '../inc/rodape.php'; ?>