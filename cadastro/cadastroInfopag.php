<?php
    require_once '../model/usuarioDAO.php';
    require_once '../model/infopagDAO.php';
    require_once '../model/mercadoDAO.php';
    require_once '../cadastro/cadastro.php';
    require_once '../inc/cabecalhocadastro.php';
    $infopagDAO = new infopagDAO($conn);
    $mercadoDAO = new mercadoDAO($conn);
    $usuarioDAO = new usuarioDAO($conn);
    $id = $_GET['id'];
    $mercado = $mercadoDAO->getMercadoByIdUsuario($id);
    $email = $usuarioDAO->getUsuarioByDono($mercado['id_dono']);
    if(isset($_POST['infopag'])){
        switch ($_POST['infopag']) {
            case 'telefone':$chavepix = $mercado['telefone'];break;
                
            case 'email':$chavepix = $email['email'];break;
                
            case 'cnpj':$chavepix = $mercado['cnpj'];break;
                
            }
        

                if ($infopagDAO->inserirInfoPag($mercado['id_mercado'], $_POST['infopag'], $chavepix)){
                    echo "<script>alert('Cadastro concluído com sucesso');window.location.href='login.php'</script>";
                    
                    exit;
                }
            }
?>
    <div id="area-principal">
            <div class="postagem infopag">
                <h2>No momento só estamos trabalhando com pix</h2>
                <div class="login-box">
                    <h3>Escolha a forma de receber pagamento </h3>
                    <div class="input-group">

                        <form action="" method="POST">
                            <select name="infopag" id="infopag">
                                <option value="telefone">Telefone</option>
                                <option value="email">Email</option>
                                <option value="cnpj">CNPJ</option>
                            </select>
                            <button class="button_padrao btn_edit">Confirmar</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    <?php 