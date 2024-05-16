<?php

$dsn = "mysql:host=127.0.0.1;dbname=marketbank"  ;
try{//tenta executar este trecho, se alguma exceção/erro for encontrada, pula pro bloco catch
$conn = new PDO("$dsn","root","");

$conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}catch(PDOException $erro){ //se alguma exceção do tipo PDOException for capturada, o bloco catch é executado e a variavel $erro se torna um objeto do tipo PDOException

    echo "Falha na conexão:".$erro->getMessage();

}





// Insere os dados na tabela de usuários
// $sql = "SELECT * FROM mercado WHERE ";

// if ($conn->query($sql) === TRUE) {
//      // Usuário autenticado com sucesso
//      echo "<script>alert('Cadastro realizado com sucesso!');</script>";
//     echo "<script>window.location.href = '../index.php';</script>";
//      exit; // Certifique-se de sair do script após o redirecionamento
// } else {
//     echo "Erro ao cadastrar: " . $conn->error;
// }


// $conn->close();
// ?>
