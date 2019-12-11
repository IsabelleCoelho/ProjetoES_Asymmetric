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
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <link rel="stylesheet" href="CSS/stylePerfil.css">
        </head>
        <body>
            <header>
                <div class=botaoPerfil>
                    <img class="perfil" src="Assets/userDefault.svg" alt="perfil">
                </div>
                <div class=botaoSair>
                    <img class="sair" src="Assets/sair.svg" alt="sair" aligm="center">
                </div>
                <a href="index.html">
                    <img class="logo1" src="Assets/logo1.svg" alt="logo1">
                </a>
                <div class=botaoHistorico>
                    <img class="historico" src="Assets/historico.svg" alt="historico">
                </div>
                <div class=botaoCarrinho>
                    <img class="carrinho" src="Assets/carrinho.svg" alt="carrinho">
                </div>
            </header>
            <h1 class="titulo">Perfil</h1>
            <div class="container">
                <form id="formulario" method="POST" action="*">
                    <div class="input">
                        <label for="text">Nome</label><br>
                        <input type="nome" name="nome" value ="<?php echo $clienteAtual->getNome(); ?>" disabled>
                    </div>
                    <div class="input">
                        <label for="email">E-mail</label><br>
                        <input type="email" name="email" value="<?php echo $clienteAtual->getEmail(); ?>" disabled>
                    </div>
                    <div class="input">
                        <label for="text">CPF</label><br>
                        <input type="text" name="cpf" value="<?php echo $clienteAtual->getCpf(); ?>" disabled>
                    </div>
                </form>
                <div id="foto">
                    <img class="imgdefault" src="<?php echo "../uploads/users/".$clienteAtual->getFoto(); ?>">
                </div>
                <div id="buttonLogin">
                    <button id="botaoAlterar" type="push">Alterar</button>
                    <form method="POST" action="../Controller/ExcluirCliente.php">
                        <input type="text" name="bkpFoto" value="<?php echo $clienteAtual->getFoto(); ?>" hidden />
                        <button type="submit" id="botaoAlterar" name="excluirCliente">Excluir</button>
                    </form>
                </div>
            </div>
        </body>
<?php
    }
?>