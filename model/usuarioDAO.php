<?php

class usuarioDAO
{

    private $conn;


    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function getUsuarioById($id_usuario)
    {
        try {
            $query = "SELECT id_usuario , nome , email , tipo FROM usuario WHERE id_usuario = :id_usuario;";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return "ocorreu um erro{$stmt->errorInfo()}";
            }

        } catch (PDOException $erro) {
            return "ocorreu um erro" . $erro->getMessage() . "<br>arquivo" . $erro->getFile();
        }
    }
    public function verificaEmailExiste($email)
    {
        try {
            $query = "SELECT * FROM usuario WHERE email = :email;";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            if ($stmt->execute() && $stmt->rowCount() < 0) {
                return TRUE;
            }
        } catch (PDOException $erro) {
            echo "ocorreu um erro" . $erro->getMessage() . "<br>arquivo" . $erro->getFile();
        }

    }
    public function verificaEmailExisteAtt($emailAtt,$emailsessao){
        $query = "SELECT * FROM usuario WHERE email = :email" ;
        $stmt = $this->conn->prepare($query);//verifica se existe um usuario com esse email na tabela, att para update
        $stmt->bindValue(':email',$emailAtt,PDO::PARAM_STR);
    
        if($stmt->execute() && $stmt->rowCount()>0){
            $verify = $stmt->fetch(PDO::FETCH_ASSOC);
            // var_dump($verify['email']);exit;
            // $verify2=$conn->prepare("SELECT * FROM ")        ;
            if($verify['email']!=$emailsessao){
            return TRUE;}
    }}

    public function inserirUsuario($nome, $email, $senha, $tipo){
        $query = "INSERT INTO usuario (nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return TRUE;
        } else {
            return $stmt->errorInfo();
        }
    }

    public function atualizarUsuario($nome, $email, $senha, $id_usuario)
    {
        $stmt = $this->conn->prepare("UPDATE usuario SET nome = :nome , email = :email , senha = :senha WHERE id_usuario = :id_usuario");//atualiza a tabela usuario
        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        if($stmt->execute()){
            return TRUE;
        }else{
            echo "ocorreu um erro".$stmt->errorInfo();
        }
    }

    public function getIdUsuarioByEmail($email)
    {
        $query = "SELECT id_usuario FROM usuario WHERE email = :email; ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        } else {
            echo "Erro ao cadastrar" . $stmt->errorInfo();
        }
    }
    public function login($email, $senha)
    {
        $stmt = $this->conn->prepare("SELECT id_usuario,nome,email,tipo FROM `usuario` WHERE email = :email AND senha = :senha;");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':senha', $senha, PDO::PARAM_STR);
        if ($stmt->execute() && $stmt->rowCount() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
    public function getSenhaById($id_usuario)
    {
        $query = "SELECT senha FROM usuario WHERE id_usuario = :id_usuario ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_COLUMN);
        } else {
            echo "ocorreu um erro" . $stmt->errorInfo();
        }

    }
}