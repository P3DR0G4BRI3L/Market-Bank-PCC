<?php
require_once '../cadastro/cadastro.php';
require_once '../func/func.php';
require_once '../model/mercadoDAO.php';
require_once '../model/usuarioDAO.php';
session_start();

//verifica se tem algum usuário logado retorna true ou false
$regioes = array(
    "Brasília", "Gama", "Taguatinga", "Brazlândia", "Sobradinho", "Fercal", "Planaltina", "Itapoã", "Paranoá",
     "Ceilândia", "Guará", "Cruzeiro", "Samambaia", "SIA", "Candangolândia", "Sudoeste/Octogonal", "Varjão", "Águas Claras",
    "Riacho Fundo II", "Santa Maria", "São Sebastião", "Recanto das Emas", "Park Way", "Scia (Estrutural)",
    "Jardim Botânico", "Sobradinho II", "Lago Sul", "Riacho Fundo", "Lago Norte", "Vicente Pires", "Núcleo Bandeirante"
);

$mercadoDAO = new mercadoDAO($conn);
if (usuarioEstaLogado()) {
    $_SESSION['usuario']['verMercado'] = null;
} else {
    header('location:../index.php');
}

require_once '../inc/cabecalho.php'; //mostra o cabeçalho
?>



<div id="area-principal">

    <div id="area-postagens">


        <?php
        // o cabeçalho é mostrado em cima normal, porem, se a pessoa não estiver logada é criado uma div postagem e mostra pro usuário que ele não pode acessar essa pagina 
        voceNaoTemPermissao();

        ?>
    



            

        <?php $mercados = $mercadoDAO->getAllMercados();
         if (!empty($mercados)) : ?>
            <div class="postagem flex center">
                <?php foreach ($mercados as $mercado) : ?>
                    <?php if (empty($_GET['filtroRegiao']) || $_GET['filtroRegiao'] == $mercado['regiaoadm']) : ?>
                        <div class="view_mercado">
                            <h2><?= ucwords($mercado['nomeMerc']); ?></h2>
                            <?php if (!mercadoEstaLogado()) : ?>
                                <a href="verPerfilMercado.php?id_mercado=<?= $mercado['id_mercado']; ?>">
                            <?php endif ?>
                            <img src="../cadastro/uploads/<?= $mercado['imagem']; ?>" alt="Imagem do mercado">
                            <?php if (!mercadoEstaLogado()) : ?>
                                </a>
                            <?php endif ?>
                            <h2><?= $mercado['regiaoadm'] ?></h2>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <h2>Ainda não foram inseridos mercados</h2>
        <?php endif; ?>
    </div>
    

    <div id="area-lateral">

        <div class="conteudo-lateral">
            <h3>Filtrar regiões</h3>
            <form action="" method="GET">

                <select name="filtroRegiao" id="filtroRegiao" onchange="this.form.submit()">
                    <option value="" disabled selected>Selecione a região administrativa</option>
                    <?php foreach ($regioes as $regiao) : ?>
                        <option value="<?=$regiao?>"<?=(isset($_GET['filtroRegiao']) && $regiao==$_GET['filtroRegiao'])?'selected':''?>><?=$regiao?></option>
                    <?php endforeach ?>
                </select>

            </form>
            <a href="?">limpar filtro</a>
        </div>

    </div>
</div>



<?php require_once '../inc/rodape.php'; ?>