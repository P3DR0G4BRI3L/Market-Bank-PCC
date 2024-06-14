-- MySQL Workbench Forward Engineering
DROP DATABASE IF EXISTS marketbank;
CREATE DATABASE marketbank;
USE marketbank;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema marketbank
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema marketbank
-- -----------------------------------------------------


-- -----------------------------------------------------
-- Table `marketbank`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marketbank`.`usuario` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `tipo` ENUM('cliente', 'administrador', 'dono') NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `email` (`email` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;



-- -----------------------------------------------------
-- Table `marketbank`.`mercado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marketbank`.`mercado` (
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
  INDEX `id_dono` (`id_dono` ASC) ,
  CONSTRAINT `mercado_ibfk_1`
    FOREIGN KEY (`id_dono`)
    REFERENCES `marketbank`.`usuario` (`id_usuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `marketbank`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marketbank`.`cliente` (
  `id_cliente` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(11) NOT NULL,
  `telefone` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  INDEX `id_usuario` (`id_usuario` ASC) ,
  CONSTRAINT `cliente_ibfk_1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `marketbank`.`usuario` (`id_usuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `marketbank`.`carrinho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marketbank`.`carrinho` (
  `id_carrinho` INT(11) NOT NULL AUTO_INCREMENT,
  `id_mercado` INT(11) NOT NULL,
  `id_cliente` INT(11)  NULL,
  `data_criacao`TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `status` ENUM('pendente', 'finalizado') NOT NULL DEFAULT 'pendente',
  `descricao` TEXT NULL,
  PRIMARY KEY (`id_carrinho`),
  INDEX `id_mercado_idx` (`id_mercado` ASC) ,
  INDEX `fk_carrinho_cliente1_idx` (`id_cliente` ASC) ,
  CONSTRAINT `id_mercado`
    FOREIGN KEY (`id_mercado`)
    REFERENCES `marketbank`.`mercado` (`id_mercado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrinho_cliente1`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `marketbank`.`cliente` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `marketbank`.`filtroproduto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marketbank`.`filtroproduto` (
  `id_filtro` INT(11) NOT NULL AUTO_INCREMENT,
  `nomeFiltro` VARCHAR(45) NOT NULL,
  `id_mercado` INT(11) NOT NULL,
  PRIMARY KEY (`id_filtro`),
  INDEX `id_mercado` (`id_mercado` ASC),
  CONSTRAINT `filtroProduto_ibfk_1`
    FOREIGN KEY (`id_mercado`)
    REFERENCES `marketbank`.`mercado` (`id_mercado`)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

-- -----------------------------------------------------
-- Table `marketbank`.`infopag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marketbank`.`infopag` (
  `id_infoPag` INT(11) NOT NULL AUTO_INCREMENT,
  `id_mercado` INT(11) NOT NULL,
  `tipo` ENUM('telefone', 'cnpj', 'email') NOT NULL DEFAULT 'cnpj',
  `pix` VARCHAR(70) NOT NULL,
  PRIMARY KEY (`id_infoPag`),
  INDEX `id_mercado` (`id_mercado` ASC) ,
  CONSTRAINT `infoPag_ibfk_1`
    FOREIGN KEY (`id_mercado`)
    REFERENCES `marketbank`.`mercado` (`id_mercado`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `marketbank`.`panfleto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marketbank`.`panfleto` (
  `id_panfleto` INT(11) NOT NULL AUTO_INCREMENT,
  `foto` VARCHAR(120) NOT NULL,
  `validade` DATE NOT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  `id_mercado` INT(11) NOT NULL,
  PRIMARY KEY (`id_panfleto`),
  INDEX `id_mercado` (`id_mercado` ASC) ,
  CONSTRAINT `panfleto_ibfk_1`
    FOREIGN KEY (`id_mercado`)
    REFERENCES `marketbank`.`mercado` (`id_mercado`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `marketbank`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marketbank`.`produto` (
  `id_produto` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `fotoProduto` VARCHAR(120) NOT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  `id_mercado` INT(11) NOT NULL,
  `id_filtro` INT(11) NULL DEFAULT NULL, -- Permitindo NULL
  PRIMARY KEY (`id_produto`),
  INDEX `id_mercado` (`id_mercado` ASC),
  CONSTRAINT `produto_ibfk_1`
    FOREIGN KEY (`id_mercado`)
    REFERENCES `marketbank`.`mercado` (`id_mercado`),
  CONSTRAINT `fk_produto_filtroproduto1`
    FOREIGN KEY (`id_filtro`)
    REFERENCES `marketbank`.`filtroproduto` (`id_filtro`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

-- -----------------------------------------------------
-- Table `marketbank`.`itens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marketbank`.`itens` (
  `id_itens` INT(11) NOT NULL AUTO_INCREMENT,
  `quantidade` INT(11) NOT NULL,
  `id_carrinho` INT(11) NOT NULL,
  `id_produto` INT(11) NOT NULL,
  PRIMARY KEY (`id_itens`),
  INDEX `fk_itens_carrinho1_idx` (`id_carrinho` ASC) ,
  INDEX `fk_itens_produto1_idx` (`id_produto` ASC) ,
  CONSTRAINT `fk_itens_carrinho1`
    FOREIGN KEY (`id_carrinho`)
    REFERENCES `marketbank`.`carrinho` (`id_carrinho`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_itens_produto1`
    FOREIGN KEY (`id_produto`)
    REFERENCES `marketbank`.`produto` (`id_produto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;




INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `tipo`) VALUES
(1, 'Fabio Guimarâes', 'supresko@gmail.com', '202cb962ac59075b964b07152d234b70', 'dono'),
(2, 'Josias', 'fineno@gmail.com', '202cb962ac59075b964b07152d234b70', 'dono'),
(3, 'Manuel', 'baratissimo@gmail.com', '202cb962ac59075b964b07152d234b70', 'dono'),
(4, 'carlinhos', 'carlinhos@gmail.com', '202cb962ac59075b964b07152d234b70', 'dono');


INSERT INTO `usuario` (`id_usuario`,`nome`, `email`, `senha`, `tipo`) VALUES
(5,'Administrador', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'administrador'),
(6,'João da Silva', 'joao@gmail.com', '202cb962ac59075b964b07152d234b70', 'cliente'),
(7,'Maria Santos', 'maria@gmail.com', '202cb962ac59075b964b07152d234b70', 'cliente'),
(8,'Carlos Oliveira', 'carlos@gmail.com', '202cb962ac59075b964b07152d234b70', 'cliente'),
(9,'Ana Souza', 'ana@gmail.com', '202cb962ac59075b964b07152d234b70', 'cliente'),
(10,'Pedro Almeida', 'pedro@gmail.com', '202cb962ac59075b964b07152d234b70', 'cliente');

INSERT INTO cliente (`id_cliente`,`id_usuario`,`telefone`)VALUES
(1, 6, '61958598541'),
(2, 7, '61256846254'),
(3, 8, '61928765741'),
(4, 9, '63293442341'),
(5, 10,'61923432434');

INSERT INTO `mercado` (`id_mercado`, `nomeMerc`, `regiaoadm`, `endereco`, `horarioAbert`, `horarioFecha`, `telefone`, `cnpj`, `imagem`, `descricao`, `id_dono`, `compras`) VALUES
(1, 'Supresko', 'Recanto das Emas', 'QNH 8 Conjunto H ', '08:30:00', '22:00:00', '25452424242', '12313333131129', '666ae7c84abe4.jpg', 'Fechado nos feriados', 1, 'sim'),
(2, 'Fineno', 'Recanto das Emas', 'QNH 85 Conjunto Y Rua dos Ares', '09:00:00', '22:50:00', '84789884897', '95943135861786', '666ae88cb0ae7.jpg', 'nos finais de semana fechamos às 20 hrs', 2, 'sim'),
(3, 'Baratissimo', 'Santa Maria', 'QRT 70 Conjunto Z Rua do  Arouche', '08:50:00', '22:00:00', '74394939834', '61751651464558', '666ae9efeabf6.jpg', 'entre o periodo de 12:30 e 13:00 hrs fechamos para o almoço', 3, 'sim'),
(4, 'Carlinhos supermercado', 'Ceilândia', 'HSR 70 Conjunto J Rua do  Matagal', '08:00:00', '22:00:00', '20502050205', '67189771879749', '666af0cdef4d9.jfif', '', 4, 'sim');


INSERT INTO `infopag` (`id_infoPag`, `id_mercado`, `tipo`, `pix`) VALUES
(1, 1, 'email', 'supresko@gmail.com'),
(2, 2, 'cnpj', '95943135861786'),
(3, 3, 'telefone', '74394939834'),
(4, 4, 'telefone', '20502050205');

INSERT INTO `filtroproduto` (`id_filtro`, `nomeFiltro`, `id_mercado`) VALUES
(1, 'Frios', 2),
(2, 'Verduras', 2),
(3, 'Laticínios', 1),
(4, 'Açogue', 1),
(6, 'Frutas', 3);


INSERT INTO `produto` (`id_produto`, `nome`, `preco`, `fotoProduto`, `descricao`, `id_mercado`, `id_filtro`) VALUES
(1, 'Laranja-pera', '3.00', '666aead6bdc5b.jpg', 'Por Kg', 3, 6),
(2, 'Pacote de bala 7 Belo ', '14.00', '666aebcde259c.webp', '600g', 2, 1),
(3, 'Leite Piracanjuba', '2.00', '666aecce63099.webp', '1 Litro', 1, 3),
(4, 'Queijo President', '20.00', '666aed797cb37.webp', '', 1, 3),
(5, 'Carne de Vitela', '12.00', '666aee882bd96.png', 'Por Kg', 1, 4),
(6, 'Creme Nívea', '10.00', '666af1275ba24.jpg', '', 4, NULL);



INSERT INTO `panfleto` (`id_panfleto`, `foto`, `validade`, `descricao`, `id_mercado`) VALUES
(1, '666aeedfd91b5.jpg', '2024-06-20', '', 1);
















