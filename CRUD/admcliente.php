<?php
session_start();
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';

if ($_SESSION['usuario']['tipo'] != 'administrador') {
    header('location:../index.php');
}
if (usuarioEstaLogado() && $_SESSION['usuario']['tipo'] == 'administrador') {
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE tipo = :tipo ");
    $stmt->bindValue(':tipo', 'cliente', PDO::PARAM_STR);
    if ($stmt->execute()) {
        $allcliente = $stmt->fetchAll();
    }


}

require_once '../inc/cabecalhocadastro.php';
?>
<div id="area-principal">

    <div id="area-postagens">
        <!--Aberturac -->
        <div class="postagem">
            <h2>Administração clientes</h2>
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
                        
                        <a href="editclienteadm.php?id_usuario=<?= $mercadoDono['id_dono'] ?>" onclick="confirmarExclusaoClienteadm();">Editar</a>

                        
                    </th>
                </tr>



            <?php endforeach ?>
        </table>
            <button class="button_padrao"onclick="window.history.back()">Voltar</button>






            <!-- </div>
        </div> -->
        </div>
        <!--// Fechamento postagem -->

        <!--Abertura postagem -->
        <div class="postagem">
            <h2>Explore.</h2>
            <span class="data-postagem">postado 10 março 2022</span>
            <p>
                O Market Bank foi criado na intenção de informar os clientes de produtos que os mesmos desejam.
            </p>
            <a href="">Ver mais</a>
        </div>
        <!--// Fechamento postagem -->
    </div>





    <?php require_once '../inc/rodape.php'; ?>