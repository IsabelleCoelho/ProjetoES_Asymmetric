<?php session_start(); ?>
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
      <form id="formulario" method="POST" action="../Controller/CadastrarCliente.php" enctype="multipart/form-data">
<?php       if (isset($_SESSION['err'])) {
                if ($_SESSION['err']  === 2)
                    echo '<p style="color: red;">CPF já cadastrado!</p>';
                if ($_SESSION['err']  === 1)
                    echo '<p style="color: red;">Email já cadastrado!</p>';
                unset($_SESSION['err']);
            } ?>
        <h1 class="titulo">Cadastro</h1>
        <div class="input">
          <label for="email">E-mail</label><br>
          <input type="email" name="email" required>
        </div>
        <div class="input">
          <label for="text">Nome</label><br>
          <input type="text" name="nome" autocomplete="off" required>
        </div>
        <div class="input">
          <label for="password">Senha</label><br>
          <input type="password" name="senha" autocomplete="new-password" required>
        </div>
        <div class="input">
          <label for="text">CPF</label><br>
          <input type="text" name="cpf" required>
        </div>
        <div class="input">
          <label for="file">Foto</label><br>
          <input type="file" name="foto">
        </div>
        <div class="input">
          <label for="text">Rua</label><br>
          <input type="text" name="rua" required>
        </div>
        <div class="input">
          <label for="number">Número</label><br>
          <input type="number" name="numResidencia" required>
        </div>
        <div class="input">
          <label for="text">Bairro</label><br>
          <input type="text" name="bairro" required>
        </div>
        <div class="input">
          <label for="text">Cidade</label><br>
          <input type="text" name="cidade" required>
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
        <a href="login.php"><div class="botaoCancelar">Cancelar</div></a>
        <button type="submit" name="enviarCliente" style="padding: 8px 18px; margin-right: 20px;">Confirmar</button>
        </div>
      </form>
    </div>
  </body>
</html>