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
            return TRUE;
        }else{
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }

}