<?php
   if (isset($_POST['nomeObra'])) {
       $con = mysqli_connect("127.0.0.1", "root", "", "asymmetric");
       $query = "INSERT INTO obra(nomeObra, valorEstimado, material, local, nomeAutor, foto, altura, largura) VALUES ('".$_POST['nomeObra']."', ".$_POST['valorEstimado'].", '".$_POST['material']."', '".$_POST['local']."', '".$_POST['nomeAutor']."', '".$_POST['foto']."', ".$_POST['altura'].", ".$_POST['largura'].");";
       $execute = mysqli_query($con, $query);
       echo $_POST['valorEstimado'];
   }
?>

<html>
    <head>
        <title>Oiii</title>
    </head>
    <body >
        <form method="POST" action="#">
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
            <input type="text" name="foto" /><br/>
            <label>Altura: </label>
            <input type="number" step="0.01" placeholder="3.75" name="altura" /><br/>
            <label>Largura: </label>
            <input type="number" step="0.01" placeholder="3.75" name="largura" /><br/><br/>
            <input type="submit" value="Enviar" />
        </form>
    </body>
</html>