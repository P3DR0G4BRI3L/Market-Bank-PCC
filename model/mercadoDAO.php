<?php
class mercadoDAO{

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function inserirMercado($nomeMerc, $regiaoadm, $endereco, $horarioAbert, $horarioFecha, $telefone, $cnpj, $imagem, $descricao, $compras, $id_dono
    ){

        $query = "INSERT INTO mercado ( nomeMerc, regiaoadm, endereco, horarioAbert, horarioFecha, telefone, cnpj, imagem, descricao, compras, id_dono)
        VALUES
                            ( :nomeMerc, :regiaoadm, :endereco, :horarioAbert, :horarioFecha, :telefone, :cnpj, :imagem, :descricao , :compras, :id_dono );";

    $stmt = $this->conn->prepare($query);// salva/prepara a consulta sql para ser executada
    $stmt->bindValue(':nomeMerc',$nomeMerc,PDO::PARAM_STR);//substitui os parametros pelo valor inserido em bindValue
    $stmt->bindValue(':regiaoadm',$regiaoadm,PDO::PARAM_STR);
    $stmt->bindValue(':endereco',$endereco,PDO::PARAM_STR);
    $stmt->bindValue(':horarioAbert',$horarioAbert);
    $stmt->bindValue(':horarioFecha',$horarioFecha);
    $stmt->bindValue(':telefone',$telefone);
    $stmt->bindValue(':cnpj',$cnpj,PDO::PARAM_STR);
    $stmt->bindValue(':imagem',$imagem,PDO::PARAM_STR);
    $stmt->bindValue(':descricao',$descricao,PDO::PARAM_STR);
    $stmt->bindValue(':compras',$compras,PDO::PARAM_STR);
    $stmt->bindValue(':id_dono',$id_dono,PDO::PARAM_INT);//id_dono referencia id_usuario na tabela usuario
    if($stmt->execute()){
        return TRUE;
    }else{
        echo "Erro ao cadastrar" . $stmt->errorInfo();
    }






    }












    public function getMercadoByIdUsuario($id_dono)
    {
        $query = "SELECT * FROM mercado WHERE id_dono = :id_dono";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_dono',$id_dono,PDO::PARAM_INT);
        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }



}