<?php
    session_start();
    if (isset($_SESSION['usrId'])) { ?>
        <div style="padding-left:20%; padding-right:20%;">
<?php       if (isset($_SESSION['carrinho'])) { ?>
                <div style="display:inline-block; width:150px; background-color:grey;">
                    <h2 align="center" style="margin:0px; margin-left:5px!important;">Obra</h1>
<?php               foreach ($_SESSION['carrinho'] as $item) { ?>
                        <h3 style="margin:0px; margin-left:5px!important;"><?php echo $item['nome']; ?></h3>
<?php               } ?>
                </div>
                <div style="display:inline-block; width:150px; background-color:grey;">
                    <h2 align="center" style="margin:0px; margin-left:5px!important;">Valor</h1>
<?php               foreach ($_SESSION['carrinho'] as $item) { ?>
                        <h3 style="margin:0px; margin-left:5px!important;"><?php echo 'R$'.$item['preco']; ?></h3>
<?php               } ?>
                </div>
                <div style="display:inline-block; width:150px; background-color:grey;">
                    <h2 align="center" style="margin:0px; margin-left:5px!important;">Qntd</h1>
<?php               foreach ($_SESSION['carrinho'] as $item) {
                        if ($item['qntd'] > 1) { ?>
                            <form method="POST" action="../Controller/Carrinho.php" style="margin:0px; display:inline-block;">
                                <input type="text" name="acaoCarrinho" value="rmvQtd" hidden />
                                <input type="number" name="id" value="<?php echo $item['id']; ?>" hidden />
                                <input type="submit" value="-" name="enviar" style="padding:0px; margin:0px; height:20px; width:25px; display:inline-block;"/>
                            </form>
<?php                   }
                        if ($item['qntd'] < $item['max']) { ?>
                            <form method="POST" action="../Controller/Carrinho.php" style="margin:0px; display:inline-block;">
                                <input type="text" name="acaoCarrinho" value="addQtd" hidden />
                                <input type="number" name="id" value="<?php echo $item['id']; ?>" hidden />
                                <input type="submit" value="+" name="enviar" style="padding:0px; margin:0px; height:20px; width:25px; display:inline-block;"/>
                            </form>
<?php                   } ?>
                        <h3 style="margin:0px; margin-left:5px!important; display:inline-block;"><?php echo $item['qntd'].'/'.$item['max']; ?></h3><br/>
<?php               } ?>
                </div>
                <div style="display:inline-block; width:150px; background-color:grey;">
                    <h2 align="center" style="margin:0px; margin-left:5px!important;"></h1>
<?php               foreach ($_SESSION['carrinho'] as $item) { ?>
                        <form method="POST" action="../Controller/Carrinho.php" style="margin:0px; display:inline-block;">
                            <input type="text" name="acaoCarrinho" value="rmvCarPage" hidden />
                            <input type="number" name="id" value="<?php echo $item['id']; ?>" hidden />
                            <input type="submit" value="REMOVER" name="enviar" style="padding:0px; margin:0px; height:25px;"/>
                        </form><br/>
<?php               } ?>
                </div>
                <br/><br/>
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
                echo "Carrinho vazio :("; ?>
            <br/><br/><a href="index.php">Voltar</a>
        </div>
<?php
    }
?>