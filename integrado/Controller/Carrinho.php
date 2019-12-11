<?php
    session_start();
    if (isset($_SESSION['usrId'])) {
        if (isset($_POST['enviar'])) {
            include("../Model/Obra.php");
            include("../Model/Compra.php");
            include("../Model/Cliente.php");
            include("../Model/Comprar.php");
            include("../Persistence/ObraDAO.php");
            include("../Persistence/CompraDAO.php");
            include("../Persistence/ClienteDAO.php");
            include("../Persistence/ComprarDAO.php");
            include("../Persistence/Connection.php");
            switch ($_POST['acaoCarrinho']) {
                case "add":
                    $obra = new Obra();
                    $obra->setIdObra($_POST['idObra']);
                    $connection = new Connection();
                    $con = $connection->openConnection();
                    $obraDao = new ObraDAO();
                    $obraDao->recuperar($con, $obra);
                    $connection->closeConnection();
                    $item = array(
                        'id' => $obra->getIdObra(),
                        'nome' => $obra->getNomeObra(),
                        'preco' => $obra->getValorEstimado(),
                        'qntd' => 1,
                        'max' => $obra->getEstoque()
                    );
                    if (isset($_SESSION['carrinho'])) {
                        $qntd = count($_SESSION['carrinho']);
                        $_SESSION['carrinho'][$qntd] = $item;
                    } else
                        $_SESSION['carrinho'][0] = $item;
                    header("Location: ../View/index.php");
                    break;
                case "rmvIndex":
                    foreach ($_SESSION['carrinho'] as $chaves => $valores) {
                        if ($valores['id'] === $_POST['idObra'])
                            unset($_SESSION['carrinho'][$chaves]);
                    }
                    if (empty($_SESSION['carrinho'])) unset($_SESSION['carrinho']);
                    header("Location: ../View/index.php");
                    break;
                case "rmvCarPage":
                    foreach ($_SESSION['carrinho'] as $chaves => $valores) {
                        if ($valores['id'] === $_POST['id'])
                            unset($_SESSION['carrinho'][$chaves]);
                    }
                    if (empty($_SESSION['carrinho'])) unset($_SESSION['carrinho']);
                    header("Location: ../View/carrinho.php");
                    break;
                case "empty":
                    unset($_SESSION['carrinho']);
                    header("Location: ../View/index.php");
                    break;
                case "addQtd":
                    foreach ($_SESSION['carrinho'] as $chaves => $valores) {
                        if ($valores['id'] === $_POST['id'])
                            $_SESSION['carrinho'][$chaves]['qntd'] += 1;
                    }
                    header("Location: ../View/carrinho.php");
                    break;
                case "rmvQtd":
                    foreach ($_SESSION['carrinho'] as $chaves => $valores) {
                        if ($valores['id'] === $_POST['id'])
                            $_SESSION['carrinho'][$chaves]['qntd'] -= 1;
                    }
                    header("Location: ../View/carrinho.php");
                    break;
            }
        }
    }
?>