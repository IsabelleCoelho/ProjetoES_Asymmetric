<?php
    class Cliente {
        private $idCliente;
        private $cpf;
        private $senha;
        private $nome;
        private $email;
        private $estado;
        private $cidade;
        private $bairro;
        private $rua;
        private $numResidencia;
        private $foto;

        public function Cliente() {
            $this->idCliente = -1;
            $this->cpf = "";
            $this->senha = "";
            $this->nome = "";
            $this->email = "";
            $this->estado = "";
            $this->cidade = "";
            $this->bairro = "";
            $this->rua = "";
            $this->numResidencia = 0;
            $this->foto = "";
        }

        public function construtor(int $idCliente, String $cpf, String $nome, String $email, String $estado, String $cidade, String $bairro, String $rua, int $numResidencia, String $foto) {
            $this->idCliente = $idCliente;
            $this->cpf = $cpf;
            $this->nome = $nome;
            $this->email = $email;
            $this->estado = $estado;
            $this->cidade = $cidade;
            $this->bairro = $bairro;
            $this->rua = $rua;
            $this->numResidencia = $numResidencia;
            $this->foto = $foto;
        }

        public function setupFromSqlRow($row){
            $this->idCliente = $row['idCliente'];
            $this->cpf = $row['cpf'];
            $this->senha = $row['senha'];
            $this->nome = $row['nome'];
            $this->email = $row['email'];
            $this->estado = $row['estado'];
            $this->cidade = $row['cidade'];
            $this->bairro = $row['bairro'];
            $this->rua = $row['rua'];
            $this->numResidencia = $row['numResidencia'];
            $this->foto = $row['foto'];
        }

        public function getIdCliente() { return $this->idCliente; }
        public function getCpf() { return $this->cpf; }
        public function getSenha() { return $this->senha; }
        public function getNome() { return $this->nome; }
        public function getEmail() { return $this->email; }
        public function getEstado() { return $this->estado; }
        public function getCidade() { return $this->cidade; }
        public function getBairro() { return $this->bairro; }
        public function getRua() { return $this->rua; }
        public function getNumResidencia() { return $this->numResidencia; }
        public function getFoto() { return $this->foto; }

        public function setIdCliente(int $idCliente) { $this->idCliente = $idCliente; }
        public function setCpf(String $cpf) { $this->cpf = $cpf; }
        public function setSenha(String $senha) { $this->senha = $senha; }
    }
?>