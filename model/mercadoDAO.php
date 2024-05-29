<?php
class mercadoDAO
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
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

        $stmt = $this->conn->prepare($query);// salva/prepara a consulta sql para ser executada
        $stmt->bindValue(':nomeMerc', $nomeMerc, PDO::PARAM_STR);//substitui os parametros pelo valor inserido em bindValue
        $stmt->bindValue(':regiaoadm', $regiaoadm, PDO::PARAM_STR);
        $stmt->bindValue(':endereco', $endereco, PDO::PARAM_STR);
        $stmt->bindValue(':horarioAbert', $horarioAbert);
        $stmt->bindValue(':horarioFecha', $horarioFecha);
        $stmt->bindValue(':telefone', $telefone);
        $stmt->bindValue(':cnpj', $cnpj, PDO::PARAM_STR);
        $stmt->bindValue(':imagem', $img, PDO::PARAM_STR);
        $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindValue(':compras', $compras, PDO::PARAM_STR);
        $stmt->bindValue(':id_dono', $id_dono, PDO::PARAM_INT);//id_dono referencia id_usuario na tabela usuario
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
            return $stmt->fetchAll(PDO::FETCH_ASSOC);//vai retornar um array de indice com arrays associativos com os nome das colunas
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

    public function lidarImagem($filesimagem)
    {
        if ($filesimagem['error'] === UPLOAD_ERR_OK) {
            //este trecho if cuida para que a imagem seja copiada para a pasta cadastro/uploads no servidor local e o caminho fique armazenado no banco de dados
// Verifica se o arquivo foi enviado com sucesso

            // Diretório onde você deseja armazenar as imagens
            $diretorioDestino = 'C:\xampp\htdocs\Market-Bank\cadastro\uploads\\';

            // Nome do arquivo original
            $imagem = $filesimagem['name'];

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
    }


}