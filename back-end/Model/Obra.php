<?php
    class Obra {
        private $idObra;
        private $nomeObra;
        private $valorEstimado;
        private $material;
        private $local;
        private $nomeAutor;
        private $foto;
        private $altura;
        private $largura;
        private $tipoFundo;
        private $estoque;

        public function Obra() {
            $this->idObra = -1;
            $this->nomeObra = "";
            $this->valorEstimado = 0;
            $this->material = "";
            $this->local = "";
            $this->nomeAutor = "";
            $this->foto = "";
            $this->altura = 0.0;
            $this->largura = 0.0;
            $this->tipoFundo = 1;
            $this->estoque = 1;
        }

        public function construtor(int $idObra, String $nomeObra, int $valorEstimado, String $material, String $local, String $nomeAutor, String $foto, float $altura, float $largura, int $tipoFundo, int $estoque) {
            $this->idObra = $idObra;
            $this->nomeObra = $nomeObra;
            $this->valorEstimado = $valorEstimado;
            $this->material = $material;
            $this->local = $local;
            $this->nomeAutor = $nomeAutor;
            $this->foto = $foto;
            $this->altura = $altura;
            $this->largura = $largura;
            $this->tipoFundo = $tipoFundo;
            $this->estoque = $estoque;
        }

        public function setupFromSqlRow($rowObra){
            $this->idObra = $rowObra['idObra'];
            $this->nomeObra = $rowObra['nomeObra'];
            $this->valorEstimado = $rowObra['valorEstimado'];
            $this->material = $rowObra['material'];
            $this->local = $rowObra['local'];
            $this->nomeAutor = $rowObra['nomeAutor'];
            $this->foto = $rowObra['foto'];
            $this->altura = $rowObra['altura'];
            $this->largura = $rowObra['largura'];
            $this->tipoFundo = $rowObra['tipoFundo'];
            $this->estoque = $rowObra['estoque'];
        }

        public function getIdObra() { return $this->idObra; }
        public function getNomeObra() { return $this->nomeObra; }
        public function getValorEstimado() { return $this->valorEstimado; }
        public function getMaterial() { return $this->material; }
        public function getLocal() { return $this->local; }
        public function getNomeAutor() { return $this->nomeAutor; }
        public function getFoto() { return $this->foto; }
        public function getAltura() { return $this->altura; }
        public function getLargura() { return $this->largura; }
        public function getTipoFundo() { return $this->tipoFundo; }
        public function getEstoque() { return $this->estoque; }

        public function setIdObra(int $idObra) { $this->idObra = $idObra; }
    }
?>
