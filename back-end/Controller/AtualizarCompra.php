<?php
    if (isset($_POST['atualizarCompra'])) {
        include("../Model/Compra.php");
        include("../Model/Cliente.php");
        include("../Persistence/CompraDAO.php");
        include("../Persistence/ClienteDAO.php");
        include("../Persistence/Connection.php");
        $clienteDest = new Cliente();
        $clienteDest->setCpf($_POST['cpfDest']);
        $connection = new Connection();
        $con = $connection->openConnection();
        $clienteDao = new ClienteDAO();
        if ($clienteDao->recuperarPorCpf($con, $clienteDest)) {
            $compra = new Compra();
            $compra->setIdCompra($_POST['idCompra']);
            $compra->setCpfDestinatario($_POST['cpfDest']);
            $connection = new Connection();
            $con = $connection->openConnection();
            $compraDao = new CompraDAO();
            $compraDao->alterar($con, $compra);
            $connection->closeConnection();
        }
        header("Location: ../View/historicoCompras.php");
    }
?>