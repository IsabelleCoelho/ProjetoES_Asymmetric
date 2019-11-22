<?php
    include("obraClass.php");
    $obra = new Obra();
    $obras = $obra->recuperarTodasObras();
?>

<html>
    <head>
        <title>Listar todas obras</title>
    </head>
    <body>
        <div style="padding-left:20%; padding-right:20%;">
<?php       foreach ($obras as $umaObra) { ?>
                <div style="display:inline-block; border:2px solid black; width:150px; height:200px; background-color:grey; padding-left:10px;">
                    <img src="<?php echo 'uploads/obras/'.$umaObra->getFoto(); ?>" style="margin-left:20px; margin-top:5px; width:100px; height:100px;" /><br/>
                    <h1 style="margin-top:2px; margin-bottom:0px;"><?php echo $umaObra->getNomeObra(); ?></h1><br/>
                    <div style="display:inline-block;">
                        <form method="POST" action="atualizarObra.php">
                            <input type="number" name="idObra" value="<?php echo $umaObra->getIdObra(); ?>" hidden />
                            <input type="submit" name="atualizarObra" style="background-image:url('imgs/edit2.png'); width:25px; height:25px; border : none; color : transparent;" />
                        </form>
                    </div>
                    <div style="display:inline-block; margin-left:15px;">
                        <form method="POST" action="excluirObra.php">
                            <input type="text" name="foto" value="<?php echo $umaObra->getFoto(); ?>" hidden />
                            <input type="number" name="idObra" value="<?php echo $umaObra->getIdObra(); ?>" hidden />
                            <input type="submit" name="excluirObra" style="background-image:url('imgs/delete2.png'); width:25px; height:25px; border : none; color : transparent;" />
                        </form>
                    </div>
                </div>
<?php       } ?>
        </div>
    </body>
</html>