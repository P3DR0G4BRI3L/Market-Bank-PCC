DROP DATABASE IF EXISTS marketbank;
CREATE DATABASE marketbank;
USE marketbank;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Table `marketbank`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL, 
  `senha` VARCHAR(255) NOT NULL,
  `tipo` ENUM('cliente', 'administrador', 'dono') NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `email` (`email` ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `marketbank`.`administrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administrador` (
  `id_administrador` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id_administrador`),
  INDEX `id_usuario` (`id_usuario` ASC),
  CONSTRAINT `administrador_ibfk_1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `marketbank`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  INDEX `id_usuario` (`id_usuario` ASC),
  CONSTRAINT `cliente_ibfk_1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `marketbank`.`carrinho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `carrinho` (
  `id_carrinho` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id_carrinho`),
  INDEX `id_usuario_idx` (`id_usuario` ASC),
  CONSTRAINT `carrinho_ibfk_1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `cliente` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `marketbank`.`mercado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mercado` (
  `id_mercado` INT(11) NOT NULL AUTO_INCREMENT,
  `nomeMerc` VARCHAR(255) NOT NULL,
  `regiaoadm` VARCHAR(45) NOT NULL,
  `endereco` VARCHAR(255) NOT NULL,
  `horarioAbert` TIME NOT NULL,
  `horarioFecha` TIME NOT NULL,
  `telefone` VARCHAR(11) NOT NULL,
  `cnpj` VARCHAR(20) NOT NULL,
  `imagem` VARCHAR(120) NOT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  `id_dono` INT(11) NOT NULL,
  `compras` ENUM('sim', 'nao') NOT NULL,
  PRIMARY KEY (`id_mercado`),
  INDEX `id_dono` (`id_dono` ASC),
  CONSTRAINT `mercado_ibfk_1`
    FOREIGN KEY (`id_dono`)
    REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `marketbank`.`filtroproduto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `filtroproduto` (
  `id_filtro` INT(11) NOT NULL AUTO_INCREMENT,
  `nomeFiltro` VARCHAR(45) NOT NULL,
  `id_mercado` INT(11) NOT NULL,
  PRIMARY KEY (`id_filtro`),
  INDEX `id_mercado` (`id_mercado` ASC),
  CONSTRAINT `filtroproduto_ibfk_1`
    FOREIGN KEY (`id_mercado`)
    REFERENCES `mercado` (`id_mercado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `marketbank`.`infopag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infopag` (
  `id_infoPag` INT(11) NOT NULL AUTO_INCREMENT,
  `id_mercado` INT(11) NOT NULL,
  PRIMARY KEY (`id_infoPag`),
  INDEX `id_mercado` (`id_mercado` ASC),
  CONSTRAINT `infopag_ibfk_1`
    FOREIGN KEY (`id_mercado`)
    REFERENCES `mercado` (`id_mercado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `marketbank`.`panfleto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `panfleto` (
  `id_panfleto` INT(11) NOT NULL AUTO_INCREMENT,
  `foto` VARCHAR(120) NOT NULL,
  `validade` DATE NOT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  `id_mercado` INT(11) NOT NULL,
  PRIMARY KEY (`id_panfleto`),
  INDEX `id_mercado` (`id_mercado` ASC),
  CONSTRAINT `panfleto_ibfk_1`
    FOREIGN KEY (`id_mercado`)
    REFERENCES `mercado` (`id_mercado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `marketbank`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `produto` (
  `id_produto` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `fotoProduto` VARCHAR(120) NOT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  `id_mercado` INT(11) NOT NULL,
  `id_filtro` INT(11) NULL,
  PRIMARY KEY (`id_produto`),
  INDEX `id_mercado` (`id_mercado` ASC),
  INDEX `fk_produto_filtroproduto1_idx` (`id_filtro` ASC),
  CONSTRAINT `produto_ibfk_1`
    FOREIGN KEY (`id_mercado`)
    REFERENCES `mercado` (`id_mercado`),
  CONSTRAINT `fk_produto_filtroproduto1`
    FOREIGN KEY (`id_filtro`)
    REFERENCES `filtroproduto` (`id_filtro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `marketbank`.`itens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `itens` (
  `id_itens` INT(11) NOT NULL AUTO_INCREMENT,
  `id_carrinho` INT(11) NOT NULL,
  `quantidade` INT(11) NOT NULL,
  `id_produto` INT(11) NOT NULL,
  PRIMARY KEY (`id_itens`),
  INDEX `fk_itens_carrinho1_idx` (`id_carrinho` ASC),
  INDEX `fk_itens_produto1_idx` (`id_produto` ASC),
  CONSTRAINT `fk_itens_carrinho1`
    FOREIGN KEY (`id_carrinho`)
    REFERENCES `carrinho` (`id_carrinho`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_itens_produto1`
    FOREIGN KEY (`id_produto`)
    REFERENCES `produto` (`id_produto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Restaurar as configurações originais
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
