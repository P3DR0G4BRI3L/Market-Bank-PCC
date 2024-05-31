<?php
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';
require_once '../model/mercadoDAO.php';
require_once '../model/panfletoDAO.php';

session_start();


if(!mercadoEstaLogado()){
    header('location:../index.php');
    exit;
}
if(isset($_FILES['foto'],$_POST['validade'],$_POST['descricao'])){

    $foto=$_FILES['foto'];
    $validade=$_POST['validade'];
    $descricao=$_POST['descricao'];
    $id_mercado = $_SESSION['usuario']['mercado']['id_mercado'];

    $panfletoDAO = new panfletoDAO($conn);
    if($panfletoDAO->inserirPanfleto($foto,$validade,$descricao,$id_mercado)){
        echo "<script>
            alert('Produto postado com sucesso');
            window.location.href = '../cadastro/verMeumercado.php';
        </script>";
    }

}






 require_once '../inc/cabecalho.php'; 
?>

    <?php
   
    ?>
    <div id="area-principal">

        <div id="area-postagens">
            <!--Abertura postagem -->
            <div class="postagem">

                <h2>Postar panfleto no mercado:&nbsp;<?= $_SESSION['usuario']['mercado']['nomeMerc'] ?></h2>
               

                <div class="container">
					<div class="login-box">
						<form action="" method="POST" enctype="multipart/form-data">
							
							
							<div class="input-group">
								<label for="foto">Foto do panfleto:</label>
								<input type="file" id="foto" name="foto" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
							</div>
							
							<div class="input-group">
								<label for="validade">Validade:</label>
								<input type="date" id="validade" name="validade" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
							</div>

							<div class="input-group">
								<label for="descricao">Descrição: <h6>*opcional</h6></label>
								<input type="text" id="descricao" name="descricao" onkeydown="if(event.keyCode === 13) event.preventDefault()">
							</div>

							<button type="submit" class="button_padrao btn_edit">Adicionar</button>
						</form>
					</div>
				</div>
            </div>
            <!--// Fechamento postagem -->

            <!--Abertura postagem -->
           
            
            <?php require_once '../inc/rodape.php'; ?>