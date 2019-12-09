<?php
    session_start();
    if (isset($_SESSION['usrId'])) {
        include("../Model/Obra.php");
        include("../Model/Compra.php");
        include("../Model/Comprar.php");
        include("../Persistence/ObraDAO.php");
        include("../Persistence/CompraDAO.php");
        include("../Persistence/ComprarDAO.php");
        include("../Persistence/Connection.php");
        $compra = new Compra();
        $compra->setIdCliente($_SESSION['usrId']);
        $connection = new Connection();
        $con = $connection->openConnection();
        $compraDao = new CompraDAO();
        $compras = $compraDao->recuperarCompras($con, $compra);
        $comprar = new Comprar();
        $comprarDao = new ComprarDAO();
        $i = 0;
        foreach ($compras as $umaCompra) {
            $comprar->setIdCompra($umaCompra->getIdCompra());
            $carrinho = $comprarDao->recuperar($con, $umaCompra);
            ++$i;
        }
?>
        <html>
            <head>
                <title>Historico</title>
            </head>
            <body>
                <div style="padding-left:20%; padding-right:20%;">
                    <div style="width:100%; height:30px; background-color:grey; margin-bottom:10px;">
                        <a href="../Controller/Logout.php" style="color:white; margin-left:66%;">Logout</a>
                    </div>
<?php               foreach ($obras as $umaObra) { ?>
                        <div style="display:inline-block; border:2px solid black; width:150px; height:200px; background-color:grey; padding-left:10px;">
                            <img src="<?php echo "../uploads/obras/".$umaObra->getFoto(); ?>" style="margin-left:20px; margin-top:5px; width:100px; height:100px;" /><br/>
                            <h2 style="margin-top:2px; margin-bottom:0px;"><?php echo $umaObra->getNomeObra(); ?></h2><br/>
                            <div style="display:inline-block;">
                                <form method="POST" action="atualizarObra.php">
                                    <input type="number" name="idObra" value="<?php echo $umaObra->getIdObra(); ?>" hidden />
                                    <input type="submit" name="atualizarObra" style="background-image:url('../imgs/edit2.png'); width:25px; height:25px; border : none; color : transparent;" />
                                </form>
                            </div>
                            <div style="display:inline-block; margin-left:15px;">
                                <form method="POST" action="../Controller/excluirObra.php">
                                    <input type="text" name="foto" value="<?php echo $umaObra->getFoto(); ?>" hidden />
                                    <input type="number" name="idObra" value="<?php echo $umaObra->getIdObra(); ?>" hidden />
                                    <input type="submit" name="excluirObra" style="background-image:url('../imgs/delete2.png'); width:25px; height:25px; border : none; color : transparent;" />
                                </form>
                            </div>
                        </div>
<?php               } ?>
                    <a href="cadastrarObra.php">
                        <div style="display:inline-block; border:2px solid black; width:150px; height:200px; background-color:white; padding-left:10px;">
                            <br/><br/><br/><br/><h1 style="margin-top:2px; margin-bottom:3px; margin-left:55px;">+</h1><br/><br/><br/>
                        </div>
                    </a>
                </div>
            </body>
        </html>
<?php
        $connection->closeConnection();
    }
?>