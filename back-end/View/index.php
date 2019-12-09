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

        <html>
            <head>
                <title>Inicio</title>
            </head>
            <body style="margin-top:0px;">
                <div style="padding-left:20%; padding-right:20%;">
                    <div style="width:100%; height:30px; background-color:grey; margin-bottom:10px;">
                        <a href="editar-dados.php" style="color:white; margin-left:10%;">Perfil</a>
<?php                   if (isset($_SESSION['carrinho'])) {
                            echo '<a href="carrinho.php" style="color:white; margin-left:20%;">Carrinho: '.count($_SESSION['carrinho']).' itens</a>';
                        } else {
                            echo '<a href="carrinho.php" style="color:white; margin-left:20%;">Carrinho vazio.</a>';
                        } ?>
                        <a href="../Controller/Logout.php" style="color:white; margin-right:10%; float:right;">Logout</a>
                    </div>
<?php               foreach ($obras as $umaObra) {
                        if ($umaObra->getEstoque() > 0) { ?>
                            <div style="display:inline-block; border:2px solid black; width:150px; height:200px; background-color:grey; padding-left:10px;">
                                <img src="<?php echo "../uploads/obras/".$umaObra->getFoto(); ?>" style="margin-left:20px; margin-top:5px; width:100px; height:100px;" /><br/>
                                <h2 style="margin-top:2px; margin-bottom:0px;"><?php echo $umaObra->getNomeObra(); ?></h2><br/>
<?php                           if (isset($_SESSION['carrinho'])) {
                                    $item = array_column($_SESSION['carrinho'], 'id');
                                    if (!in_array($umaObra->getIdObra(), $item)) { ?>
                                        <div style="display:inline-block;">
                                            <form method="POST" action="../Controller/Carrinho.php">
                                                <input type="text" name="acaoCarrinho" value="add" hidden />
                                                <input type="number" name="idObra" value="<?php echo $umaObra->getIdObra(); ?>" hidden />
                                                <input type="submit" name="enviar" value="+" style="width:20px; height:20px; background-color:green; color:white;" />
                                            </form>
                                        </div>
<?php                               } else { ?>
                                        <div style="display:inline-block;">
                                            <form method="POST" action="../Controller/Carrinho.php">
                                                <input type="text" name="acaoCarrinho" value="rmvIndex" hidden />
                                                <input type="number" name="idObra" value="<?php echo $umaObra->getIdObra(); ?>" hidden />
                                                <input type="submit" name="enviar" value="-" style="width:20px; height:20px; background-color:red; color:white;" />
                                            </form>
                                        </div>
<?php                               }
                                } else { ?>
                                    <div style="display:inline-block;">
                                        <form method="POST" action="../Controller/Carrinho.php">
                                            <input type="text" name="acaoCarrinho" value="add" hidden />
                                            <input type="number" name="idObra" value="<?php echo $umaObra->getIdObra(); ?>" hidden />
                                            <input type="submit" name="enviar" value="+" style="width:20px; height:20px; background-color:green; color:white;" />
                                        </form>
                                    </div>
<?php                           } ?>
                            </div>
<?php                   }
                    } ?>
                </div>
            </body>
        </html>
<?php
    } else {
        header("Location: login.php");
    }
?>