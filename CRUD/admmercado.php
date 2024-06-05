<?php 
session_start();
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';
require_once '../model/administradorDAO.php';

if($_SESSION['usuario']['tipo'] != 'administrador'){
    header('location:../index.php');
}
if (admEstaLogado()) {
    $administradorDAO = new administradorDAO($conn);
    $allMercadoDono = $administradorDAO->getAllUsuarioByTipo('dono');


}



require_once '../inc/cabecalhocadastro.php';
?>
<div id="area-principal2">

<div id="area-postagens">
    <!--Aberturac -->
    <div class="postagem_adm" >
        <h2  class="postagem_admtit">Administração Mercados</h2>
        <!-- <div class="cadastro_option">
        <div class="login-box"> -->
        <table>
            <caption>Mercados</caption>



            <thead>
                <tr class="table_adm">
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nome do Mercado</th>
                    <th>Região Administrativa</th>
                    <th>Endereço</th>
                    <th>Horário de abertura</th>
                    <th>Horário de fechamento</th>
                    <th>Telefone</th>
                    <th>CNPJ</th>
                    <th>Imagem</th>
                    <th>Descrição</th>
                    <th>Compras</th>
                    <th>Excluir</th>
                    <th>Editar</th>
                </tr>
            </thead>

            <?php foreach ($allMercadoDono as $mercadoDono): ?>
                <tr>
                    <th><?= $mercadoDono['nome']; ?></th>
                    <th><?= $mercadoDono['email']; ?></th>
                    <th><?= $mercadoDono['nomeMerc']; ?></th>
                    <th><?= $mercadoDono['regiaoadm']; ?></th>
                    <th><?= $mercadoDono['endereco']; ?></th>
                    <th><?= $mercadoDono['horarioAbert']; ?></th>
                    <th><?= $mercadoDono['horarioFecha']; ?></th>
                    <th><?= $mercadoDono['telefone']; ?></th>
                    <th><?= $mercadoDono['cnpj']; ?></th>
                    <th><img src="../cadastro/uploads/<?= $mercadoDono['imagem']; ?>" class="imagem" alt="foto mercadoDono"></th>
                    <th><?= $mercadoDono['descricao']; ?></th>
                    <th><?= $mercadoDono['compras']; ?></th>

                    <th>
                        <form action="delclienteadm.php" method="post"><input type="hidden" name="id_usuario" value="<?= $mercado['id_dono'] ?>"> <button
                                type="submit" id="btn_tabela" onclick="return confirmarExclusaoClienteadm()">Excluir</button>
                        </form>
                    </th>
                    <th>
                        <form action="editclienteadm.php" method="post"><input type="hidden" name="id_usuario" value="<?= $mercado['id_dono'] ?>"> <button
                                type="submit" id="btn_tabela" >Editar</button>
                        </form>
                    </th>
                </tr>



            <?php endforeach ?>
        </table>
        <button class="btn_left" onclick="window.history.back()">Voltar</button>


    <!--// Fechamento postagem -->
</div>





<?php require_once '../inc/rodape.php'; ?>