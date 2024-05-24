<?php
require_once '../cadastro/cadastro.php';
class clienteDAO{

    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getById($id): int{
        

    }
}


?>
