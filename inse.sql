-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 12, 2019 at 05:25 AM
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
  `cnpj` varchar(14) NOT NULL,
  `ramo` varchar(100) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `responsavel` varchar(255) NOT NULL,
  `telefone` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `confir_senha` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

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
(8, 'Simple Organic SA', 'Simple Organic', '123456789', 'Cosméticos', '', '', '', 'simple@gmail.com', '9c7e833b65d98201c54e9b14552db1a3', 'lukm14109020'),
(9, 'Exemplo Empresa10', 'Maria Thereza Miranda de Camargo', '12345678', 'Cosméticos', '', '', '', 'mmcamargo90@gmail.com', '9c7e833b65d98201c54e9b14552db1a3', 'lukm14109020'),
(10, 'Exemplo Empresa16', 'Empresa 16', '12345678', 'Cosméticos', '', '', '', 'empresa16@gmail.com', '202cb962ac59075b964b07152d234b70', '123'),
(27, 'Brenno', 'Brenno Oliveira Fernandes', '83534813000199', 'ComÃ©rcio', 'Rua AmÃ©rico de Campos, 9', 'Brenno Oliveira Fernandes', '19982286247', 'breennoliveira@live.com', '202cb962ac59075b964b07152d234b70', '123');

-- --------------------------------------------------------

--
-- Table structure for table `objetivo`
--

DROP TABLE IF EXISTS `objetivo`;
CREATE TABLE IF NOT EXISTS `objetivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo` varchar(255) NOT NULL,
  `plano_estrategico` int(11) NOT NULL,
  `perspectiva_bsc` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plano_estrategico_idx` (`plano_estrategico`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `plano_estrategico`
--

DROP TABLE IF EXISTS `plano_estrategico`;
CREATE TABLE IF NOT EXISTS `plano_estrategico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `visao` varchar(255) NOT NULL,
  `missao` varchar(255) NOT NULL,
  `comeco` date NOT NULL,
  `fim` date NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `publicado` tinyint(4) NOT NULL,
  `empresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa_plano` (`empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

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
