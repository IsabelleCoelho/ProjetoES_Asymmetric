<?php
    class Connection {
        private $con;

        public function openConnection() {
            $this->con = mysqli_connect("127.0.0.1", "root", "root", "asymmetric");
            return $this->con;
        }

        public function closeConnection() {
            mysqli_close($this->con);
        }
    }
?>
