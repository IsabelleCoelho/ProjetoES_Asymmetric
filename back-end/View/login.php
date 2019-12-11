<?php session_start(); ?>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <form method="POST" action="../Controller/login.php">
<?php       if (isset($_SESSION['err'])) {
                echo '<p style="color:red;">CPF ou senha invalidos!</p>';
                unset($_SESSION['err']);
            } else if (isset($_SESSION['success'])) {
                echo '<p style="color:green;">Registrado com sucesso!</p>';
                unset($_SESSION['success']);
            } ?>
            <label>CPF: </label>
            <input type="text" name="cpf" autocomplete="off" required /><br/>
            <label>Senha: </label>
            <input type="password" name="senha" autocomplete="new-password" required /><br/><br/>
            <input type="submit" name="login" value="Entrar" />
            <a href="cadastro.php">Registrar-se</a>
        </form>
    </body>
</html>
