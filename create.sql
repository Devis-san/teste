-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Nov-2021 às 03:34
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_horizon`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_postagens`
--

CREATE TABLE `tb_postagens` (
  `idpost` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `mensagem` longtext NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_postagens`
--

INSERT INTO `tb_postagens` (`idpost`, `idusuario`, `mensagem`, `data`) VALUES
(48, 2, 'Olá, Bem Vindo ao nosso projeto!', '2021-11-29 23:33:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL,
  `desnome` varchar(255) NOT NULL,
  `desemail` varchar(255) NOT NULL,
  `dessenha` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `user_level` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `desnome`, `desemail`, `dessenha`, `created`, `modified`, `user_level`) VALUES
(2, 'admin', 'admin@admin.com', '$2y$12$hofvKUU6PNLAmvRw7sfJFuXHOj4f5BYExf45R4eLcIO0O9DfPdELi', '2021-11-11 14:56:32', NULL, 1),
(4, 'Jhuan Robert', 'jhuanrobert17@gmail.com', '$2y$12$809fxLiNIqXGv2ECJdHQOuTfRi6PAqfaHRM/K2u14ccxb5GCqGRji', '2021-11-11 14:56:32', NULL, 0),
(5, 'vitor ', 'vto.hugo67@gmail.com', '$2y$12$IGaPHmY4Re0pNwsun0vFa.jlRtyK2OVXiDRVe5qtmhThr9jVjYEMi', '2021-11-11 17:20:30', NULL, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_postagens`
--
ALTER TABLE `tb_postagens`
  ADD PRIMARY KEY (`idpost`);

--
-- Índices para tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_postagens`
--
ALTER TABLE `tb_postagens`
  MODIFY `idpost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
