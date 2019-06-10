-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 10, 2019 at 09:45 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `objetivo`
--

INSERT INTO `objetivo` (`id`, `objetivo`, `plano_estrategico`, `perspectiva_bsc`) VALUES
(14, 'aaaa', 2, '2'),
(15, 'aaaa', 12, '12'),
(16, 'hahahahaha', 23, ''),
(23, 'adda', 27, ''),
(24, '3131', 27, ''),
(25, 'dss', 27, '');

-- --------------------------------------------------------

--
-- Table structure for table `plano_estrategico`
--

DROP TABLE IF EXISTS `plano_estrategico`;
CREATE TABLE IF NOT EXISTS `plano_estrategico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `visao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `missao` varchar(255) CHARACTER SET utf8 NOT NULL,
  `comeco` date NOT NULL,
  `fim` date NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `publicado` tinyint(4) NOT NULL,
  `empresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa_plano` (`empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plano_estrategico`
--

INSERT INTO `plano_estrategico` (`id`, `titulo`, `visao`, `missao`, `comeco`, `fim`, `ativo`, `publicado`, `empresa`) VALUES
(2, 'Plano Estrategico Teste 1', 'teste02', 'TESSSST2', '2019-03-04', '2019-03-05', 0, 0, 1),
(9, 'Plano Estrategico Teste 2', '123', '123123', '2019-06-09', '2019-06-10', 0, 0, 1),
(10, 'Plano Estrategico Teste 3', 'aaa', 'aaaa', '2019-06-09', '2019-06-10', 0, 0, 1),
(11, 'Plano Estrategico Teste 4', 'aa', '111', '2019-06-09', '2019-06-10', 0, 0, 1),
(12, 'Plano Estrategico Teste 5', 'asdasd', 'asdasdasdasd', '2019-06-09', '2019-06-10', 0, 0, 1),
(14, 'Plano Estrategico Teste 6', 'teste6', 'teste6', '2019-06-10', '2019-06-30', 0, 0, 1),
(22, 's', 's', 's', '2019-06-11', '1970-01-01', 0, 0, 1),
(23, 'asdasd', 'asdasddsa', 'adsadsdasads', '2019-06-25', '2019-06-11', 0, 0, 1),
(24, 'sssssssssssssssssssssssssss', 'ssssssssssssssssssssssssss', 'ssssssssssssssssssssssssssss', '2019-06-19', '2019-06-19', 0, 0, 1),
(26, 's', 's', 's', '2019-06-12', '2019-06-14', 0, 0, 1),
(27, 'adsda', 'adda', 'daad', '2019-06-10', '2019-06-10', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `valor`
--

DROP TABLE IF EXISTS `valor`;
CREATE TABLE IF NOT EXISTS `valor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` varchar(255) NOT NULL,
  `plano_estrategico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plano_valor` (`plano_estrategico`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `valor`
--

INSERT INTO `valor` (`id`, `valor`, `plano_estrategico`) VALUES
(13, '1111', 2),
(14, 'sss', 2),
(15, 'sss', 2),
(16, '123', 2),
(18, 'aaa', 2),
(19, 'ss', 2),
(20, 'aaa', 10),
(32, 's', 22),
(33, '33', 22),
(34, 'asd', 23),
(35, 'aadddddd', 23),
(36, 'aaaa', 23),
(38, 'sssssssssssssssssssssssssss', 24),
(39, 'ssss', 24),
(43, 'dada', 27);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `objetivo`
--
ALTER TABLE `objetivo`
  ADD CONSTRAINT `plano_objetivo` FOREIGN KEY (`plano_estrategico`) REFERENCES `plano_estrategico` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `plano_estrategico`
--
ALTER TABLE `plano_estrategico`
  ADD CONSTRAINT `empresa_plano` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `valor`
--
ALTER TABLE `valor`
  ADD CONSTRAINT `plano_valor` FOREIGN KEY (`plano_estrategico`) REFERENCES `plano_estrategico` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
