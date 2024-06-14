<?php

class itensDAO{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function inserirItens($quantidade, $id_carrinho, $id_produto){
        $query = "INSERT INTO itens (quantidade, id_carrinho, id_produto) VALUES (:quantidade,:id_carrinho,:id_produto);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':quantidade',$quantidade,PDO::PARAM_INT);
        $stmt->bindValue(':id_carrinho',$id_carrinho,PDO::PARAM_INT);
        $stmt->bindValue(':id_produto',$id_produto,PDO::PARAM_INT);
        if($stmt->execute()){
            return TRUE;
        }else{
            return "ocorreu um erro" . $stmt->errorInfo(); 
        }
    }

    public function getAllItensCarrinhoByIdCliente($id_cliente){
        $query = "SELECT itens.* , carrinho.* FROM itens JOIN carrinho ON itens.id_carrinho = carrinho.id_carrinho WHERE carrinho.id_cliente = :id_cliente";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_cliente',$id_cliente,PDO::PARAM_INT);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return "ocorreu um erro" . $stmt->errorInfo(); 
        }
    }

    public function getAllItensByIdCarrinho($id_carrinho){
        $query = "SELECT * FROM itens WHERE id_carrinho = :id_carrinho;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_carrinho',$id_carrinho,PDO::PARAM_INT);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }
    public function deleteAllItensByIdCarrinho($carrinhos)
    {
        $query = "DELETE FROM itens WHERE id_carrinho = :id_carrinho;";
        $stmt = $this->conn->prepare($query);
        foreach ($carrinhos as $carrinho) {
            $stmt->bindValue(':id_carrinho',$carrinho['id_carrinho'], PDO::PARAM_INT);
            if (!$stmt->execute()) {
                return "ocorreu um erro" . $stmt->errorInfo();
            }
        }

        return TRUE;
    }    
}