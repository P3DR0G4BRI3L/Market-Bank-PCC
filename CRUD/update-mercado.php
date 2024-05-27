<?php
session_start();
require_once '../func/func.php';
require_once '../cadastro/cadastro.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';
if(!usuarioEstaLogado()){
    header('location:../index.php');
    exit;
}
$usuarioDAO = new usuarioDAO($conn);

if (mercadoEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);

       $mercadoDAO = new mercadoDAO($conn);
       $infmercado = $mercadoDAO->getMercadoByIdUsuario($_SESSION['usuario']['id_usuario']);

}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['nome'], $_POST['nome_mercado'], $_POST['cnpj'], $_POST['endereco'], $_POST['horarioAbert'], $_POST['horarioFecha'],
 $_POST['telefone'], $_POST['senha'],$_POST['regiaoadm'],$_POST['compras'])) {

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
    $descricao = $_POST['descricao'] ?? null;
    $compras = $_POST['compras'];
    $regiaoadm = $_POST['regiaoadm'];



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

    
    $attUser = $usuarioDAO->atualizarUsuario($nome,$email,$senha,$id_usuario);
    

    $stmt2 = $conn->prepare("UPDATE mercado SET nomeMerc = :nomeMerc , endereco = :endereco , horarioAbert = :horarioAbert , horarioFecha = :horarioFecha , telefone = :telefone , cnpj = :cnpj , imagem = :imagem, regiaoadm = :regiaoadm, compras = :compras, descricao = :descricao WHERE id_mercado = :id_mercado ");//atualiza a tabela mercado
    $stmt2->bindValue(':nomeMerc',$nomeMerc,PDO::PARAM_STR);
    $stmt2->bindValue(':endereco',$endereco,PDO::PARAM_STR);
    $stmt2->bindValue(':horarioAbert',$horarioAbert);
    $stmt2->bindValue(':horarioFecha',$horarioFecha);
    $stmt2->bindValue(':telefone',$telefone,PDO::PARAM_STR);
    $stmt2->bindValue(':cnpj',$cnpj,PDO::PARAM_STR);
    $stmt2->bindValue(':imagem',$imagem,PDO::PARAM_STR);
    $stmt2->bindValue(':regiaoadm',$regiaoadm,PDO::PARAM_STR);
    $stmt2->bindValue(':compras',$compras,PDO::PARAM_STR);
    $stmt2->bindValue(':descricao',$descricao,PDO::PARAM_STR);
    $stmt2->bindValue(':id_mercado',$infmercado['id_mercado'],PDO::PARAM_INT);

    if( $stmt2->execute()){
        $stmt3 = $conn->prepare("SELECT * FROM usuario WHERE id_usuario = :id_dono ");
        $stmt3->bindValue(':id_dono',$infmercado['id_dono'],PDO::PARAM_INT);
        $stmt3->execute();
        $_SESSION['usuario'] = $stmt3->fetch();//atribui as informções mais atuais do usuario ao usuario de sessão
        echo " <script>alert('Mercado editado com sucesso')
        window.location.href='../cadastro/verMeuMercado.php'
        </script> ";
    }else{
        echo "alert('ocorreu um erro')".$stmt->errorInfo();
        echo "alert('ocorreu um erro')".$stmt2->errorInfo();
    }

}
require_once '../inc/cabecalho.php';
?>
<div id="area-principal">

    <div id="area-postagens">
        <!--Aberturac -->
        <div class="postagem">
            <h2>Editar mercado</h2>
            
            <div class="container">
                <div class="login-box">
                    <form action="" method="POST" enctype="multipart/form-data"  onsubmit="return validarquant();">

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

                        <div class="input-endereco">
                            <label for="regiaoadm">Região Administrativa:</label>
                            <select id="regiaoadm" name="regiaoadm" required>
                                <option value="" disabled selected>Selecione a região administrativa</option>
                                <option value="Brasília" <?= $infmercado['regiaoadm']=="Brasília" ? 'selected':'' ?> >Brasília</option>
                                <option value="Gama" <?= $infmercado['regiaoadm']=="Gama" ? 'selected':'' ?> >Gama</option>
                                <option value="Taguatinga" <?= $infmercado['regiaoadm']=="Taguatinga" ? 'selected':'' ?> >Taguatinga</option>
                                <option value="Brazlândia" <?= $infmercado['regiaoadm']=="Brazlândia" ? 'selected':'' ?> >Brazlândia</option>
                                <option value="Sobradinho" <?= $infmercado['regiaoadm']=="Sobradinho" ? 'selected':'' ?> >Sobradinho</option>
                                <option value="Planaltina" <?= $infmercado['regiaoadm']=="Planaltina" ? 'selected':'' ?> >Planaltina</option>
                                <option value="Paranoá" <?= $infmercado['regiaoadm']=="Paranoá" ? 'selected':'' ?> >Paranoá</option>
                                <option value="Núcleo Bandeirante" <?= $infmercado['regiaoadm']=="Núcleo Bandeirante"? 'selected':'' ?>>Núcleo Bandeirante</option>
                                <option value="Ceilândia" <?= $infmercado['regiaoadm']=="Ceilândia" ? 'selected':'' ?> >Ceilândia</option>
                                <option value="Guará" <?= $infmercado['regiaoadm']=="Guará" ? 'selected':'' ?> >Guará</option>
                                <option value="Cruzeiro" <?= $infmercado['regiaoadm']=="Cruzeiro" ? 'selected':'' ?> >Cruzeiro</option>
                                <option value="Samambaia" <?= $infmercado['regiaoadm']=="Samambaia" ? 'selected':'' ?> >Samambaia</option>
                                <option value="Santa Maria" <?= $infmercado['regiaoadm']=="Santa Maria"? 'selected':'' ?> >Santa Maria</option>
                                <option value="São Sebastião" <?= $infmercado['regiaoadm']=="São Sebastião"? 'selected':'' ?> >São Sebastião</option>
                                <option value="Recanto das Emas"<?= $infmercado['regiaoadm']=="Recanto das Emas" ? 'selected':'' ?> >Recanto das Emas</option>
                                <option value="Lago Sul" <?= $infmercado['regiaoadm']=="Lago Sul"? 'selected':'' ?> >Lago Sul</option>
                                <option value="Riacho Fundo" <?= $infmercado['regiaoadm']=="Riacho Fundo"? 'selected':'' ?> >Riacho Fundo</option>
                                <option value="Lago Norte" <?= $infmercado['regiaoadm']=="Lago Norte"? 'selected':'' ?> >Lago Norte</option>
                                <option value="Candangolândia" <?= $infmercado['regiaoadm']=="Candangolândia" ? 'selected':'' ?> >Candangolândia</option>
                                <option value="Águas Claras" <?= $infmercado['regiaoadm']=="Águas Claras"? 'selected':'' ?> >Águas Claras</option>
                                <option value="Riacho Fundo II"  <?= $infmercado['regiaoadm']== "Riacho Fundo II" ? 'selected':''== '' ?> >Riacho Fundo II</option>
                                <option value="Sudoeste/Octogonal" <?= $infmercado['regiaoadm']=="Sudoeste/Octogonal"? 'selected':'' ?> >Sudoeste/Octogonal</option>
                                <option value="Varjão" <?= $infmercado['regiaoadm']=="Varjão" ? 'selected':'' ?> >Varjão</option>
                                <option value="Park Way" <?= $infmercado['regiaoadm']=="Park Way"? 'selected':'' ?> >Park Way</option>
                                <option value="Scia (Estrutural)" <?= $infmercado['regiaoadm']=="Scia (Estrutural)"? 'selected':'' ?> >Scia (Estrutural)</option>
                                <option value="Sobradinho II" <?= $infmercado['regiaoadm']=="Sobradinho II"? 'selected':'' ?> >Sobradinho II</option>
                                <option value="Jardim Botânico" <?= $infmercado['regiaoadm']=="Jardim Botânico"? 'selected':'' ?> >Jardim Botânico</option>
                                <option value="Itapoã" <?= $infmercado['regiaoadm']=="Itapoã" ? 'selected':'' ?> >Itapoã</option>
                                <option value="SIA" <?= $infmercado['regiaoadm']=="SIA" ? 'selected':'' ?> >SIA</option>
                                <option value="Vicente Pires" <?= $infmercado['regiaoadm']=="Vicente Pires"? 'selected':'' ?> >Vicente Pires</option>
                                <option value="Fercal" <?= $infmercado['regiaoadm']=="Fercal" ? 'selected':'' ?> >Fercal</option>
                            </select>

                        <div class="input-group">
                            <label for="endereco">Endereço:</label>
                            <input type="text" id="endereco" name="endereco" value="<?= $infmercado['endereco'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira o endereço" required>
                        </div>

                        <div class="input-group">
                            <label for="descricao">Informações adicionais:<h6>*Opcional</h6></label>
                            <input type="text" id="descricao" name="descricao" value="<?= $infmercado['descricao'] ?>"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="Insira as Informações adicionais" >
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
                            <input type="password" id="senha" name="senha" value="<?= $usuarioDAO->getSenhaById($_SESSION['usuario']['id_usuario']) ?>"
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
                            <label for="imagem">Foto do supermercado: <h6 >* escolha uma nova imagem
                                    se quiser trocar a atual</h6></label>
                            <input type="hidden" name="fotoatual" value="<?= $infmercado['imagem'] ?>">
                            <input type="file" id="imagem" name="imagem"
                                onkeydown="if(event.keyCode === 13) event.preventDefault()"
                                placeholder="faça upload de uma foto do mercado">
                        </div>


                        <div class="input-compra">
                            <label for="compras">Deseja fornecer compras pelo site?&nbsp;&nbsp;&nbsp;</label>
                            <input type="radio" id="compras" name="compras" value="sim" onkeydown="if(event.keyCode === 13) event.preventDefault()" required
                            <?=$infmercado['compras'] == 'sim' ?'checked' : ''?>>
                            <p>Sim</p>

                            <input type="radio" id="compras" name="compras" value="nao" onkeydown="if(event.keyCode === 13) event.preventDefault()" required <?=$infmercado['compras'] == 'nao' ?'checked' : ''?> >
                            <p>Não</p>

                        </div>

                        <button class="btn_left" onclick="window.location.href='../cadastro/verMeuMercado.php'">Voltar</button>

                        <button type="submit">Salvar</button>

                    </form>
                </div>
            </div>
            
        </div>

    </div>
    <?php require_once '../inc/rodape.php'; ?>