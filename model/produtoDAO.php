<?php
class produtoDAO
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function inserirProduto($nome, $preco, $fotoProduto, $descricao, $id_mercado)
    {
        $img = $this->lidarImagem($fotoProduto);
        $query = "INSERT INTO produto (nome, preco, fotoProduto, descricao, id_mercado) VALUES (:nome, :preco, :fotoProduto, :descricao,:id_mercado);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindValue(':preco', $preco, PDO::PARAM_INT);
        $stmt->bindValue(':fotoProduto', $img, PDO::PARAM_STR);
        $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindValue(':id_mercado', $id_mercado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return TRUE;

        } else {
            return $stmt;
        }
    }

    public function lidarImagem($filesimgprod)
    {
        if ($filesimgprod['error'] === UPLOAD_ERR_OK) {
            //este trecho if cuida para que a imagem seja copiada para a pasta cadastro/uploads no servidor local e o caminho fique armazenado no banco de dados
// Verifica se o arquivo foi enviado com sucesso

            // Diretório onde você deseja armazenar as imagens
            $diretorioDestino = 'C:\xampp\htdocs\Market-Bank\cadastro\uploads\\';

            // Nome do arquivo original
            $imagem = $filesimgprod['name'];

            // Caminho completo para onde o arquivo será movido
            $caminhoDestino = $diretorioDestino . $imagem;

            // Move o arquivo enviado para o diretório de destino
            if (move_uploaded_file($filesimgprod['tmp_name'], $caminhoDestino)) {
                //Arquivo enviado com sucesso.
                return $imagem;
            } else {
                echo "Erro ao mover o arquivo para o diretório de destino.";
            }
        } else {
            echo "Erro no envio do arquivo: " . $_FILES['imagem']['error'];
        }
    }
}

