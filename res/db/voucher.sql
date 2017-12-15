-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15-Dez-2017 às 21:03
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voucher`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

CREATE TABLE `config` (
  `id_config` bigint(20) UNSIGNED NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `trocasenhatempo` char(1) DEFAULT NULL,
  `tempotrocasenha` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `config`
--

INSERT INTO `config` (`id_config`, `descricao`, `trocasenhatempo`, `tempotrocasenha`) VALUES
(1, 'Troca da Senha', 'S', 360);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dbupdate`
--

CREATE TABLE `dbupdate` (
  `id_dbupdate` bigint(20) UNSIGNED NOT NULL,
  `updatedon` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `dbupdate`
--

INSERT INTO `dbupdate` (`id_dbupdate`, `updatedon`) VALUES
(1, 1502987152);

-- --------------------------------------------------------

--
-- Estrutura da tabela `offer`
--

CREATE TABLE `offer` (
  `id_offer` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `percent` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `offer`
--

INSERT INTO `offer` (`id_offer`, `name`, `percent`) VALUES
(1, 'Offer #1', 50),
(2, 'Offer #2', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

CREATE TABLE `permissao` (
  `id_permissao` bigint(20) UNSIGNED NOT NULL,
  `id_processo` bigint(20) UNSIGNED DEFAULT NULL,
  `ver` char(1) DEFAULT NULL,
  `inserir` char(1) DEFAULT NULL,
  `excluir` char(1) DEFAULT NULL,
  `editar` char(1) DEFAULT NULL,
  `id_usuario` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`id_permissao`, `id_processo`, `ver`, `inserir`, `excluir`, `editar`, `id_usuario`) VALUES
(1, 1, 'S', 'S', 'S', 'S', 1),
(71, 14, 'S', 'S', NULL, NULL, 4),
(72, 17, 'S', 'S', NULL, 'S', 3),
(69, 17, 'S', NULL, NULL, NULL, 4),
(68, 16, 'S', 'S', 'S', 'S', 2),
(67, 15, 'S', 'S', NULL, 'S', 3),
(66, 14, 'S', 'S', 'S', 'S', 3),
(65, 3, 'S', 'S', 'S', 'S', 3),
(64, 14, 'S', 'S', 'S', 'S', 2),
(63, 3, 'S', 'S', 'S', 'S', 2),
(62, 3, 'S', NULL, NULL, NULL, 34),
(61, 3, 'S', 'S', 'S', 'S', 33);

-- --------------------------------------------------------

--
-- Estrutura da tabela `processo`
--

CREATE TABLE `processo` (
  `id_processo` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `controladores` varchar(160) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `processo`
--

INSERT INTO `processo` (`id_processo`, `nome`, `descricao`, `controladores`) VALUES
(1, 'ALL', 'Acesso total ao sistema', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `recipient`
--

CREATE TABLE `recipient` (
  `id_recipient` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `email` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `recipient`
--

INSERT INTO `recipient` (`id_recipient`, `name`, `email`) VALUES
(1, 'Leonardo Danieli', 'leonardo.danieli@gmail.com'),
(2, 'Taise Alves', 'taisefalves@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `loginuser` varchar(25) DEFAULT NULL,
  `nomecompleto` varchar(35) DEFAULT NULL,
  `lastname` varchar(35) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `datasenha` date DEFAULT NULL,
  `tipo` varchar(7) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senhaemail` varchar(50) DEFAULT NULL,
  `assinaturaemail` longtext,
  `smtp` varchar(255) DEFAULT NULL,
  `porta` varchar(3) DEFAULT NULL,
  `grupo` int(11) DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL,
  `excluivel` char(1) DEFAULT NULL,
  `editavel` char(1) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `trocasenhatempo` char(1) DEFAULT NULL,
  `paginainicial` varchar(100) DEFAULT NULL,
  `telephone` varchar(25) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `approved` char(1) DEFAULT 'N',
  `profileurl` varchar(255) DEFAULT NULL,
  `actualcity` varchar(120) DEFAULT NULL,
  `liveincity` varchar(120) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('M','F','O') DEFAULT NULL,
  `relationship` enum('s','m','ir','e','cu','dp','or','ic','sp','d','w') DEFAULT NULL COMMENT 'single, married, in a relationship, engaged, in a civil union, in a domestic partnership, in an open relationship, it is complicated, separated, divorced, widowed',
  `bio` varchar(140) DEFAULT NULL,
  `instagram` varchar(45) DEFAULT NULL,
  `twitter` varchar(45) DEFAULT NULL,
  `facebook` varchar(45) DEFAULT NULL,
  `occupation` varchar(60) DEFAULT NULL,
  `dreamjob` varchar(60) DEFAULT NULL,
  `calendartype` int(11) DEFAULT NULL,
  `traveledto` varchar(255) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `hometowncity` varchar(120) DEFAULT NULL,
  `confirmurl` varchar(16) DEFAULT NULL,
  `fb_id` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `nationality` varchar(50) NOT NULL,
  `nationality2` varchar(50) NOT NULL,
  `passport` varchar(50) NOT NULL,
  `passport2` varchar(50) NOT NULL,
  `allergies` varchar(100) NOT NULL,
  `medicalissues` varchar(200) NOT NULL,
  `contactname` varchar(100) NOT NULL,
  `contactrelationship` varchar(50) NOT NULL,
  `contactnumber` varchar(20) NOT NULL,
  `contactemail` varchar(100) NOT NULL,
  `doctorname` varchar(100) NOT NULL,
  `doctornumber` varchar(20) NOT NULL,
  `doctoremail` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `loginuser`, `nomecompleto`, `lastname`, `senha`, `datasenha`, `tipo`, `email`, `senhaemail`, `assinaturaemail`, `smtp`, `porta`, `grupo`, `ativo`, `excluivel`, `editavel`, `id_empresa`, `trocasenhatempo`, `paginainicial`, `telephone`, `photo`, `approved`, `profileurl`, `actualcity`, `liveincity`, `birthdate`, `gender`, `relationship`, `bio`, `instagram`, `twitter`, `facebook`, `occupation`, `dreamjob`, `calendartype`, `traveledto`, `education`, `hometowncity`, `confirmurl`, `fb_id`, `created_at`, `nationality`, `nationality2`, `passport`, `passport2`, `allergies`, `medicalissues`, `contactname`, `contactrelationship`, `contactnumber`, `contactemail`, `doctorname`, `doctornumber`, `doctoremail`) VALUES
(1, 'admin', 'Admin', 'The', '28335c822634cc5f5992415058957371', '2017-12-07', 'user', 'admin@admin.com', NULL, NULL, NULL, NULL, 1, 'S', 'N', 'N', 1, 'S', 'index', NULL, 'Dubai, United Arab Emirates.jpg', 'S', NULL, NULL, NULL, '2017-07-04', 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-17 13:40:03', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(49, 'Leonardo.danieli@gmail.co', 'Leonardo', NULL, '44e51526be3c22d83f09ab86050d03c2', NULL, NULL, 'leonardo.danieli@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'S', 'S', NULL, NULL, NULL, NULL, NULL, 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-17 13:40:03', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `voucher`
--

CREATE TABLE `voucher` (
  `id_voucher` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(32) COLLATE utf8_bin NOT NULL,
  `id_recipient` int(11) NOT NULL,
  `id_offer` int(11) NOT NULL,
  `expirationdate` datetime NOT NULL,
  `used_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `voucher`
--

INSERT INTO `voucher` (`id_voucher`, `code`, `id_recipient`, `id_offer`, `expirationdate`, `used_at`) VALUES
(3, '1a363715b0edaa3c76fa8082d59178eb', 1, 1, '2017-12-30 00:00:00', NULL),
(4, 'd6a45e210ab1886ad3e62e7f991998b2', 2, 1, '2017-12-30 00:00:00', NULL),
(5, '52858681c03659f7bcd016ba790cf678', 1, 1, '2017-12-29 00:00:00', '2017-12-15 13:17:28'),
(6, '25062177afee2ab4d7883ec484fd6d77', 2, 1, '2017-12-29 00:00:00', NULL),
(10, '20d4c530b6ec7d93261dfca2a1aa0bf3', 1, 2, '2017-12-09 00:00:00', NULL),
(11, '21c8faf3956e0db5493f32920ceffa02', 2, 2, '2017-12-29 00:00:00', NULL),
(12, '5dbf719a5de1b49c069d24d4b61899bf', 1, 2, '2018-01-02 00:00:00', NULL),
(13, 'bb3e8bf09e98af74b702e6f90d471115', 2, 2, '2018-01-02 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id_config`),
  ADD UNIQUE KEY `id_config` (`id_config`);

--
-- Indexes for table `dbupdate`
--
ALTER TABLE `dbupdate`
  ADD UNIQUE KEY `id_dbupdate` (`id_dbupdate`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id_offer`),
  ADD UNIQUE KEY `id_ofer` (`id_offer`);

--
-- Indexes for table `permissao`
--
ALTER TABLE `permissao`
  ADD PRIMARY KEY (`id_permissao`),
  ADD UNIQUE KEY `id_permissao` (`id_permissao`),
  ADD KEY `permissao_id_processo_fkey` (`id_processo`),
  ADD KEY `fk_permissao_usuario_idx` (`id_usuario`);

--
-- Indexes for table `processo`
--
ALTER TABLE `processo`
  ADD PRIMARY KEY (`id_processo`),
  ADD UNIQUE KEY `id_processo` (`id_processo`);

--
-- Indexes for table `recipient`
--
ALTER TABLE `recipient`
  ADD PRIMARY KEY (`id_recipient`),
  ADD UNIQUE KEY `id_recipient` (`id_recipient`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`),
  ADD UNIQUE KEY `usuario_loginuser_key` (`loginuser`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`),
  ADD UNIQUE KEY `id_voucher` (`id_voucher`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id_config` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dbupdate`
--
ALTER TABLE `dbupdate`
  MODIFY `id_dbupdate` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id_offer` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `permissao`
--
ALTER TABLE `permissao`
  MODIFY `id_permissao` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `processo`
--
ALTER TABLE `processo`
  MODIFY `id_processo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;
--
-- AUTO_INCREMENT for table `recipient`
--
ALTER TABLE `recipient`
  MODIFY `id_recipient` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id_voucher` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
