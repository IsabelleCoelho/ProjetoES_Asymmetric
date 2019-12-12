<?php
    session_start();
    if (isset($_SESSION['admin'])) {
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
            <form id="formulario" method="POST" action="../Controller/CadastrarObra.php" enctype="multipart/form-data">
              <h1 class="titulo">Cadastro de Produto</h1>
              <div class="input">
                <label for="text">Nome</label><br>
                <input type="text" name="nomeObra" required>
              </div>
              <div class="input">
                <label for="text">Artista</label><br>
                <input type="text" name="nomeAutor" required>
              </div>
              <div class="input">
                <label for="text">Local</label><br>
                <input type="text" name="local" required>
              </div>
              <div class="input">
                <label for="text">Material</label><br>
                <input type="text" name="material" required>
              </div>
              <div class="input">
                <label for="text">Altura</label><br>
                <input type="text" name="altura" placeholder="3.75" required>
              </div>
              <div class="input">
                <label for="text">Largura</label><br>
                <input type="text" name="largura" placeholder="3.75" required>
              </div>
              <div class="input">
                <label for="number">Valor</label><br>
                <input type="number" step="0.0001" name="valorEstimado" min="0.0000" required>
              </div>
              <div class="input">
                <label for="file">Foto</label><br>
                <input type="file" name="foto" required>
              </div>
              <div class="input">
                  <label for="number">Quantidade</label><br>
                  <input type="number" value="1" name="estoque" required> 
              </div>
              <div id="botoes">
              <a href="admin-page.php"><div class="botaoCancelar">Cancelar</div></a>
              <button type="submit" name="enviarObra" value="Enviar">Confirmar</button>
              </div>
            </form>
          </div>
        </body>
      </html>
<?php
    }
?>