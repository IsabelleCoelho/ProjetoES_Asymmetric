<?php
    if(isset($_POST['atualizarObra'])) {
        include("../Model/Obra.php");
        include("../Persistence/ObraDAO.php");
        include("../Persistence/Connection.php");
        $obraAtual = new Obra();
        $obraAtual->setIdObra($_POST['idObra']);
        $connection = new Connection();
        $con = $connection->openConnection();
        $obra = new ObraDAO();
        $obra->recuperar($con, $obraAtual);
        $connection->closeConnection();
?>
        <html>
            <head>
                <title>Atualizar obra</title>
            </head>
            <body>
                <form method="POST" action="../Controller/AtualizarObra.php" enctype="multipart/form-data">
                    <label>Nome da obra: </label>
                    <input type="text" name="nomeObra" value="<?php echo $obraAtual->getNomeObra(); ?>" required /><br/>
                    <label>Valor estimado: </label>
                    <input type="number" name="valorEstimado" value="<?php echo $obraAtual->getValorEstimado(); ?>" required /><br/>
                    <label>Material: </label>
                    <input type="text" name="material" value="<?php echo $obraAtual->getMaterial(); ?>" required /><br/>
                    <label>Local: </label>
                    <input type="text" name="local" value="<?php echo $obraAtual->getLocal(); ?>" required /><br/>
                    <label>Nome do Autor: </label>
                    <input type="text" name="nomeAutor" value="<?php echo $obraAtual->getNomeAutor(); ?>" required /> <br/>
                    <label>Foto: </label>
                    <input type="text" name="bkpFoto" value="<?php echo $obraAtual->getFoto(); ?>" hidden />
                    <input type="file" name="foto" /><br/>
                    <label>Altura: </label>
                    <input type="number" step="0.01" name="altura" value="<?php echo $obraAtual->getAltura(); ?>" required /><br/>
                    <label>Largura: </label>
                    <input type="number" step="0.01" name="largura" value="<?php echo $obraAtual->getLargura(); ?>" required /><br/>
                    <label>Estoque: </label>
                    <input type="number", name="estoque" value="<?php echo $obraAtual->getEstoque(); required ?>" /><br/>
                    <input type="number" name="idObra" value="<?php echo $_POST['idObra']; ?>" hidden />
                    <input type="submit" name="enviarObra" value="Enviar" />
                </form>
            </body>
        </html>
<?php
    } else {
        echo "Nao eh possivel editar uma obra inexistente!";
    }
?>
