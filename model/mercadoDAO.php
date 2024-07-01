<?php
class mercadoDAO
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getIdMercadoByIdDono($id_dono_OU_id_usuario)
    {
        $query = "SELECT id_mercado FROM mercado WHERE id_dono = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id_dono_OU_id_usuario, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_COLUMN);
        } else {
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }
    public function getIdUsuarioByIdMercado($id_mercado)
    {
        $query = "SELECT id_dono FROM mercado WHERE id_mercado = :id_mercado;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado', $id_mercado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_COLUMN);
        } else {
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }

    public function inserirMercado(
        $nomeMerc,
        $regiaoadm,
        $endereco,
        $horarioAbert,
        $horarioFecha,
        $telefone,
        $cnpj,
        $imagem,
        $descricao,
        $compras,
        $id_dono
    ) {
        $img = $this->lidarImagem($imagem);/* da o tratamento adequado para a imagem ser armazenada no banco de dados */
        $query = "INSERT INTO mercado ( nomeMerc, regiaoadm, endereco, horarioAbert, horarioFecha, telefone, cnpj, imagem, descricao, compras, id_dono)
        VALUES
                            ( :nomeMerc, :regiaoadm, :endereco, :horarioAbert, :horarioFecha, :telefone, :cnpj, :imagem, :descricao , :compras, :id_dono );";

        $stmt = $this->conn->prepare($query); // salva/prepara a consulta sql para ser executada
        $stmt->bindValue(':nomeMerc', $nomeMerc, PDO::PARAM_STR); //substitui os parametros pelo valor inserido em bindValue
        $stmt->bindValue(':regiaoadm', $regiaoadm, PDO::PARAM_STR);
        $stmt->bindValue(':endereco', $endereco, PDO::PARAM_STR);
        $stmt->bindValue(':horarioAbert', $horarioAbert);
        $stmt->bindValue(':horarioFecha', $horarioFecha);
        $stmt->bindValue(':telefone', $telefone);
        $stmt->bindValue(':cnpj', $cnpj, PDO::PARAM_STR);
        $stmt->bindValue(':imagem', $img, PDO::PARAM_STR);
        $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindValue(':compras', $compras, PDO::PARAM_STR);
        $stmt->bindValue(':id_dono', $id_dono, PDO::PARAM_INT); //id_dono referencia id_usuario na tabela usuario
        if ($stmt->execute()) {
            return TRUE;
        } else {
            return $stmt;
        }
    }

    public function getAllMercados()
    {
        $stmt = $this->conn->prepare("SELECT * FROM mercado;");
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC); //vai retornar um array de indice com arrays associativos com os nome das colunas
        } else {
            return FALSE;
        }
    }


    public function getMercadoByIdUsuario($id_dono)
    {
        $query = "SELECT * FROM mercado WHERE id_dono = :id_dono";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_dono', $id_dono, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getMercadoById($id_mercado)
    {
        $query = "SELECT * FROM mercado WHERE id_mercado = :id_mercado";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado', $id_mercado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
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
                $diretorioDestino = '../cadastro/uploads/';
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
        }
    }

    public function atualizarMercado(
        $nomeMerc,
        $regiaoadm,
        $endereco,
        $horarioAbert,
        $horarioFecha,
        $telefone,
        $cnpj,
        $imagem,
        $descricao,
        $compras,
        $id_mercado
    ) {
        $query = "UPDATE mercado SET nomeMerc = :nomeMerc , endereco = :endereco , horarioAbert = :horarioAbert , horarioFecha = :horarioFecha
         , telefone = :telefone , cnpj = :cnpj , imagem = :imagem, regiaoadm = :regiaoadm, compras = :compras, descricao = :descricao
          WHERE id_mercado = :id_mercado ";

        $stmt = $this->conn->prepare($query); //atualiza a tabela mercado
        $stmt->bindValue(':nomeMerc', $nomeMerc, PDO::PARAM_STR);
        $stmt->bindValue(':endereco', $endereco, PDO::PARAM_STR);
        $stmt->bindValue(':horarioAbert', $horarioAbert);
        $stmt->bindValue(':horarioFecha', $horarioFecha);
        $stmt->bindValue(':telefone', $telefone, PDO::PARAM_STR);
        $stmt->bindValue(':cnpj', $cnpj, PDO::PARAM_STR);
        $stmt->bindValue(':imagem', $imagem, PDO::PARAM_STR);
        $stmt->bindValue(':regiaoadm', $regiaoadm, PDO::PARAM_STR);
        $stmt->bindValue(':compras', $compras, PDO::PARAM_STR);
        $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindValue(':id_mercado', $id_mercado, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return TRUE;
        } else {
            echo "ocorreu um erro" . $stmt->errorInfo();
        }
    }
    public function deleteMercadoById($id_dono)
    {

        $query = "DELETE FROM mercado WHERE id_dono = :id_dono";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_dono', $id_dono, PDO::PARAM_INT);
        if ($stmt->execute()) {

            return TRUE;
        } else {
            return "ocorreu um erro " . $stmt->errorInfo();
        }
    }

    public function deleteMercadoByIdMercado($id_mercado)
    {

        $query = "DELETE FROM mercado WHERE id_mercado = :id_mercado";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado', $id_mercado, PDO::PARAM_INT);
        if ($stmt->execute()) {

            return TRUE;
        } else {
            return "ocorreu um erro " . $stmt->errorInfo();
        }
    }




    public function deleteAllProdutosByMercado($id_mercado)
    {
        $query = "DELETE FROM produto WHERE id_mercado = :id_mercado";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado', $id_mercado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return TRUE;
        } else {
            return "ocorreu um erro " . $stmt->errorInfo();
        }
    }

    public function deleteAllPanfletosByMercado($id_mercado)
    {
        $query = "DELETE FROM panfleto WHERE id_mercado = :id_mercado";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado', $id_mercado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return TRUE;
        } else {
            return "ocorreu um erro " . $stmt->errorInfo();
        }
    }
    public function deleteAllfiltroProdutoByMercado($id_mercado)
    {
        $query = "DELETE FROM filtroProduto WHERE  id_mercado = :id_mercado;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado', $id_mercado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return TRUE;
        } else {
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }
    public function deleteAllInfoPagByIdMercado($id_mercado)
    {
        $query = "DELETE FROM infopag WHERE  id_mercado = :id_mercado;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado', $id_mercado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return TRUE;
        } else {
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }


    public function getImagemById($id_mercado)
    {
        $query = "SELECT imagem FROM mercado WHERE id_mercado=:id_mercado;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado', $id_mercado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_COLUMN);
        }
    }

    public function verificaCNPJexiste($cnpj)
    {
        try {
            $query = "SELECT * FROM mercado WHERE cnpj = :cnpj;";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':cnpj', $cnpj);
            if ($stmt->execute() && $stmt->rowCount() > 0) {
                return TRUE;
            }
        } catch (PDOException $erro) {
            echo "ocorreu um erro" . $erro->getMessage() . "<br>arquivo" . $erro->getFile();
        }
    }

    public function verificaCNPJexisteAtt($cnpjAtt, $cnpjsessao)
    {
        $query = "SELECT * FROM mercado WHERE cnpj = :cnpj";
        $stmt = $this->conn->prepare($query); //verifica se existe um usuario com esse cnpj na tabela, att para update
        $stmt->bindValue(':cnpj', $cnpjAtt, PDO::PARAM_STR);

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $verify = $stmt->fetch(PDO::FETCH_ASSOC);
            // var_dump($verify['cnpj']);exit;
            // $verify2=$conn->prepare("SELECT * FROM ")        ;
            if ($verify['cnpj'] != $cnpjsessao) {
                return TRUE;
            }
        }
    }

    public function getMercadoByRegiaoADM($regiaoadm)
    {
        if (empty($regiaoadm)) {
            exit;
        }
        $query = "SELECT * FROM mercado WHERE regiaoadm = :regiaoadm";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':regiaoadm', $regiaoadm, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }
    public function deleteAllItensByIdProdutos($produtos)
    {
        $query = "DELETE FROM itens WHERE id_produto = :id_produto;";
        $stmt = $this->conn->prepare($query);
        foreach ($produtos as $produto) {
            $stmt->bindValue(':id_produto', $produto['id_produto'], PDO::PARAM_INT);
            if (!$stmt->execute()) {
                return "ocorreu um erro" . $stmt->errorInfo();
            }
        }

        return TRUE;
    }

    public function deleteAllCarrinhosByIdMercado($id_mercado)
    {
        $query = "DELETE FROM carrinho WHERE id_mercado = :id_mercado;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_mercado', $id_mercado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return TRUE;
        } else {
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }
    public function getAllIdCarrinhoByIdCliente($id_cliente)
    {
        $query = "SELECT id_carrinho FROM carrinho WHERE id_cliente = :id_cliente;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_cliente', $id_cliente, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return "ocorreu um erro" . $stmt->errorInfo();
        }
    }
    public function getAllregioes(){
        $query = "SELECT DISTINCT regiaoadm FROM mercado;";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return "ocorreu um erro" . $stmt->errorInfo();
        }
        
    }
    
}
