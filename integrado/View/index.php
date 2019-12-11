<?php
    session_start();
    if (isset($_SESSION['usrId'])) {
        include("../Model/Obra.php");
        include("../Persistence/ObraDAO.php");
        include("../Persistence/Connection.php");
        $connection = new Connection();
        $con = $connection->openConnection();
        $obra = new ObraDAO();
        $obras = $obra->recuperarTodasObras($con);
        $connection->closeConnection();
?>

        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <link rel="stylesheet" href="CSS/styleIndex.css">
        </head>
        <body>
            <header>
                <div class=botaoPerfil>
                    <a href="perfil.php"><img class="perfil" src="Assets/userDefault.svg" alt="perfil"></a>
                </div>
                <div class=botaoSair>
                    <img class="sair" src="Assets/sair.svg" alt="sair" aligm="center">
                </div>
                <a href="index.html">
                    <img class="logo1" src="Assets/logo1.svg" alt="logo1">
                </a>
                <div class=botaoHistorico>
                    <a href="historicoCompras.php"><img class="historico" src="Assets/historico.svg" alt="historico"></a>
                </div>
                <div class=botaoCarrinho>
                    <img class="carrinho" src="Assets/carrinho.svg" alt="carrinho">
                </div>
            </header>
            <div class="container">
                <div class="imagem">
                    <h1 id="titulo">O pensador</h1><br>
                    <img class="pensadorImg" src="Assets/pensador.svg" alt="pensadorImg">
                </div>
                <div class="descricao">
                    <h1>Escultura "O pensador"</h1><br>
                    <h2>Artista:<br>
                        Local:<br>
                        Material<br>
                        Valor Estimado<br>
                        Altura:<br>
                        Largura:<br>
                        xx.xx$<br>
                    </h2><br>
                    <button type="button">Comprar</button>
                </div>
            </div>
        </body>
        </html>
<?php
    } else {
        header("Location: login.php");
    }
?>