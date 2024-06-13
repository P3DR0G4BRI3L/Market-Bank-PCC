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
<div id="area-principal">

    <!--Aberturac -->
    <div class="postagem home" >
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
                    <th>Imagem</th>
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
                    <th><img src="../cadastro/uploads/<?= $mercadoDono['imagem']; ?>" class="imagem" alt="foto mercadoDono"></th>

                    <th>

                    <a href="delclienteadm.php?id_usuario=<?= $mercadoDono['id_dono'] ?>">Excluir</a>
                    
                    </th>
                    <th>
                        
                        <a href="editclienteadm.php?id_usuario=<?= $mercadoDono['id_dono'] ?>">Editar</a>

                        
                    </th>
                </tr>



            <?php endforeach ?>
        </table>
        <button class="btn_left" onclick="window.history.back()">Voltar</button>


    <!--// Fechamento postagem -->
</div>
</div>





<?php require_once '../inc/rodape.php'; ?>