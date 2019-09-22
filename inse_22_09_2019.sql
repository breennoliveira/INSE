-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 22-Set-2019 às 19:58
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id`, `razaosocial`, `nomefantasia`, `cnpj`, `ramo`, `endereco`) VALUES
(6, 'EMPRESA1 S.A.', 'Brenno Oliveira Fernandes', '96877400000159', 10, 4),
(7, 'Bgreen S.A.', 'Bgreen Cosmeticos', '18918592000190', 21, 5);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`) VALUES
(4, 'Rua AmÃ©rico de Campos, 9', '9', '', 'sdf', 'Campinas', 'SÃ£o Paulo', '13083-040'),
(5, 'Rua dos Bobos', '20', 'Casa', 'Esmero', 'Campinas', 'SP', '13076-901');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estrategia`
--

INSERT INTO `estrategia` (`id`, `estrategia`, `perspectiva_bsc`, `grau_contribuicao`, `impacto_economico`, `impacto_social`, `impacto_ambiental`, `indicador_sustentabilidade`, `objetivo`) VALUES
(17, 'A1', 'EconÃ´mico-Financeira', 1, 300, 200, 100, 0.6, 29),
(18, 'A2', 'Aprendizado e Crescimento', 2, 200, 300, 200, 2.4, 29),
(19, 'A1', 'EconÃ´mico-Financeira', 1, 200, 100, 100, 0.2, 28),
(20, 'A1', 'EconÃ´mico-Financeira', 1, 100, 100, 100, 0.1, 30);

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
(8, 'edit_plano', 'Editar plano estrategico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id`, `grupo`) VALUES
(1, 'Master'),
(2, 'Teste'),
(3, 'Teste1'),
(4, 'Teste1'),
(5, 'Teste123'),
(6, 'estrategico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `impacto`
--

DROP TABLE IF EXISTS `impacto`;
CREATE TABLE IF NOT EXISTS `impacto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perspectiva_bsc` varchar(25) NOT NULL,
  `dimensao` varchar(9) NOT NULL,
  `impacto` int(3) NOT NULL,
  `plano_estrategico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plano_impacto_idx` (`plano_estrategico`)
) ENGINE=InnoDB AUTO_INCREMENT=526 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `impacto`
--

