<?php
class clienteDAO
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getClienteById($id_usuario)
    {
        $query = "SELECT * FROM cliente WHERE id_usuario = :id_usuario ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return "ocorreu um erro " . $stmt->errorInfo();
        }
    }
    public function inserirCliente($id_usuario)
    {
        $query = "INSERT INTO cliente(id_usuario) VALUES (:id_cliente)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_cliente', $id_usuario, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return TRUE;
        } else {
            return "ocorreu um erro " . $stmt->errorInfo();
        }
    }

    public function deleteClienteById($id_usuario){
        $query = "DELETE  FROM cliente WHERE  id_usuario = :id_usuario ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        if($stmt->execute()){
            return TRUE;
        }else{
            return "ocorreu um erro " . $stmt->errorInfo();
        }
    }
}
