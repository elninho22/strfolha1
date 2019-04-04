-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04-Abr-2019 às 16:03
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `folha_pagamento`
--

CREATE TABLE `folha_pagamento` (
  `fopa_codi` int(11) NOT NULL,
  `fopa_arquivo` varchar(145) DEFAULT NULL COMMENT 'arquivo',
  `fopa_data` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'data automatica',
  `fopa_text` text COMMENT 'comentario',
  `fopa_usua` int(11) NOT NULL COMMENT 'id do usuario'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `folha_pagamento`
--

INSERT INTO `folha_pagamento` (`fopa_codi`, `fopa_arquivo`, `fopa_data`, `fopa_text`, `fopa_usua`) VALUES
(36, NULL, '0000-00-00 00:00:00', 'adf', 6),
(37, NULL, '0000-00-00 00:00:00', 'zcxv', 7),
(38, NULL, '0000-00-00 00:00:00', 'zxcv', 6),
(39, NULL, '0000-00-00 00:00:00', 'SFG', 6),
(40, NULL, '0000-00-00 00:00:00', 'SFG', 6),
(41, NULL, NULL, '', 6),
(42, NULL, NULL, '', 6),
(43, NULL, NULL, '', 6),
(44, NULL, NULL, '', 6),
(45, NULL, '0000-00-00 00:00:00', 'adfa', 6),
(46, NULL, '0000-00-00 00:00:00', 'af', 6),
(47, NULL, '0000-00-00 00:00:00', 'af', 6),
(48, NULL, '0000-00-00 00:00:00', 'af', 6),
(49, NULL, '0000-00-00 00:00:00', 'af', 6),
(50, NULL, '0000-00-00 00:00:00', 'af', 6),
(51, NULL, '0000-00-00 00:00:00', 'af', 6),
(52, NULL, '0000-00-00 00:00:00', 'dfghj', 6),
(53, NULL, NULL, '', 6),
(54, NULL, NULL, '', 6),
(55, NULL, NULL, '', 6),
(56, NULL, '0000-00-00 00:00:00', 'asd', 6),
(57, NULL, '0000-00-00 00:00:00', 'asd', 6),
(58, NULL, NULL, '', 6),
(59, NULL, '0000-00-00 00:00:00', 'adsf', 6),
(60, NULL, '0000-00-00 00:00:00', 'adsf', 6),
(61, NULL, '0000-00-00 00:00:00', 'adsf', 6),
(62, NULL, '0000-00-00 00:00:00', 'asd', 6),
(63, NULL, '0000-00-00 00:00:00', 'asdf', 6),
(64, NULL, '0000-00-00 00:00:00', 'adsfa', 6),
(65, NULL, '0000-00-00 00:00:00', 'asdfa', 6),
(66, NULL, '0000-00-00 00:00:00', 'zxcvz', 6),
(67, NULL, '0000-00-00 00:00:00', 'zxcvz', 6),
(68, NULL, '0000-00-00 00:00:00', 'sfdgs', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `gestor_usuario`
--

CREATE TABLE `gestor_usuario` (
  `geus_gest` int(11) NOT NULL,
  `geus_usua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `gestor_usuario`
--

INSERT INTO `gestor_usuario` (`geus_gest`, `geus_usua`) VALUES
(6, 25),
(6, 26),
(7, 27),
(6, 28),
(7, 29);

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
  `usua_hash` varchar(80) DEFAULT NULL COMMENT 'Código para envia por email, assim pode recurar a senha de acesso',
  `usua_nivel` int(11) DEFAULT NULL COMMENT '1 usuario comum, 2 gestor',
  `usua_foto` varchar(150) DEFAULT NULL,
  `usua_logi` varchar(80) DEFAULT NULL COMMENT 'Login para para acessar a ferramenta',
  `usua_guest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usua_codi`, `usua_nome`, `usua_dins`, `usua_pass`, `usua_mail`, `usua_hash`, `usua_nivel`, `usua_foto`, `usua_logi`, `usua_guest`) VALUES
(6, 'Rafael Magola', '2019-03-28 13:30:07', 'admin123456', 'rafael@colaborativa.tv', NULL, 1, '', 'rafael.magola', 1),
(7, 'Ricardo', '2019-04-02 15:11:30', '123456', 'teste@teste.com.br', NULL, 1, '', NULL, 1),
(29, 'admin', '2019-04-03 16:34:26', 'admin', 'admin@admin.com', NULL, NULL, NULL, NULL, 6);

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
  MODIFY `fohi_codi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `folha_pagamento`
--
ALTER TABLE `folha_pagamento`
  MODIFY `fopa_codi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usua_codi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `folha_historico`
--
ALTER TABLE `folha_historico`
  ADD CONSTRAINT `fk_fopa_fopa` FOREIGN KEY (`fopa_fopa`) REFERENCES `folha_pagamento` (`fopa_codi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `folha_pagamento`
--
ALTER TABLE `folha_pagamento`
  ADD CONSTRAINT `fk_fopa_usua` FOREIGN KEY (`fopa_usua`) REFERENCES `usuario` (`usua_codi`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
