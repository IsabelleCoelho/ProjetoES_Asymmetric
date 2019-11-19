CREATE SCHEMA IF NOT EXISTS `asymmetric` DEFAULT CHARACTER SET utf8 ;
USE `mydb`;

CREATE TABLE IF NOT EXISTS `asymmetric`.`obra` (
  `idObra` INT NOT NULL AUTO_INCREMENT,
  `nomeObra` VARCHAR(20) NOT NULL,
  `valorEstimado` LONG NOT NULL,
  `material` VARCHAR(10) NOT NULL,
  `local` VARCHAR(15) NOT NULL,
  `nomeAutor` VARCHAR(15) NOT NULL,
  `foto` VARCHAR(15) NOT NULL,
  `largura` FLOAT NOT NULL,
  `altura`  FLOAT NOT NULL,
  PRIMARY KEY (`idObra`),
  INDEX (`nomeObra`))
ENGINE = InnoDB;

use `asymmetric`;
SELECT * FROM `obra`;

DROP TABLE `asymmetric`.`obra`;