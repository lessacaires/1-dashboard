-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 03-Dez-2017 às 11:05
-- Versão do servidor: 10.1.26-MariaDB-0+deb9u1
-- PHP Version: 7.0.19-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `cat_id` int(11) NOT NULL,
  `cat_nome` varchar(255) NOT NULL,
  `cat_data_cad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`cat_id`, `cat_nome`, `cat_data_cad`) VALUES
(1, 'notÃ­cias', '2017-09-27 04:12:53'),
(4, 'esportes', '2017-09-28 05:17:43'),
(5, 'entretenimento', '2017-09-28 05:17:43'),
(6, 'show', '2017-09-28 05:17:43'),
(7, 'teatro', '2017-09-28 05:17:43'),
(8, 'vaquejada', '2017-09-29 06:14:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `nivel_acessos`
--

CREATE TABLE `nivel_acessos` (
  `ni_id` int(11) NOT NULL,
  `ni_nome` varchar(220) NOT NULL,
  `ni_data_cad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ni_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `promotores`
--

CREATE TABLE `promotores` (
  `promo_id` int(11) NOT NULL,
  `promo_nome` varchar(220) NOT NULL,
  `promo_rg` char(15) NOT NULL,
  `promo_cpf` varchar(15) NOT NULL,
  `promo_ctps` char(20) NOT NULL,
  `promo_status` tinyint(1) NOT NULL,
  `promo_obs` text NOT NULL,
  `promo_data_cad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `promo_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `promo_aso` tinyint(1) NOT NULL,
  `promo_ficha_reg` tinyint(1) NOT NULL,
  `promo_comp_res` tinyint(1) NOT NULL,
  `promo_carta` tinyint(1) NOT NULL,
  `promo_situacao` tinyint(1) NOT NULL,
  `promo_empresa` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `promotores`
--

INSERT INTO `promotores` (`promo_id`, `promo_nome`, `promo_rg`, `promo_cpf`, `promo_ctps`, `promo_status`, `promo_obs`, `promo_data_cad`, `promo_update`, `promo_aso`, `promo_ficha_reg`, `promo_comp_res`, `promo_carta`, `promo_situacao`, `promo_empresa`) VALUES
(7, 'DENNIS LESSA DOURADO', '1234567890', '12345678901', '12345', 1, '', '2017-12-03 12:56:31', '2017-12-03 13:04:36', 0, 0, 0, 0, 1, 'LESDO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_id` int(11) NOT NULL,
  `usu_nome` varchar(255) NOT NULL,
  `usu_senha` varchar(32) NOT NULL,
  `usu_login` varchar(220) NOT NULL,
  `usu_email` varchar(60) NOT NULL,
  `usu_cpf` varchar(11) NOT NULL,
  `usu_thumb` varchar(255) DEFAULT NULL,
  `usu_data_nasc` timestamp NULL DEFAULT NULL,
  `usu_data_cad` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `usu_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usu_nivel_acesso_id` int(11) NOT NULL,
  `usu_status` double DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`usu_id`, `usu_nome`, `usu_senha`, `usu_login`, `usu_email`, `usu_cpf`, `usu_thumb`, `usu_data_nasc`, `usu_data_cad`, `usu_update`, `usu_nivel_acesso_id`, `usu_status`) VALUES
(1, 'Administrador', '6c206cb7beda6ff19b4f21128d95fb6e', 'admin', 'lessacaires@gmail.com', '00198223505', 'admin.jpg', '1980-11-11 06:00:00', '2017-11-24 06:00:00', '2017-11-27 01:16:46', 1, 1),
(7, 'Dennis Lessa Dourado', '827ccb0eea8a706c4c34a16891f84e7b', 'dennislessa', 'dennislessa@hotmail.com', '', NULL, NULL, '2017-12-03 01:40:22', '2017-12-03 01:40:37', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `promotores`
--
ALTER TABLE `promotores`
  ADD PRIMARY KEY (`promo_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `promotores`
--
ALTER TABLE `promotores`
  MODIFY `promo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
