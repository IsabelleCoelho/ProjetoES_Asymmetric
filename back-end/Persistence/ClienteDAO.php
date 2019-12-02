<?php
    class ClienteDAO {
        public function recuperar($con, $cliente) {
            $query = "SELECT * FROM cliente WHERE idCliente=".$cliente->getIdCliente().";";
            if ($row = mysqli_fetch_assoc(mysqli_query($con, $query)))
                $cliente->setupFromSqlRow($row);
        }

        public function recuperarPorCpf($con, $cliente) {
            $query = "SELECT * FROM cliente WHERE cpf='".$cliente->getCpf()."';";
            if ($row = mysqli_fetch_assoc(mysqli_query($con, $query)))
                $cliente->setupFromSqlRow($row);
        }

        public function inserir($con, $cliente) {
            $query = "SELECT * FROM cliente WHERE cpf='".$cliente->getCpf()."';";
            $execute = mysqli_query($con, $query);
            if (mysqli_num_rows($execute) === 0) {
                $query = "SELECT * FROM cliente WHERE email='".$cliente->getEmail()."';";
                $execute = mysqli_query($con, $query);
                if (mysqli_num_rows($execute) === 0) {
                    $query = "INSERT INTO cliente(cpf, senha, nome, email, estado, cidade, bairro, rua, numResidencia, foto) VALUES ('".$cliente->getCpf()."', '".$cliente->getSenha()."', '".$cliente->getNome()."', '".$cliente->getEmail()."', '".$cliente->getEstado()."', '".$cliente->getCidade()."', '".$cliente->getBairro()."', '".$cliente->getRua()."', ".$cliente->getNumResidencia().", '".$cliente->getFoto()."');";
                    mysqli_query($con, $query);
                    return 0;
                } else
                    return 1; // Mesmo email
            } else
                return 2; //Mesmo CPF
        }

        public function alterar($con, $cliente) {
            $query = "SELECT * FROM cliente WHERE email='".$cliente->getEmail()."';";
            $execute = mysqli_query($con, $query);
            if (mysqli_num_rows($execute) === 0) {
                $query = "UPDATE cliente SET nome='".$cliente->getNome()."', senha='".$cliente->getSenha()."', email='".$cliente->getEmail()."', estado='".$cliente->getEstado()."', cidade='".$cliente->getCidade()."', bairro='".$cliente->getBairro()."', rua='".$cliente->getRua()."', numResidencia=".$cliente->getNumResidencia().", foto='".$cliente->getFoto()."' WHERE idCliente=".$cliente->getIdCliente().";";
                mysqli_query($con, $query);
            } else
                throw new Exception('sameEmailAddr');
        }

        public function excluir($con, $cliente) {
            $query = "DELETE FROM cliente WHERE idCliente=".$cliente->getIdCliente().";";
            mysqli_query($con, $query);
        }

        public function login($con, $cliente) : int{
            $cpf = mysqli_real_escape_string($con, $cliente->getCpf());
            $senha = mysqli_real_escape_string($con, $cliente->getSenha());
            $query = "SELECT * FROM cliente WHERE cpf='".$cpf."' AND senha='".$senha."';";
            $execute = mysqli_query($con, $query);
            if (mysqli_num_rows($execute) === 1) {
                $row = mysqli_fetch_assoc($execute);
                return $row['idCliente'];
            } else
                return -1;
        }
    }
?>