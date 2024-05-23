DROP DATABASE IF EXISTS marketbank;
CREATE DATABASE marketbank;
USE marketbank;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

-- Criação da tabela `usuario`
CREATE TABLE usuario (
  id_usuario INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  senha VARCHAR(255) NOT NULL,
  tipo ENUM('cliente', 'administrador', 'dono') DEFAULT NULL,
  PRIMARY KEY (id_usuario),
  UNIQUE INDEX email (email)
) ENGINE = InnoDB
DEFAULT CHARSET = utf8mb4;

-- Criação da tabela `administrador`
CREATE TABLE administrador (
  id_administrador INT(11) NOT NULL AUTO_INCREMENT,
  id_usuario INT(11) NOT NULL,
  PRIMARY KEY (id_administrador),
  INDEX (id_usuario),
  CONSTRAINT administrador_ibfk_1 FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario)
) ENGINE = InnoDB
DEFAULT CHARSET = utf8mb4;

-- Criação da tabela `cliente`
CREATE TABLE cliente (
  id_cliente INT(11) NOT NULL AUTO_INCREMENT,
  id_usuario INT(11) NOT NULL,
  PRIMARY KEY (id_cliente),
  INDEX (id_usuario),
  CONSTRAINT cliente_ibfk_1 FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario)
) ENGINE = InnoDB
DEFAULT CHARSET = utf8mb4;

-- Criação da tabela `mercado`
CREATE TABLE mercado (
  id_mercado INT(11) NOT NULL AUTO_INCREMENT,
  nomeMerc VARCHAR(255) NOT NULL,
  regiaoadm VARCHAR(45) NOT NULL,
  endereco VARCHAR(255) NOT NULL,
  horarioAbert TIME NOT NULL,
  horarioFecha TIME NOT NULL,
  telefone VARCHAR(11) NOT NULL,
  cnpj VARCHAR(20) NOT NULL,
  imagem VARCHAR(120) NOT NULL,
  descricao TEXT,
  id_dono INT(11) NOT NULL,
  compras ENUM('sim', 'nao') NOT NULL,
  PRIMARY KEY (id_mercado),
  INDEX (id_dono),
  CONSTRAINT mercado_ibfk_1 FOREIGN KEY (id_dono) REFERENCES usuario (id_usuario)
) ENGINE = InnoDB
DEFAULT CHARSET = utf8mb4;

-- Criação da tabela `produto`
CREATE TABLE produto (
  id_produto INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  preco DECIMAL(10,2) NOT NULL,
  fotoProduto VARCHAR(120) NOT NULL,
  descricao TEXT,
  id_mercado INT(11) NOT NULL,
  PRIMARY KEY (id_produto),
  INDEX (id_mercado),
  CONSTRAINT produto_ibfk_1 FOREIGN KEY (id_mercado) REFERENCES mercado (id_mercado)
) ENGINE = InnoDB
DEFAULT CHARSET = utf8mb4;

-- Criação da tabela `filtroProduto`
CREATE TABLE filtroProduto (
  id_sessao INT(11) NOT NULL AUTO_INCREMENT,
  nomeSessao VARCHAR(45) NOT NULL,
  id_mercado INT(11) NOT NULL,
  id_produto INT(11) NOT NULL,
  PRIMARY KEY (id_sessao),
  INDEX (id_mercado),
  INDEX (id_produto),
  CONSTRAINT filtroProduto_ibfk_1 FOREIGN KEY (id_mercado) REFERENCES mercado (id_mercado),
  CONSTRAINT filtroProduto_ibfk_2 FOREIGN KEY (id_produto) REFERENCES produto (id_produto)
) ENGINE = InnoDB
DEFAULT CHARSET = utf8mb4;

-- Criação da tabela `carrinho`
CREATE TABLE carrinho (
  id_carrinho INT(11) NOT NULL AUTO_INCREMENT,
  id_produto INT(11) NOT NULL,
  id_cliente INT(11) NOT NULL,
  PRIMARY KEY (id_carrinho),
  INDEX (id_produto),
  INDEX (id_cliente),
  CONSTRAINT carrinho_ibfk_1 FOREIGN KEY (id_produto) REFERENCES produto (id_produto),
  CONSTRAINT carrinho_ibfk_2 FOREIGN KEY (id_cliente) REFERENCES cliente (id_cliente)
) ENGINE = InnoDB
DEFAULT CHARSET = utf8mb4;

-- Criação da tabela `panfleto`
CREATE TABLE panfleto (
  id_panfleto INT(11) NOT NULL AUTO_INCREMENT,
  foto VARCHAR(120) NOT NULL,
  validade DATE NOT NULL,
  descricao TEXT,
  id_mercado INT(11) NOT NULL,
  PRIMARY KEY (id_panfleto),
  INDEX (id_mercado),
  CONSTRAINT panfleto_ibfk_1 FOREIGN KEY (id_mercado) REFERENCES mercado (id_mercado)
) ENGINE = InnoDB
DEFAULT CHARSET = utf8mb4;

-- Criação da tabela `infoPag`
CREATE TABLE infoPag (
  id_infoPag INT(11) NOT NULL AUTO_INCREMENT,
  id_mercado INT(11) NOT NULL,
  PRIMARY KEY (id_infoPag),
  INDEX (id_mercado),
  CONSTRAINT infoPag_ibfk_1 FOREIGN KEY (id_mercado) REFERENCES mercado (id_mercado)
) ENGINE = InnoDB
DEFAULT CHARSET = utf8mb4;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
