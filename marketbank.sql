-- Tabela Usuario
CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('cliente', 'administrador', 'dono') -- Ou qualquer tipo adicional que você precise
);

-- Tabela Mercado
CREATE TABLE mercado (
    id_mercado INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    horarioFunc TIME NOT NULL,
    telefone INT NOT NULL,
    cnpj  VARCHAR(20)NOT NULL,
    id_dono INT,
    FOREIGN KEY (id_dono) REFERENCES usuario(id_usuario)
);

-- Tabela Produto
CREATE TABLE produto (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    id_mercado INT,
    FOREIGN KEY (id_mercado) REFERENCES mercado(id_mercado)
);

-- Tabela Sessao
CREATE TABLE sessao (
    id_sessao INT AUTO_INCREMENT PRIMARY KEY,
    id_mercado INT,
    FOREIGN KEY (id_mercado) REFERENCES mercado(id_mercado)
);

-- Tabela Administrador
CREATE TABLE administrador (
    id_administrador INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

-- Tabela Cliente
CREATE TABLE cliente (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);