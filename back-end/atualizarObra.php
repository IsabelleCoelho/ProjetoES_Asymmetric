<?php
    if(isset($_POST['atualizarObra'])) {
        if (isset($_POST['enviarObra'])) {
            if (!empty($_FILES['foto']['name'])) {
                include("globalVariables.php");
                $img = basename($_FILES['foto']['name']);
                $imgName = $img;
                $imgDir = IMG_OBRAS_PATH.$img;
                $imgType = strtolower(pathinfo($imgDir, PATHINFO_EXTENSION));
                if (getimagesize($_FILES['foto']["tmp_name"]) === false || ($imgType != "jpg" && $imgType != "png" && $imgType != "svg")) die("O arquivo nao e' uma imagem ou não atende aos formatos PNG, SVG ou JPG!");
                else {
                    $i = 0;
                    while (file_exists($imgDir)) {
                        $str_array = explode('.'.$imgType, $img);
                        $imgName = $str_array[0].'('.++$i.').'.$imgType;
                        $imgDir = IMG_OBRAS_PATH.$imgName;
                    }
                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $imgDir) === false) echo "Nao foi possivel fazer o upload da imagem!";
                    else unlink(IMG_OBRAS_PATH.$_POST['bkpFoto']);
                }
            } else
                $imgName = $_POST['bkpFoto'];
            include("obraClass.php");
            $obraAtual = new Obra();
            $obraAtual->construtor($_POST['idObra'], $_POST['nomeObra'], $_POST['valorEstimado'], $_POST['material'], $_POST['local'], $_POST['nomeAutor'], $imgName, $_POST['altura'], $_POST['largura'], $_POST['tipoFundo']);
            $obraAtual->atualizarObra();
            header("Location: listarTodasObras.php");
        } else {
            include("obraClass.php");
            $obraAtual = new Obra();
            $obraAtual->setIdObra($_POST['idObra']);
            $obraAtual->recuperarObra();
?>
            <html>
                <head>
                    <title>Atualizar obra</title>
                </head>
                <body>
                    <form method="POST" action="#" enctype="multipart/form-data">
                        <label>Nome da obra: </label>
                        <input type="text" name="nomeObra" value="<?php echo $obraAtual->getNomeObra(); ?>" /><br/>
                        <label>Valor estimado: </label>
                        <input type="number" name="valorEstimado" value="<?php echo $obraAtual->getValorEstimado(); ?>" /><br/>
                        <label>Material: </label>
                        <input type="text" name="material" value="<?php echo $obraAtual->getMaterial(); ?>" /><br/>
                        <label>Local: </label>
                        <input type="text" name="local" value="<?php echo $obraAtual->getLocal(); ?>" /><br/>
                        <label>Nome do Autor: </label>
                        <input type="text" name="nomeAutor" value="<?php echo $obraAtual->getNomeAutor(); ?>" /> <br/>
                        <label>Foto: </label>
                        <input type="text" name="bkpFoto" value="<?php echo $obraAtual->getFoto(); ?>" hidden />
                        <input type="file" name="foto" /><br/>
                        <label>Altura: </label>
                        <input type="number" step="0.01" name="altura" value="<?php echo $obraAtual->getAltura(); ?>" /><br/>
                        <label>Largura: </label>
                        <input type="number" step="0.01" name="largura" value="<?php echo $obraAtual->getLargura(); ?>" /><br/>
                        <label>Tipo de fundo: </label><br/>
<?php                   $tipoFundo = $obraAtual->getTipoFundo();
                        if ($tipoFundo == 1) { ?>
                            <input type="radio" name="tipoFundo" value="1" checked> Tipo 1<br/>
                            <input type="radio" name="tipoFundo" value="2"> Tipo 2<br/>
                            <input type="radio" name="tipoFundo" value="3"> Tipo 3<br/><br/>
<?php                   } else if ($tipoFundo == 2) { ?>
                            <input type="radio" name="tipoFundo" value="1"> Tipo 1<br/>
                            <input type="radio" name="tipoFundo" value="2" checked> Tipo 2<br/>
                            <input type="radio" name="tipoFundo" value="3"> Tipo 3<br/><br/>
<?php                   } else { ?>
                            <input type="radio" name="tipoFundo" value="1"> Tipo 1<br/>
                            <input type="radio" name="tipoFundo" value="2"> Tipo 2<br/>
                            <input type="radio" name="tipoFundo" value="3" checked> Tipo 3<br/><br/>
<?php                   } ?>
                        <input type="number" name="idObra" value="<?php echo $_POST['idObra']; ?>" hidden />
                        <input type="text" name="atualizarObra" hidden />
                        <input type="submit" name="enviarObra" value="Enviar" />
                    </form>
                </body>
            </html>
<?php   }
    } else {
        echo "Nao eh possivel editar uma obra inexistente!";
    }
?>
