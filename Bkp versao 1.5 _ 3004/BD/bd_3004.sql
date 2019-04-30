-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30-Abr-2019 às 17:27
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `folharhstr`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `folha_historico`
--

CREATE TABLE `folha_historico` (
  `fohi_codi` int(11) NOT NULL,
  `fohi_data` datetime DEFAULT CURRENT_TIMESTAMP,
  `fohi_text` varchar(45) DEFAULT NULL,
  `fohi_arq` varchar(45) DEFAULT NULL,
  `fopa_fopa` int(11) NOT NULL COMMENT 'Id da folha de pagamento'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `folha_historico`
--

INSERT INTO `folha_historico` (`fohi_codi`, `fohi_data`, `fohi_text`, `fohi_arq`, `fopa_fopa`) VALUES
(1, '0000-00-00 00:00:00', 'test', 'teste', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `folha_pagamento`
--

CREATE TABLE `folha_pagamento` (
  `fopa_codi` int(11) NOT NULL,
  `fopa_arquivo` varchar(145) DEFAULT NULL COMMENT 'arquivo',
  `fopa_data` text NOT NULL COMMENT 'data automatica',
  `fopa_text` text COMMENT 'comentario',
  `fopa_usua` int(11) NOT NULL COMMENT 'id do usuario',
  `fopa_guest` int(11) NOT NULL COMMENT 'id do gestor',
  `fopa_stat` char(1) NOT NULL DEFAULT '0',
  `fopa_dins` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'data de cadastro folha de pagamento'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `gestor_usuario`
--

CREATE TABLE `gestor_usuario` (
  `geus_gest` int(11) NOT NULL,
  `geus_usua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usua_codi` int(11) NOT NULL,
  `usua_nome` varchar(80) DEFAULT NULL COMMENT 'nome',
  `usua_dins` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'data de cadastro Automatica',
  `usua_pass` char(80) DEFAULT NULL COMMENT 'senha de acesso',
  `usua_mail` varchar(80) DEFAULT NULL COMMENT 'email para qual vai disparar a notificaçao',
  `usua_insc` varchar(20) DEFAULT NULL,
  `usua_hash` varchar(80) DEFAULT NULL COMMENT 'Código para envia por email, assim pode recurar a senha de acesso',
  `usua_nivel` varchar(11) DEFAULT NULL COMMENT '2 usuario comum, 1 gestor',
  `usua_logi` varchar(20) DEFAULT NULL,
  `usua_foto` varchar(150) DEFAULT NULL,
  `usua_guest` int(11) NOT NULL,
  `authKey` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usua_codi`, `usua_nome`, `usua_dins`, `usua_pass`, `usua_mail`, `usua_insc`, `usua_hash`, `usua_nivel`, `usua_logi`, `usua_foto`, `usua_guest`, `authKey`) VALUES
(1, 'admin', '2019-04-30 11:50:17', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', 'admin@admin.com', '123456', NULL, '98', NULL, NULL, 1, ''),
(2, 'Lucas', '2019-04-30 12:03:30', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', 'lucas.tobaro@colaborativa.co', '1245678', NULL, '99', NULL, NULL, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `folha_historico`
--
ALTER TABLE `folha_historico`
  ADD PRIMARY KEY (`fohi_codi`,`fopa_fopa`),
  ADD KEY `fk_folha_historico_folha_pagamento1_idx` (`fopa_fopa`);

--
-- Indexes for table `folha_pagamento`
--
ALTER TABLE `folha_pagamento`
  ADD PRIMARY KEY (`fopa_codi`,`fopa_usua`),
  ADD KEY `fk_fopa_usua` (`fopa_usua`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usua_codi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `folha_historico`
--
ALTER TABLE `folha_historico`
  MODIFY `fohi_codi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `folha_pagamento`
--
ALTER TABLE `folha_pagamento`
  MODIFY `fopa_codi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usua_codi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
