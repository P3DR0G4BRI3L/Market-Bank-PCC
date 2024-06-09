<?php
session_start();
require_once '../model/usuarioDAO.php';
require_once '../cadastro/cadastro.php';
$usuarioDAO = new usuarioDAO($conn);
$senhaAtual = $usuarioDAO->getSenhaById($_SESSION['usuario']['id_usuario']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($senhaAtual === md5($_POST['senhaantiga'])) {
        if ($_POST['senhanova'] === $_POST['confirmasenhanova']) {
            if ($usuarioDAO->alterarSenha($_SESSION['usuario']['id_usuario'], $_POST['senhanova'])) {
                echo "<script>alert('senha alterada com sucesso');</script>";
                if($_SESSION['usuario']['tipo']=='cliente'){
                echo "<script>window.location.href='../cadastro/verMeuCliente.php'</script>";
                exit;
                }elseif($_SESSION['usuario']['tipo']=='dono'){
                    echo "<script>window.location.href='../cadastro/verMeuMercado.php'</script>";
                }
            }
        } else {
            header('location:?senha2=as senhas devem ser iguais');
        }
    } else {
        header('location:?senha1=senha incorreta');
    }
}















require_once '../inc/cabecalhocadastro.php';
?>
<div id="area-principal">
    <div id="area-postagens">
        <!--Aberturac -->
        <div class="postagem">
            <h2>Alterar senha</h2>
            <div class="container">
                <div class="login-box largura_menor">
                    <form action="" method="POST">

                        <div class="input-group">
                            <?php if (isset($_GET['senha1'])) : ?>
                                <h6><?= $_GET['senha1'] ?></h6>
                            <?php endif ?>
                            <label for="senha">Senha atual:</label>
                            <input type="password" id="senha" name="senhaantiga" placeholder="Insira a senha antiga" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                            <button type="button" id="mostrarSenha" onclick="mostrarsenha()"><span class="lnr lnr-eye"></span></button>

                        </div>

                        <div class="input-group">
                            <label for="senha">Nova senha:</label>
                            <?php if (isset($_GET['senha2'])) : ?>
                                <h6><?= $_GET['senha2'] ?></h6>
                            <?php endif ?>
                            <input type="password" id="senha" name="senhanova" placeholder="Insira a nova senha" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                            <button type="button" id="mostrarSenha" onclick="mostrarsenha()"><span class="lnr lnr-eye"></span></button>

                        </div>

                        <div class="input-group">
                            <label for="senha">Confirmar nova senha:</label>

                            <input type="password" id="senha" name="confirmasenhanova" placeholder="confirme a nova senha" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                            <button type="button" id="mostrarSenha" onclick="mostrarsenha()"><span class="lnr lnr-eye"></span></button>

                        </div>



                        <?php if(clienteEstaLogado()): ?>
                <button type="button" class="button_padrao" onclick="window.location.href='../cadastro/verMeuCliente.php'">Voltar</button>
                            <?php endif ?>

                        <?php if(mercadoEstaLogado()): ?>
                <button type="button" class="button_padrao" onclick="window.location.href='../cadastro/verMeuMercado.php'">Voltar</button>
                            <?php endif ?>
                        <button class="button_padrao btn_edit" type="submit">Alterar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>