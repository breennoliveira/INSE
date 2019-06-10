-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 10, 2019 at 01:31 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inse`
--

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razaosocial` varchar(100) NOT NULL,
  `nomefantasia` varchar(100) NOT NULL,
  `cnpj` varchar(100) NOT NULL,
  `ramo` varchar(100) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `responsavel` varchar(255) NOT NULL,
  `telefone` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `confir_senha` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `empresa`
--

INSERT INTO `empresa` (`id`, `razaosocial`, `nomefantasia`, `cnpj`, `ramo`, `endereco`, `responsavel`, `telefone`, `email`, `senha`, `confir_senha`) VALUES
(1, 'Exemplo Empresa', 'Nome Empresa', '12345678', 'Alimentos', '', '', '', 'empresa@gmail.com', '25d55ad283aa400af464c76d713c07ad', '12345678'),
(2, 'Exemplo Empresa2', 'Nome Empresa2', '123456789', 'Alimentos2', '', '', '', 'empresa2@gmail.com', '25d55ad283aa400af464c76d713c07ad', '12345678'),
(3, 'Exemplo Empresa3', 'Nome Empresa3', '123456789', 'Alimentos3', '', '', '', 'empresa3@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '12345'),
(4, 'Exemplo Empresa4', 'Nome Empresa4', '123456789', 'Alimentos4', '', '', '', 'empresa4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456'),
(5, 'Exemplo Empresa5', 'Nome Empresa5', '12345678', 'Alimentos5', '', '', '', 'empresa5@gmail.com', '25d55ad283aa400af464c76d713c07ad', '12345678'),
(6, 'Exemplo Empresa6', 'Empresa Nome6', '12345678', 'Alimentos6', '', '', '', 'empresa6@gmail.com', '25d55ad283aa400af464c76d713c07ad', '12345678'),
(7, 'BGreen SA', 'BGreen Cosmetics ', '12345678899q38293239', 'CosmÃ©ticos', '', '', '', 'bgreen@gmail.com', 'bf48f877893cffae5f7a19eb558f317e', 'lukm1410'),
(8, 'Simple Organic SA', 'Simple Organic', '123456789', 'CosmÃ©ticos', '', '', '', 'simple@gmail.com', '9c7e833b65d98201c54e9b14552db1a3', 'lukm14109020'),
(9, 'Exemplo Empresa10', 'Maria Thereza Miranda de Camargo', '12345678', 'CosmÃ©ticos', '', '', '', 'mmcamargo90@gmail.com', '9c7e833b65d98201c54e9b14552db1a3', 'lukm14109020'),
(10, 'Exemplo Empresa16', 'Empresa 16', '12345678', 'CosmÃ©ticos', '', '', '', 'empresa16@gmail.com', '202cb962ac59075b964b07152d234b70', '123'),
(11, 'Nestle', 'Nestle', '11443423423', 'Comida', '', '', '', 'nestle@gmail.com', '202cb962ac59075b964b07152d234b70', '123'),
(12, 'Teste01', 'teste01', '11111111111222', 'IndÃºstria', '', '', '', 'teste01@teste01.com', '2e3817293fc275dbee74bd71ce6eb056', 'lala');

-- --------------------------------------------------------

--
-- Table structure for table `identidade`
--

DROP TABLE IF EXISTS `identidade`;
CREATE TABLE IF NOT EXISTS `identidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visao` varchar(500) NOT NULL,
  `missao` varchar(500) NOT NULL,
  `valores` varchar(500) NOT NULL,
  `plano_estrategico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plano_identidade` (`plano_estrategico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `objetivo`
--

DROP TABLE IF EXISTS `objetivo`;
CREATE TABLE IF NOT EXISTS `objetivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo` varchar(45) NOT NULL,
  `plano_estrategico` int(11) NOT NULL,
  `perspectiva_bsc` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plano_estrategico_idx` (`plano_estrategico`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `objetivo`
--

INSERT INTO `objetivo` (`id`, `objetivo`, `plano_estrategico`, `perspectiva_bsc`) VALUES
(10, 'aaaa', 1, ''),
(11, 'aa', 1, ''),
(14, 'aaaa', 2, '2'),
(15, 'aaaa', 12, '12');

-- --------------------------------------------------------

--
-- Table structure for table `plano_estrategico`
--

DROP TABLE IF EXISTS `plano_estrategico`;
CREATE TABLE IF NOT EXISTS `plano_estrategico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `missao` varchar(255) CHARACTER SET utf8 NOT NULL,
  `valores` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comeco` date NOT NULL,
  `fim` date NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `publicado` tinyint(4) NOT NULL,
  `empresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa_plano` (`empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plano_estrategico`
--

INSERT INTO `plano_estrategico` (`id`, `visao`, `missao`, `valores`, `comeco`, `fim`, `ativo`, `publicado`, `empresa`) VALUES
(1, 'teste01', 'aa', 'TESSSST', '2019-03-04', '2019-03-05', 0, 0, 1),
(2, 'teste02', 'TESSSST2', 'TESTTTT2', '2019-03-04', '2019-03-05', 0, 0, 1),
(9, '123', '123123', '123123123', '2019-06-09', '2019-06-10', 0, 0, 1),
(10, 'aaa', 'aaaa', 'aaaaaa', '2019-06-09', '2019-06-10', 0, 0, 1),
(11, 'aa', '111', '1111', '2019-06-09', '2019-06-10', 0, 0, 1),
(12, 'asdasd', 'asdasdasdasd', 'asdasd1', '2019-06-09', '2019-06-10', 0, 0, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `identidade`
--
ALTER TABLE `identidade`
  ADD CONSTRAINT `plano_identidade` FOREIGN KEY (`plano_estrategico`) REFERENCES `plano_estrategico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `objetivo`
--
ALTER TABLE `objetivo`
  ADD CONSTRAINT `plano_objetivo` FOREIGN KEY (`plano_estrategico`) REFERENCES `plano_estrategico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `plano_estrategico`
--
ALTER TABLE `plano_estrategico`
  ADD CONSTRAINT `empresa_plano` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
