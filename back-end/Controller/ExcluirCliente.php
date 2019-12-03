<?php
    if (isset($_POST['excluirCliente'])) {
        include("globalVariables.php");
        include("../Model/Cliente.php");
        include("../Persistence/ClienteDAO.php");
        include("../Persistence/Connection.php");
        session_start();
        $cliente = new Cliente();
        $cliente->setIdCliente($_SESSION['usrId']);
        $connection = new Connection();
        $con = $connection->openConnection();
        $clienteDao = new ClienteDAO();
        $clienteDao->excluir($con, $cliente);
        $connection->closeConnection();
        unset($_SESSION['usrId']);
        if ($_POST['bkpFoto'] != "default.png") unlink(IMG_USER_PATH.$_POST['bkpFoto']);
        header("Location: ../View/login.php");
    }
?>