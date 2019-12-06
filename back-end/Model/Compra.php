<?php
    class Compra {
        private $idCompra;
        private $cpfCliente;
        private $cpfDestinatario;
        private $status;
        private $dataCompra;

        public function Compra() {
            $this->idCompra = -1;
            $this->cpfCliente = "";
            $this->cpfDestinatario = "";
            $this->status = 'p';
            $this->dataCompra = "";
        }

        public function getIdCompra() { return $this->idCompra; }
        public function getCpfCliente() { return $this->cpfCliente; }
        public function getCpfDestinatario() { return $this->cpfDestinatario; }
        public function getStatus() { return $this->status; }
        public function getDataCompra() { return $this->dataCompra; }

        public function setIdCompra(int $id) { $this->idCompra = $id; }
        public function setCpfCliente(String $cpf) { $this->cpfCliente = $cpf; }
        public function setCpfDestinatario(String $cpf) { $this->cpfDestinatario = $cpf; }
        public function setStatus(String $status) { $this->status = $status; }
        public function setDataCompra() { $this->dataCompra = date('d/m/Y'); }
    }
?>