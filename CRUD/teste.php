<?php 
session_start();
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';

if($_SESSION['usuario']['tipo'] != 'administrador'){
    header('location:../index.php');
}
if (usuarioEstaLogado() && $_SESSION['usuario']['tipo'] == 'administrador') {
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE tipo = :tipo ");
    $stmt->bindValue(':tipo', 'dono', PDO::PARAM_STR);

    $stmt2 = $conn->prepare("SELECT * FROM mercado");
    if ($stmt->execute() && $stmt2->execute()) {
        $alldono = $stmt->fetchAll();
        $allmercado = $stmt2->fetchAll();
    }else{
        echo"Ocorreu um erro".$stmt->errorInfo();
    }


}



require_once '../inc/cabecalhocadastro.php';
?>
<div id="area-principal">

<div id="area-postagens">
    <!--Aberturac -->
    <div class="postagem" >
        <h2>Administração Mercados</h2>
        <!-- <div class="cadastro_option">
        <div class="login-box"> -->
        <table>
            <caption>Mercados</caption>



            <thead>
                <tr>
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

            <?php foreach ($alldono as $dono): ?>
                <tr>
                    <th><?= $dono['nome']; ?></th>
                    <th><?= $dono['email']; ?></th>
                    <?php endforeach ?>
                    <?php foreach($allmercado as $mercado): ?>
                        <th><?= $mercado['nomeMerc']; ?></th>
                        <th><?= $mercado['regiaoadm']; ?></th>
                        <th><?= $mercado['endereco']; ?></th>
                        <th><?= $mercado['horarioAbert']; ?></th>
                        <th><?= $mercado['horarioFecha']; ?></th>
                        <th><?= $mercado['telefone']; ?></th>
                        <th><?= $mercado['cnpj']; ?></th>
                        <th><img src="../cadastro/uploads/<?= $mercado['imagem']; ?>" class="imagem" alt="foto mercado"></th>
                        <th><?= $mercado['descricao']; ?></th>
                        <th><?= $mercado['compras']; ?></th>
                        
                        <th>
                            <form action="delclienteadm.php" method="post"><input type="hidden" name="id_usuario" value="<?= $mercado['id_dono'] ?>"> <button
                            type="submit" id="btn_tabela" onclick="confirmarExclusaoClienteadm()">Excluir</button>
                        </form>
                    </th>
                    <th>
                        <form action="editclienteadm.php" method="post"><input type="hidden" name="id_usuario" value="<?= $mercado['id_dono'] ?>"> <button
                        type="submit" id="btn_tabela" >Editar</button>
                    </form>
                </th>
            </tr>
            
            <?php endforeach?>
            
            
        </table>
        <button class="btn_left" onclick="window.history.back()">Voltar</button>


    <!--// Fechamento postagem -->
</div>





<?php require_once '../inc/rodape.php'; ?>