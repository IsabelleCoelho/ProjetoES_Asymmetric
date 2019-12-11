<?php
    session_start();
    if (isset($_SESSION['usrId'])) {
        include("../Model/Cliente.php");
        include("../Persistence/ClienteDAO.php");
        include("../Persistence/Connection.php");
        $clienteAtual = new Cliente();
        $clienteAtual->setIdCliente($_SESSION['usrId']);
        $connection = new Connection();
        $con = $connection->openConnection();
        $cliente = new ClienteDAO();
        $cliente->recuperar($con, $clienteAtual);
        $connection->closeConnection();
?>
        <html>
            <head>
                <title>Perfil</title>
            </head>
            <body>
                <img src="<?php echo "../uploads/users/".$clienteAtual->getFoto(); ?>" style="width:100px; height:100px;" /><br/>
                CPF: 
            </body>
        </html>
<?php
    }
?>