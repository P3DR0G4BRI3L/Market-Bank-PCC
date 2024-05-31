<?php
class filtroProduto{

    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function inserirFiltro($nomeFiltro,$id_mercado){
        $query = "INSERT INTO filtroproduto(nomeFiltro , id_mercado , id_produto) VALUES(:nomeFiltro,:id_mercado);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nomeFiltro',$nomeFiltro,PDO::PARAM_STR); 
        $stmt->bindValue(':id_mercado',$id_mercado,PDO::PARAM_INT); 
        if($stmt->execute()){
            return TRUE;
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