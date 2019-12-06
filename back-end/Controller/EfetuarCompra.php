<?php 
    if (isset($_POST['enviar']) && $_POST['acaoCarrinho'] == "comprar") {
        include("../Model/Compra.php");
        include("../Model/Cliente.php");
        include("../Model/Comprar.php");
        include("../Persistence/CompraDAO.php");
        include("../Persistence/ClienteDAO.php");
        include("../Persistence/ComprarDAO.php");
        include("../Persistence/Connection.php");
        session_start();
        $cliente = new Cliente();
        $cliente->setIdCliente($_SESSION['usrId']);
        $connection = new Connection();
        $con = $connection->openConnection();
        $clienteDao = new ClienteDAO();
        $clienteDao->recuperar($con, $cliente);
        $cpfCliente = $cliente->getCpf();
        if (!empty($_POST['cpfDest'])) {
            $clienteDest = new Cliente();
            $clienteDest->setCpf($_POST['cpfDest']);
            if ($clienteDao->recuperarPorCpf($con, $clienteDest))
                $cpfDest = $_POST['cpfDest'];
            else
                $cpfDest = $cpfCliente;
        } else
            $cpfDest = $cpfCliente;
        $compra = new Compra();
        $compra->setCpfCliente($cpfCliente);
        $compra->setCpfDestinatario($cpfDest);
        $compra->setDataCompra();
        $compraDao = new CompraDAO();
        $compraDao->inserir($con, $compra);
        $idCompra = $compraDao->recuperarIdCompraAtual();
        $comprar = new Comprar();
        $comprarDao = new ComprarDAO();
        foreach ($_SESSION['carrinho'] as $cartItem) {
            $comprar->construtor($idCompra, $cartItem['id'], $cartItem['qntd']);
            $comprarDao->inserir($con, $comprar);
        }
        $connection->closeConnection();
        header("Location: ../View/index.php");
    }
?>