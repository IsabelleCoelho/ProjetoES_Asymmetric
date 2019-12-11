<?php
    if (isset($_POST['excluirObra'])) {
        include("../Model/Obra.php");
        include("../Persistence/ObraDAO.php");
        include("../Persistence/Connection.php");
        include("globalVariables.php");
        $obra = new Obra();
        $obra->setIdObra($_POST['idObra']);
        unlink(IMG_OBRAS_PATH.$_POST['foto']);
        $connection = new Connection();
        $con = $connection->openConnection();
        $obraDAO = new ObraDAO();
        $obraDAO->excluir($con, $obra);
        $connection->closeConnection();
        header("Location: ../View/admin-page.php");
    } else
        echo "Nao eh possivel excluir uma obra inexistente!";
?>