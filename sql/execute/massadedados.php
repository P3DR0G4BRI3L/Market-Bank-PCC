<?php

require_once '../../cadastro/cadastro.php';
require_once '../../model/usuarioDAO.php';
require_once '../../model/mercadoDAO.php';
require_once '../../model/clienteDAO.php';
require_once '../../model/mercadoDAO.php';
require_once '../../model/produtoDAO.php';
require_once 'C:\xampp\htdocs\Market-Bank\model\administradorDAO.php';

$administradorDAO = new administradorDAO($conn);

$usuarioDAO = new usuarioDAO($conn);
$clienteDAO = new clienteDAO($conn);
$mercadoDAO = new mercadoDAO($conn);
$produtoDAO = new produtoDAO($conn);


$usuarioDAO->inserirUsuario('Administrador','admin@gmail.com',md5('123'),'administrador');
$id_admin = $usuarioDAO->getIdUsuarioByEmail('admin@gmail.com');
$administradorDAO->inserirAdministrador($id_admin);


if($usuarioDAO->inserirUsuario('usuario exemplo','usuarioexemplo@gmail.com',md5('123'),'cliente'))
{
if($clienteDAO->inserirCliente($usuarioDAO->getIdUsuarioByEmail('usuarioexemplo@gmail.com'))){

}

}

if($usuarioDAO->inserirUsuario('mercado exemplo','mercadoexemplo@gmail.com',md5('123'),'dono'))
{
$id_dono = $usuarioDAO->getIdUsuarioByEmail('mercadoexemplo@gmail.com');
$imagem = 'mercado_central_valencia_espana_2014-06-30_dd_115.jpg';
$caminho = 'C:\xampp\htdocs\Market-Bank\cadastro\uploads\\' ;
copy($imagem , $caminho . $imagem);
if($mercadoDAO->inserirMercado('exemplo mercado','Ceilandia Sul','QNH 13 Conjunto 3 Lote 10','07:00:00','23:30:00','61990062014','12345678912345',$imagem,'Esta é a descrição do mercado de exemplo','sim',$id_dono)

){
    $imagem = 'banana.jpg';
    $caminho = 'C:\xampp\htdocs\Market-Bank\cadastro\uploads\\' ;
    copy($imagem , $caminho . $imagem);
    $id_mercado = $mercadoDAO->getMercadoByIdUsuario($id_dono);

    $produtoDAO->inserirProduto('banana',5,$imagem,'essa descrição representa o produto banana',$id_mercado);
}
echo "<script>
    alert('Executado com sucesso!');
          window.location.href='../../index.php';
</script> ";
}




