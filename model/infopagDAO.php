<?php

class infopagDAO{
    private $conn;

    public function __construct($conn){
        $this->conn=$conn;
    }
    public function inserirInfoPag($id_mercado, $tipo, $chavepix){
        $query = "INSERT INTO infopag(id_mercado,tipo,pix)VALUES(:id_mercado,:tipo,:chavepix)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado',$id_mercado,PDO::PARAM_INT);
        $stmt->bindValue(':chavepix',$chavepix,PDO::PARAM_STR);
        $stmt->bindValue(':tipo',$tipo,PDO::PARAM_STR);
        if($stmt->execute()){
            return TRUE;
        }else{
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }

    public function atualizarInfoPag($id_mercado,$tipo,$chavepix){
        $query = "UPDATE infopag SET tipo = :tipo , pix = :chavepix) WHERE id_mercado = :id_mercado";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado',$id_mercado,PDO::PARAM_INT);
        $stmt->bindValue(':chavepix',$chavepix,PDO::PARAM_STR);
        $stmt->bindValue(':tipo',$tipo,PDO::PARAM_STR);
        if($stmt->execute()){
            return TRUE;
        }else{
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }

    public function getInfopagByIdMercado($id_mercado){
        $query = "SELECT * FROM infopag WHERE id_mercado = :id_mercado;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado',$id_mercado,PDO::PARAM_INT);
        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }
    public function deleteInfoPagById($id_mercado){
        $query = "DELETE FROM infopag WHERE id_mercado = :id_mercado;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado',$id_mercado,PDO::PARAM_INT);
        if($stmt->execute()){
            return TRUE;
        }else{
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }

}