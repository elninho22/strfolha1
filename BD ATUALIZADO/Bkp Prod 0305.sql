/*
MySQL Backup
Database: folharhstr
Backup Time: 2019-05-03 18:04:28
*/

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `folharhstr`.`folha_historico`;
DROP TABLE IF EXISTS `folharhstr`.`folha_pagamento`;
DROP TABLE IF EXISTS `folharhstr`.`gestor_usuario`;
DROP TABLE IF EXISTS `folharhstr`.`usuario`;
CREATE TABLE `folha_historico` (
  `fohi_codi` int(11) NOT NULL AUTO_INCREMENT,
  `fohi_data` datetime DEFAULT CURRENT_TIMESTAMP,
  `fohi_text` varchar(45) DEFAULT NULL,
  `fohi_arq` varchar(45) DEFAULT NULL,
  `fopa_fopa` int(11) NOT NULL COMMENT 'Id da folha de pagamento',
  PRIMARY KEY (`fohi_codi`,`fopa_fopa`),
  KEY `fk_folha_historico_folha_pagamento1_idx` (`fopa_fopa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
CREATE TABLE `folha_pagamento` (
  `fopa_codi` int(11) NOT NULL AUTO_INCREMENT,
  `fopa_arquivo` varchar(145) DEFAULT NULL COMMENT 'arquivo',
  `fopa_data` text NOT NULL COMMENT 'data automatica',
  `fopa_text` text COMMENT 'comentario',
  `fopa_usua` int(11) NOT NULL COMMENT 'id do usuario',
  `fopa_guest` int(11) NOT NULL COMMENT 'id do gestor',
  `fopa_stat` char(1) NOT NULL DEFAULT '0',
  `fopa_dins` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'data de cadastro folha de pagamento',
  PRIMARY KEY (`fopa_codi`,`fopa_usua`),
  KEY `fk_fopa_usua` (`fopa_usua`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `gestor_usuario` (
  `geus_gest` int(11) NOT NULL,
  `geus_usua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `usuario` (
  `usua_codi` int(11) NOT NULL AUTO_INCREMENT,
  `usua_nome` varchar(80) DEFAULT NULL COMMENT 'nome',
  `usua_dins` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'data de cadastro Automatica',
  `usua_pass` char(80) DEFAULT NULL COMMENT 'senha de acesso',
  `usua_mail` varchar(80) DEFAULT NULL COMMENT 'email para qual vai disparar a notificaçao',
  `usua_insc` varchar(20) DEFAULT NULL,
  `usua_hash` varchar(80) DEFAULT NULL COMMENT 'Código para envia por email, assim pode recurar a senha de acesso',
  `usua_nivel` varchar(11) DEFAULT NULL COMMENT '2 usuario comum, 1 gestor',
  `usua_ngest` varchar(11) DEFAULT NULL COMMENT 'define o tipo de usuario se 98 gestor diferente usuario\r\n',
  `usua_guest` int(11) NOT NULL,
  `usua_logi` varchar(20) DEFAULT NULL,
  `usua_foto` varchar(150) DEFAULT NULL,
  `authKey` varchar(150) NOT NULL,
  PRIMARY KEY (`usua_codi`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
BEGIN;
LOCK TABLES `folharhstr`.`folha_historico` WRITE;
DELETE FROM `folharhstr`.`folha_historico`;
INSERT INTO `folharhstr`.`folha_historico` (`fohi_codi`,`fohi_data`,`fohi_text`,`fohi_arq`,`fopa_fopa`) VALUES (1, '0000-00-00 00:00:00', 'test', 'teste', 5);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `folharhstr`.`folha_pagamento` WRITE;
DELETE FROM `folharhstr`.`folha_pagamento`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `folharhstr`.`gestor_usuario` WRITE;
DELETE FROM `folharhstr`.`gestor_usuario`;
INSERT INTO `folharhstr`.`gestor_usuario` (`geus_gest`,`geus_usua`) VALUES (1, 2),(1, 3),(1, 1),(1, 7),(1, 6),(1, 5),(1, 4);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `folharhstr`.`usuario` WRITE;
DELETE FROM `folharhstr`.`usuario`;
INSERT INTO `folharhstr`.`usuario` (`usua_codi`,`usua_nome`,`usua_dins`,`usua_pass`,`usua_mail`,`usua_insc`,`usua_hash`,`usua_nivel`,`usua_ngest`,`usua_guest`,`usua_logi`,`usua_foto`,`authKey`) VALUES (1, 'admin', '2019-04-30 11:50:17', '625bb055d774b2d84fbd55938e05d5fd80fedec6fc07b8847c3ba979e2898bc0', 'andrechb2@gmail.com', '999999999', NULL, '98', '1755', 1, '20', NULL, ''),(2, 'Lucas', '2019-04-30 12:03:30', '80c6f8b15f8d77be2defa7fa4b52261d06493a9e5af49e9dc88741e9080eec63', 'lucas.tobaro@colaborativa.co', '9', NULL, '99', '1803', 1, '20', NULL, ''),(3, 'Andre juliano', '2019-04-30 15:08:43', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', 'andrejulianom@gmail.com', '10', NULL, '99', '1803', 1, '20', NULL, ''),(4, 'Rafael Bernardes', '2019-05-03 16:53:09', '761b9b55a82d2835f7ed07cfc5f45ee4d928a1a0776dc4e462ad33bb570cfd33', 'rafael@colaborativa.tv', '', NULL, '98', '98', 1, '20', NULL, ''),(5, 'Alessandra Lunardi', '2019-05-03 16:55:07', '39b67448450f1fe9dce6d877db7439242c3249232e310b6d5442bdc7fee5c6b9', 'alessandra.lunardi@colaborativa.tv', '', NULL, '98', '98', 1, '20', NULL, ''),(6, 'Ricardo Kudla', '2019-05-03 16:56:03', 'd74da9dd53c48f8d383dd9ed88db584e289dfe4f1fbb44080283388957665e0f', 'ricardo@colaborativa.tv', '', NULL, '98', '98', 1, '20', NULL, ''),(7, 'Renata Raso', '2019-05-03 16:56:32', '169c23ac324e0d2be71631aeed329059e0e429ecb62ab07c2465d7040324cc5a', 'renata.raso@colaborativa.co', '', NULL, '98', '98', 1, '20', NULL, '');
UNLOCK TABLES;
COMMIT;
