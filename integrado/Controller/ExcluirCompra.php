<?php
    if (isset($_POST['excluirCompra'])) {
        include("../Model/Compra.php");
        include("../Model/Comprar.php");
        include("../Model/Obra.php");
        include("../Persistence/CompraDAO.php");
        include("../Persistence/ComprarDAO.php");
        include("../Persistence/ObraDAO.php");
        include("../Persistence/Connection.php");
        session_start();
        $compra = new Compra();
        $compra->setIdCompra($_POST['idCompra']);
        $comprar = new Comprar();
        $comprar->setIdCompra($_POST['idCompra']);
        $obra = new Obra();
        $connection = new Connection();
        $con = $connection->openConnection();
        $comprarDao = new ComprarDAO();
        $carrinho = $comprarDao->recuperar($con, $comprar);
        $obraDao = new ObraDAO();
        foreach ($carrinho as $item) {
            $obra->setIdObra($item['idObra']);
            $obra->setEstoque($item['qntd']);
            $obraDao->restaurarEstoque($con, $obra);
        }
        $compraDao = new CompraDAO();
        $compraDao->excluir($con, $compra);
        $connection->closeConnection();
        header("Location: ../View/historicoCompras.php");
    }
?>