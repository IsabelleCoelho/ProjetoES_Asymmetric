<?php
    if (isset($_POST['attCliente'])) {
        if (!empty($_FILES['foto']['name'])) {
            include("globalVariables.php");
            $img = basename($_FILES['foto']['name']);
            $imgName = $img;
            $imgDir = IMG_USER_PATH.$img;
            $imgType = strtolower(pathinfo($imgDir, PATHINFO_EXTENSION));
            if (($imgType != "jpg" && $imgType != "png")) die("O arquivo nao e' uma imagem ou não atende aos formatos PNG, SVG ou JPG!");
            else {
                $i = 0;
                while (file_exists($imgDir)) {
                    $str_array = explode('.'.$imgType, $img);
                    $imgName = $str_array[0].'('.$i.').'.$imgType;
                    $imgDir = IMG_OBRAS_PATH.$imgName;
                    ++$i;
                }
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $imgDir) === false) die("Nao foi possivel fazer o upload da imagem!");
                else unlink(IMG_USER_PATH.$_POST['bkpFoto']);
            }
        } else
            $imgName = $_POST['bkpFoto'];
        include("../Model/Cliente.php");
        include("../Persistence/ClienteDAO.php");
        include("../Persistence/Connection.php");
        session_start();
        $cliente = new Cliente();
        $cliente->construtor($_SESSION['usrId'], "", $_POST['nome'], $_POST['email'], $_POST['estado'], $_POST['cidade'], $_POST['bairro'], $_POST['rua'], $_POST['numResidencia'], $imgName);
        if (isset($_POST['senha']))
            $cliente->setSenha(md5("A1ENCTYPE092".$_POST['senha']));
        else
            $cliente->setSenha($_POST['bkpSenha']);
        $connection = new Connection();
        $con = $connection->openConnection();
        $clienteDao = new ClienteDAO();
        $res = $clienteDao->alterar($con, $cliente);
        $connection->closeConnection();
        if ($res === 0)
            header("Location: ../View/perfil.php");
        else {
            if (!empty($_FILES['foto']['name'])) unlink($imgDir);
            $_SESSION['err'] = $res;
            header("Location: ../View/editar-dados.php");
        }
    }
?>