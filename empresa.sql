-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 20-Maio-2019 às 11:30
-- Versão do servidor: 5.7.21
-- PHP Version: 5.6.35

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
-- Estrutura da tabela `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razaosocial` varchar(100) NOT NULL,
  `nomefantasia` varchar(100) NOT NULL,
  `cnpj` varchar(100) NOT NULL,
  `ramo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `confir_senha` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id`, `razaosocial`, `nomefantasia`, `cnpj`, `ramo`, `email`, `senha`, `confir_senha`) VALUES
(1, 'Exemplo Empresa', 'Nome Empresa', '12345678', 'Alimentos', 'empresa@gmail.com', '25d55ad283aa400af464c76d713c07ad', '12345678'),
(2, 'Exemplo Empresa2', 'Nome Empresa2', '123456789', 'Alimentos2', 'empresa2@gmail.com', '25d55ad283aa400af464c76d713c07ad', '12345678'),
(3, 'Exemplo Empresa3', 'Nome Empresa3', '123456789', 'Alimentos3', 'empresa3@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '12345'),
(4, 'Exemplo Empresa4', 'Nome Empresa4', '123456789', 'Alimentos4', 'empresa4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456'),
(5, 'Exemplo Empresa5', 'Nome Empresa5', '12345678', 'Alimentos5', 'empresa5@gmail.com', '25d55ad283aa400af464c76d713c07ad', '12345678'),
(6, 'Exemplo Empresa6', 'Empresa Nome6', '12345678', 'Alimentos6', 'empresa6@gmail.com', '25d55ad283aa400af464c76d713c07ad', '12345678'),
(7, 'BGreen SA', 'BGreen Cosmetics ', '12345678899q38293239', 'CosmÃ©ticos', 'bgreen@gmail.com', 'bf48f877893cffae5f7a19eb558f317e', 'lukm1410'),
(8, 'Simple Organic SA', 'Simple Organic', '123456789', 'CosmÃ©ticos', 'simple@gmail.com', '9c7e833b65d98201c54e9b14552db1a3', 'lukm14109020'),
(9, 'Exemplo Empresa10', 'Maria Thereza Miranda de Camargo', '12345678', 'CosmÃ©ticos', 'mmcamargo90@gmail.com', '9c7e833b65d98201c54e9b14552db1a3', 'lukm14109020'),
(10, 'Exemplo Empresa16', 'Empresa 16', '12345678', 'CosmÃ©ticos', 'empresa16@gmail.com', '202cb962ac59075b964b07152d234b70', '123'),
(11, 'Nestle', 'Nestle', '11443423423', 'Comida', 'nestle@gmail.com', '202cb962ac59075b964b07152d234b70', '123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
