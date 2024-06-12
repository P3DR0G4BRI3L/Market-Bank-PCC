<?php
class panfletoDAO
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function inserirPanfleto($foto, $validade, $descricao, $id_mercado)
    {
        $img = $this->lidarImagem($foto);
        $query = "INSERT INTO panfleto(foto,validade,descricao,id_mercado)VALUES(:foto,:validade,:descricao,:id_mercado);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':foto', $img, PDO::PARAM_STR);
        $stmt->bindValue(':validade', $validade, PDO::PARAM_STR);
        $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindValue(':id_mercado', $id_mercado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return TRUE;
        } else {
            return "ocorreu um erro " . $stmt->errorInfo();
        }
    }

    public function deletePanfleto($id_panfleto)
    {
        $query = "DELETE FROM panfleto WHERE id_panfleto = :id_panfleto;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_panfleto', $id_panfleto, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return TRUE;
        } else {
            return "ocorreu um erro " . $stmt->errorInfo();
        }
    }

    public function getAllPanfletoByIdMercado($id_mercado)
    {
        $query = "SELECT * FROM panfleto WHERE id_mercado = :id_mercado;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado', $id_mercado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return "ocorreu um erro " . $stmt->errorInfo();
        }
    }

    public function atualizarPanfleto( $validade, $descricao, $id_panfleto)
    {
        $query = "UPDATE panfleto SET  validade = :validade , descricao = :descricao WHERE id_panfleto = :id_panfleto;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':validade',$validade);
        $stmt->bindValue(':descricao',$descricao,PDO::PARAM_STR);
        $stmt->bindValue(':id_panfleto',$id_panfleto,PDO::PARAM_INT);
        if($stmt->execute()){
            return TRUE;
        }else{
        return "ocorreu um erro " . $stmt->errorInfo();

        }
    }
    public function lidarImagem($filesimagem)
    {
        if (
            is_array($filesimagem) && isset($filesimagem['name']) && isset($filesimagem['type'])
            && isset($filesimagem['tmp_name']) && isset($filesimagem['error']) && isset($filesimagem['size'])
        ) {
            if ($filesimagem['error'] === UPLOAD_ERR_OK) {
                //este trecho if cuida para que a imagem seja copiada para a pasta cadastro/uploads no servidor local e o caminho fique armazenado no banco de dados
                // Verifica se o arquivo foi enviado com sucesso

                // Diretório onde você deseja armazenar as imagens
                $diretorioDestino = 'C:\xampp\htdocs\Market-Bank\cadastro\uploads\\';
                $fileInfo = pathinfo($filesimagem['name']);
                // Nome do arquivo original
                $filesimagem['name'] = uniqid();
                $imagem = $filesimagem['name'] . '.' . $fileInfo['extension'];

                // Caminho completo para onde o arquivo será movido
                $caminhoDestino = $diretorioDestino . $imagem;

                // Move o arquivo enviado para o diretório de destino
                if (move_uploaded_file($filesimagem['tmp_name'], $caminhoDestino)) {
                    //Arquivo enviado com sucesso.
                    return $imagem;
                } else {
                    echo "Erro ao mover o arquivo para o diretório de destino.";
                }
            } else {
                echo "Erro no envio do arquivo: " . $_FILES['imagem']['error'];
            }
        } else {
            $imagem = $filesimagem;
            return $imagem;
        }}

        public function excluirPanfleto($id_panfleto){
            $query = "DELETE FROM panfleto WHERE id_panfleto = :id_panfleto ;";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id_panfleto',$id_panfleto,PDO::PARAM_INT);
            if($stmt->execute()){
                return TRUE;
            }else{
                return "ocorreu um erro" . $stmt->errorInfo();
            }
        }
        public function getPanfById($id_panfleto){
            $query = "SELECT * FROM panfleto WHERE id_panfleto = :id_panfleto;";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id_panfleto',$id_panfleto,PDO::PARAM_INT);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }else{
                return "ocorreu um erro" . $stmt->errorInfo();
            }
        }
    
}