INSERT INTO `impacto` (`id`, `perspectiva_bsc`, `dimensao`, `impacto`, `plano_estrategico`) VALUES
(306, 'EconÃ´mico-Financeira', 'Economica', 300, 1),
(307, 'Clientes', 'Economica', 266, 1),
(308, 'Processos Internos', 'Economica', 266, 1),
(309, 'Aprendizado e Crescimento', 'Economica', 133, 1),
(310, 'EconÃ´mico-Financeira', 'Social', 233, 1),
(311, 'Clientes', 'Social', 200, 1),
(312, 'Processos Internos', 'Social', 166, 1),
(313, 'Aprendizado e Crescimento', 'Social', 300, 1),
(314, 'EconÃ´mico-Financeira', 'Ambiental', 166, 1),
(315, 'Clientes', 'Ambiental', 133, 1),
(316, 'Processos Internos', 'Ambiental', 266, 1),
(317, 'Aprendizado e Crescimento', 'Ambiental', 100, 1),
(318, 'EconÃ´mico-Financeira', 'Geral', 233, 1),
(319, 'Clientes', 'Geral', 200, 1),
(320, 'Processos Internos', 'Geral', 233, 1),
(321, 'Aprendizado e Crescimento', 'Geral', 177, 1),
(322, 'Geral', 'Economica', 241, 1),
(323, 'Geral', 'Social', 225, 1),
(324, 'Geral', 'Ambiental', 166, 1),
(325, 'Geral', 'Geral', 211, 1),
(486, 'EconÃ´mico-Financeira', 'Economica', 0, 3),
(487, 'Clientes', 'Economica', 0, 3),
(488, 'Processos Internos', 'Economica', 0, 3),
(489, 'Aprendizado e Crescimento', 'Economica', 0, 3),
(490, 'EconÃ´mico-Financeira', 'Social', 0, 3),
(491, 'Clientes', 'Social', 0, 3),
(492, 'Processos Internos', 'Social', 0, 3),
(493, 'Aprendizado e Crescimento', 'Social', 0, 3),
(494, 'EconÃ´mico-Financeira', 'Ambiental', 0, 3),
(495, 'Clientes', 'Ambiental', 0, 3),
(496, 'Processos Internos', 'Ambiental', 0, 3),
(497, 'Aprendizado e Crescimento', 'Ambiental', 0, 3),
(498, 'EconÃ´mico-Financeira', 'Geral', 0, 3),
(499, 'Clientes', 'Geral', 0, 3),
(500, 'Processos Internos', 'Geral', 0, 3),
(501, 'Aprendizado e Crescimento', 'Geral', 0, 3),
(502, 'Geral', 'Economica', 0, 3),
(503, 'Geral', 'Social', 0, 3),
(504, 'Geral', 'Ambiental', 0, 3),
(505, 'Geral', 'Geral', 0, 3),
(506, 'EconÃ´mico-Financeira', 'Economica', 0, 2),
(507, 'Clientes', 'Economica', 0, 2),
(508, 'Processos Internos', 'Economica', 0, 2),
(509, 'Aprendizado e Crescimento', 'Economica', 0, 2),
(510, 'EconÃ´mico-Financeira', 'Social', 0, 2),
(511, 'Clientes', 'Social', 0, 2),
(512, 'Processos Internos', 'Social', 0, 2),
(513, 'Aprendizado e Crescimento', 'Social', 0, 2),
(514, 'EconÃ´mico-Financeira', 'Ambiental', 0, 2),
(515, 'Clientes', 'Ambiental', 0, 2),
(516, 'Processos Internos', 'Ambiental', 0, 2),
(517, 'Aprendizado e Crescimento', 'Ambiental', 0, 2),
(518, 'EconÃ´mico-Financeira', 'Geral', 0, 2),
(519, 'Clientes', 'Geral', 0, 2),
(520, 'Processos Internos', 'Geral', 0, 2),
(521, 'Aprendizado e Crescimento', 'Geral', 0, 2),
(522, 'Geral', 'Economica', 0, 2),
(523, 'Geral', 'Social', 0, 2),
(524, 'Geral', 'Ambiental', 0, 2),
(525, 'Geral', 'Geral', 0, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `indicador`
--

INSERT INTO `indicador` (`id`, `indicador`, `meta`) VALUES
(1, 'Indicador 1', 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `meta`
--

INSERT INTO `meta` (`id`, `meta`, `data_limite`, `objetivo`) VALUES
(1, 'asdadada', '2019-09-11', 22),
(2, 'aaaa', '2019-09-08', 22),
(3, 'Uma meta', '2019-09-25', 29);

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `objetivo`
--

INSERT INTO `objetivo` (`id`, `objetivo`, `plano_estrategico`) VALUES
(22, 'asdasd', 1),
(28, 'dadada', 2),
(29, 'Objetivo empresarial 1', 3),
(30, 'Objetivo empresarial 2', 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`id`, `funcionalidade`, `grupo`) VALUES
(1, 1, 1),
(2, 2, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `plano_estrategico`
--

INSERT INTO `plano_estrategico` (`id`, `titulo`, `visao`, `missao`, `comeco`, `fim`, `ativo`, `publicado`, `empresa`) VALUES
(1, 'Plano estrategico 2019 empresa tal', 'as', 'asd', '2019-08-22', '2019-08-19', 0, 0, 6),
(2, 'adada', 'ada', 'dada', '2019-09-17', '2019-09-25', 0, 0, 6),
(3, 'Primeiro Plano EstratÃ©gico da Bgreen', 'A empresa tem como visÃ£o a sustentabilidade', 'A missÃ£o da empresa Ã© fazer os clientes felizes', '2019-09-23', '2024-09-23', 0, 0, 7);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `telefone`
--

INSERT INTO `telefone` (`id`, `usuario`, `telefone`) VALUES
(5, 2, '19982286246'),
(6, 3, '19996462821');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `senha`, `nome`, `sobrenome`, `genero`, `empresa`, `grupo`) VALUES
(2, 'breennoliveira@live.com', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d34244c6b6c4f555645354e6a466b4c6c4252536d55314d67244264632b744d4c69706531783070714a3267746a55625339646f6b5735676a3266743452737a6d69515534, 'Brenno', 'Fernandes', 'Masculino', 6, 1),
(3, 'mmcamargo89@gmail.com', 0x246172676f6e32696424763d3139246d3d3133313037322c743d342c703d3424626d39484c6b4d31646d6c454e6b315455554a7253512442566d724d4e752f366b4554652f4c35777976504c4b4c344a6a55374c7a6847654a484341714a7854574d, 'Maria Thereza', 'Miranda de Camargo', 'Feminino', 7, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `valor`
--

INSERT INTO `valor` (`id`, `valor`, `plano_estrategico`) VALUES
(4, 'asdsad', 1),
(5, 'daaaa', 2),
(6, 'Sustentabilidade', 3),
(7, 'Respeito', 3),
(8, 'Empatia', 3);

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
  ADD CONSTRAINT `objetivo_estrategia` FOREIGN KEY (`objetivo`) REFERENCES `objetivo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `impacto`
--
ALTER TABLE `impacto`
  ADD CONSTRAINT `plano_impacto` FOREIGN KEY (`plano_estrategico`) REFERENCES `plano_estrategico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `indicador`
--
ALTER TABLE `indicador`
  ADD CONSTRAINT `meta_indicador` FOREIGN KEY (`meta`) REFERENCES `meta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `meta`
--
ALTER TABLE `meta`
  ADD CONSTRAINT `objetivo_meta` FOREIGN KEY (`objetivo`) REFERENCES `objetivo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `objetivo`
--
ALTER TABLE `objetivo`
  ADD CONSTRAINT `plano_objetivo` FOREIGN KEY (`plano_estrategico`) REFERENCES `plano_estrategico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `permissao`
--
ALTER TABLE `permissao`
  ADD CONSTRAINT `funcionalidade` FOREIGN KEY (`funcionalidade`) REFERENCES `funcionalidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `grupo` FOREIGN KEY (`grupo`) REFERENCES `grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `plano_valor` FOREIGN KEY (`plano_estrategico`) REFERENCES `plano_estrategico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
