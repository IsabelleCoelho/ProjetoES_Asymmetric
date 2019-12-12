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
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="CSS/styleFormularios.css" />
        </head>
        <body>
            <div class="conteinerFormulario">
            <div id="logo">
                <img class="logo1" src="Assets/logo.png" alt="logo1">
            </div>
            <form id="formulario" method="POST" action="../Controller/AtualizarCliente.php" enctype="multipart/form-data">
<?php           if (isset($_SESSION['err'])) {
                    if ($_SESSION['err']  === 1)
                        echo '<p style="color: red;">Email já cadastrado!</p>';
                    unset($_SESSION['err']);
                } ?>
                <h1 class="titulo">Alterar Dados</h1>
                <div class="input">
                <label for="email">E-mail</label><br>
                <input type="email" name="email" value="<?php echo $clienteAtual->getEmail(); ?>" required>
                </div>
                <div class="input">
                <label for="text">Nome</label><br>
                <input type="text" name="nome" value="<?php echo $clienteAtual->getNome(); ?>" required>
                </div>
                <div class="input">
                <label for="password">Senha</label><br>
                <input type="text" name="bkpSenha" value="<?php echo $clienteAtual->getSenha(); ?>" style="display:none;" />
                <input type="password" name="senha" autocomplete="new-password">
                </div>
                <div class="input">
                <label for="file">Foto</label><br>
                <input type="text" name="bkpFoto" value="<?php echo $clienteAtual->getFoto(); ?>" style="display:none;" />
                <input type="file" name="foto">
                </div>
                <div class="input">
                <label for="text">Rua</label><br>
                <input type="text" name="rua" value="<?php echo $clienteAtual->getRua(); ?>" required>
                </div>
                <div class="input">
                <label for="number">Número</label><br>
                <input type="number" name="numResidencia" value="<?php echo $clienteAtual->getNumResidencia(); ?>" required>
                </div>
                <div class="input">
                <label for="text">Bairro</label><br>
                <input type="text" name="bairro" value="<?php echo $clienteAtual->getBairro(); ?>" required>
                </div>
                <div class="input">
                <label for="text">Cidade</label><br>
                <input type="text" name="cidade" value="<?php echo $clienteAtual->getCidade(); ?>" required>
                </div>
                Estado<br><br>
                <select id="estado" name="estado" required>
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
            </select>
                <div id="botoes">
                <a href="perfil.php"><button type="push" style="padding: 8px 18px; margin-right: 20px;">Cancelar</button></a>
                <button type="submit" name="attCliente" style="padding: 8px 18px; margin-right: 20px;">Confirmar</button>
                </div>
            </form>
            </div>
        </body>
        </html>
<?php
    }
?>