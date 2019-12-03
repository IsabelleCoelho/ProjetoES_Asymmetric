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
                        <a href="editar-dados.php" style="margin-left:33%;">Perfil</a>
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
                                <form method="POST" action="excluirObra.php">
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
    }
?>