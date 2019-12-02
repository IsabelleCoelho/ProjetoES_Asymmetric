CREATE SCHEMA IF NOT EXISTS `asymmetric` DEFAULT CHARACTER SET utf8 ;
USE `asymmetric`;

CREATE TABLE IF NOT EXISTS `asymmetric`.`obra` (
  `idObra` INT NOT NULL AUTO_INCREMENT,
  `nomeObra` VARCHAR(20) NOT NULL,
  `valorEstimado` BIGINT NOT NULL,
  `material` VARCHAR(10) NOT NULL,
  `local` VARCHAR(15) NOT NULL,
  `nomeAutor` VARCHAR(15) NOT NULL,
  `foto` VARCHAR(30) NOT NULL,
  `largura` FLOAT NOT NULL,
  `altura` FLOAT NOT NULL,
  `tipoFundo` INT NOT NULL,
  PRIMARY KEY (`idObra`),
  INDEX (`nomeObra`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `asymmetric`.`cliente` (
	`idCliente` INT NOT NULL AUTO_INCREMENT,
    `cpf` VARCHAR(14) NOT NULL,
    `senha` VARCHAR(32) NOT NULL,
    `nome` VARCHAR(40) NOT NULL,
    `email` VARCHAR(40) NOT NULL,
    `estado` CHAR(2) NOT NULL,
    `cidade` VARCHAR(20) NOT NULL,
    `bairro` VARCHAR(20) NOT NULL,
    `rua` VARCHAR(20) NOT NULL,
    `numResidencia` INT NOT NULL,
    `foto` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`idCliente`),
    INDEX (`cpf`),
    INDEX (`email`))
ENGINE = InnoDB;
