<?php
session_start();
require_once '../model/filtroProdutoDAO.php';
require_once '../inc/cabecalho.php';
require_once '../cadastro/cadastro.php';
if($_SESSION['usuario']['tipo']!= 'dono'){
    header('location:../index.php');
}
var_dump($_POST['updatefiltro']);
$filtroProdutoDAO = new filtroProdutoDAO($conn);
$filtro = $filtroProdutoDAO->getFiltroById($_POST['updatefiltro']);
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['nomeFiltro'])){
    if($filtroProdutoDAO->updateFiltro($_POST['nomeFiltro'],$_POST['updatefiltro'])){
        
            echo "<script>
            alert('Categoria editada com sucesso!');
            window.location.href='read-filtro.php';
            </script>";
    
}}
?>
<div id="area-principal">

<div id="area-postagens">
    <!--Abertura postagem -->
    <div class="postagem">

        <h2>Editar categoria no mercado:&nbsp;<?= $_SESSION['usuario']['mercado']['nomeMerc'] ?></h2>
       

        <div class="container">
            <div class="login-box">
                <form action="" method="POST">
                    
                    <div class="input-group">
                        <label for="nome">Nome da categoria:</label>
                        <input type="text" name="nomeFiltro" value="<?= $filtro['nomeFiltro'] ?>" required>
                    </div>
                    

                    <button type="submit" class="button_padrao btn_edit">Salvar</button>
                </form>
            </div>
        </div>
    </div>
    <!--// Fechamento postagem -->

    <!--Abertura postagem -->
   
    
    <?php require_once '../inc/rodape.php'; ?>