<?php
    class CompraDAO {
        public function recuperarPorCpf($con, $compra) {
            $query = "SELECT * FROM compra WHERE cpf=".$compra->getCpf()." ORDER BY idCompra DESC;";
            $compras = array();
            $i = 0;
            while ($row = mysqli_fetch_assoc(mysqli_query($con, $query))) {
                $compras[$i] = new Compra();
                $compras[$i]->setupFromSqlRow($row);
                ++$i;
            }
            return $compras;
        }

        public function recuperarIdCompraAtual($con) {
            $query = "SELECT MAX(idCompra) AS max_id FROM compra;";
            $row = mysqli_fetch_array(mysqli_query($con, $query));
            return $row['max_id'];
        }
        
        public function inserir($con, $compra){
            $query = "INSERT INTO compra(cpf, cpfDestinatario, status, dataCompra, valorTotal) VALUES ('".$compra->getCpfCliente()."', '".$compra->getCpfDestinatario()."', '".$compra->getStatus()."', '".$compra->getDataCompra()."', ".$compra->getValorTotal().");";
            mysqli_query($con, $query);
        }

        public function alterar($con, $compra) {
            $query = "UPDATE compra SET cpfDestinatario='".$compra->getCpfDestinatario()."' WHERE idCompra=".$compra->getIdCompra().";";
            mysqli_query($con, $query);
        }

        public function excluir($con, $compra) {
            $query = "DELETE FROM compra WHERE idCompra=".$compra->getIdCompra().";";
            mysqli_query($con, $query);
        }
    }
?>