<?php
    if (isset($_POST['enviarCliente'])) {
        if (!empty($_FILES['foto']['name'])) {
            include("globalVariables.php");
            $img = basename($_FILES['foto']['name']);
            $imgDir = IMG_USER_PATH.$img;
            $imgType = strtolower(pathinfo($imgDir, PATHINFO_EXTENSION));
            $nameAux = basename($_FILES['foto']['name'], '.'.$imgType);
            if (($imgType != "jpg" && $imgType != "png")) die("O arquivo nao e' uma imagem ou não atende aos formatos PNG, SVG ou JPG!");
            else {
                $i = 0;
                while (file_exists($imgDir)) {
                    $imgName = $nameAux.'('.$i.').'.$imgType;
                    $imgDir = IMG_USER_PATH.$imgName;
                    ++$i;
                }
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $imgDir) === false) die("Nao foi possivel fazer o upload da imagem!");
            }
        } else
            $imgName = "default.png";
        include("../Model/Cliente.php");
        include("../Persistence/ClienteDAO.php");
        include("../Persistence/Connection.php");
        $cliente = new Cliente();
        $cliente->construtor(0, $_POST['cpf'], $_POST['nome'], $_POST['email'], $_POST['estado'], $_POST['cidade'], $_POST['bairro'], $_POST['rua'], $_POST['numResidencia'], $imgName);
        $cliente->setSenha(md5("A1ENCTYPE092".$_POST['senha']));
        $connection = new Connection();
        $con = $connection->openConnection();
        $clienteDao = new ClienteDAO();
        $res = $clienteDao->inserir($con, $cliente);
        $connection->closeConnection();
        session_start();
        if ($res === 0) {
            $_SESSION['success'] = 1;
            header("Location: ../View/login.php");
        } else {
            if (isset($imgDir)) unlink($imgDir);
            $_SESSION['err'] = $res;
            header("Location: ../View/cadastro.php");
        }
    }
?>