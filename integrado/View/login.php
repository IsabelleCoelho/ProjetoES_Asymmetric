<?php session_start(); ?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="CSS/styleFormularios.css" />
    </head>
    <body>
        <div class="conteinerFormularioLogin">
            <div id="logo">
                <img class="logo1" src="Assets/logo.png" />
            </div>
            <form id="formulario" method="POST" action="../Controller/login.php">
<?php           if (isset($_SESSION['err'])) {
                    echo '<p style="color:red;">CPF ou senha invalidos!</p>';
                    unset($_SESSION['err']);
                } else if (isset($_SESSION['success'])) {
                    echo '<p style="color:green;">Registrado com sucesso!</p>';
                    unset($_SESSION['success']);
                } ?>
                <h1 class="titulo">Login</h1>
                <div class="input">
                    <div class="input">
                        <label for="text">CPF</label><br>
                        <input type="text" name="cpf" autocomplete="off" required>
                    </div>
                    <div class="input">
                        <label for="text">Senha</label><br>
                        <input type="password" name="senha" autocomplete="new-password" required>
                    </div>
                </div>
                <div id="buttonLogin">
                    <button type="submit" name="login">Login</button>    
                    <a href="cadastro.php"><div class="botaoCancelar">Registrar</div></a>
                </div>
            </form>
        </div>
    </body>
</html>
