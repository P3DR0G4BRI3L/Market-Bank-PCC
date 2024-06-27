<?php
require_once '../model/filtroProdutoDAO.php';

$filtroProdutoDAO = new filtroProdutoDAO($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deletefiltro'])) {
    $id_filtro = $_POST['deletefiltro'];
    if ($filtroProdutoDAO->deleteFiltro($id_filtro)) {
        echo "<script>
                    alert('Filtro excluído com sucesso');
                    window.location.href='../CRUD/read-filtro.php';
                    </script>";
        exit;
    }
}
