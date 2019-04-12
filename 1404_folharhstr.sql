-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Abr-2019 às 22:05
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
  `fopa_stat` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `folha_pagamento`
--

INSERT INTO `folha_pagamento` (`fopa_codi`, `fopa_arquivo`, `fopa_data`, `fopa_text`, `fopa_usua`, `fopa_guest`, `fopa_stat`) VALUES
(5, '/uploads/folha/files/infos-1554835459.txt', 'Outubro', 'TESTE DE UPDATE', 5, 5, '1'),
(9, '/uploads/folha/files/readme-projetostr-1555005596.txt', 'Abril', 'teste', 3, 5, '1');

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
(1, 3),
(1, 4),
(1, 5),
(5, 3),
(5, 1),
(3, 1),
(5, 1),
(3, 1),
(5, 6),
(3, 7),
(7, 8),
(6, 9);

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
  `usua_nivel` int(11) DEFAULT NULL COMMENT '2 usuario comum, 1 gestor',
  `usua_foto` varchar(150) DEFAULT NULL,
  `usua_logi` varchar(80) DEFAULT NULL COMMENT 'Login para para acessar a ferramenta',
  `usua_guest` int(11) NOT NULL,
  `authKey` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usua_codi`, `usua_nome`, `usua_dins`, `usua_pass`, `usua_mail`, `usua_hash`, `usua_nivel`, `usua_foto`, `usua_logi`, `usua_guest`, `authKey`) VALUES
(3, 'Teste', '2019-04-05 13:34:37', '1234', 'teste@teste.com', NULL, 1, NULL, NULL, 3, '5456'),
(5, 'Sup', '2019-04-05 14:17:14', '12345', 'sup@sup.com', NULL, 1, NULL, NULL, 3, '123454'),
(6, 'novo', '2019-04-11 14:50:55', '321654', 'a@a.com', NULL, 1, NULL, NULL, 3, '45654'),
(7, 'andre', '2019-04-11 16:50:37', '123456789', 'andre@andre.com', NULL, 1, NULL, NULL, 3, ''),
(8, 'carlos', '2019-04-11 16:51:53', '123', 'carlos@email.com', NULL, NULL, NULL, NULL, 7, ''),
(9, 'maria', '2019-04-11 16:54:43', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'maria1@teste.com.br', NULL, 1, NULL, NULL, 6, '');

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
  MODIFY `fopa_codi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usua_codi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
