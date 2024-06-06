<?php
class filtroProdutoDAO{

    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function inserirFiltro($nomeFiltro,$id_mercado){
        $query = "INSERT INTO filtroproduto(nomeFiltro , id_mercado) VALUES(:nomeFiltro,:id_mercado);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nomeFiltro',$nomeFiltro,PDO::PARAM_STR); 
        $stmt->bindValue(':id_mercado',$id_mercado,PDO::PARAM_INT); 
        if($stmt->execute()){
           // $id_filtro = $this->conn->lastInsertId();
           // $query = "UPDATE produto SET id_filtro = :id_filtro WHERE id_produto = :id_produto  ;";
           // $stmt = $this->conn->prepare($query);
           // $stmt->bindValue(':id_filtro',$id_filtro,PDO::PARAM_INT);
           // $stmt->bindValue(':id_produto',$id_produto,PDO::PARAM_INT);
           // if($stmt->execute())//{
                return TRUE;
            //}
        }else{
            return "ocorreu um erro " . $stmt->errorInfo();
        }
    }
    public function inserirFiltroProduto($id_filtro,$id_produto){
        $query = "UPDATE produto SET id_filtro = :id_filtro WHERE id_produto = :id_produto;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_filtro',$id_filtro,PDO::PARAM_INT);
        $stmt->bindValue(':id_produto',$id_produto,PDO::PARAM_INT);
        if($stmt->execute()){
            return TRUE;
        }
    }

    public function getAllFiltroByIdMercado($id_mercado){
        $query = "SELECT * FROM filtroproduto WHERE id_mercado = :id_mercado;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado',$id_mercado,PDO::PARAM_INT);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }
    public function getFiltroById($id_filtro){
        $query = "SELECT * FROM  filtroproduto WHERE id_filtro = :id_filtro";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_filtro',$id_filtro,PDO::PARAM_INT);
        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
    public function updateFiltro($nomeFiltro,$id_filtro){
        $query =  "UPDATE filtroproduto SET nomeFiltro = :nomeFiltro  WHERE id_filtro = :id_filtro";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nomeFiltro',$nomeFiltro,PDO::PARAM_STR);
        $stmt->bindValue(':id_filtro',$id_filtro,PDO::PARAM_INT);
        if($stmt->execute()){
            return TRUE;
        }else{
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }
   

}