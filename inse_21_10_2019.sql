-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 21-Out-2019 às 23:11
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.3.5

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
  `cnpj` varchar(14) NOT NULL,
  `ramo` int(11) NOT NULL,
  `endereco` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cnpj_UNIQUE` (`cnpj`),
  KEY `ramo_empresa_idx` (`ramo`),
  KEY `endereco_empresa_idx` (`endereco`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id`, `razaosocial`, `nomefantasia`, `cnpj`, `ramo`, `endereco`) VALUES
(0, 'default', 'default', '0000', 1, 4),
(6, 'EMPRESA1 S.A.', 'Brenno Oliveira Fernandes', '96877400000159', 10, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `endereco` varchar(255) NOT NULL,
  `numero` varchar(4) NOT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(19) NOT NULL,
  `cep` varchar(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`) VALUES
(4, 'Rua AmÃ©rico de Campos, 9', '9', '', 'sdf', 'Campinas', 'SÃ£o Paulo', '13083-040');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estrategia`
--

DROP TABLE IF EXISTS `estrategia`;
CREATE TABLE IF NOT EXISTS `estrategia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estrategia` varchar(255) NOT NULL,
  `perspectiva_bsc` varchar(25) NOT NULL,
  `grau_contribuicao` int(1) DEFAULT NULL,
  `impacto_economico` int(3) DEFAULT NULL,
  `impacto_social` int(3) DEFAULT NULL,
  `impacto_ambiental` int(3) DEFAULT NULL,
  `indicador_sustentabilidade` float DEFAULT NULL,
  `objetivo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `objetivo_estrategia_idx` (`objetivo`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estrategia`
--

INSERT INTO `estrategia` (`id`, `estrategia`, `perspectiva_bsc`, `grau_contribuicao`, `impacto_economico`, `impacto_social`, `impacto_ambiental`, `indicador_sustentabilidade`, `objetivo`) VALUES
(2, 'AÃ§Ã£o A1', 'EconÃ´mico-Financeira', 2, 300, 300, 200, 3.6, 22),
(3, 'AÃ§Ã£o A3', 'EconÃ´mico-Financeira', 2, 300, 200, 200, 2.4, 22),
(4, 'AÃ§Ã£o D1', 'EconÃ´mico-Financeira', 1, 300, 200, 100, 0.6, 22),
(5, 'AÃ§Ã£o A2', 'Clientes', 1, 200, 200, 100, 0.4, 22),
(6, 'AÃ§Ã£o A4', 'Clientes', 2, 300, 200, 200, 2.4, 22),
(7, 'AÃ§Ã£o D3', 'Clientes', 1, 300, 200, 100, 0.6, 22),
(8, 'AÃ§Ã£o B1', 'Processos Internos', 3, 200, 200, 300, 3.6, 22),
(9, 'AÃ§Ã£o B2', 'Processos Internos', 1, 300, 100, 200, 0.6, 22),
(10, 'AÃ§Ã£o B3', 'Processos Internos', 2, 300, 200, 300, 3.6, 22),
(11, 'AÃ§Ã£o C1', 'Aprendizado e Crescimento', 2, 200, 300, 100, 1.2, 22),
(12, 'AÃ§Ã£o C2', 'Aprendizado e Crescimento', 1, 100, 300, 100, 0.3, 22),
(13, 'AÃ§Ã£o C3', 'Aprendizado e Crescimento', 1, 100, 300, 100, 0.3, 22),
(14, 'Pesquisa de mercado para foco em produtos relevantes', 'Clientes', 2, 200, 200, 100, 0.8, 23),
(15, 'RevitalizaÃ§Ã£o de processos legados e eliminaÃ§Ã£o de etapas burocrÃ¡ticas.', 'Processos Internos', 1, 100, 300, 100, 0.3, 23),
(18, 'Realizar instalaÃ§Ã£o de placas de energia solar, com sourcing e mÃ£o de obra locais, em todos os telhados da matriz.', 'EconÃ´mico-Financeira', 2, 100, 200, 300, 1.2, 24),
(19, 'asdasd', 'EconÃ´mico-Financeira', 2, 300, 300, 100, 1.8, 27),
(20, 'daad', 'Clientes', 2, 300, 100, 300, 1.8, 27),
(22, 'daada', 'EconÃ´mico-Financeira', 1, 200, 100, 100, 0.2, 28),
(28, 'Contratar especialistas para treinar os empregados.', 'Aprendizado e Crescimento', 2, 200, 300, 100, 1.2, 26),
(29, 'RealizaÃ§Ã£o de eventos mensais na empresa, convidando empresas locais com boa reputaÃ§Ã£o em sustentabilidade para usufruir da empresa (Food trucks, etc..)', 'Processos Internos', 2, 300, 300, 200, 3.6, 25),
(30, 'Reformular processos para eliminaÃ§Ã£o de horas extras desnecessÃ¡rias e prover melhor workflow.', 'Processos Internos', 2, 200, 300, 100, 1.2, 25),
(31, 'adadada', 'Processos Internos', 3, 200, 200, 200, 2.4, 27),
(32, 'adadadada', 'Aprendizado e Crescimento', 3, 300, 300, 300, 8.1, 27);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionalidade`
--

DROP TABLE IF EXISTS `funcionalidade`;
CREATE TABLE IF NOT EXISTS `funcionalidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `funcionalidade` varchar(45) NOT NULL,
  `nome_func` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionalidade`
--

INSERT INTO `funcionalidade` (`id`, `funcionalidade`, `nome_func`) VALUES
(1, 'geren_empresa', 'Alterar Dados da Empresa'),
(2, 'geren_usuarios', 'Gerenciar usuarios'),
(3, 'geren_permissions', 'Gerenciar permissoes'),
(4, 'criar_pee', 'Criar PEE'),
(5, 'edit_pee', 'Editar PEE'),
(6, 'ativo_pee', 'Ativar/Desativar PEE'),
(7, 'edit_identidade', 'Editar identidade organizacional'),
(8, 'edit_plano', 'Editar plano estrategico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo` varchar(45) NOT NULL,
  `empresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa_grupo` (`empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id`, `grupo`, `empresa`) VALUES
(1, 'Default', 0),
(2, 'Master', 0),
(10, 'Teste1', 0),
(11, 'dadada', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `impacto`
--

DROP TABLE IF EXISTS `impacto`;
CREATE TABLE IF NOT EXISTS `impacto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perspectiva_bsc` varchar(25) NOT NULL,
  `dimensao` varchar(9) NOT NULL,
  `impacto` decimal(5,2) NOT NULL,
  `plano_estrategico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plano_impacto_idx` (`plano_estrategico`)
) ENGINE=InnoDB AUTO_INCREMENT=1546 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `impacto`
--

INSERT INTO `impacto` (`id`, `perspectiva_bsc`, `dimensao`, `impacto`, `plano_estrategico`) VALUES
(726, 'EconÃ´mico-Financeira', 'Economica', '300.00', 1),
(727, 'Clientes', 'Economica', '266.00', 1),
(728, 'Processos Internos', 'Economica', '266.00', 1),
(729, 'Aprendizado e Crescimento', 'Economica', '133.00', 1),
(730, 'EconÃ´mico-Financeira', 'Social', '233.00', 1),
(731, 'Clientes', 'Social', '200.00', 1),
(732, 'Processos Internos', 'Social', '166.00', 1),
(733, 'Aprendizado e Crescimento', 'Social', '300.00', 1),
(734, 'EconÃ´mico-Financeira', 'Ambiental', '166.00', 1),
(735, 'Clientes', 'Ambiental', '133.00', 1),
(736, 'Processos Internos', 'Ambiental', '266.00', 1),
(737, 'Aprendizado e Crescimento', 'Ambiental', '100.00', 1),
(738, 'EconÃ´mico-Financeira', 'Geral', '2.20', 1),
(739, 'Clientes', 'Geral', '1.13', 1),
(740, 'Processos Internos', 'Geral', '2.60', 1),
(741, 'Aprendizado e Crescimento', 'Geral', '0.60', 1),
(742, 'Geral', 'Economica', '241.00', 1),
(743, 'Geral', 'Social', '225.00', 1),
(744, 'Geral', 'Ambiental', '166.00', 1),
(745, 'Geral', 'Geral', '1.63', 1),
(1386, 'EconÃ´mico-Financeira', 'Economica', '300.00', 3),
(1387, 'Clientes', 'Economica', '300.00', 3),
(1388, 'Processos Internos', 'Economica', '200.00', 3),
(1389, 'Aprendizado e Crescimento', 'Economica', '300.00', 3),
(1390, 'EconÃ´mico-Financeira', 'Social', '300.00', 3),
(1391, 'Clientes', 'Social', '100.00', 3),
(1392, 'Processos Internos', 'Social', '200.00', 3),
(1393, 'Aprendizado e Crescimento', 'Social', '300.00', 3),
(1394, 'EconÃ´mico-Financeira', 'Ambiental', '100.00', 3),
(1395, 'Clientes', 'Ambiental', '300.00', 3),
(1396, 'Processos Internos', 'Ambiental', '200.00', 3),
(1397, 'Aprendizado e Crescimento', 'Ambiental', '300.00', 3),
(1398, 'EconÃ´mico-Financeira', 'Geral', '1.80', 3),
(1399, 'Clientes', 'Geral', '1.80', 3),
(1400, 'Processos Internos', 'Geral', '2.40', 3),
(1401, 'Aprendizado e Crescimento', 'Geral', '8.10', 3),
(1402, 'Geral', 'Economica', '275.00', 3),
(1403, 'Geral', 'Social', '225.00', 3),
(1404, 'Geral', 'Ambiental', '225.00', 3),
(1405, 'Geral', 'Geral', '3.53', 3),
(1446, 'EconÃ´mico-Financeira', 'Economica', '100.00', 2),
(1447, 'Clientes', 'Economica', '200.00', 2),
(1448, 'Processos Internos', 'Economica', '200.00', 2),
(1449, 'Aprendizado e Crescimento', 'Economica', '200.00', 2),
(1450, 'EconÃ´mico-Financeira', 'Social', '200.00', 2),
(1451, 'Clientes', 'Social', '200.00', 2),
(1452, 'Processos Internos', 'Social', '300.00', 2),
(1453, 'Aprendizado e Crescimento', 'Social', '300.00', 2),
(1454, 'EconÃ´mico-Financeira', 'Ambiental', '300.00', 2),
(1455, 'Clientes', 'Ambiental', '100.00', 2),
(1456, 'Processos Internos', 'Ambiental', '133.00', 2),
(1457, 'Aprendizado e Crescimento', 'Ambiental', '100.00', 2),
(1458, 'EconÃ´mico-Financeira', 'Geral', '1.20', 2),
(1459, 'Clientes', 'Geral', '0.80', 2),
(1460, 'Processos Internos', 'Geral', '1.70', 2),
(1461, 'Aprendizado e Crescimento', 'Geral', '1.20', 2),
(1462, 'Geral', 'Economica', '175.00', 2),
(1463, 'Geral', 'Social', '250.00', 2),
(1464, 'Geral', 'Ambiental', '158.00', 2),
(1465, 'Geral', 'Geral', '1.23', 2),
(1526, 'EconÃ´mico-Financeira', 'Economica', '200.00', 8),
(1527, 'EconÃ´mico-Financeira', 'Social', '100.00', 8),
(1528, 'EconÃ´mico-Financeira', 'Ambiental', '100.00', 8),
(1529, 'EconÃ´mico-Financeira', 'Geral', '0.20', 8),
(1530, 'Clientes', 'Economica', '0.00', 8),
(1531, 'Clientes', 'Social', '0.00', 8),
(1532, 'Clientes', 'Ambiental', '0.00', 8),
(1533, 'Clientes', 'Geral', '0.00', 8),
(1534, 'Processos Internos', 'Economica', '0.00', 8),
(1535, 'Processos Internos', 'Social', '0.00', 8),
(1536, 'Processos Internos', 'Ambiental', '0.00', 8),
(1537, 'Processos Internos', 'Geral', '0.00', 8),
(1538, 'Aprendizado e Crescimento', 'Economica', '0.00', 8),
(1539, 'Aprendizado e Crescimento', 'Social', '0.00', 8),
(1540, 'Aprendizado e Crescimento', 'Ambiental', '0.00', 8),
(1541, 'Aprendizado e Crescimento', 'Geral', '0.00', 8),
(1542, 'Geral', 'Economica', '50.00', 8),
(1543, 'Geral', 'Social', '25.00', 8),
(1544, 'Geral', 'Ambiental', '25.00', 8),
(1545, 'Geral', 'Geral', '0.05', 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `indicador`
--

DROP TABLE IF EXISTS `indicador`;
CREATE TABLE IF NOT EXISTS `indicador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `indicador` varchar(255) NOT NULL,
  `meta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_indicador_idx` (`meta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `meta`
--

DROP TABLE IF EXISTS `meta`;
CREATE TABLE IF NOT EXISTS `meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta` varchar(255) NOT NULL,
  `data_limite` date NOT NULL,
  `objetivo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `objetivo_meta_idx` (`objetivo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `meta`
--

INSERT INTO `meta` (`id`, `meta`, `data_limite`, `objetivo`) VALUES
(1, 'asdadada', '2019-09-11', 22),
(2, 'aaaa', '2019-09-08', 22);

-- --------------------------------------------------------

--
-- Estrutura da tabela `objetivo`
--

DROP TABLE IF EXISTS `objetivo`;
CREATE TABLE IF NOT EXISTS `objetivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo` varchar(255) NOT NULL,
  `plano_estrategico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plano_objetivo_idx` (`plano_estrategico`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `objetivo`
--

INSERT INTO `objetivo` (`id`, `objetivo`, `plano_estrategico`) VALUES
(22, 'asdasd', 1),
(23, 'Aumentar os rendimentos em 20%', 2),
(24, 'Entrar no top 10 empresas com maior uso de energia verde da regiÃ£o', 2),
(25, 'Ser nomeado como Best Place to Work', 2),
(26, 'Aumentar a produtividade em 15%', 2),
(27, 'asdasd', 3),
(28, 'asdasdasd', 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

DROP TABLE IF EXISTS `permissao`;
CREATE TABLE IF NOT EXISTS `permissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `funcionalidade` int(11) NOT NULL,
  `grupo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `funcionalidade_idx` (`funcionalidade`),
  KEY `grupo_idx` (`grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`id`, `funcionalidade`, `grupo`) VALUES
(1, 1, 1),
(2, 2, 1),
(7, 1, 10),
(8, 2, 10),
(9, 3, 10),
(26, 2, 11),
(27, 3, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `plano_estrategico`
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
  KEY `empresa_plano_idx` (`empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `plano_estrategico`
--

INSERT INTO `plano_estrategico` (`id`, `titulo`, `visao`, `missao`, `comeco`, `fim`, `ativo`, `publicado`, `empresa`) VALUES
(1, 'Plano estrategico 2019 empresa tal', 'as', 'asd', '2016-01-01', '2017-01-01', 0, 1, 6),
(2, 'Plano Estrategico 2019 - 2021', 'Ser a maior empresa de prestaÃ§Ã£o de serviÃ§os do estado.', 'Ser a empresa mais competitiva da regiÃ£o, com excelÃªncia em prestaÃ§Ã£o de serviÃ§os e Ã³tima qualidade de trabalho.', '2017-01-01', '2020-01-01', 1, 1, 6),
(3, 'adsada', 'dsadas', 'asdas', '2014-01-01', '2016-01-01', 0, 1, 6),
(4, '123123', '123123', '123123', '2019-09-25', '2019-10-01', 0, 0, 6),
(8, 'asdasd', 'asdas', 'dasd', '2019-10-16', '2019-10-23', 0, 0, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ramo_atuacao`
--

DROP TABLE IF EXISTS `ramo_atuacao`;
CREATE TABLE IF NOT EXISTS `ramo_atuacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atividade` varchar(25) NOT NULL,
  `ramo` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ramo_atuacao`
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
-- Estrutura da tabela `telefone`
--

DROP TABLE IF EXISTS `telefone`;
CREATE TABLE IF NOT EXISTS `telefone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_telefone_idx` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `telefone`
--

INSERT INTO `telefone` (`id`, `usuario`, `telefone`) VALUES
(5, 2, '19982286247');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `senha` blob NOT NULL,
  `nome` varchar(254) NOT NULL,
  `sobrenome` varchar(254) NOT NULL,
  `genero` varchar(45) NOT NULL,
  `empresa` int(11) NOT NULL,
  `grupo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `empresa_usuario_idx` (`empresa`),
  KEY `grupo_usuario_idx` (`grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `senha`, `nome`, `sobrenome`, `genero`, `empresa`, `grupo`) VALUES
(2, 'breennoliveira@live.com', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d34244c6b6c4f555645354e6a466b4c6c4252536d55314d67244264632b744d4c69706531783070714a3267746a55625339646f6b5735676a3266743452737a6d69515534, 'Brenno', 'Fernandes', 'Masculino', 6, 10),
(3, 'breennoliveira@live.comd', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d342454456f7759693543635467756447787a593039464e6724527144306669554a3339725150394c344b4a684d504d7674515138684d463731556f464946743173745755, 'Brenno', 'Fernandes', 'Masculino', 6, 2),
(4, '3131@gmail.com', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d34244c6d5633523035726357526e576c457753476844596724487463325653497059794a507143774e6735434431534d556d74516d74362f2b623777313133427a503763, 'dadada', '3131', '231', 6, 1),
(11, 'dada@gmail.com', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d34246456647a636b68556154513459334a6f4e6b646a4e6724514a576f794648375770443033793832336b2b7a576c592f5051305374697547514d306e48303669495667, 'dadadada', 'dadaaaaaaa', 'dada', 6, 10),
(12, 'breennoliveira@live.coms', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d34244c3070535257525453454a5356533955645659304c6724744b386c4f4a4d774b54594c3972396e624135314239726272714179665661537947435167483132396949, 'dadadada', 'dadadada', 'dadaa', 6, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `valor`
--

DROP TABLE IF EXISTS `valor`;
CREATE TABLE IF NOT EXISTS `valor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` varchar(255) NOT NULL,
  `plano_estrategico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plano_valor_idx` (`plano_estrategico`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `valor`
--

INSERT INTO `valor` (`id`, `valor`, `plano_estrategico`) VALUES
(4, 'asdsad', 1),
(5, 'dasdasd', 3),
(6, '12331', 4),
(7, 'Teste1', 2),
(11, 'asdasd', 8);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `endereco_empresa` FOREIGN KEY (`endereco`) REFERENCES `endereco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ramo_empresa` FOREIGN KEY (`ramo`) REFERENCES `ramo_atuacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `estrategia`
--
ALTER TABLE `estrategia`
  ADD CONSTRAINT `objetivo_estrategia` FOREIGN KEY (`objetivo`) REFERENCES `objetivo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `empresa_grupo` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `impacto`
--
ALTER TABLE `impacto`
  ADD CONSTRAINT `plano_impacto` FOREIGN KEY (`plano_estrategico`) REFERENCES `plano_estrategico` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `indicador`
--
ALTER TABLE `indicador`
  ADD CONSTRAINT `meta_indicador` FOREIGN KEY (`meta`) REFERENCES `meta` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `meta`
--
ALTER TABLE `meta`
  ADD CONSTRAINT `objetivo_meta` FOREIGN KEY (`objetivo`) REFERENCES `objetivo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `objetivo`
--
ALTER TABLE `objetivo`
  ADD CONSTRAINT `plano_objetivo` FOREIGN KEY (`plano_estrategico`) REFERENCES `plano_estrategico` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `permissao`
--
ALTER TABLE `permissao`
  ADD CONSTRAINT `funcionalidade` FOREIGN KEY (`funcionalidade`) REFERENCES `funcionalidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `grupo` FOREIGN KEY (`grupo`) REFERENCES `grupo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `plano_estrategico`
--
ALTER TABLE `plano_estrategico`
  ADD CONSTRAINT `empresa_plano` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `telefone`
--
ALTER TABLE `telefone`
  ADD CONSTRAINT `usuario_telefone` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `empresa_usuario` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `grupo_usuario` FOREIGN KEY (`grupo`) REFERENCES `grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `valor`
--
ALTER TABLE `valor`
  ADD CONSTRAINT `plano_valor` FOREIGN KEY (`plano_estrategico`) REFERENCES `plano_estrategico` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
