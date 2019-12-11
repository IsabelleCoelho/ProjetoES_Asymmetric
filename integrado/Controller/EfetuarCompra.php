<?php 
    if (isset($_POST['enviar']) && $_POST['acaoCarrinho'] == "comprar") {
        include("../Model/Compra.php");
        include("../Model/Cliente.php");
        include("../Model/Comprar.php");
        include("../Model/Obra.php");
        include("../Persistence/CompraDAO.php");
        include("../Persistence/ClienteDAO.php");
        include("../Persistence/ComprarDAO.php");
        include("../Persistence/ObraDAO.php");
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
        $valorTotal = 0;
        foreach ($_SESSION['carrinho'] as $cartItem)
            $valorTotal += $cartItem['preco']*$cartItem['qntd'];
        $compra = new Compra();
        $compra->construtor($cliente->getIdCliente(), $cpfCliente, $cpfDest, $valorTotal);
        $compraDao = new CompraDAO();
        $compraDao->inserir($con, $compra);
        $idCompra = $compraDao->recuperarIdCompraAtual($con);
        $comprar = new Comprar();
        $obra = new Obra();
        $comprarDao = new ComprarDAO();
        $obraDao = new ObraDAO();
        foreach ($_SESSION['carrinho'] as $cartItem) {
            $obra->setIdObra($cartItem['id']);
            $obra->setEstoque($cartItem['qntd']);
            $comprar->construtor($idCompra, $obra->getIdObra(), $obra->getEstoque());
            $comprarDao->inserir($con, $comprar);
            $obraDao->alterarEstoque($con, $obra);
        }
        $connection->closeConnection();
        unset($_SESSION['carrinho']);
        header("Location: ../View/index.php");
    }
?>