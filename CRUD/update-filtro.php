<?php
session_start();
require_once '../model/filtroProdutoDAO.php';
require_once '../inc/cabecalho.php';
require_once '../cadastro/cadastro.php';
if($_SESSION['usuario']['tipo']!= 'dono'){
    header('location:../index.php');
}
$filtroProdutoDAO = new filtroProdutoDAO($conn);
$id_filtro = $_POST['updatefiltro'] ?? 0;
$filtro = $filtroProdutoDAO->getFiltroById($id_filtro);
if(isset($_POST['nomeFiltro'],$_POST['id_filtro'])){
    if($filtroProdutoDAO->updateFiltro($_POST['nomeFiltro'],$_POST['id_filtro'])){
           echo "<script>
           alert('Categoria editada com sucesso!');
           window.location.href='read-filtro.php';
           </script>";
        
        }}

?>
<div class="wrapper">
<div id="area-principal">

    <!--Abertura postagem -->
    <div class="postagem home">

        <h2>Editar categoria no mercado:&nbsp;<?= $_SESSION['usuario']['mercado']['nomeMerc'] ?></h2>
       

        <div class="container">
            <div class="login-box">
                <form action="" method="POST">
                    
                    <input type="hidden" name="id_filtro" value="<?=$filtro['id_filtro']?>">

                    <div class="input-group">
                        <label for="nome">Nome da categoria:</label>
                        <input type="text" name="nomeFiltro" value="<?= $filtro['nomeFiltro'] ?>" required>
                    </div>
                    

                    <button type="submit" class="button_padrao btn_edit">Salvar</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!--// Fechamento postagem -->

    <!--Abertura postagem -->
   
    
    <?php require_once '../inc/rodape.php'; ?>