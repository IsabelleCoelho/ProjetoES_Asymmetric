<?php
    if (isset($_POST['enviarObra'])) {
        if (!empty($_FILES['foto']['name'])) {
            include("globalVariables.php");
            $img = basename($_FILES['foto']['name']);
            $imgDir = IMG_OBRAS_PATH.$img;
            $imgType = strtolower(pathinfo($imgDir, PATHINFO_EXTENSION));
            $nameAux = basename($_FILES['foto']['name'], '.'.$imgType);
            if (($imgType != "jpg" && $imgType != "png" && $imgType != "svg")) die("O arquivo nao e' uma imagem ou não atende aos formatos PNG, SVG ou JPG!");
            else {
                $i = 0;
                while (file_exists($imgDir)) {
                    $imgName = $nameAux.'('.$i.').'.$imgType;
                    $imgDir = IMG_OBRAS_PATH.$imgName;
                    ++$i;
                }
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $imgDir) === false) die("Nao foi possivel fazer o upload da imagem!");
                else unlink(IMG_OBRAS_PATH.$_POST['bkpFoto']);
            }
        } else
            $imgName = $_POST['bkpFoto'];
        include("../Model/Obra.php");
        include("../Persistence/ObraDAO.php");
        include("../Persistence/Connection.php");
        $obraAtual = new Obra();
        $obraAtual->construtor($_POST['idObra'], $_POST['nomeObra'], $_POST['valorEstimado'], $_POST['material'], $_POST['local'], $_POST['nomeAutor'], $imgName, $_POST['altura'], $_POST['largura'], $_POST['estoque']);
        $connection = new Connection();
        $con = $connection->openConnection();
        $obra = new ObraDAO();
        $obra->alterar($con, $obraAtual);
        $connection->closeConnection();
        header("Location: ../View/admin-page.php");
    }
?>