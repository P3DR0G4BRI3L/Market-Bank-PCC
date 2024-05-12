-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/05/2024 às 07:43
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `marketbank`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `mercado`
--

CREATE TABLE `mercado` (
  `id_mercado` int(11) NOT NULL,
  `nomeMerc` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `horarioAbert` time NOT NULL,
  `horarioFecha` time NOT NULL,
  `telefone` int(11) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `imagem` varchar(120) NOT NULL,
  `id_dono` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mercado`
--

INSERT INTO `mercado` (`id_mercado`, `nomeMerc`, `endereco`, `horarioAbert`, `horarioFecha`, `telefone`, `cnpj`, `imagem`, `id_dono`) VALUES
(1, 'mercadin do predo', 'samambaia sul qr 514 logradouro 42 apartamento 12', '07:00:00', '22:00:00', 2147483647, '12345672345678', 'Leonardo_Diffusion_XL_crie_uma_imagem_de_fundo_de_um_site_de_r_0.jpg', 1),
(2, 'buteco mercado do pedro', 'taguatinga norte qnh 13 conjunto 12 lote 9', '05:00:00', '23:00:00', 2147483647, '23232323232233', 'th.jpeg', 4),
(3, 'americanas', 'samambaia norte qn213 conjunto 3 lote 14', '05:00:00', '21:00:00', 2147483647, '12234343235343', 'americanas.jpeg', 5);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `mercado`
--
ALTER TABLE `mercado`
  ADD PRIMARY KEY (`id_mercado`),
  ADD KEY `id_dono` (`id_dono`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `mercado`
--
ALTER TABLE `mercado`
  MODIFY `id_mercado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `mercado`
--
ALTER TABLE `mercado`
  ADD CONSTRAINT `mercado_ibfk_1` FOREIGN KEY (`id_dono`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
