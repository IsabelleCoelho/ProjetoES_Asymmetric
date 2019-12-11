<?php
    if(isset($_POST['atualizarObra'])) {
        include("../Model/Obra.php");
        include("../Persistence/ObraDAO.php");
        include("../Persistence/Connection.php");
        $obraAtual = new Obra();
        $obraAtual->setIdObra($_POST['idObra']);
        $connection = new Connection();
        $con = $connection->openConnection();
        $obra = new ObraDAO();
        $obra->recuperar($con, $obraAtual);
        $connection->closeConnection();
?>

  <html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/styleFormularios.css" />
  </head>
  <body>
    <div class="conteinerFormulario">
      <div id="logo">
          <img class="logo1" src="../Assets/logo.png" alt="logo1">
      </div>
      <form id="formulario" method="POST" action="*">
        <h1 class="titulo">Alterar Produtos</h1>
        <div class="input">
          <label for="text">Nome</label><br>
          <input type="text" name="nomeObra" value="<?php echo $obraAtual->getNomeObra(); ?>" required>
        </div>
        <div class="input">
          <label for="text">Artista</label><br>
          <input type="text" name="nomeAutor" value="<?php echo $obraAtual->getNomeAutor(); ?>" required>
        </div>
        <div class="input">
          <label for="text">Local</label><br>
          <input type="text" name="local" value="<?php echo $obraAtual->getLocal(); ?>" required>
        </div>
        <div class="input">
          <label for="text">Material</label><br>
          <input type="text" name="material" value="<?php echo $obraAtual->getMaterial(); ?>" required>
        </div>
        <div class="input">
          <label for="text">Altura</label><br>
          <input type="text" name="altura" value="<?php echo $obraAtual->getAltura(); ?>" required>
        </div>
        <div class="input">
          <label for="text">Largura</label><br>
          <input type="text" name="largura" value="<?php echo $obraAtual->getLargura(); ?>" required>
        </div>
        <div class="input">
          <label for="number">Valor</label><br>
          <input type="number" step="0.0001" name="valorEstimado" min="0.0000" value="<?php echo $obraAtual->getValorEstimado(); ?>" required>
        </div>
        <div class="input">
          <label for="file">Foto</label><br>
          <input type="file" name="foto">
        </div>
        <div class="input">
          <label for="number">Quantidade</label><br>
          <input type="number" name="estoque" value="<?php echo $obraAtual->getEstoque(); ?>" required>
        </div>
        <div id="botoes">
          <button type="push">Cancelar</button>
          <button type="submit" name="enviarObra" value="Enviar">Confirmar</button>
        </div>
      </form>
    </div>
  </body>
</html>
<?php
    } else {
        echo "Não é possivel editar uma obra inexistente!";
    }
?>
