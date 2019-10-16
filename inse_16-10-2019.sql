-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 16-Out-2019 às 22:31
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
(4, 'Rua AmÃ©rico de Campos, 9', '10', '', 'sdf', 'Campinas', 'SÃ£o Paulo', '13083-040');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

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
(13, 'AÃ§Ã£o C3', 'Aprendizado e Crescimento', 1, 100, 300, 100, 0.3, 22);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

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
(8, 'edit_plano', 'Editar plano estrategico'),
(9, 'resumo', 'Resumo de Sustentabilidade');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id`, `grupo`, `empresa`) VALUES
(1, 'Default', 0),
(2, 'Master', 0),
(10, 'Teste1', 0),
(11, 'dadada', 6),
(13, 'Teste Orandi', 6),
(14, 'Teste Orandi2', 6);

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
) ENGINE=InnoDB AUTO_INCREMENT=746 DEFAULT CHARSET=utf8;

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
(745, 'Geral', 'Geral', '1.63', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `objetivo`
--

INSERT INTO `objetivo` (`id`, `objetivo`, `plano_estrategico`) VALUES
(22, 'asdasd', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`id`, `funcionalidade`, `grupo`) VALUES
(1, 1, 1),
(2, 2, 1),
(7, 1, 10),
(8, 2, 10),
(9, 3, 10),
(70, 1, 11),
(71, 3, 11),
(72, 4, 11),
(73, 5, 11),
(74, 6, 11),
(75, 7, 11),
(76, 8, 11),
(116, 1, 13),
(117, 2, 13),
(118, 3, 13),
(119, 4, 13),
(120, 7, 13),
(121, 8, 13),
(122, 9, 13),
(123, 4, 14),
(124, 7, 14),
(125, 8, 14),
(126, 9, 14);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `plano_estrategico`
--

INSERT INTO `plano_estrategico` (`id`, `titulo`, `visao`, `missao`, `comeco`, `fim`, `ativo`, `publicado`, `empresa`) VALUES
(1, 'Plano estrategico 2019 empresa tal', 'as', 'asd', '2019-08-22', '2019-08-19', 1, 1, 6),
(2, 'adada', 'ada', 'dada', '2019-09-17', '2019-09-25', 0, 0, 6),
(3, 'adsada', 'dsadas', 'asdas', '2019-09-12', '2019-10-01', 0, 0, 6),
(4, '123123', '123123', '123123', '2019-09-25', '2019-10-01', 0, 0, 6);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `senha`, `nome`, `sobrenome`, `genero`, `empresa`, `grupo`) VALUES
(2, 'breennoliveira@live.com', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d34244c6b6c4f555645354e6a466b4c6c4252536d55314d67244264632b744d4c69706531783070714a3267746a55625339646f6b5735676a3266743452737a6d69515534, 'Brenno', 'Fernandes', 'Masculino', 6, 13),
(3, 'breennoliveira@live.comd', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d342454456f7759693543635467756447787a593039464e6724527144306669554a3339725150394c344b4a684d504d7674515138684d463731556f464946743173745755, 'Brenno', 'Fernandes', 'Masculino', 6, 10),
(4, 'dadada@gmail.com', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d34244c6d5633523035726357526e576c457753476844596724487463325653497059794a507143774e6735434431534d556d74516d74362f2b623777313133427a503763, 'dadada', '3131', '231', 6, 1),
(11, 'dada@gmail.com', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d34246456647a636b68556154513459334a6f4e6b646a4e6724514a576f794648375770443033793832336b2b7a576c592f5051305374697547514d306e48303669495667, 'dadadada', 'dadaaaaaaa', 'dada', 6, 10),
(12, 'breennoliveira@live.coms', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d34244c3070535257525453454a5356533955645659304c6724744b386c4f4a4d774b54594c3972396e624135314239726272714179665661537947435167483132396949, 'dadadada', 'dadadada', 'dadaa', 6, 2),
(13, 'mmcamargo89@gmail.com', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d3424516d4a6f546c4e6b5a6e524a576a4243526b67785a4124565832746f5339316952496c44437768584f546559396858337179333455665a504b4f6c32664e72715438, 'Maria Thereza Miranda', 'de Camargo', 'feminino', 6, 2),
(14, 'orandi@gmail.com', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d34245431707a5a4774434e6a4a48526e67754f55786a6441245472644d4743466169734a30583344424e2f395174494150795a557130686f50446f3537304e456a366749, 'Orandi', 'Falsarella', 'Masculino', 6, 2),
(15, 'pedro@gmail.com', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d3424534846445a4649775245466d61584a725555565652412463795a53504f4d5255374137524b73664c395070343066624d38454f37513851416d48613964737149386f, 'pedro', 'oliveira', 'masculino', 6, 1),
(16, 'gilda@gmail.com', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d3424546c46704e455a35654556484e3146424e5535515151244476664b5348703179437565756c332f4b6479716a35746d7855702f6876562b55376f7061614a76684930, 'gilda ', 'miranda rosa', 'feminino', 6, 14);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
