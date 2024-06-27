<?php
    session_start();
require_once '../model/usuarioDAO.php';

require_once '../model/clienteDAO.php';

require_once '../model/carrinhoDAO.php';

require_once '../model/itensDAO.php';

require_once '../cadastro/cadastro.php';

    $carrinhoDAO = new carrinhoDAO($conn);

    $itensDAO = new itensDAO($conn);

    $usuarioDAO = new usuarioDAO($conn);

    $clienteDAO = new clienteDAO($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteperfil'])) {
                if ($itensDAO->deleteAllItensByidCarrinho($carrinhoDAO->getAllCarrinhoByIdCliente($_SESSION['usuario']['id_cliente'])) &&

                    $carrinhoDAO->deleteAllCarrinhoByIdCliente($_SESSION['usuario']['id_cliente']) &&

                        $clienteDAO->deleteClienteById($_SESSION['usuario']['id_usuario']) &&

                            $usuarioDAO->excluirUsuario($_SESSION['usuario']['id_usuario'])) {

                                session_destroy();
                                echo "<script>
                                alert('Perfil excluído com sucesso');
                                window.location.href='../index.php';
                                </script>";
                                exit;
                            }
                            }
                      




