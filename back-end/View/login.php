<?php session_start(); ?>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <form method="POST" action="../Controller/login.php">
<?php       if (isset($_SESSION['err'])) {
                echo '<p style="color: red;">CPF ou senha invalidos!</p>';
                unset($_SESSION['err']);
            } ?>
            <label>CPF: </label>
            <input type="text" name="cpf" autocomplete="off" required /><br/>
            <label>Senha: </label>
            <input type="password" name="senha" autocomplete="new-password" required /><br/><br/>
            <input type="submit" name="login" value="Entrar" />
        </form>
    </body>
</html>
