<?php
session_start();
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';

if (usuarioEstaLogado() && $_SESSION['usuario']['tipo'] == 'dono') {

    //armazena todas as informações do mercado logado em $infmercado
    $mercName = $_SESSION['usuario']['id_usuario'];
    $mercado = $conn->prepare("SELECT * FROM mercado WHERE id_dono = :mercName;");
    $mercado->bindValue(':mercName', $mercName, PDO::PARAM_INT);
    $mercado->execute();
    $infmercado = $mercado->fetch();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['nome'], $_POST['nome_mercado'], $_POST['cnpj'], $_POST['endereco'], $_POST['horarioAbert'], $_POST['horarioFecha'], $_POST['telefone'], $_POST['senha'])) {

    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $nomeMerc = $_POST['nome_mercado'];
    $cnpj = $_POST['cnpj'];
    $endereco = $_POST['endereco'];
    $horarioAbert = $_POST['horarioAbert'];
    $horarioFecha = $_POST['horarioFecha'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $imagem = $_POST['fotoatual'];
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
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
    //id_mercado	
// nomeMerc	
// endereco	
// horarioAbert	
// horarioFecha	
// telefone	
// cnpj	
// imagem	
// id_dono 
    $stmt = $conn->prepare("UPDATE usuario SET nome = :nome , email = :email , senha = :senha WHERE id_usuario = :id_dono");//atualiza a tabela usuario
    $stmt->bindValue(':nome',$nome,PDO::PARAM_STR);
    $stmt->bindValue(':email',$email,PDO::PARAM_STR);
    $stmt->bindValue(':senha',$senha,PDO::PARAM_STR);
    $stmt->bindValue(':id_dono',$infmercado['id_dono'],PDO::PARAM_INT);


    $stmt2 = $conn->prepare("UPDATE mercado SET nomeMerc = :nomeMerc , endereco = :endereco , horarioAbert = :horarioAbert , horarioFecha = :horarioFecha , telefone = :telefone , cnpj = :cnpj , imagem = :imagem WHERE id_mercado = :id_mercado ");//atualiza a tabela mercado
    $stmt2->bindValue(':nomeMerc',$nomeMerc,PDO::PARAM_STR);
    $stmt2->bindValue(':endereco',$endereco,PDO::PARAM_STR);
    $stmt2->bindValue(':horarioAbert',$horarioAbert);
    $stmt2->bindValue(':horarioFecha',$horarioFecha);
    $stmt2->bindValue(':telefone',$telefone,PDO::PARAM_STR);
    $stmt2->bindValue(':cnpj',$cnpj,PDO::PARAM_STR);
    $stmt2->bindValue(':imagem',$imagem,PDO::PARAM_STR);
    $stmt2->bindValue(':id_mercado',$infmercado['id_mercado'],PDO::PARAM_INT);

    if($stmt->execute() && $stmt2->execute()){
        $stmt3 = $conn->prepare("SELECT * FROM usuario WHERE id_usuario = :id_dono ");
        $stmt3->bindValue(':id_dono',$infmercado['id_dono'],PDO::PARAM_INT);
        $stmt3->execute();
        $_SESSION['usuario'] = $stmt3->fetch();
        echo " <script>alert('Mercado editado com sucesso')
        window.location.href='../cadastro/verMeuMercado.php'
        </script> ";
    }else{
        echo "alert('ocorreu um erro')".$stmt->errorInfo();
    }

}
require_once '../inc/cabecalho.php';
?>
<div id="area-principal">

    <div id="area-postagens">
        <!--Aberturac -->
        <div class="postagem">
            <h2>Editar mercado</h2>
            <p>
            <div class="container">
                <div class="login-box">
                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="input-group">
                            <label for="username">E-mail:</label>

                            <input type="email" id="username" name="email" value="<?= $_SESSION['usuario']['email'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira seu email" required>
                        </div>

                        <div class="input-group">
                            <label for="nome">Nome do proprietário:</label>
                            <input type="text" id="nome" name="nome" value="<?= $_SESSION['usuario']['nome'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira seu nome" required>
                        </div>

                        <div class="input-group">
                            <label for="nome">Nome do Mercado:</label>
                            <input type="text" id="nome" name="nome_mercado" value="<?= $infmercado['nomeMerc'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira o nome do mercado" required>
                        </div>

                        <div class="input-group">
                            <label for="cnpj">CNPJ:</label>
                            <input type="text" id="cnpj" name="cnpj" value="<?= $infmercado['cnpj'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required
                                placeholder="Insira seu CNPJ" minlength="14" maxlength="14"
                                oninput="restringirLetras(this)">
                        </div>

                        <div class="input-group">
                            <label for="endereco">Endereço:</label>
                            <input type="text" id="endereco" name="endereco" value="<?= $infmercado['endereco'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira o endereço" required>
                        </div>


                        <div class="input-group">
                            <label for="horarioFunc">Horário de abertura:&nbsp;</label>
                            <input type="time" id="horarioFunc" name="horarioAbert"
                                value="<?= date('H:i' , strtotime($infmercado['horarioAbert'])) ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>

                            <label for="horarioFunc">Horário de fechamento:</label>
                            <input type="time" id="horarioFunc" name="horarioFecha"
                                value="<?= date('H:i' , strtotime($infmercado['horarioFecha'])) ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required>
                        </div>


                        <div class="input-group">
                            <label for="telefone">Telefone:</label>
                            <input type="text" id="telefone" name="telefone" value="<?= $infmercado['telefone'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required
                                placeholder="Insira o telefone para contato" minlength="11" maxlength="11"
                                oninput="restringirLetras(this)">
                        </div>

                        <div class="input-group">
                            <label for="senha">Senha:</label>
                            <input type="password" id="senha" name="senha" value="<?= $_SESSION['usuario']['senha'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()" required
                                placeholder="Insira sua senha">
                            <button type="button" id="mostrarSenha" onclick="mostrarsenha()">Mostrar Senha</button>
                        </div>

                        <div class="input-group">

                            <picture>
                                <img src="../cadastro/uploads/<?= $infmercado['imagem'] ?>" alt="foto do mercado"
                                    width="100px">
                                <legend>Imagem atual</legend>
                            </picture>
                            <label for="imagem">Foto do supermercado: <h6 style="color:red;">* escolha uma nova imagem
                                    se quiser trocar a atual</h6></label>
                            <input type="hidden" name="fotoatual" value="<?= $infmercado['imagem'] ?>">
                            <input type="file" id="imagem" name="imagem"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="faça upload de uma foto do mercado">
                        </div>

                        <button class="btn_left" onclick="window.location.href='cadastrar.php'">Voltar</button>

                        <button type="submit">Cadastrar</button>

                    </form>
                </div>
            </div>
            </p>
        </div>

    </div>
    <?php require_once '../inc/rodape.php'; ?>