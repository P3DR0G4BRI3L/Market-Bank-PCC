<?php

// Conexão com o banco de dados
require_once 'cadastro.php';

// Obtem os dados do formulário




//este trecho if cuida para que a imagem seja copiada para a pasta cadastro/uploads no servidor local e o caminho fique armazenado no banco de dados
// Verifica se o arquivo foi enviado com sucesso
if ($_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    // Diretório onde você deseja armazenar as imagens
    $diretorioDestino = 'C:\xampp\htdocs\Market-Bank\cadastro\uploads\\';
    
    // Nome do arquivo original
    $imagem = $_FILES['imagem']['name'];
    
    // Caminho completo para onde o arquivo será movido
    $caminhoDestino = $diretorioDestino . $imagem;
    
    // Move o arquivo enviado para o diretório de destino
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
        echo "Arquivo enviado com sucesso.";
    } else {
        echo "Erro ao mover o arquivo para o diretório de destino.";
    }
} else {
    echo "Erro no envio do arquivo: " . $_FILES['imagem']['error'];
}

$nome = $_POST['nome'];
$nomeMerc = $_POST['nome_mercado'];
$endereco = $_POST['endereco'];
$horarioAbert = $_POST['horarioAbert'];
$horarioFecha = $_POST['horarioFecha'];
$telefone = $_POST['telefone'];
$cnpj = $_POST['cnpj'];

$email = $_POST['email'];
$senha = $_POST['senha'];

//verifica se ja existe esse email no banco de dados
$sqlverify = "SELECT * FROM usuario WHERE email = :email;";
$result = $conn->prepare($sqlverify);
$result->bindValue(':email', $email, PDO::PARAM_STR);
$result->execute();
if($result->rowCount()>0){
    echo "<script>
            alert('O email inserido já está em uso');
            window.location.href = 'cadastrarMercado.php';
          </script>";
    exit;
}



$sqlUser = "INSERT INTO usuario (nome, email, senha, tipo) VALUES (:nome, :email, :senha, 'dono');";
$torf=$conn->prepare($sqlUser); //$torf== True OR False
$torf->bindValue(':nome', $nome, PDO::PARAM_STR);
$torf->bindValue(':email', $email, PDO::PARAM_STR);
$torf->bindValue(':senha', $senha, PDO::PARAM_STR);
$torf->execute();

//verifica se a variavel $sqlUser foi executada com sucesso dentro do banco de dados
if ($torf) {
    
    //*LEIA TUDO :se esse comando sql for executado com sucesso a variável $getid retorna valor TRUE e se torna um objeto do tipo PDOStatement
    // e pode executar os métodos fetch(), rowCount(), fetch por padrao retorna um array associativo 
    $getid = $conn->prepare("SELECT id_usuario FROM usuario WHERE email = :email");
    $getid->bindValue(':email',$email,PDO::PARAM_STR);
    $getid->execute();
    if ($getid) {

       //esse metodo do $getid retorna um array associativo baseado na ultima query feita, em *LEIA TUDO: ela consultou a tabela usuarios
        $id = $getid->fetch();

        //$id_usuario recebeu o id de usuario
        $id_dono = $id['id_usuario'];

        //insere os dados na tabela mercado
       $sqlMerc = "INSERT INTO mercado ( nomeMerc, endereco, horarioAbert, horarioFecha, telefone, cnpj, imagem, id_dono)
        VALUES
        ( :nomeMerc, :endereco, :horarioAbert, :horarioFecha, :telefone, :cnpj, :imagem, :id_dono );";

    $connmerc = $conn->prepare($sqlMerc);// salva/prepara a consulta sql para ser executada
    $connmerc->bindValue(':nomeMerc',$nomeMerc,PDO::PARAM_STR);//substitui os parametros pelo valor inserido em bindValue
    $connmerc->bindValue(':endereco',$endereco,PDO::PARAM_STR);
    $connmerc->bindValue(':horarioAbert',$horarioAbert);
    $connmerc->bindValue(':horarioFecha',$horarioFecha);
    $connmerc->bindValue(':telefone',$telefone);
    $connmerc->bindValue(':cnpj',$cnpj,PDO::PARAM_STR);
    $connmerc->bindValue(':imagem',$imagem,PDO::PARAM_STR);
    $connmerc->bindValue(':id_dono',$id_dono,PDO::PARAM_INT);
    $connmerc->execute();
        if ($connmerc) {

            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
             echo "<script>window.location.href = '../index.php';</script>";

            exit; // Certifique-se de sair do script após o redirecionamento
        }
    }
} else {
    echo "Erro ao cadastrar: " . $torf->errorInfo();
}


$conn = null;
