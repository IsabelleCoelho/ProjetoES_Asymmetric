<?php
    session_start();
    if (isset($_SESSION['usrId'])) {
        include("../Model/Obra.php");
        include("../Model/Compra.php");
        include("../Model/Comprar.php");
        include("../Persistence/ObraDAO.php");
        include("../Persistence/CompraDAO.php");
        include("../Persistence/ComprarDAO.php");
        include("../Persistence/Connection.php");
        $connection = new Connection();
        $con = $connection->openConnection();
        $compra = new CompraDAO();
        $compras = $compra->recuperarPorCpf();
        $connection->closeConnection();
?>

<?php
    }
?>