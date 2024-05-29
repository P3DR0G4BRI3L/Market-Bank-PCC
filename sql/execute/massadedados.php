<?php
require_once '../../cadastro/cadastro.php';
require_once '../model/clienteDAO.php';
require_once '../model/usuarioDAO.php';
require_once '../model/produtoDAO.php';
require_once '../model/mercadoDAO.php';

$usuarioDAO = new usuarioDAO($conn);
$clienteDAO = new clienteDAO($conn);
$mercadoDAO = new mercadoDAO($conn);

$usuarioDAO->inserirUsuario('usuario exemplo','usuarioexemplo@gmail.com','123','cliente');//insere o usuario cliente na tabela usuario

$clienteDAO->inserirCliente($usuarioDAO->getIdUsuarioByEmail('usuarioexemplo@gmail.com'));//insere o usuario cliente na tabela cliente

$usuarioDAO->inserirUsuario('mercado exemplo','mercadoexemplo@gmail.com','123','dono');//insere o usuario dono na tabela usuário

$id_dono = $usuarioDAO->getIdUsuarioByEmail('mercadoexemplo@gmail.com');
$imagem = 'mercado_central_valencia_espana_2014-06-30_dd_115.jpg';
$caminho = 'C:\xampp\htdocs\Market-Bank\cadastro\uploads\\' ;
copy($imagem , $caminho . $imagem);
$mercadoDAO->inserirMercado('exemplo mercado','Ceilandia Sul','QNH 13 Conjunto 3 Lote 10','07:00:00','23:30:00','61990062014','12345678912345',$imagem,'Esta é a descrição do mercado de exemplo','sim',$id_dono);





