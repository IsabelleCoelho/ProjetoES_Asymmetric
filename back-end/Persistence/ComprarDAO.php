<?php
    class ComprarDAO {
        public function recuperar($con, $compra) {
            $query = "SELECT * FROM compra WHERE idCompra=".$compra->getIdCompra().";";
            if ($row = mysqli_fetch_assoc(mysqli_query($con, $query)))
                $compra->setupFromSqlRow($row);
        }

        public function inserir($con, $comprar){
            $query = "INSERT INTO comprar(idCombra, idObra, quantidade) VALUES (".$comprar->getIdCompra().", ".$comprar->getIdObra().", ".$comprar->getQuantidade().");";
            mysqli_query($con, $query);
        }
    }
?>