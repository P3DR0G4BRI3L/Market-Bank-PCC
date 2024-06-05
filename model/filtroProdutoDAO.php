<?php
class filtroProduto{

    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function inserirFiltro($nomeFiltro,$id_mercado,$id_produto){
        $query = "INSERT INTO filtroproduto(nomeFiltro , id_mercado) VALUES(:nomeFiltro,:id_mercado);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nomeFiltro',$nomeFiltro,PDO::PARAM_STR); 
        $stmt->bindValue(':id_mercado',$id_mercado,PDO::PARAM_INT); 
        if($stmt->execute()){
            $id_filtro = $this->conn->lastInsertId();
            $query = "UPDATE produto SET id_filtro = :id_filtro WHERE id_produto = :id_produto  ;";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id_filtro',$id_filtro,PDO::PARAM_INT);
            $stmt->bindValue(':id_produto',$id_produto,PDO::PARAM_INT);
            if($stmt->execute()){
                return TRUE;
            }
        }else{
            return "ocorreu um erro " . $stmt->errorInfo();
        }
    }

    public function getFiltroByIdMercado($id_mercado){
        $query = "SELECT * FROM filtroproduto WHERE id_mercado = :id_mercado;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado',$id_mercado,PDO::PARAM_INT);
        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }
   

}