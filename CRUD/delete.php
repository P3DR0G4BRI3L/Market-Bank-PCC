<?php
session_start();
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';
require_once '../model/produtoDAO.php';
require_once '../model/mercadoDAO.php';
require_once '../model/infopagDAO.php';
require_once '../model/panfletoDAO.php';
require_once '../model/usuarioDAO.php';
require_once '../model/clienteDAO.php';
require_once '../model/filtroProdutoDAO.php';
require_once '../model/carrinhoDAO.php';
require_once '../model/itensDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carrinhoDAO = new carrinhoDAO($conn);
    $itensDAO = new itensDAO($conn);
    $usuarioDAO = new usuarioDAO($conn);
    $panfletoDAO = new panfletoDAO($conn);
    $clienteDAO = new clienteDAO($conn);
    $mercadoDAO = new mercadoDAO($conn);
    $infopagDAO = new infopagDAO($conn);
    $produtoDAO = new produtoDAO($conn);
    $filtroProdutoDAO = new filtroProdutoDAO($conn);

    switch ($_SESSION['usuario']['tipo']) {

        case 'dono':

            if (isset($_POST['deletemercado'])) { //deleta o mercado e tudo relacionado a ele

                $deletefoto = "C:\xampp\htdocs\Market-Bank\cadastro\uploads\\";
                $imagemPath = $deletefoto . $_SESSION['usuario']['mercado']['imagem'];
                if (file_exists($imagemPath)) {
                    unlink($imagemPath);
                }

                $id_mercado = $_SESSION['usuario']['mercado']['id_mercado'];
                if (
                    $mercadoDAO->deleteAllItensByIdProdutos($produtoDAO->getAllProdutoByIdMercado($id_mercado)) &&

                    $mercadoDAO->deleteAllCarrinhosByIdMercado($id_mercado) &&

                    $mercadoDAO->deleteAllProdutosByMercado($id_mercado) &&

                    $mercadoDAO->deleteAllPanfletosByMercado($id_mercado) &&

                    $mercadoDAO->deleteAllfiltroProdutoByMercado($id_mercado) &&

                    $mercadoDAO->deleteAllInfoPagByIdMercado($id_mercado)

                ) {

                    if ($mercadoDAO->deleteMercadoById($_SESSION['usuario']['id_usuario'])) {
                        if ($usuarioDAO->excluirUsuario($_SESSION['usuario']['id_usuario'])) {


                            session_destroy();
                            echo "<script>
                        alert('Mercado,produtos e panfletos excluídos com sucesso');
                        window.location.href='../index.php';
                        </script>";
                            exit;
                        }
                    }
                }
            } elseif (isset($_POST['deleteprod'], $_POST['deletefile'])) {

                $deletefoto = "../cadastro/uploads/";
                $imagemPath = $deletefoto . $_POST['deletefile'];
                if (file_exists($imagemPath)) {
                    unlink($imagemPath);
                }

                $id_produto = $_POST['deleteprod'];
                if ($produtoDAO->excluirproduto($id_produto)) {
                    echo "<script>
                    alert('Produto excluído com sucesso');
                    window.location.href='../CRUD/read-prod.php';
                    </script>";
                    exit;
                }
            } elseif (isset($_POST['deletepanf'], $_POST['deletefilepanf'])) {
                $deletefoto = "C:\xampp\htdocs\Market-Bank\cadastro\uploads\\";
                unlink($deletefoto . $_POST['deletefilepanf']);
                $id_panfleto = $_POST['deletepanf'];
                if ($panfletoDAO->deletePanfleto($id_panfleto)) {
                    echo "<script>
                    alert('Panfleto excluído com sucesso');
                    window.location.href='../CRUD/read-panf.php';
                    </script>";
                    exit;
                }
            } elseif (isset($_POST['deletefiltro'])) {
                $id_filtro = $_POST['deletefiltro'];
                if ($filtroProdutoDAO->deleteFiltro($id_filtro)) {
                    echo "<script>
                    alert('Filtro excluído com sucesso');
                    window.location.href='../CRUD/read-filtro.php';
                    </script>";
                    exit;
                }
            }
            break;

        case 'cliente':
            if (isset($_POST['deleteperfil'])) {
                if ($itensDAO->deleteAllItensByidCarrinho($carrinhoDAO->getAllCarrinhoByIdCliente($_SESSION['usuario']['id_cliente']))) {



                    if ($carrinhoDAO->deleteAllCarrinhoByIdCliente($_SESSION['usuario']['id_cliente'])) {

                        if ($clienteDAO->deleteClienteById($_SESSION['usuario']['id_usuario'])) {

                            if ($usuarioDAO->excluirUsuario($_SESSION['usuario']['id_usuario'])) {
                                session_destroy();
                                echo "<script>
                    alert('Perfil excluído com sucesso');
                    window.location.href='../index.php';
                    </script>";
                                exit;
                            }
                        }
                    }
                }
            }
            break;

        case 'administrador':
            if (isset($_POST['deletecliente'])) {
                if ($clienteDAO->deleteClienteById($_POST['deletecliente'])) {
                    if ($usuarioDAO->excluirUsuario($_POST['deletecliente'])) {
                        echo "<script>
                                alert('Cliente excluído com sucesso');
                                window.location.href='../CRUD/read-prod.php';
                                </script>";
                        exit;
                    }
                }
            } elseif (isset($_POST['deletemercado'])) {
                $deletefoto = "C:\xampp\htdocs\Market-Bank\cadastro\uploads\\";
                unlink($deletefoto . $mercadoDAO->getImagemById($_POST['deletemercado']));
                if (isset($_POST['deletemercado'])) {
                    if ($mercadoDAO->deleteAllProdutosByMercado($_SESSION['usuario']['id_usuario'])) {
                        if ($mercadoDAO->deleteAllPanfletosByMercado($_SESSION['usuario']['id_usuario'])) {
                            if ($mercadoDAO->deleteAllfiltroProdutoByMercado($_SESSION['usuario']['id_usuario'])) {
                                if ($mercadoDAO->deleteMercadoById($_SESSION['usuario']['id_usuario'])) {
                                    if ($usuarioDAO->excluirUsuario($_SESSION['usuario']['id_usuario'])) { //deleta o mercado e tudo relacionado a ele

                                        echo "<script>
                        alert('Mercado e produtos excluídos com sucesso');
                              window.location.href='../CRUD/read-prod.php';
                    </script>";
                                        exit;
                                    }
                                }
                            }
                        }
                    }
                }
            }
    }
} else {
    require_once '../inc/cabecalho.php';
    voceNaoTemPermissao();
    require_once '../inc/cabecalho.php';
}
