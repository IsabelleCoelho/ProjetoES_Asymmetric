<?php
    class CompraDAO {
        public function recuperarPorCpf($con, $compra) {
            $query = "SELECT * FROM compra WHERE cpf=".$compra->getCpf().";";
            if ($row = mysqli_fetch_assoc(mysqli_query($con, $query)))
                $compra->setupFromSqlRow($row);
        }

        public function recuperarIdCompraAtual() {
            $query = "SELECT MAX(idCompra) AS max_id FROM compra;";
            $row = mysqli_fetch_array(mysqli_query($con, $query));
            return $row['max_id'];
        }
        
        public function inserir($con, $compra){
            $query = "INSERT INTO compra(cpf, cpfDestinatario, status, dataCompra) VALUES ('".$compra->getCpfCliente()."', '".$compra->getCpfDestinatario()."', '".$compra->getStatus()."', '".$compra->getDataCompra()."');";
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