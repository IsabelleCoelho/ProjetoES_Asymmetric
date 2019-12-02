<?php
    if (isset($_POST['login'])) {
        include("../Model/Cliente.php");
        include("../Persistence/ClienteDAO.php");
        include("../Persistence/Connection.php");
        $cliente = new Cliente();
        $cliente->setCpf($_POST['cpf']);
        $cliente->setSenha(md5("A1ENCTYPE092".$_POST['senha']));
        $connection = new Connection();
        $con = $connection->openConnection();
        $clienteDao = new ClienteDAO();
        $res = $clienteDao->login($con, $cliente);
        $connection->closeConnection();
        session_start();
        if ($res === -1) {
            $_SESSION['err'] = 1;
            header("Location: ../View/login.php");
        } else {
            $_SESSION['usrId'] = $res;
            header("Location: ../View/index.php");
        }
    }
?>