<?php
    session_start();
    if (isset($_SESSION['usrId'])) {
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
            <link rel="stylesheet" href="CSS/styleIndex.css">
        </head>
        <body>
            <header>
                <div class=botaoPerfil>
                    <a href="perfil.php"><img class="perfil" src="Assets/userDefault.svg" alt="perfil"></a>
                </div>
                <div class=botaoSair>
                    <a href="../Controller/Logout.php"><img class="sair" src="Assets/sair.svg" alt="sair" aligm="center"></a>
                </div>
                <a href="index.html">
                    <a href="index.php"><img class="logo1" src="Assets/logo1.svg" alt="logo1"></a>
                </a>
                <div class=botaoHistorico>
                    <a href="historicoCompras.php"><img class="historico" src="Assets/historico.svg" alt="historico"></a>
                </div>
                <div class=botaoCarrinho>
                    <a href="carrinho.php"><img class="carrinho" src="Assets/carrinho.svg" alt="carrinho"></a>
                </div>
            </header>
<?php       foreach ($obras as $umaObra) {
                if ($umaObra->getEstoque() > 0) { ?>
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
<?php                       if (isset($_SESSION['carrinho'])) {
                                $item = array_column($_SESSION['carrinho'], 'id');
                                if (!in_array($umaObra->getIdObra(), $item)) { ?>
                                    <div style="display:inline-block;">
                                        <form method="POST" action="../Controller/Carrinho.php">
                                            <input type="text" name="acaoCarrinho" value="add" hidden />
                                            <input type="number" name="idObra" value="<?php echo $umaObra->getIdObra(); ?>" hidden />
                                            <button type="submit" name="enviar">Adicionar ao Carrinho</button>     
                                        </form>
                                    </div>
<?php                               } else { ?>
                                        <div style="display:inline-block;">
                                            <form method="POST" action="../Controller/Carrinho.php">
                                                <input type="text" name="acaoCarrinho" value="rmvIndex" hidden />
                                                <input type="number" name="idObra" value="<?php echo $umaObra->getIdObra(); ?>" hidden />
                                                <button type="submit" name="enviar">Remover ao Carrinho</button>   
                                            </form>
                                        </div>
<?php                               }
                                } else { ?>
                                    <div style="display:inline-block;">
                                        <form method="POST" action="../Controller/Carrinho.php">
                                            <input type="text" name="acaoCarrinho" value="add" hidden />
                                            <input type="number" name="idObra" value="<?php echo $umaObra->getIdObra(); ?>" hidden />
                                            <button type="submit" name="enviar">Adicionar ao Carrinho</button>
                                        </form>
                                    </div>
<?php                           } ?>
                        </div>
                    </div>
<?php           }
            } ?>
        </body>
        </html>
<?php
    }
?>