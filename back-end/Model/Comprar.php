<?php
    class Comprar {
        private $idCompra;
        private $idObra;
        private $quantidade;

        public function Comprar() {
            $this->idCompra = -1;
            $this->idObra = -1;
            $this->quantidade = 1;
        }

        public function construtor(int $idCompra, int $idObra, int $quantidade) {
            $this->idCompra = $idCompra;
            $this->idObra = $idObra;
            $this->quantidade = $quantidade;
        }

        public function setupFromSqlRow($row){
            $this->idCompra = $row['idCompra'];
            $this->idObra = $row['idObra'];
            $this->quantidade = $row['quantidade'];
        }

        public function getIdCompra() { return $this->idCompra; }
        public function getIdObra() { return $this->idObra; }
        public function getQuantidade() { return $this->quantidade; }

        public function setIdCompra(int $idCompra) { $this->idCompra = $idCompra; }
    }
?>
