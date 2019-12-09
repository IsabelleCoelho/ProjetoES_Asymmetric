CREATE SCHEMA IF NOT EXISTS asymmetric DEFAULT CHARACTER SET utf8 ;
USE asymmetric;

CREATE TABLE IF NOT EXISTS asymmetric.obra (
  idObra INT NOT NULL AUTO_INCREMENT,
  nomeObra VARCHAR(20) NOT NULL,
  valorEstimado BIGINT NOT NULL,
  material VARCHAR(10) NOT NULL,
  `local` VARCHAR(15) NOT NULL,
  nomeAutor VARCHAR(15) NOT NULL,
  foto VARCHAR(30) NOT NULL,
  largura FLOAT NOT NULL,
  altura FLOAT NOT NULL,
  estoque INT NOT NULL,
  PRIMARY KEY (idObra),
  INDEX (nomeObra))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS asymmetric.cliente (
	idCliente INT NOT NULL AUTO_INCREMENT,
    cpf VARCHAR(14) NOT NULL,
    senha VARCHAR(32) NOT NULL,
    nome VARCHAR(40) NOT NULL,
    email VARCHAR(40) NOT NULL,
    estado CHAR(2) NOT NULL,
    cidade VARCHAR(20) NOT NULL,
    bairro VARCHAR(20) NOT NULL,
    rua VARCHAR(20) NOT NULL,
    numResidencia INT NOT NULL,
    foto VARCHAR(20) NOT NULL,
    PRIMARY KEY (idCliente),
    INDEX (cpf),
    INDEX (email))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS asymmetric.compra (
	idCompra INT NOT NULL AUTO_INCREMENT,
    idCliente INT,
    cpf VARCHAR(14) NOT NULL,
    cpfDestinatario VARCHAR(14) NOT NULL,
    `status` CHAR(1) NOT NULL,
    dataCompra VARCHAR(10) NOT NULL,
    valorTotal BIGINT NOT NULL,
	PRIMARY KEY (idCompra),
    CONSTRAINT fk_cliente_id
		FOREIGN KEY (idCliente)
        REFERENCES cliente (idCliente)
        ON DELETE SET NULL)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS asymmetric.comprar (
	idCompra INT NOT NULL,
    idObra INT NOT NULL,
    quantidade INT NOT NULL,
    PRIMARY KEY (idCompra,idObra),
    CONSTRAINT fk_compra_id
		FOREIGN KEY (idCompra)
        REFERENCES compra (idCompra)
        ON DELETE CASCADE,
	CONSTRAINT fk_obra_id
		FOREIGN KEY (idObra)
        REFERENCES obra (idObra)
        ON DELETE RESTRICT)
ENGINE = InnoDB;

use asymmetric;
SELECT * FROM obra ORDER BY idObra;
SELECT * FROM cliente;
SELECT * FROM compra;
SELECT * FROM comprar;

SELECT * FROM compra WHERE idCliente=2 ORDER BY idCompra DESC;
SELECT * FROM obra o INNER JOIN comprar c ON o.idObra = c.idObra WHERE idCompra=2;

SELECT MAX(idCompra) AS maxId FROM compra;
SELECT MAX(idObra) FROM obra;

INSERT INTO compra(idCliente, cpf, cpfDestinatario, status, dataCompra, valorTotal) VALUES (1, 'ff', 'ff', 'p', '11/11/2011', 1234);

DROP TABLE asymmetric.obra;
DROP TABLE asymmetric.cliente;
DROP TABLE asymmetric.compra;
DROP TABLE asymmetric.comprar;
