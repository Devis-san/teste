-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Dez-2021 às 21:44
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
-- Estrutura da tabela `tb_comentarios`
--

CREATE TABLE `tb_comentarios` (
  `idpost` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `mensagem` longtext NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_comentarios`
--

INSERT INTO `tb_comentarios` (`idpost`, `idusuario`, `mensagem`, `data`) VALUES
(2, 89, 'como', '2021-12-08 19:31:07'),
(12, 89, 't', '2021-12-08 19:28:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_postagens`
--

CREATE TABLE `tb_postagens` (
  `idpost` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `mensagem` longtext NOT NULL,
  `incurtidas` int(11) NOT NULL DEFAULT 0,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_postagens`
--

INSERT INTO `tb_postagens` (`idpost`, `idusuario`, `mensagem`, `incurtidas`, `data`, `lastupdate`) VALUES
(93, 2, 'bucetinha :D', 5, '2021-12-08 20:08:01', '2021-12-08 20:08:01'),
(99, 12, 'super piroca', 1, '2021-12-08 20:11:30', '2021-12-08 20:11:30');

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
(5, 'vitor ', 'vto.hugo67@gmail.com', '$2y$12$IGaPHmY4Re0pNwsun0vFa.jlRtyK2OVXiDRVe5qtmhThr9jVjYEMi', '2021-11-11 17:20:30', NULL, 1),
(11, 'Loranne__', 'wendylorranne@gmail.com', '$2y$12$WXmvb5kbKqLPJfC8ZDKcx.XhjSiGmbsfYhOrFVq3CMzOSX2kMVWi.', '2021-12-06 15:07:00', NULL, 0),
(12, 'rodrigo', 'vto.hugo67@gmail.com', '$2y$12$rU.C68sN/T20uFTczytAcervRmVtGFcY/vr37xZIYWmKY8FwDAJ4y', '2021-12-08 18:05:24', NULL, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_comentarios`
--
ALTER TABLE `tb_comentarios`
  ADD PRIMARY KEY (`idpost`);

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
  MODIFY `idpost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
