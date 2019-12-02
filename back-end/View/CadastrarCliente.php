<?php session_start(); ?>
<html>
    <head>
        <title>Cadastrar Cliente</title>
    </head>
    <body>
        <form method="POST" action="../Controller/CadastrarCliente.php" enctype="multipart/form-data">
<?php       if (isset($_SESSION['err'])) {
                if ($_SESSION['err']  === 2)
                    echo '<p style="color: red;">CPF já cadastrado!</p>';
                if ($_SESSION['err']  === 1)
                    echo '<p style="color: red;">Email já cadastrado!</p>';
                unset($_SESSION['err']);
            } ?>
            <label>CPF: </label>
            <input type="text" name="cpf" autocomplete="off" required /><br/>
            <label>Senha: </label>
            <input type="password" name="senha" autocomplete="new-password" required /><br/>
            <label>Nome: </label>
            <input type="text" name="nome" required /><br/>
            <label>Email: </label>
            <input type="text" name="email" required /><br/>
            <label>Estado: </label>
            <input type="text" name="estado" maxlength="2" placeholder="RJ" required /><br/>
            <label>Cidade: </label>
            <input type="text" name="cidade" required /><br/>
            <label>Bairro: </label>
            <input type="text" name="bairro" required /><br/>
            <label>Rua: </label>
            <input type="text" name="rua" required /><br/>
            <label>Numero da residencia: </label>
            <input type="number" name="numResidencia" required /><br/>
            <label>Foto: </label>
            <input type="file" name="foto" /><br/><br/>
            <input type="submit" name="enviarCliente" value="Enviar" />
        </form>
    </body>
</html>
