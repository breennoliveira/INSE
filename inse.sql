-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Table `inse`.`ramo_atuacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `inse`.`ramo_atuacao` ;

CREATE TABLE IF NOT EXISTS `inse`.`ramo_atuacao` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `atividade` VARCHAR(25) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `ramo` VARCHAR(15) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

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

-- -----------------------------------------------------
-- Table `inse`.`empresa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `inse`.`empresa` ;

CREATE TABLE IF NOT EXISTS `inse`.`empresa` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `razaosocial` VARCHAR(100) NOT NULL,
  `nomefantasia` VARCHAR(100) NOT NULL,
  `cnpj` VARCHAR(14) NOT NULL,
  `ramo` INT(11) NOT NULL,
  `endereco` VARCHAR(255) NOT NULL,
  `numero` VARCHAR(4) NULL DEFAULT NULL,
  `complemento` VARCHAR(255) NULL DEFAULT NULL,
  `bairro` VARCHAR(255) NOT NULL,
  `cidade` VARCHAR(255) NOT NULL,
  `cep` VARCHAR(9) NULL DEFAULT NULL,
  `responsavel` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(13) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(100) NOT NULL,
  `confir_senha` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email` (`email` ASC) ,
  INDEX `ramo_atuacao` (`ramo` ASC) ,
  CONSTRAINT `ramo_atuacao`
    FOREIGN KEY (`ramo`)
    REFERENCES `inse`.`ramo_atuacao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `inse`.`plano_estrategico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `inse`.`plano_estrategico` ;

CREATE TABLE IF NOT EXISTS `inse`.`plano_estrategico` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) NOT NULL,
  `visao` VARCHAR(255) NOT NULL,
  `missao` VARCHAR(255) NOT NULL,
  `comeco` DATE NOT NULL,
  `fim` DATE NOT NULL,
  `ativo` TINYINT(4) NOT NULL,
  `publicado` TINYINT(4) NOT NULL,
  `empresa` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `empresa_plano` (`empresa` ASC) ,
  CONSTRAINT `empresa_plano`
    FOREIGN KEY (`empresa`)
    REFERENCES `inse`.`empresa` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `inse`.`objetivo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `inse`.`objetivo` ;

CREATE TABLE IF NOT EXISTS `inse`.`objetivo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `objetivo` VARCHAR(255) NOT NULL,
  `plano_estrategico` INT(11) NOT NULL,
  `perspectiva_bsc` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `plano_estrategico_idx` (`plano_estrategico` ASC) ,
  CONSTRAINT `plano_objetivo`
    FOREIGN KEY (`plano_estrategico`)
    REFERENCES `inse`.`plano_estrategico` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `inse`.`valor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `inse`.`valor` ;

CREATE TABLE IF NOT EXISTS `inse`.`valor` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `valor` VARCHAR(255) NOT NULL,
  `plano_estrategico` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `plano_valor` (`plano_estrategico` ASC) ,
  CONSTRAINT `plano_valor`
    FOREIGN KEY (`plano_estrategico`)
    REFERENCES `inse`.`plano_estrategico` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
