<?php
    if (isset($_POST['enviarObra'])) {
        include("globalVariables.php");
        $imgName = basename($_FILES['foto']['name']);
        $imgDir = IMG_OBRAS_PATH.$imgName;
        $imgType = strtolower(pathinfo($imgDir, PATHINFO_EXTENSION));
        if (getimagesize($_FILES['foto']["tmp_name"]) === false || ($imgType != "jpg" && $imgType != "png" && $imgType != "svg")) die("O arquivo nao e' uma imagem ou não atende aos formatos PNG, SVG ou JPG!");
        else {
            $i = 0;
            while (file_exists($imgDir)) {
                $str_array = explode('.'.$imgType, $imgName);
                $imgName = $str_array[0].'('.++$i.').'.$imgType;
                $imgDir = IMG_OBRAS_PATH.$imgName;
            }
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $imgDir) === false) echo "Nao foi possivel fazer o upload da imagem!";
            else {
                include("obraClass.php");
                $obra = new Obra();
                $obra->construtor(0, $_POST['nomeObra'], $_POST['valorEstimado'], $_POST['material'], $_POST['local'], $_POST['nomeAutor'], $imgName, $_POST['altura'], $_POST['largura'], $_POST['tipoFundo']);
                header("Location: listarTodasObras.php");
            }
        }
    }
?>

<html>
    <head>
        <title>Cadastrar obra</title>
    </head>
    <body>
        <form method="POST" action="#" enctype="multipart/form-data">
            <?php
                if(isset($inserido)) {
                    if ($inserido == false) echo "<p style='color:red;'>Nao inseriu!</p><br/>";
                    else echo "<p style='color:green;'>Inseriu!</p><br/>";
                }
            ?>
            <label>Nome da obra: </label>
            <input type="text" name="nomeObra" /><br/>
            <label>Valor estimado: </label>
            <input type="number" name="valorEstimado" /><br/>
            <label>Material: </label>
            <input type="text" name="material" /><br/>
            <label>Local: </label>
            <input type="text" name="local" /><br/>
            <label>Nome do Autor: </label>
            <input type="text" name="nomeAutor" /> <br/>
            <label>Foto: </label>
            <input type="file" name="foto" /><br/>
            <label>Altura: </label>
            <input type="number" step="0.01" placeholder="3.75" name="altura" /><br/>
            <label>Largura: </label>
            <input type="number" step="0.01" placeholder="3.75" name="largura" /><br/>
            <label>Tipo de fundo: </label><br/>
            <input type="radio" name="tipoFundo" value="1" checked> Tipo 1<br/>
            <input type="radio" name="tipoFundo" value="2"> Tipo 2<br/>
            <input type="radio" name="tipoFundo" value="3"> Tipo 3<br/><br/>
            <input type="submit" name="enviarObra" value="Enviar" />
        </form>
    </body>
</html>