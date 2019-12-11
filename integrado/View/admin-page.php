<?php
    session_start();
    if (isset($_SESSION['admin'])) {
        include("../Model/Obra.php");
        include("../Persistence/ObraDAO.php");
        include("../Persistence/Connection.php");
        $connection = new Connection();
        $con = $connection->openConnection();
        $obra = new ObraDAO();
        $obras = $obra->recuperarTodasObras($con);
        $connection->closeConnection();
?>

        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <link rel="stylesheet" href="CSS/styleTelaAdmin.css">
        </head>
        <body>
            <header>
                <div class=botaoSair>
                    <img class="sair" src="Assets/sair.svg" alt="sair">
                </div>
                <a href="telaProdutosAdmin.html">
                    <img class="logo1" src="Assets/logo1.svg" alt="logo1">
                </a>
                <a href="#" id="addProduto">Adicionar Produto</a>
            </header>
            <div class="container">
<?php       foreach ($obras as $umaObra) { ?>
                <div class="container">
                    <div class="imagem">
                        <h1 id="titulo"><?php echo $umaObra->getNomeObra(); ?></h1><br>
                        <img style="width:347px; height:457px;" src="<?php echo "../uploads/obras/".$umaObra->getFoto(); ?>" alt="pensadorImg">
                    </div>
                    <div class="descricao">
                        <h1>"<?php echo $umaObra->getNomeObra(); ?>"</h1><br>
                        <h2>Artista: <?php echo $umaObra->getNomeAutor(); ?><br>
                            Local: <?php echo $umaObra->getLocal(); ?><br>
                            Material: <?php echo $umaObra->getMaterial(); ?><br>
                            Valor Estimado: R$<?php echo $umaObra->getValorEstimado(); ?><br>
                            Altura: <?php echo $umaObra->getAltura(); ?><br>
                            Largura: <?php echo $umaObra->getLargura(); ?><br>
                        </h2><br>
                    </div>
                </div>
<?php       } ?>
                    <button type="button" id="alterarObra">Alterar</button>
                    <button type="button" id="excluirObra">Excluir</button>
                </div>
            </div>
        </body>
        </html>
<?php
    }
?>