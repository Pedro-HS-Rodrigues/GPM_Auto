-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/08/2024 às 20:29
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gpm_auto`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `veiculo` varchar(50) DEFAULT NULL,
  `placa` varchar(10) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `id` int(11) NOT NULL,
  `resp` int(11) DEFAULT NULL,
  `nome_prod` varchar(100) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `qntd` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estoque`
--

INSERT INTO `estoque` (`id`, `resp`, `nome_prod`, `tipo`, `qntd`) VALUES
(1, NULL, 'Óleo de Motor 5W30', 'Lubrificante', 1),
(2, NULL, 'Filtro de Óleo', 'Peça de Reposição', 0),
(3, NULL, 'Pastilha de Freio', 'Peça de Reposição', 5),
(4, NULL, 'Velas de Ignição', 'Peça de Reposição', 0),
(5, NULL, 'Bateria de Carro 60Ah', 'Elétrico', 5),
(6, NULL, 'Cabo de Velas', 'Peça de Reposição', 20),
(7, NULL, 'Correia Dentada', 'Peça de Reposição', 10),
(8, NULL, 'Óleo de Transmissão', 'Lubrificante', 4),
(9, NULL, 'Amortecedor Dianteiro', 'Peça de Reposição', 9),
(10, NULL, 'Amortecedor Traseiro', 'Peça de Reposição', 20),
(11, NULL, 'Kit de Embreagem', 'Peça de Reposição', 5),
(12, NULL, 'Filtro de Ar', 'Peça de Reposição', 20),
(13, NULL, 'Radiador', 'Peça de Reposição', 15),
(14, NULL, 'Cinta de Freio de Mão', 'Peça de Reposição', 20),
(15, NULL, 'Bico Injetor', 'Peça de Reposição', 30),
(16, NULL, 'Disco de Freio', 'Peça de Reposição', 22),
(17, NULL, 'Palhetas de Limpador', 'Acessório', 30),
(18, NULL, 'Lanterna Traseira', 'Peça de Reposição', 20),
(19, NULL, 'Farol Dianteiro', 'Peça de Reposição', 20),
(20, NULL, 'Filtro de Combustível', 'Peça de Reposição', 40),
(29, NULL, 'Pneu aro 20', 'Pneus e Aros', 3),
(30, NULL, 'Caneta esferografica', 'Escrivania', 20),
(31, NULL, 'CodeIgniter', 'CodeIgniter', 2),
(33, NULL, 'Insercao de teste', 'Teste', 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `servico`
--

CREATE TABLE `servico` (
  `id` int(11) NOT NULL,
  `mecanico` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `servico` varchar(50) DEFAULT NULL,
  `produto` int(11) DEFAULT NULL,
  `quantidade_prod` tinyint(4) DEFAULT NULL,
  `placa` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servico`
--

INSERT INTO `servico` (`id`, `mecanico`, `data`, `servico`, `produto`, `quantidade_prod`, `placa`) VALUES
(15, 3, '2024-07-19', 'Balanceamento\n', 1, 10, NULL),
(16, 3, '2024-07-19', 'Balanceamento\n', 1, 10, NULL),
(17, 3, '2024-07-19', 'Balanceamento\n', 1, 10, NULL),
(18, 3, '2024-07-19', 'Balanceamento\n', 1, 10, NULL),
(19, 3, '2024-07-19', 'Balanceamento\n', 1, 10, NULL),
(20, 3, '2024-07-19', 'Balanceamento\n', 1, 10, NULL),
(21, 3, '2024-07-19', 'Balanceamento\n', 1, 10, NULL),
(42, 18, '2024-07-01', 'Trocou oleo', 4, 1, NULL),
(44, 18, '2024-07-19', 'Balanceamento', 4, 1, NULL),
(45, 3, '2024-07-25', 'Balanceamento', 6, 2, NULL),
(46, 3, '2024-07-25', 'Balanceamento', 5, 16, NULL),
(47, 3, '2024-07-25', 'Balanceamento', 10, 50, NULL),
(48, 3, '2024-07-25', 'Pneu', 10, 77, NULL),
(50, 18, '2024-08-02', 'Trocou oleo', 1, 1, NULL),
(51, 3, '2024-08-02', 'Teste Code Igniter', 1, 5, NULL),
(52, 3, '2024-08-02', 'Teste Code Igniter 2', 5, 3, NULL),
(53, 3, '2024-08-02', 'Teste Code Igniter 3', 4, 1, NULL),
(55, 3, '2024-08-02', 'Troca de Pastilhas de Freio', 1, 1, NULL),
(56, 3, '2024-08-01', 'Troca de Filtro de Ar', 12, 10, '5555'),
(57, 3, '2024-08-01', 'Troca de Filtro de Ar', 12, 10, '6666'),
(58, 3, '2024-08-02', 'Troca de Filtro de Ar', 12, 1, '1111'),
(59, 3, '2024-08-02', 'Troca de Filtro de Ar', 12, 1, '2222'),
(60, 3, '2024-08-02', 'Troca de Filtro de Ar', 12, 1, '3333'),
(61, 3, '2024-08-02', 'Troca de Filtro de Ar', 12, 1, '4444'),
(62, 3, '2024-08-02', 'Troca de Filtro de Ar', 12, 1, '5555'),
(63, 18, '2024-08-02', 'Troca de Óleo', 1, 1, '55556'),
(64, 18, '2024-08-03', 'Troca de Óleo', 8, 5, '7777'),
(65, 18, '2024-08-31', 'Substituição de Velas', 4, 10, '7777'),
(66, 18, '2024-08-03', 'Troca de Pastilhas de Freio', 3, 10, '7777'),
(67, 18, '2024-08-09', 'Troca de Óleo', 8, 1, ''),
(68, 3, '2024-08-09', 'Troca de Bateria', 5, 5, ''),
(69, 3, '2024-08-02', 'Troca de Filtro de Ar', 4, 60, ''),
(70, 3, '2024-08-02', 'Substituição de Velas', 9, 1, ''),
(71, 3, '2024-09-07', 'Substituição de Velas', 3, 5, ''),
(73, 3, '2024-08-02', 'Troca de óleoooooooo', 5, 1, 'ABC1234'),
(74, 3, '2024-09-06', 'Troca de Pastilhas de Freio', 2, 1, ''),
(75, 18, '2024-08-02', 'Alinhamento e Balanceamento', 29, 2, 'PMS4939'),
(76, 3, '2024-08-03', 'Reparo de Vazamentos', 6, 2, ''),
(77, 3, '2024-10-12', 'Troca de Pastilhas de Freio', 6, 3, ''),
(78, 3, '2024-12-21', 'Troca de Filtro de Ar', 14, 10, 'PMS49392'),
(80, 3, '2024-08-03', 'Troca de Pastilhas de Freio', 2, 20, 'PMS4939'),
(85, 18, '2024-08-03', 'Troca de Óleo', 3, 5, 'PMS4939');

--
-- Acionadores `servico`
--
DELIMITER $$
CREATE TRIGGER `update_estoque_after_servico` AFTER INSERT ON `servico` FOR EACH ROW BEGIN
    UPDATE `estoque`
    SET `qntd` = GREATEST(`qntd` - NEW.`quantidade_prod`, 0)
    WHERE `id` = NEW.`produto`;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `nivel` tinyint(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `cargo`, `nivel`, `username`, `senha`) VALUES
(3, 'Pedro Henrique Santos Rodrigues', 'Mecânico Geral', 3, 'prodrigues', '$2y$10$kT5YnbuQHd4sxXChYTiG3Oai5RvhaXpQ9GEPtcO9rmnz05PQ6.G7e'),
(4, 'João Marcelo Pereira', 'Gerente de estoque', 2, 'jmarcelo', '$2y$10$I0txQk8uhO2hmz6PI9RO0uvuGmsEbB2FSrXRKHwim9Dyao1Psdhmm'),
(5, 'GPM Master', 'Administrador', 1, 'admin', '$2y$10$tV8hZxJtwu68tFFyOHtVnedxbQupRJI2BlnYjiMti5yvgKSgaLZfi'),
(13, 'Pedro Henrique Santos Rodrigues', 'Mecânico Geral', 2, 'zeze', '$2y$10$mf3wi6rH7BbH95aG.1Y26.c2WHufrfdmmfkG4VQugYP6ErvLzs.cy'),
(15, 'Cristiano', 'Vendedor', 4, 'vendedor2', '$2y$10$5syrt9mmKgJzoZzBINCKauRgB7LZ7yeAB3qI4rJdtVcp5t8pOscnu'),
(16, 'Pedro Henrique', 'Vendedor', 4, 'vendedor', '$2y$10$6tQitpWvaROfpGR109q3K.BaB4LiHcjD56aHQpkprhLcr9zgqpS0K'),
(17, 'Bruno Mars', 'Almoxarife', 2, 'almoxarife', '$2y$10$V78nq2pFfSeqnYq8WF/qj.xJRvDcVqZIvl1sJbKUxSHMgDz4OgkFW'),
(18, 'Michael Jaime', 'Mecanico', 3, 'mecanico', '$2y$10$lcBzWLUdehk5ZkZ7f3yp2OkYzYeqzEyWEF5Ux.KVBPax/6d6NYJNK'),
(20, 'Mateus', 'Vendedor de Pneus', 4, 'matheus29', '$2y$10$Pghh6e1UZDVhdVFUxouxB.gu22VkgGxyEzN0C9V5i8m.oibWTgIGG'),
(22, 'Petrus', 'Administrador', 1, 'Petrus', '$2y$10$4jjFtiBGTXpKcUmk1F4YCuj.Is6m3KM3vy8xhqMkjN8PhIUgH5Loe'),
(43, 'Manoel Fernandes', 'Administrador', 2, 'almoxarife2', '$2y$10$a/cR6/Aq98gR4E4vNcm9COJ32ilgQ3B0/aMm7.f7WDOqEW2q6r14.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `vendedor` int(11) NOT NULL,
  `data` date NOT NULL,
  `produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `venda`
--

INSERT INTO `venda` (`id`, `vendedor`, `data`, `produto`, `quantidade`) VALUES
(2, 15, '2024-07-18', 1, 5),
(3, 15, '2024-07-18', 1, 10),
(4, 15, '2024-07-19', 5, 10),
(5, 15, '2024-07-19', 5, 10),
(6, 15, '2024-07-19', 12, 10),
(7, 15, '2024-07-17', 3, 10),
(8, 15, '2024-07-17', 3, 77),
(9, 16, '2024-07-02', 6, 2),
(10, 16, '2024-07-18', 2, 5),
(11, 16, '2024-07-19', 13, 9),
(12, 16, '2024-07-05', 2, 20),
(13, 20, '2024-07-07', 4, 1),
(14, 16, '2024-07-20', 7, 1),
(15, 16, '2024-07-04', 30, 1),
(16, 16, '2024-07-25', 30, 2),
(17, 16, '2024-07-26', 9, 7),
(18, 16, '2024-07-25', 9, 4),
(19, 15, '2024-07-25', 7, 5),
(20, 15, '2024-08-01', 1, 2),
(21, 16, '2024-08-01', 1, 5),
(22, 15, '2024-08-01', 3, 5),
(23, 15, '2024-08-01', 7, 3),
(25, 16, '2024-08-01', 4, 2),
(26, 15, '2024-08-01', 4, 2),
(27, 16, '2024-08-01', 4, 4),
(28, 16, '2024-08-01', 4, 6),
(29, 16, '2024-08-01', 31, 3),
(30, 15, '2024-08-01', 6, 39),
(31, 16, '2024-08-01', 4, 5),
(32, 16, '2024-08-02', 4, 2),
(33, 20, '2024-08-01', 4, 1),
(34, 20, '2024-08-01', 4, 1),
(35, 16, '2024-08-01', 11, 5),
(36, 16, '2024-08-01', 8, 2),
(37, 16, '2024-08-02', 12, 5),
(38, 16, '2024-08-03', 1, 2),
(39, 16, '2024-08-10', 5, 3),
(40, 16, '2024-08-10', 5, 2),
(41, 16, '2024-08-31', 8, 5),
(42, 16, '2024-08-31', 8, 5),
(43, 16, '2024-08-31', 6, 5),
(44, 16, '2024-08-02', 2, 5),
(45, 15, '2024-08-03', 3, 5);

--
-- Acionadores `venda`
--
DELIMITER $$
CREATE TRIGGER `update_estoque_where_null` AFTER INSERT ON `venda` FOR EACH ROW BEGIN
    UPDATE `estoque`
    SET `qntd` = GREATEST(`qntd` - NEW.`quantidade`, 0)
    WHERE `id` = NEW.`produto`;
END
$$
DELIMITER ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resp` (`resp`);

--
-- Índices de tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mecanico` (`mecanico`),
  ADD KEY `produto` (`produto`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendedor` (`vendedor`),
  ADD KEY `produto` (`produto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`resp`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `servico`
--
ALTER TABLE `servico`
  ADD CONSTRAINT `servico_ibfk_2` FOREIGN KEY (`mecanico`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `servico_ibfk_3` FOREIGN KEY (`produto`) REFERENCES `estoque` (`id`);

--
-- Restrições para tabelas `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`vendedor`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`produto`) REFERENCES `estoque` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
