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
        }

        public function construtor(int $idObra, String $nomeObra, int $valorEstimado, String $material, String $local, String $nomeAutor, String $foto, float $altura, float $largura, int $tipoFundo) {
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
        }

        private function setupFromSqlRow($rowObra){
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

        public function setIdObra(int $idObra) { $this->idObra = $idObra; }

        // MySQL Access
        public function recuperarTodasObras() {
            include("sqlConnect.php");
            $con = openCon();
            $query = "SELECT * FROM obra ORDER BY idObra;";
            $execute = mysqli_query($con, $query);
            $obras = array();
            $i = 0;
            while ($rowObra = mysqli_fetch_assoc($execute)) {
                $obras[$i] = new Obra();
                $obras[$i]->setupFromSqlRow($rowObra);
                ++$i;
            }
            closeCon($con);
            return $obras;
        }

        public function recuperarObra() {
            include("sqlConnect.php");
            $con = openCon();
            $query = "SELECT * FROM obra WHERE idObra=".$this->idObra.";";
            if ($row = mysqli_fetch_assoc(mysqli_query($con, $query)))
                $this->setupFromSqlRow($row);
            closeCon($con);
        }

        public function inserirObra() : bool{
            include("sqlConnect.php");
            $con = openCon();
            $query = "INSERT INTO obra(nomeObra, valorEstimado, material, local, nomeAutor, foto, altura, largura, tipoFundo) VALUES ('".$this->nomeObra."', ".$this->valorEstimado.", '".$this->material."', '".$this->local."', '".$this->nomeAutor."', '".$this->foto."', ".$this->altura.", ".$this->largura.", ".$this->tipoFundo.");";
            if(mysqli_query($con, $query)) $inserido = true;
            else $inserido = false;
            closeCon($con);
            return $inserido;
        }

        public function atualizarObra() {
            include("sqlConnect.php");
            $con = openCon();
            $query = "UPDATE obra SET nomeObra='".$this->nomeObra."', valorEstimado=".$this->valorEstimado.", material='".$this->material."', local='".$this->local."', nomeAutor='".$this->nomeAutor."', foto='".$this->foto."', altura=".$this->altura.", largura=".$this->largura.", tipoFundo=".$this->tipoFundo." WHERE idObra=".$this->idObra.";";
            mysqli_query($con, $query);
            closeCon($con);
        }

        public function excluirObra() {
            include("sqlConnect.php");
            $con = openCon();
            $query = "DELETE FROM obra WHERE idObra=".$this->idObra.";";
            mysqli_query($con, $query);
            closeCon($con);
        }
    }
?>