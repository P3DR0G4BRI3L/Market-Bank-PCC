<?php

require_once '../../cadastro/cadastro.php';
require_once '../../model/usuarioDAO.php';
require_once '../../model/mercadoDAO.php';
require_once '../../model/clienteDAO.php';
require_once '../../model/mercadoDAO.php';
require_once '../../model/produtoDAO.php';
require_once '../../model/panfletoDAO.php';
require_once 'C:\xampp\htdocs\Market-Bank\model\administradorDAO.php';


$administradorDAO = new administradorDAO($conn);
$panfletoDAO = new panfletoDAO($conn);

$usuarioDAO = new usuarioDAO($conn);
$clienteDAO = new clienteDAO($conn);
$mercadoDAO = new mercadoDAO($conn);
$produtoDAO = new produtoDAO($conn);


if ($usuarioDAO->inserirUsuario('Administrador', 'admin@gmail.com', md5('123'), 'administrador')) { //se  a inserção do usuário do tipo administrador for bem sucedida

    $administradorDAO->inserirAdministrador($usuarioDAO->getIdUsuarioByEmail('admin@gmail.com')); //adiciona o usuario do tipo administrador na tabela administrador
}

if ($usuarioDAO->inserirUsuario('usuario cliente', 'usuario@gmail.com', md5('123'), 'cliente')) { //se  a inserção do usuário do tipo cliente for bem sucedida

    $clienteDAO->inserirCliente($usuarioDAO->getIdUsuarioByEmail('usuario@gmail.com')); //adiciona o usuario do tipo cliente na tabela cliente
}


if ($usuarioDAO->inserirUsuario('mercado ', 'mercado@gmail.com', md5('123'), 'dono')) { //se  a inserção do usuário do tipo dono/mercado for bem sucedida

    $id_dono = $usuarioDAO->getIdUsuarioByEmail('mercado@gmail.com'); //armazena o id do dono para o mercado referenciar a tabela usuario

    $imagem = 'mercado.jpg'; //imagem do mercado

    $caminho = 'C:\xampp\htdocs\Market-Bank\cadastro\uploads\\'; //lugar para onde a imagem vai ser copiada

    copy($imagem, $caminho . $imagem); //copia a imagem pra pasta uploads em cadastro/uploads

    if ($mercadoDAO->inserirMercado(
        ' mercado',
        'Ceilandia Sul',
        'QNH 13 Conjunto 3 Lote 10',
        '07:00:00',
        '23:30:00',
        '61996062014',
        '12345678912345',
        $imagem,
        'Esta é a descrição do mercado  ',
        'sim',
        $id_dono
    )) { //se a inserção desse mercado for bem sucedida um produto desse mercado vai ser criado

        $imagem = 'banana.jpg'; //imagem do produto

        copy($imagem, $caminho . $imagem);

        $id_mercado = $mercadoDAO->getMercadoByIdUsuario($id_dono); //armazena o id do mercado que vai adicionar  um produto

        if ($produtoDAO->inserirProduto('banana', 5, $imagem, 'essa descrição representa o produto banana', $id_mercado)){//se a inserção do produto for bem sucedida adiciona um panfleto

            $imagem = 'panfleto.webp';
            
            copy($imagem, $caminho . $imagem);

            if ($panfletoDAO->inserirPanfleto($imagem, '2024-06-10', 'descricao do panfleto', $id_mercado)) {//se a inserção do panfleto for bem sucedida redireciona para o index

                echo "<script>alert('Executado com sucesso!');window.location.href='../../index.php';</script> ";
            }
        }
    }
}
