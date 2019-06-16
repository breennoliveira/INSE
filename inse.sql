-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 14, 2019 at 08:48 PM
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
  `razaosocial` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomefantasia` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ramo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsavel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confir_senha` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(27, 'Brenno', 'Brenno Oliveira Fernandes', '83534813000199', 'ComÃ©rcio', 'Rua AmÃ©rico de Campos, 9', 'Brenno Oliveira Fernandes', '19982286247', 'breennoliveira@live.com', '202cb962ac59075b964b07152d234b70', '123'),
(28, 'Brennoooo', 'LALALALALA', '61138356000180', 'GrÃ¡fica', 'asdasd', 'asdasd', '1123712', 'kaeno.oliveira@gmail.com', '202cb962ac59075b964b07152d234b70', '123');

-- --------------------------------------------------------

--
-- Table structure for table `objetivo`
--

DROP TABLE IF EXISTS `objetivo`;
CREATE TABLE IF NOT EXISTS `objetivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plano_estrategico` int(11) NOT NULL,
  `perspectiva_bsc` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plano_estrategico_idx` (`plano_estrategico`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `objetivo`
--

INSERT INTO `objetivo` (`id`, `objetivo`, `plano_estrategico`, `perspectiva_bsc`) VALUES
(109, 'adad', 44, ''),
(110, 'ada', 44, '');

-- --------------------------------------------------------

--
-- Table structure for table `plano_estrategico`
--

DROP TABLE IF EXISTS `plano_estrategico`;
CREATE TABLE IF NOT EXISTS `plano_estrategico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `missao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comeco` date NOT NULL,
  `fim` date NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `publicado` tinyint(4) NOT NULL,
  `empresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa_plano` (`empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plano_estrategico`
--

INSERT INTO `plano_estrategico` (`id`, `titulo`, `visao`, `missao`, `comeco`, `fim`, `ativo`, `publicado`, `empresa`) VALUES
(43, 'asdasd', 'asdasd', 'asd', '2019-06-12', '2019-06-16', 0, 0, 1),
(44, 'asdasdasdasd', 'asdasd', 'asdada', '2019-06-13', '2019-06-19', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ramo_atuacao`
--

DROP TABLE IF EXISTS `ramo_atuacao`;
CREATE TABLE IF NOT EXISTS `ramo_atuacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atividade` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ramo` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ramo_atuacao`
--

INSERT INTO `ramo_atuacao` (`id`, `atividade`, `ramo`) VALUES
(1, 'Gráfica', 'Industrial'),
(2, 'Calçado', 'Industrial'),
(3, 'Vestuário', 'Industrial'),
(4, 'Bebidas', 'Industrial'),
(5, 'Mobiliário', 'Industrial'),
(6, 'Couros', 'Industrial'),
(7, 'Metalurgia', 'Industrial'),
(8, 'Mecânica', 'Industrial'),
(9, 'Veículos', 'Comercial'),
(10, 'Tecidos', 'Comercial'),
(11, 'Combustíveis', 'Comercial'),
(12, 'Ferragens', 'Comercial'),
(13, 'Roupas', 'Comercial'),
(14, 'Livros e Revistas', 'Comercial'),
(15, 'Flores', 'Comercial'),
(16, 'Eletrônicos', 'Comercial'),
(17, 'Acessórios', 'Comercial'),
(18, 'Alimentação', 'Servicos'),
(19, 'Transporte', 'Servicos'),
(20, 'Turismo', 'Servicos'),
(21, 'Saúde', 'Servicos'),
(22, 'Educação', 'Servicos'),
(23, 'Lazer', 'Servicos'),
(24, 'Assistência Técnica', 'Servicos'),
(25, 'Segurança', 'Servicos');

-- --------------------------------------------------------

--
-- Table structure for table `valor`
--

DROP TABLE IF EXISTS `valor`;
CREATE TABLE IF NOT EXISTS `valor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plano_estrategico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plano_valor` (`plano_estrategico`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `valor`
--

INSERT INTO `valor` (`id`, `valor`, `plano_estrategico`) VALUES
(80, 'asdasd', 44),
(81, 'asdasd', 44);

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
