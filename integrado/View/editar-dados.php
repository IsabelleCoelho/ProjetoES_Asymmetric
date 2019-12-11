<?php
    session_start();
    if(!isset($_POST['atualizarCliente'])) {
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
                <title>Alterar Dados</title>
            </head>
            <body>
                <form method="POST" action="../Controller/AtualizarCliente.php" enctype="multipart/form-data">
<?php               if (isset($_SESSION['err'])) {
                        if ($_SESSION['err']  === 1)
                            echo '<p style="color: red;">Email já cadastrado!</p>';
                        unset($_SESSION['err']);
                    } ?>
                    <label>Senha: </label>
                    <input type="password" name="senha" autocomplete="new-password" /><br/>
                    <input type="text" name="bkpSenha" value="<?php echo $clienteAtual->getSenha(); ?>" hidden />
                    <label>Nome: </label>
                    <input type="text" name="nome" value="<?php echo $clienteAtual->getNome(); ?>" required /><br/>
                    <label>Email: </label>
                    <input type="text" name="email" value="<?php echo $clienteAtual->getEmail(); ?>" required /><br/>
                    <label>Estado: </label>
                    <input type="text" name="estado" maxlength="2" placeholder="RJ" value="<?php echo $clienteAtual->getEstado(); ?>" required /><br/>
                    <label>Cidade: </label>
                    <input type="text" name="cidade" value="<?php echo $clienteAtual->getCidade(); ?>" required /><br/>
                    <label>Bairro: </label>
                    <input type="text" name="bairro" value="<?php echo $clienteAtual->getBairro(); ?>" required /><br/>
                    <label>Rua: </label>
                    <input type="text" name="rua" value="<?php echo $clienteAtual->getRua(); ?>" required /><br/>
                    <label>Numero da residencia: </label>
                    <input type="number" name="numResidencia" value="<?php echo $clienteAtual->getNumResidencia(); ?>" required /><br/>
                    <label>Foto: </label>
                    <input type="file" name="foto" /><br/><br/>
                    <input type="text" name="bkpFoto" value="<?php echo $clienteAtual->getFoto(); ?>" hidden />
                    <input type="submit" name="attCliente" value="Alterar" />
                </form>
                <form method="POST" action="../Controller/ExcluirCliente.php">
                    <input type="text" name="bkpFoto" value="<?php echo $clienteAtual->getFoto(); ?>" hidden />
                    <input type="submit" name="excluirCliente" value="Excluir conta" />
                </form>
            </body>
        </html>
<?php
    }
?>