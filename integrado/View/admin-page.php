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
                    <a href="../Controller/Logout.php"><img class="sair" src="Assets/sair.svg" alt="sair"></a>
                </div>
                <a href="telaProdutosAdmin.html">
                    <img class="logo1" src="Assets/logo1.svg" alt="logo1">
                </a>
                <a href="cadastrarObra.php" id="addProduto">Adicionar Produto</a>
            </header>
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
                        <div style="display:inline-block;">
                            <form method="POST" action="atualizarObra.php">
                                <input type="number" name="idObra" value="<?php echo $umaObra->getIdObra(); ?>" hidden />
                                <button id="alterarObra" type="submit" name="atualizarObra">Alterar</button>
                            </form>
                        </div>
                        <div style="display:inline-block; margin-left:15px;">
                            <form method="POST" action="../Controller/excluirObra.php">
                                <input type="text" name="foto" value="<?php echo $umaObra->getFoto(); ?>" hidden />
                                <input type="number" name="idObra" value="<?php echo $umaObra->getIdObra(); ?>" hidden />
                                <button id="excluirObra" type="submit" name="excluirObra">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
<?php       } ?>
        </body>
        </html>
<?php
    }
?>