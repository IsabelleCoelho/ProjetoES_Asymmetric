<?php
    class ObraDAO {
        public function recuperarTodasObras($con) {
            $query = "SELECT * FROM obra ORDER BY idObra;";
            $execute = mysqli_query($con, $query);
            $obras = array();
            $i = 0;
            while ($rowObra = mysqli_fetch_assoc($execute)) {
                $obras[$i] = new Obra();
                $obras[$i]->setupFromSqlRow($rowObra);
                ++$i;
            }
            return $obras;
        }

        public function recuperar($con, $obra) {
            $query = "SELECT * FROM obra WHERE idObra=".$obra->getIdObra().";";
            if ($row = mysqli_fetch_assoc(mysqli_query($con, $query)))
                $obra->setupFromSqlRow($row);
        }

        public function inserir($con, $obra){
            $query = "INSERT INTO obra(nomeObra, valorEstimado, material, local, nomeAutor, foto, altura, largura, estoque) VALUES ('".$obra->getNomeObra()."', ".$obra->getValorEstimado().", '".$obra->getMaterial()."', '".$obra->getLocal()."', '".$obra->getNomeAutor()."', '".$obra->getFoto()."', ".$obra->getAltura().", ".$obra->getLargura().", ".$obra->getEstoque().");";
            mysqli_query($con, $query);
        }

        public function alterar($con, $obra) {
            $query = "UPDATE obra SET nomeObra='".$obra->getNomeObra()."', valorEstimado=".$obra->getValorEstimado().", material='".$obra->getMaterial()."', local='".$obra->getLocal()."', nomeAutor='".$obra->getNomeAutor()."', foto='".$obra->getFoto()."', altura=".$obra->getAltura().", largura=".$obra->getLargura().", estoque=".$obra->getEstoque()." WHERE idObra=".$obra->getIdObra().";";
            mysqli_query($con, $query);
        }

        public function alterarEstoque($con, $obra) {
            $query = "SELECT estoque FROM obra WHERE idObra=".$obra->getIdObra().";";
            $novoEstoque = ((mysqli_fetch_assoc(mysqli_query($con, $query)))['estoque'] - $obra->getEstoque());
            $query = "UPDATE obra SET estoque=".$novoEstoque." WHERE idObra=".$obra->getIdObra().";";
            mysqli_query($con, $query);
        }

        public function excluir($con, $obra) {
            $query = "DELETE FROM obra WHERE idObra=".$obra->getIdObra().";";
            mysqli_query($con, $query);
        }

        public function restaurarEstoque($con, $obra) {
            $query = "SELECT estoque FROM obra WHERE idObra=".$obra->getIdObra().";";
            $novoEstoque = ((mysqli_fetch_assoc(mysqli_query($con, $query)))['estoque'] + $obra->getEstoque());
            $query = "UPDATE obra SET estoque=".$novoEstoque." WHERE idObra=".$obra->getIdObra().";";
            mysqli_query($con, $query);
        }
    }
?>