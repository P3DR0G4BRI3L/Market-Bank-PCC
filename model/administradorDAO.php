<?php
class administradorDAO
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAdministradorById($id_usuario)
    {

        try {
            $query = "SELECT * FROM administrador WHERE id_usuario = :id_usuario";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return "ocorreu um erro {$stmt->errorInfo()} ";
            }
        } catch (PDOException $erro) {
            return "ocorreu um erro" . $erro->getMessage() . "<br>arquivo:" . $erro->getFile();
        }
    }

    public function inserirAdministrador($id_usuario){
        $query = "INSERT INTO administrador(id_usuario) VALUES (:id_admin)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_admin',$id_usuario,PDO::PARAM_INT);
        if($stmt->execute()){
            return TRUE;
        }else{
            return $stmt->errorInfo();
        }

    }

}
