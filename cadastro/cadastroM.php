<?php

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "marketbank";

$conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtem os dados do formulário
$nome = $_POST['nome'];
$nomeMercado = $_POST['nome_mercado'];
$endereco = $_POST['endereco'];
$horarioAbert = $_POST['horarioAbert'];
$horarioFecha = $_POST['horarioFecha'];
$telefone = $_POST['telefone'];
$cnpj = $_POST['cnpj'];




// Verifica se o arquivo foi enviado com sucesso
if ($_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    // Diretório onde você deseja armazenar as imagens
    $diretorioDestino = 'C:\xampp\htdocs\Market-Bank\cadastro\uploads\\';

    // Nome do arquivo original
    $nomeOriginal = $_FILES['imagem']['name'];

    // Caminho completo para onde o arquivo será movido
    $caminhoDestino = $diretorioDestino . $nomeOriginal;

    // Move o arquivo enviado para o diretório de destino
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
        echo "Arquivo enviado com sucesso.";
    } else {
        echo "Erro ao mover o arquivo para o diretório de destino.";
    }
} else {
    echo "Erro no envio do arquivo: " . $_FILES['imagem']['error'];
}


$email = $_POST['email'];
$senha = $_POST['senha'];

//verifica se ja existe esse email no banco de dados
$sqlverify = "SELECT * FROM usuario WHERE email = '$email';";
$result = $conn->query($sqlverify);
if($result->num_rows>0){
    echo "<script>
            alert('O email inserido já está em uso');
            window.location.href = 'cadastrarMercado.php';
          </script>";
    exit;
}


// ordem na coluna mercado      nomeMerc	endereco	horarioAbert	horarioFecha	telefone	cnpj	imagem	id_dono
// Insere os dados na tabela de usuários
// $sqlMerc = "INSERT INTO mercado ( nomeMerc, endereco, horarioAbert, horarioFecha, telefone, cnpj, imagem)
//  VALUES
//   ( '$nomeMercado', '$endereco', '$horarioAbert', '$horarioFecha', '$telefone', '$cnpj', '$caminhoImagem' );";

$sqlUser = "INSERT INTO usuario (nome, email, senha, tipo)
VALUES
('$nome', '$email', '$senha', 'dono')
;";

//verifica se a variavel $sqlUser foi executada com sucesso dentro do banco de dados
if ($conn->query($sqlUser) === TRUE) {
    
    //*LEIA TUDO :se esse comando sql for executado com sucesso a variável $getid retorna valor TRUE e se torna um objeto do tipo mysqli_result e pode executar os métodos fetch_assoc(), fetch_array(), fetch_row() 
    $getid = $conn->query("SELECT id_usuario FROM usuario WHERE email = '$email'");

    if ($getid == TRUE) {

       //esse metodo do $getid retorna um array associativo baseado na ultima query feita, em *LEIA TUDO: ela consultou a tabela usuarios
        $id = $getid->fetch_assoc();

        //$id_usuario recebeu o id de usuario
        $id_usuario = $id['id_usuario'];

        //insere os dados na tabela mercado
       $sqlMerc = "INSERT INTO mercado ( nomeMerc, endereco, horarioAbert, horarioFecha, telefone, cnpj, imagem, id_dono)
        VALUES
        ( '$nomeMercado', '$endereco', '$horarioAbert', '$horarioFecha', '$telefone', '$cnpj', '$nomeOriginal', '$id_usuario' );";

    $connmerc = $conn->query($sqlMerc);
        if ($connmerc === TRUE) {

            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
             echo "<script>window.location.href = '../index.php';</script>";

            exit; // Certifique-se de sair do script após o redirecionamento
        }
    }
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}


$conn->close();
