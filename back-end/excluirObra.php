<?php
    if (isset($_POST['excluirObra'])) {
        include("obraClass.php");
        include("globalVariables.php");
        $obra = new Obra();
        $obra->setIdObra($_POST['idObra']);
        unlink(IMG_OBRAS_PATH.$_POST['foto']);
        $obra->excluirObra();
        header("Location: listarTodasObras.php");
    } else
        echo "Nao eh possivel excluir uma obra inexistente!";
?>