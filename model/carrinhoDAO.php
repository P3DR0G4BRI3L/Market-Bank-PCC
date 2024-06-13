<?php
class carrinhoDAO{

    private $conn;
    public function __construct($conn){
        $this->conn = $conn;        
    }

    public function inserirCarrinho($id_mercado,$id_cliente,$status,$descricao){
        $query = "INSERT INTO carrinho (id_mercado  , id_cliente , status , descricao)VALUES(:id_mercado,:id_cliente,:status,:descricao);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado',$id_mercado,PDO::PARAM_INT);
        $stmt->bindValue(':id_cliente',$id_cliente,PDO::PARAM_INT);
        $stmt->bindValue(':status',$status,PDO::PARAM_STR);
        $stmt->bindValue(':descricao',$descricao,PDO::PARAM_STR);
        if($stmt->execute()){
            $array[0] = $this->conn->lastInsertId();
            $array[1] = TRUE;
            return $array;
        }else{
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }

    public function getAllCarrinhoByIdCliente($id_cliente){
        $query = "SELECT * FROM carrinho WHERE id_cliente = :id_cliente;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_cliente',$id_cliente,PDO::PARAM_INT);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }

    public function getAllCarrinhoByIdMercado($id_mercado){
        $query = "SELECT * FROM carrinho WHERE id_mercado = :id_mercado;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado',$id_mercado,PDO::PARAM_INT);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }

    public function atualizarStatusByIdCarrinho($status,$id_carrinho){
        $query = "UPDATE carrinho SET status = :status WHERE id_carrinho = :id_carrinho;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':status',$status,PDO::PARAM_STR);
        $stmt->bindValue(':id_carrinho',$id_carrinho,PDO::PARAM_INT);
        if($stmt->execute()){
            return TRUE;
        }else{
            return "ocorreu um erro" . $stmt->errorInfo();
        }


    }

}