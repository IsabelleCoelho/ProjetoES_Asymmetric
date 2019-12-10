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
        <html>
            <head>
                <title>Historico</title>
            </head>
            <body>
                <div style="padding-left:20%; padding-right:20%;">
                    <div style="width:100%; height:30px; background-color:grey; margin-bottom:10px;">
                        <a href="index.php" style="color:white; margin-left:10%;">Inicio</a>
                        <a href="../Controller/Logout.php" style="color:white; margin-left:66%;">Logout</a>
                    </div>
                    <table align="center" border="0" cellpadding="2" cellspacing="0">
                        <tr style="background-color:#8a8a8a;">
                            <td style="max-width:150px;">
                                <h3 align="center" style="margin:2px;">CPF Destinatario</h3>
                            </td>
                            <td style="min-width:200px;">
                                <h3 align="center" style="margin:2px;">Compra</h3>
                            </td>
                            <td style="min-width:200px;">
                                <h3 align="center" style="margin:2px;">Valor total</h3>
                            </td>
                            <td>
                                <h3 align="center" style="margin:2px;">Data</h3>
                            </td>
                            <td style="min-width:80px;">
                                <h3 align="center" style="margin:2px;">Status</h3>
                            </td>
                        </tr>
<?php                   foreach ($compras as $umaCompra) {
                            $comprar->setIdCompra($umaCompra->getIdCompra());
                            $carrinho = $comprarDao->recuperar($con, $umaCompra);
                            if ($i%2 == 0) $cor = "#bfbfbf";
                            else $cor = "#8a8a8a"; ?>
                            <tr style="background-color:<?php echo $cor; ?>;">
                                <td>
<?php                               if (isset($_POST['atualizarCompra']) && $_POST['idCompra'] == $umaCompra->getIdCompra()) { ?>
                                        <form method="POST" action="../Controller/AtualizarCompra.php" style="margin-bottom:5px;">
                                            <input type="number" name="idCompra" value="<?php echo $umaCompra->getIdCompra(); ?>" hidden />
                                            <input type="text" name="cpfDest" placeholder="Novo CPF" style="width:150px;" required /><br/>
                                            <input type="submit" name="atualizarCompra" value="ATUALIZAR" />
                                            <a href="historicoCompras.php" style="display:inline-block;">CANCELAR</a>
                                        </form>
<?php                               } else { ?>
                                        <h3 align="center" style="margin:2px;"><?php echo $umaCompra->getCpfDestinatario(); ?></h3>
<?php                               } ?>
                                </td>
                                <td>
<?php                               foreach ($carrinho as $umItem) {
                                        echo '<p style="margin:0px; margin-left:15px!important;">'.$umItem['nomeObra'].' x '.$umItem['qntd'].'</p>';
                                    } ?>
                                </td>
                                <td>
                                    <h3 align="center" style="margin:2px;">R$<?php echo $umaCompra->getValorTotal(); ?></h3>
                                </td>
                                <td>
                                    <h3 align="center" style="margin:2px;"><?php echo $umaCompra->getDataCompra(); ?></h3>
                                </td>
                                <td>
<?php                               if ($umaCompra->getStatus() === 'p') {
                                        if ($umaCompra->getDataCompra() === date('d/m/Y')) { ?>
                                            <p align="center" style="color:red; margin-top:5px; margin-bottom:2px;">Pendente</p>
                                            <div style="display:inline-block; margin-left:7px;">
                                                <form method="POST" action="#" style="margin-bottom:5px;">
                                                    <input type="number" name="idCompra" value="<?php echo $umaCompra->getIdCompra(); ?>" hidden />
                                                    <input type="submit" name="atualizarCompra" style="background-image:url('../imgs/edit2.png'); width:25px; height:25px; border : none; color : transparent;" />
                                                </form>
                                            </div>
                                            <div style="display:inline-block; margin-left:5px;">
                                                <form method="POST" action="../Controller/ExcluirCompra.php" style="margin-bottom:5px;">
                                                    <input type="number" name="idCompra" value="<?php echo $umaCompra->getIdCompra(); ?>" hidden />
                                                    <input type="submit" name="excluirCompra" style="background-image:url('../imgs/delete2.png'); width:25px; height:25px; border : none; color : transparent;" />
                                                </form>
                                            </div>
<?php                                   } else {
                                            $umaCompra->setStatus('e');
                                            $compraDao->atualizarStatus($con, $umaCompra);
                                            echo '<p align="center" style="color:green; margin-top:0px; margin-bottom:0px;">Aprovado</p>';
                                        }
                                    } else { ?>
                                        <p align="center" style="color:green; margin-top:0px; margin-bottom:0px;">Aprovado</p>
<?php                               } ?>
                                </td>
                            </tr>
<?php                       ++$i;
                        } ?>
                    </table>
                </div>
            </body>
        </html>
<?php
        $connection->closeConnection();
    }
?>