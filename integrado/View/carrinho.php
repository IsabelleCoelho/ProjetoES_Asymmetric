<?php
    session_start();
    if (isset($_SESSION['usrId'])) {
        include("../Model/Obra.php");
        include("../Model/Compra.php");
        include("../Model/Comprar.php");
        include("../Persistence/ObraDAO.php");
        include("../Persistence/CompraDAO.php");
        include("../Persistence/ComprarDAO.php");
        include("../Persistence/Connection.php");
        $compra = new Compra();
        $compra->setIdCliente($_SESSION['usrId']);
        $connection = new Connection();
        $con = $connection->openConnection();
        $compraDao = new CompraDAO();
        $compras = $compraDao->recuperarCompras($con, $compra);
        $comprar = new Comprar();
        $comprarDao = new ComprarDAO();
        $i = 0;
?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <link rel="stylesheet" href="CSS/styleHistorico.css">
        </head>
        <body>
            <header>
                <div class=botaoPerfil>
                    <a href="perfil.php"><img class="perfil" src="Assets/userDefault.svg" alt="perfil"></a>
                </div>
                <div class=botaoSair>
                    <a href="../Controller/Logout.php"><img class="sair" src="Assets/sair.svg" alt="sair" aligm="center"></a>
                </div>
                <a href="index.html">
                    <a href="index.php"><img class="logo1" src="Assets/logo1.svg" alt="logo1"></a>
                </a>
                <div class=botaoHistorico>
                    <a href="historicoCompras.php"><img class="historico" src="Assets/historico.svg" alt="historico"></a>
                </div>
                <div class=botaoCarrinho>
                    <a href="carrinho.php"><img class="carrinho" src="Assets/carrinho.svg" alt="carrinho"></a>
                </div>
            </header>
            <div style="padding-top:100px; padding-left:20%;">
<?php       if (isset($_SESSION['carrinho'])) { ?>
                <table border="0" cellpadding="2" cellspacing="0">
                    <tr style="background-color:#8a8a8a;">
                        <td style="min-width:200px;">
                            <h3 align="center" style="margin:2px;">Obra</h3>
                        </td>
                        <td style="min-width:200px;">
                            <h3 align="center" style="margin:2px;">Valor</h3>
                        </td>
                        <td style="min-width:200px;">
                            <h3 align="center" style="margin:2px;">Quantidade</h3>
                        </td>
                        <td>
                            <h3 align="center" style="margin:2px;"></h3>
                        </td>
                    </tr>
<?php               foreach ($_SESSION['carrinho'] as $item) {
                        if ($i%2 == 0) $cor = "#bfbfbf";
                        else $cor = "#8a8a8a"; ?>
                        <tr style="background-color:<?php echo $cor; ?>;">
                            <td>
                                <h3 align="center" style="margin:0px; margin-left:5px!important;"><?php echo $item['nome']; ?></h3>
                            </td>
                            <td>
                                <h3 align="center" style="margin:0px; margin-left:5px!important;"><?php echo 'R$'.$item['preco']; ?></h3>
                            </td>
                            <td>
<?php                            if ($item['qntd'] > 1) { ?>
                                    <form align="center" method="POST" action="../Controller/Carrinho.php" style="margin:0px; display:inline-block;">
                                        <input type="text" name="acaoCarrinho" value="rmvQtd" style="display:none;" />
                                        <input type="number" name="id" value="<?php echo $item['id']; ?>" style="display:none;" />
                                        <input type="submit" value="-" name="enviar" style="padding:0px; margin:0px; height:20px; width:25px; display:inline-block;"/>
                                    </form>
<?php                           }
                                if ($item['qntd'] < $item['max']) { ?>
                                    <form align="center" method="POST" action="../Controller/Carrinho.php" style="margin:0px; display:inline-block;">
                                        <input type="text" name="acaoCarrinho" value="addQtd" hidden />
                                        <input type="number" name="id" value="<?php echo $item['id']; ?>" style="display:none;" />
                                        <input type="submit" value="+" name="enviar" style="padding:0px; margin:0px; height:20px; width:25px; display:inline-block;"/>
                                    </form>
<?php                           } ?>
                                <h3 align="center" style="margin:0px; margin-left:5px!important; display:inline-block;"><?php echo $item['qntd'].'/'.$item['max']; ?></h3>
                            </td>
                            <td>
                                <form method="POST" action="../Controller/Carrinho.php" style="margin:0px; display:inline-block;">
                                    <input type="text" name="acaoCarrinho" value="rmvCarPage" hidden />
                                    <input type="number" name="id" value="<?php echo $item['id']; ?>" hidden />
                                    <input type="submit" value="REMOVER" name="enviar" style="padding:0px; margin:0px; height:25px;"/>
                                </form>
                            </td>
                        </tr>  
<?php               } ?>
                </table><br/><br/>
                <form method="POST" action="../Controller/Carrinho.php" style="margin:0px; display:inline-block;">
                    <input type="text" name="acaoCarrinho" value="empty" hidden />
                    <input type="submit" value="LIMPAR CARRINHO" name="enviar" style="padding:0px; margin:0px; height:25px;"/>
                </form>
                <form method="POST" action="../Controller/EfetuarCompra.php" style="margin:0px; display:inline-block;">
                    <label>Cpf destinatario: </label>
                    <input type="text" name="cpfDest" style="width:150px;" /><br/>
                    <input type="text" name="acaoCarrinho" value="comprar" hidden />
                    <input type="submit" value="COMPRAR" name="enviar" style="padding:0px; margin:0px; height:25px;"/>
                </form>
<?php       } else
                echo 'Carrinho vazio :(<br/><br/><a href="index.php">Voltar</a>'?>
        </div>                     
        </body>
        </html>
<?php
        $connection->closeConnection();
    }
?>