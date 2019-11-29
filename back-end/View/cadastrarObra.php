<html>
    <head>
        <title>Cadastrar obra</title>
    </head>
    <body>
        <form method="POST" action="../Controller/CadastrarObra.php" enctype="multipart/form-data">
            <label>Nome da obra: </label>
            <input type="text" name="nomeObra" required /><br/>
            <label>Valor estimado: </label>
            <input type="number" name="valorEstimado" required /><br/>
            <label>Material: </label>
            <input type="text" name="material" required /><br/>
            <label>Local: </label>
            <input type="text" name="local" required /><br/>
            <label>Nome do Autor: </label>
            <input type="text" name="nomeAutor" required /> <br/>
            <label>Foto: </label>
            <input type="file" name="foto" required /><br/>
            <label>Altura: </label>
            <input type="number" step="0.01" placeholder="3.75" name="altura" required /><br/>
            <label>Largura: </label>
            <input type="number" step="0.01" placeholder="3.75" name="largura" required /><br/>
            <label>Estoque: </label>
            <input type="number" value="1" name="estoque" required /><br/>
            <label>Tipo de fundo: </label><br/>
            <input type="radio" name="tipoFundo" value="1" checked> Tipo 1<br/>
            <input type="radio" name="tipoFundo" value="2"> Tipo 2<br/>
            <input type="radio" name="tipoFundo" value="3"> Tipo 3<br/><br/>
            <input type="submit" name="enviarObra" value="Enviar" />
        </form>
    </body>
</html>
