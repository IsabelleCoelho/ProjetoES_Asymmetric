<?php
    if (isset($_POST['excluirCompra'])) {
        include("../Model/Compra.php");
        include("../Persistence/CompraDAO.php");
        include("../Persistence/Connection.php");
        $compra = new Compra();
        $compra->setIdCompra($_POST['idCompra']);
        $connection = new Connection();
        $con = $connection->openConnection();
        $compraDao = new CompraDAO();
        $compraDao->excluir($con, $compra);
        $connection->closeConnection();
        header("Location: ../View/historicoCompras.php");
    }
?>