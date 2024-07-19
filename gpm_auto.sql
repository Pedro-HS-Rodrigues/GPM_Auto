-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/07/2024 às 03:04
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
(1, NULL, 'Óleo de Motor 5W30', 'Lubrificante', 5),
(2, NULL, 'Filtro de Óleo', 'Peça de Reposição', 25),
(3, NULL, 'Pastilha de Freio', 'Peça de Reposição', 15),
(4, NULL, 'Velas de Ignição', 'Peça de Reposição', 40),
(5, NULL, 'Bateria de Carro 60Ah', 'Elétrico', 15),
(6, NULL, 'Cabo de Velas', 'Peça de Reposição', 71),
(7, NULL, 'Correia Dentada', 'Peça de Reposição', 20),
(8, NULL, 'Óleo de Transmissão', 'Lubrificante', 22),
(9, NULL, 'Amortecedor Dianteiro', 'Peça de Reposição', 17),
(10, NULL, 'Amortecedor Traseiro', 'Peça de Reposição', 127),
(11, NULL, 'Kit de Embreagem', 'Peça de Reposição', 10),
(12, NULL, 'Filtro de Ar', 'Peça de Reposição', 50),
(13, NULL, 'Radiador', 'Peça de Reposição', 8),
(14, NULL, 'Cinta de Freio de Mão', 'Peça de Reposição', 15),
(15, NULL, 'Bico Injetor', 'Peça de Reposição', 30),
(16, NULL, 'Disco de Freio', 'Peça de Reposição', 25),
(17, NULL, 'Palhetas de Limpador', 'Acessório', 30),
(18, NULL, 'Lanterna Traseira', 'Peça de Reposição', 20),
(19, NULL, 'Farol Dianteiro', 'Peça de Reposição', 10),
(20, NULL, 'Filtro de Combustível', 'Peça de Reposição', 40),
(21, NULL, 'juninho', 'juninho', 1),
(22, NULL, 'abcd', 'abcd', 527),
(23, NULL, 'dasd', 'dasda', 2),
(24, NULL, 'dadas', 'dasda', 2),
(25, NULL, 'asda', 'dasda', 2),
(26, NULL, 'ads', 'dasd', 17),
(27, NULL, 'dasdsas', 'dasdas', 56),
(28, NULL, 'aaaaaaaaaa', 'aaaaaaaaaa', 200);

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
  `quantidade_prod` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servico`
--

INSERT INTO `servico` (`id`, `mecanico`, `data`, `servico`, `produto`, `quantidade_prod`) VALUES
(15, 3, '2024-07-19', 'dasd', 1, 10),
(16, 3, '2024-07-19', 'dasd', 1, 10),
(17, 3, '2024-07-19', 'dasd', 1, 10),
(18, 3, '2024-07-19', 'dasd', 1, 10),
(19, 3, '2024-07-19', 'dasd', 1, 10),
(20, 3, '2024-07-19', 'dasd', 1, 10),
(21, 3, '2024-07-19', 'dasd', 1, 10),
(25, 3, NULL, 'Trocou oleo', 1, 10),
(26, 3, NULL, 'Trocou oleo', 8, 6),
(27, 3, NULL, 'Trocou oleo', 2, 5),
(28, 14, NULL, 'dasd', 1, 5),
(29, 14, NULL, 'Pneu', 3, 10);

--
-- Acionadores `servico`
--
DELIMITER $$
CREATE TRIGGER `update_estoque_after_servico` AFTER INSERT ON `servico` FOR EACH ROW BEGIN
    -- Subtrai a quantidade do produto no estoque
    UPDATE estoque
    SET qntd = qntd - NEW.quantidade_prod
    WHERE id = NEW.produto;
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
(6, 'joao carlos', 'teste', 2, 'teste', '$2y$10$n2NZJtbYxwF7KobhvwyLh.GJlhhqcmfT.qIhV1XD0caHV980Q0z1a'),
(9, 'da', 'asdas', 2, 'adsd', '$2y$10$R7XcYmbUQnioFk3rWdjNEuOhgAVnaBtJ.73yrtItV8Gv5odrXouNO'),
(13, 'Pedro Henrique Santos Rodrigues', 'Mecânico Geral', 2, 'zeze', '$2y$10$mf3wi6rH7BbH95aG.1Y26.c2WHufrfdmmfkG4VQugYP6ErvLzs.cy'),
(14, 'juninho', 'Mecânico Geral', 3, 'ze', '$2y$10$7t/G5iZixeTWMrHRW/IEyultPu49iC3Ac.wzGrK99tO82ujrJ5LsC');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
