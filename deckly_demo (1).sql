-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/10/2026 às 16:01
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
-- BANCO DE DEMONSTRAÇÃO: dados pessoais substituídos por valores fictícios.
-- Senha de demonstração para usuários importados: demo123. Altere após importar.
-- Banco de dados: `deckly`
--
CREATE DATABASE IF NOT EXISTS `deckly` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `deckly`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cargo`
--

CREATE TABLE `cargo` (
  `codigo_cargo` int(2) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `observacao` varchar(100) DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cargo`
--

INSERT INTO `cargo` (`codigo_cargo`, `nome`, `observacao`, `data_cadastro`, `status`) VALUES
(1, 'Administrador', '', '2026-10-16 09:28:48', b'1'),
(2, 'Faxineiro', '', '2026-10-16 09:28:49', b'1'),
(3, 'Vendedor', '', '2026-10-16 09:28:51', b'1'),
(4, 'TI', '', '2026-10-16 09:28:55', b'1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `codigo_categoria` int(2) NOT NULL,
  `nome_categoria` varchar(60) NOT NULL,
  `observacao` varchar(100) DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `status_categoria` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`codigo_categoria`, `nome_categoria`, `observacao`, `data_cadastro`, `status_categoria`) VALUES
(1, 'One Piece', '', '2026-10-16 09:29:14', b'1'),
(2, 'Yu-Gi-Oh', '', '2026-10-16 09:29:16', b'1'),
(3, 'Pokemon', '', '2026-10-16 09:29:18', b'1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `codigo_cliente` int(8) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `nome_social` varchar(60) DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` char(1) NOT NULL,
  `cpf` char(14) NOT NULL,
  `rg` varchar(12) DEFAULT NULL,
  `endereco` varchar(70) NOT NULL,
  `numero` int(4) NOT NULL,
  `complemento` varchar(40) DEFAULT NULL,
  `bairro` varchar(30) NOT NULL,
  `cidade` varchar(40) NOT NULL,
  `estado` char(2) NOT NULL,
  `cep` char(9) NOT NULL,
  `telefone_celular` char(14) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`codigo_cliente`, `nome`, `nome_social`, `data_nascimento`, `sexo`, `cpf`, `rg`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`, `telefone_celular`, `email`, `data_cadastro`, `status`) VALUES
(1, 'Cliente Demonstração 01', '', '2000-01-01', 'N', '000.000.000-01', '00.000.000-0', 'Rua de Demonstração', 1, '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', '(00)00000-0000', 'cliente01@example.com', '2026-01-01 12:00:00', b'1'),
(2, 'Cliente Demonstração 02', '', '2000-01-01', 'N', '000.000.000-02', '00.000.000-0', 'Rua de Demonstração', 1, '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', '(00)00000-0000', 'cliente02@example.com', '2026-01-01 12:00:00', b'1'),
(3, 'Cliente Demonstração 03', '', '2000-01-01', 'N', '000.000.000-03', '00.000.000-0', 'Rua de Demonstração', 1, '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', '(00)00000-0000', 'cliente03@example.com', '2026-01-01 12:00:00', b'1'),
(4, 'Cliente Demonstração 04', '', '2000-01-01', 'N', '000.000.000-04', '00.000.000-0', 'Rua de Demonstração', 1, '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', '(00)00000-0000', 'cliente04@example.com', '2026-01-01 12:00:00', b'1'),
(5, 'Cliente Demonstração 05', '', '2000-01-01', 'N', '000.000.000-05', '00.000.000-0', 'Rua de Demonstração', 1, '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', '(00)00000-0000', 'cliente05@example.com', '2026-01-01 12:00:00', b'1'),
(6, 'Cliente Demonstração 06', '', '2000-01-01', 'N', '000.000.000-06', '00.000.000-0', 'Rua de Demonstração', 1, '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', '(00)00000-0000', 'cliente06@example.com', '2026-01-01 12:00:00', b'1'),
(7, 'Cliente Demonstração 07', '', '2000-01-01', 'N', '000.000.000-07', '00.000.000-0', 'Rua de Demonstração', 1, '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', '(00)00000-0000', 'cliente07@example.com', '2026-01-01 12:00:00', b'1'),
(8, 'Cliente Demonstração 08', '', '2000-01-01', 'N', '000.000.000-08', '00.000.000-0', 'Rua de Demonstração', 1, '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', '(00)00000-0000', 'cliente08@example.com', '2026-01-01 12:00:00', b'1'),
(9, 'Cliente Demonstração 09', '', '2000-01-01', 'N', '000.000.000-09', '00.000.000-0', 'Rua de Demonstração', 1, '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', '(00)00000-0000', 'cliente09@example.com', '2026-01-01 12:00:00', b'1'),
(10, 'Cliente Demonstração 10', '', '2000-01-01', 'N', '000.000.000-10', '00.000.000-0', 'Rua de Demonstração', 1, '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', '(00)00000-0000', 'cliente10@example.com', '2026-01-01 12:00:00', b'1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `codigo_funcionario` int(4) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `nome_social` varchar(60) DEFAULT NULL,
  `foto` varchar(40) DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` char(1) NOT NULL,
  `estado_civil` varchar(20) DEFAULT NULL,
  `cpf` char(14) NOT NULL,
  `rg` varchar(12) DEFAULT NULL,
  `salario` decimal(7,2) DEFAULT NULL,
  `telefone_residencial` char(13) DEFAULT NULL,
  `telefone_celular` char(14) DEFAULT NULL,
  `endereco` varchar(70) NOT NULL,
  `complemento` varchar(40) DEFAULT NULL,
  `bairro` varchar(30) NOT NULL,
  `cidade` varchar(40) NOT NULL,
  `estado` char(2) NOT NULL,
  `cep` char(9) NOT NULL,
  `numero` int(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `senha` char(8) NOT NULL,
  `tipo_acesso` bit(1) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `status` bit(1) NOT NULL,
  `codigo_cargo` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionario`
--

INSERT INTO `funcionario` (`codigo_funcionario`, `nome`, `nome_social`, `foto`, `data_nascimento`, `sexo`, `estado_civil`, `cpf`, `rg`, `salario`, `telefone_residencial`, `telefone_celular`, `endereco`, `complemento`, `bairro`, `cidade`, `estado`, `cep`, `numero`, `email`, `usuario`, `senha`, `tipo_acesso`, `data_cadastro`, `status`, `codigo_cargo`) VALUES
(1, 'Funcionário Demonstração 01', '', 'haymitch.jpg', '2000-01-01', 'N', 'Solteiro(a)', '000.000.000-01', '00.000.000-0', 6700.00, '(00)0000-0000', '(00)00000-0000', 'Rua de Demonstração', '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', 1, 'funcionario01@example.com', 'demo01', 'demo123', b'1', '2026-01-01 12:00:00', b'1', 1),
(2, 'Funcionário Demonstração 02', '', 'peeta.jpg', '2000-01-01', 'N', 'Solteiro(a)', '000.000.000-02', '00.000.000-0', 3000.00, '(00)0000-0000', '(00)00000-0000', 'Rua de Demonstração', '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', 2, 'funcionario02@example.com', 'demo02', 'demo123', b'0', '2026-01-01 12:01:00', b'1', 3),
(3, 'Funcionário Demonstração 03', '', 'kat.jpg', '2000-01-01', 'N', 'Solteiro(a)', '000.000.000-03', '00.000.000-0', 8000.00, '(00)0000-0000', '(00)00000-0000', 'Rua de Demonstração', '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', 3, 'funcionario03@example.com', 'demo03', 'demo123', b'1', '2026-01-01 12:02:00', b'1', 1),
(4, 'Funcionário Demonstração 04', '', 'images (1).jpg', '2000-01-01', 'N', 'Solteiro(a)', '000.000.000-04', '00.000.000-0', 2325.52, '(00)0000-0000', '(00)00000-0000', 'Rua de Demonstração', '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', 4, 'funcionario04@example.com', 'demo04', 'demo123', b'0', '2026-01-01 12:03:00', b'1', 3),
(6, 'Funcionário Demonstração 05', '', 'smeagol.jpg', '2000-01-01', 'N', 'Solteiro(a)', '000.000.000-05', '00.000.000-0', 2700.00, '(00)0000-0000', '(00)00000-0000', 'Rua de Demonstração', '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', 5, 'funcionario05@example.com', 'demo05', 'demo123', b'1', '2026-01-01 12:04:00', b'1', 2),
(7, 'Funcionário Demonstração 06', '', 'legolas.jpg', '2000-01-01', 'N', 'Solteiro(a)', '000.000.000-06', '00.000.000-0', 8000.00, '(00)0000-0000', '(00)00000-0000', 'Rua de Demonstração', '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', 6, 'funcionario06@example.com', 'demo06', 'demo123', b'1', '2026-01-01 12:05:00', b'1', 1),
(8, 'Funcionário Demonstração 07', '', 'Aragorn.webp', '2000-01-01', 'N', 'Solteiro(a)', '000.000.000-07', '00.000.000-0', 5000.00, '(00)0000-0000', '(00)00000-0000', 'Rua de Demonstração', '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', 7, 'funcionario07@example.com', 'demo07', 'demo123', b'0', '2026-01-01 12:06:00', b'1', 3),
(9, 'Funcionário Demonstração 08', '', 'arwen.jpg', '2000-01-01', 'N', 'Solteiro(a)', '000.000.000-08', '00.000.000-0', 8000.00, '(00)0000-0000', '(00)00000-0000', 'Rua de Demonstração', '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', 8, 'funcionario08@example.com', 'demo08', 'demo123', b'0', '2026-01-01 12:07:00', b'1', 3),
(10, 'Funcionário Demonstração 09', '', 'gimli.jpg', '2000-01-01', 'N', 'Solteiro(a)', '000.000.000-09', '00.000.000-0', 7523.56, '(00)0000-0000', '(00)00000-0000', 'Rua de Demonstração', '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', 9, 'funcionario09@example.com', 'demo09', 'demo123', b'0', '2026-01-01 12:08:00', b'1', 3),
(11, 'Funcionário Demonstração 10', '', '', '2000-01-01', 'N', 'Solteiro(a)', '000.000.000-10', '00.000.000-0', 10000.00, '(00)0000-0000', '(00)00000-0000', 'Rua de Demonstração', '', 'Bairro Exemplo', 'Cidade Exemplo', 'SP', '00000-000', 10, 'funcionario10@example.com', 'demo10', 'demo123', b'1', '2026-01-01 12:09:00', b'1', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_venda`
--

CREATE TABLE `itens_venda` (
  `codigo_itensvenda` int(5) NOT NULL,
  `quantidade_itens` int(4) DEFAULT NULL,
  `preco_unitario` decimal(7,2) NOT NULL,
  `valor_total` decimal(7,2) DEFAULT NULL,
  `codigo_produto` int(5) DEFAULT NULL,
  `codigo_pedido` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `marca`
--

CREATE TABLE `marca` (
  `codigo_marca` int(2) NOT NULL,
  `nome_marca` varchar(60) NOT NULL,
  `observacao` varchar(100) DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `status_marca` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `marca`
--

INSERT INTO `marca` (`codigo_marca`, `nome_marca`, `observacao`, `data_cadastro`, `status_marca`) VALUES
(1, 'Bandai', '', '2026-10-16 09:29:04', b'1'),
(2, 'Konami', '', '2026-10-16 09:29:06', b'1'),
(3, 'Global Pokémon Trading Card Game', '', '2026-10-16 09:29:08', b'1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `codigo_produto` int(5) NOT NULL,
  `nome_produto` varchar(40) NOT NULL,
  `descricao_produto` varchar(100) NOT NULL,
  `raridade_produto` varchar(20) NOT NULL,
  `quantidade_estoque` int(8) NOT NULL,
  `preco_custo` decimal(7,2) NOT NULL,
  `lucro` varchar(10) NOT NULL,
  `preco_venda` decimal(7,2) NOT NULL,
  `status_promocao` bit(1) NOT NULL,
  `desconto_promocao` decimal(4,2) NOT NULL,
  `preco_promocao` decimal(7,2) NOT NULL,
  `foto_produto1` varchar(40) NOT NULL,
  `foto_produto2` varchar(40) DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `status_produto` bit(1) NOT NULL,
  `codigo_categoria` int(2) DEFAULT NULL,
  `codigo_marca` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`codigo_produto`, `nome_produto`, `descricao_produto`, `raridade_produto`, `quantidade_estoque`, `preco_custo`, `lucro`, `preco_venda`, `status_promocao`, `desconto_promocao`, `preco_promocao`, `foto_produto1`, `foto_produto2`, `data_cadastro`, `status_produto`, `codigo_categoria`, `codigo_marca`) VALUES
(1, 'Right Leg Of The Forbidden One', '', 'Super rara', 20, 50.00, '40', 70.00, b'0', 0.00, 0.00, 'exodia3i.jpg', '', '2026-10-20 11:54:49', b'1', 2, 2),
(2, 'Exodia The Forbidden One', '', 'Super rara', 30, 55.00, '40', 77.00, b'0', 0.00, 0.00, 'exodia1.jpg', '', '2026-10-20 11:55:16', b'1', 2, 2),
(3, 'Right Arm Of The Forbidden One', '', 'Super rara', 15, 50.00, '40', 70.00, b'0', 0.00, 0.00, 'exodia8.jpg', '', '2026-10-20 11:55:52', b'1', 2, 2),
(4, 'Mega Mawile EX', '', 'Comum', 55, 30.00, '40', 42.00, b'1', 2.00, 41.16, 'mega_mawile-ex.jpg', '', '2026-10-20 11:56:27', b'1', 3, 3),
(5, 'Mew EX Shine', '', 'Super rara', 5, 1000.00, '40', 1400.00, b'1', 5.00, 1330.00, 'mew_shine_ex.jpg', '', '2026-10-20 11:56:54', b'1', 3, 3),
(6, 'Monkey D. Luffy', '', 'Comum', 15, 100.00, '10', 110.00, b'0', 0.00, 0.00, 'monkeydluffy.jpg', '', '2026-10-20 11:57:15', b'1', 1, 1),
(7, 'Edward Newgate', '', 'Rara', 12, 150.00, '20', 180.00, b'1', 0.00, 0.00, 'edwardnewgate-st15-002-st15-002_p1.webp', '', '2026-10-20 11:57:54', b'1', 1, 1),
(8, 'Lim', '', 'Super rara', 15, 500.00, '40', 700.00, b'1', 10.00, 630.00, 'lim.jpg', '', '2026-10-20 11:58:36', b'1', 1, 1),
(9, 'Roronoa Zoro', '', 'Mangá', 15, 52000.00, '10', 57200.00, b'1', 2.00, 56056.00, 'zoroverde.jpg', '', '2026-10-20 11:59:37', b'1', 1, 1),
(10, 'Sanji Mangá', '', 'Mangá', 12, 57000.00, '10', 62700.00, b'1', 5.00, 59565.00, 'sanjimanga.jpg', '', '2026-10-20 12:00:13', b'1', 1, 1),
(11, 'Pikachu EX', '', 'Rara', 15, 100.00, '10', 110.00, b'0', 0.00, 0.00, 'pikachu.png', '', '2026-10-21 09:06:45', b'1', 3, 3),
(12, 'Weezing ', '', 'Comum', 60, 15.00, '20', 18.00, b'0', 0.00, 0.00, 'weezing.jpg', '', '2026-10-21 09:08:29', b'1', 3, 3),
(14, 'Pichu', '', 'Comum', 75, 20.00, '10', 22.00, b'0', 0.00, 0.00, 'pichu.webp', '', '2026-10-21 09:11:35', b'1', 3, 3),
(15, 'Raichu', '', 'Incomum', 35, 40.00, '20', 48.00, b'0', 0.00, 0.00, 'raichu.jpg', '', '2026-10-21 09:14:14', b'1', 3, 3),
(16, 'Kingler', '', 'Comum', 100, 5.00, '10', 5.50, b'0', 0.00, 0.00, 'mr.crabs.jpg', '', '2026-10-21 09:24:42', b'1', 3, 3),
(17, 'Monkey D. Luffy Mangá', '', 'Mangá', 5, 50000.00, '20', 60000.00, b'0', 0.00, 0.00, 'Monkey D..jpg', '', '2026-10-21 09:27:25', b'1', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `codigo_venda` int(5) NOT NULL,
  `data_pedido` datetime NOT NULL,
  `forma_pagamento` varchar(20) NOT NULL,
  `desconto` decimal(6,2) NOT NULL,
  `valor_total` decimal(8,2) NOT NULL,
  `codigo_cliente` int(8) DEFAULT NULL,
  `codigo_funcionario` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`codigo_cargo`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`codigo_categoria`),
  ADD UNIQUE KEY `nome_categoria` (`nome_categoria`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codigo_cliente`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`codigo_funcionario`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `codigo_cargo` (`codigo_cargo`);

--
-- Índices de tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  ADD PRIMARY KEY (`codigo_itensvenda`),
  ADD KEY `codigo_produto` (`codigo_produto`),
  ADD KEY `codigo_pedido` (`codigo_pedido`);

--
-- Índices de tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`codigo_marca`),
  ADD UNIQUE KEY `nome_marca` (`nome_marca`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`codigo_produto`),
  ADD KEY `codigo_categoria` (`codigo_categoria`),
  ADD KEY `codigo_marca` (`codigo_marca`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`codigo_venda`),
  ADD KEY `codigo_cliente` (`codigo_cliente`),
  ADD KEY `codigo_funcionario` (`codigo_funcionario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cargo`
--
ALTER TABLE `cargo`
  MODIFY `codigo_cargo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `codigo_categoria` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `codigo_cliente` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `codigo_funcionario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  MODIFY `codigo_itensvenda` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `codigo_marca` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `codigo_produto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `codigo_venda` int(5) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`codigo_cargo`) REFERENCES `cargo` (`codigo_cargo`);

--
-- Restrições para tabelas `itens_venda`
--
ALTER TABLE `itens_venda`
  ADD CONSTRAINT `itens_venda_ibfk_1` FOREIGN KEY (`codigo_produto`) REFERENCES `produto` (`codigo_produto`),
  ADD CONSTRAINT `itens_venda_ibfk_2` FOREIGN KEY (`codigo_pedido`) REFERENCES `venda` (`codigo_venda`);

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`codigo_categoria`) REFERENCES `categoria` (`codigo_categoria`),
  ADD CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`codigo_marca`) REFERENCES `marca` (`codigo_marca`);

--
-- Restrições para tabelas `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`codigo_cliente`) REFERENCES `cliente` (`codigo_cliente`),
  ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`codigo_funcionario`) REFERENCES `funcionario` (`codigo_funcionario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
