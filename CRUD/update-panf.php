<?php
session_start();
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';
require_once '../model/mercadoDAO.php';
require_once '../model/panfletoDAO.php';


$id_panfleto = $_POST['id_panfleto'];
$panfletoDAO = new panfletoDAO($conn);
$panfleto = $panfletoDAO->getPanfById($id_panfleto);


if(!mercadoEstaLogado()){
    header('location:../index.php');
    exit;
}
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['validade'],$_POST['descricao'])){

    $validade=$_POST['validade'];
    $descricao=$_POST['descricao'];
    $id_mercado = $_SESSION['usuario']['mercado']['id_mercado'];

    if($panfletoDAO->atualizarPanfleto($validade,$descricao,$id_panfleto)){
        echo "<script>
            alert('Panfleto editado com sucesso');
            window.location.href = 'read-panf.php';
        </script>";
    }

}






 require_once '../inc/cabecalho.php'; 
?>

    <?php
   
    ?>
    <div id="area-principal">

            <!--Abertura postagem -->
            <div class="postagem home">

                <h2>Editar panfleto no mercado:&nbsp;<?= $_SESSION['usuario']['mercado']['nomeMerc'] ?></h2>
               

                <div class="container">
					<div class="login-box">
						<form action="" method="POST" enctype="multipart/form-data">
							
							<input type="hidden" name="id_panfleto" value="<?= $id_panfleto;?>">
							
							<div class="input-group">
								<label for="validade">Validade:</label>
								<input type="date" id="validade" name="validade" value="<?= $panfleto['validade'] ?>" onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
							</div>

							<div class="input-group">
								<label for="descricao">Descrição: <h6>*opcional</h6></label>
								<input type="text" id="descricao" name="descricao" value="<?= $panfleto['descricao'] ?>" onkeydown="if(event.keyCode === 13) event.preventDefault()">
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