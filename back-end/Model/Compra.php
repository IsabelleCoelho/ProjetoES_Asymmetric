<?php
    class Compra {
        private $idCompra;
        private $cpfCliente;
        private $cpfDestinatario;
        private $status;
        private $dataCompra;
        private $valorToral;

        public function Compra() {
            $this->idCompra = -1;
            $this->cpfCliente = "";
            $this->cpfDestinatario = "";
            $this->status = 'p';
            $this->dataCompra = "";
        }

        public function construtor(String $cpfCliente, String $cpfDest, int $valorTotal) {
            $this->cpfCliente = $cpfCliente;
            $this->cpfDestinatario = $cpfDest;
            $this->dataCompra = date('d/m/Y');
            $this->valorTotal = $valorTotal;
        }

        public function setupFromSqlRow($row) {
            $this->idCompra = $row['idCompra'];
            $this->cpfCliente = $row['cpf'];
            $this->cpfDestinatario = $row['cpfDestinatario'];
            $this->status = $row['status'];
            $this->dataCompra = $row['dataCompra'];
            $this->valorTotal = $row['valorTotal'];
        }

        public function getIdCompra() { return $this->idCompra; }
        public function getCpfCliente() { return $this->cpfCliente; }
        public function getCpfDestinatario() { return $this->cpfDestinatario; }
        public function getStatus() { return $this->status; }
        public function getDataCompra() { return $this->dataCompra; }
        public function getValorTotal() { return $this->valorTotal; }

        public function setIdCompra(int $id) { $this->idCompra = $id; }
        public function setCpfDestinatario(String $cpf) { $this->cpfDestinatario = $cpf; }
        public function setStatus(String $status) { $this->status = $status; }
    }
?>