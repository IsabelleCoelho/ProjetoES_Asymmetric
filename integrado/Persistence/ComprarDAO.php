<?php
    class ComprarDAO {
        public function recuperar($con, $comprar) {
            $query = "SELECT * FROM obra o INNER JOIN comprar c ON o.idObra = c.idObra WHERE idCompra=".$comprar->getIdCompra().";";
            $execute = mysqli_query($con, $query);
            $compras = array(array(
                'idObra' => 0,
                'nomeObra' => "",
                'qntd' => 0,
            ));
            $i = 0;
            while ($row = mysqli_fetch_assoc($execute)) {
                $compras[$i]['idObra'] = $row['idObra'];
                $compras[$i]['nomeObra'] = $row['nomeObra'];
                $compras[$i]['qntd'] = $row['quantidade'];
                ++$i;
            }
            return $compras;
        }

        public function inserir($con, $comprar) {
            $query = "INSERT INTO comprar(idCompra, idObra, quantidade) VALUES (".$comprar->getIdCompra().", ".$comprar->getIdObra().", ".$comprar->getQuantidade().");";
            mysqli_query($con, $query);
        }
    }
?>