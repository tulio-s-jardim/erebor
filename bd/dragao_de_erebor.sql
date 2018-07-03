-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema dragao_de_erebor
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dragao_de_erebor
-- -----------------------------------------------------
DROP SCHEMA `dragao_de_erebor`;
CREATE SCHEMA IF NOT EXISTS `dragao_de_erebor` DEFAULT CHARACTER SET utf8 ;
USE `dragao_de_erebor` ;

-- -----------------------------------------------------
-- Table `dragao_de_erebor`.`cenario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dragao_de_erebor`.`cenario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `dificuldade` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `dragao_de_erebor`.`raca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dragao_de_erebor`.`raca` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `dragao_de_erebor`.`habilidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dragao_de_erebor`.`habilidade` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `custo` INT UNSIGNED NOT NULL,
  `nivel_min` INT NOT NULL DEFAULT 0,
  `dano_base` INT NOT NULL,
  `dano_fisico` DOUBLE UNSIGNED NOT NULL,
  `dano_magico` DOUBLE UNSIGNED NOT NULL,
  `cura` INT UNSIGNED NOT NULL,
  `raca_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_habilidade_raca1_idx` (`raca_id` ASC),
  CONSTRAINT `fk_habilidade_raca1`
    FOREIGN KEY (`raca_id`)
    REFERENCES `dragao_de_erebor`.`raca` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `dragao_de_erebor`.`inimigo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dragao_de_erebor`.`inimigo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `hp_maximo` INT NOT NULL DEFAULT 100,
  `dano` INT NOT NULL DEFAULT 15,
  `mult_magico` DOUBLE UNSIGNED NOT NULL DEFAULT 1,
  `mult_fisico` DOUBLE UNSIGNED NOT NULL DEFAULT 1,
  `exp_concedida` INT NOT NULL DEFAULT 5,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `dragao_de_erebor`.`inimigo_em_cenario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dragao_de_erebor`.`inimigo_em_cenario` (
  `cenario_id` INT UNSIGNED NOT NULL,
  `inimigo_id` INT UNSIGNED NOT NULL,
  `probabilidade` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`cenario_id`, `inimigo_id`),
  INDEX `fk_cenario_has_inimigo_inimigo1_idx` (`inimigo_id` ASC),
  INDEX `fk_cenario_has_inimigo_cenario1_idx` (`cenario_id` ASC),
  CONSTRAINT `fk_cenario_has_inimigo_cenario1`
    FOREIGN KEY (`cenario_id`)
    REFERENCES `dragao_de_erebor`.`cenario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cenario_has_inimigo_inimigo1`
    FOREIGN KEY (`inimigo_id`)
    REFERENCES `dragao_de_erebor`.`inimigo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `dragao_de_erebor`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dragao_de_erebor`.`usuario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `end_avatar` VARCHAR(255) NULL DEFAULT 'img/default.jpg',
  `login_diario` INT NOT NULL DEFAULT 1,
  `niveldeacesso` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `dragao_de_erebor`.`personagem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dragao_de_erebor`.`personagem` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT UNSIGNED NOT NULL,
  `raca_id` INT UNSIGNED NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `hp` INT NOT NULL DEFAULT 300,
  `mana` INT UNSIGNED NOT NULL DEFAULT 100,
  `nivel` INT NOT NULL DEFAULT 1,
  `experiencia` INT UNSIGNED NOT NULL DEFAULT 0,
  `forca` INT UNSIGNED NOT NULL DEFAULT 5,
  `inteligencia` INT UNSIGNED NOT NULL DEFAULT 5,
  `constituicao` INT UNSIGNED NOT NULL DEFAULT '5',
  `pontos_de_atributo` INT UNSIGNED NOT NULL DEFAULT 0,
  `ativo` INT NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC),
  INDEX `fk_personagem_usuario_idx` (`usuario_id` ASC),
  INDEX `fk_personagem_raca1_idx` (`raca_id` ASC),
  CONSTRAINT `fk_personagem_raca1`
    FOREIGN KEY (`raca_id`)
    REFERENCES `dragao_de_erebor`.`raca` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personagem_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `dragao_de_erebor`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `dragao_de_erebor`.`versus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dragao_de_erebor`.`versus` (
  `inimigo_id` INT UNSIGNED NOT NULL,
  `usuario_id` INT UNSIGNED NOT NULL,
  `hp_atual` INT NOT NULL,
  PRIMARY KEY (`inimigo_id`, `usuario_id`),
  INDEX `fk_inimigo_has_personagem_inimigo1_idx` (`inimigo_id` ASC),
  INDEX `fk_versus_usuario1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_inimigo_has_personagem_inimigo1`
    FOREIGN KEY (`inimigo_id`)
    REFERENCES `dragao_de_erebor`.`inimigo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_versus_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `dragao_de_erebor`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `dragao_de_erebor`;

DELIMITER $$
USE `dragao_de_erebor`$$
CREATE TRIGGER `dragao_de_erebor`.`deleteRaca`
BEFORE DELETE ON `dragao_de_erebor`.`raca`
FOR EACH ROW
BEGIN
	DELETE FROM habilidade WHERE raca_id = OLD.id;
	DELETE FROM personagem WHERE raca_id = OLD.id;
END$$

USE `dragao_de_erebor`$$
CREATE TRIGGER `dragao_de_erebor`.`deleteInimigo`
BEFORE DELETE ON `dragao_de_erebor`.`inimigo`
FOR EACH ROW
BEGIN
	DELETE FROM versus WHERE inimigo_id = OLD.id;
	DELETE FROM inimigo_em_cenario WHERE inimigo_id = OLD.id;
END$$

USE `dragao_de_erebor`$$
CREATE TRIGGER `dragao_de_erebor`.`deleteUsuario`
BEFORE DELETE ON `dragao_de_erebor`.`usuario`
FOR EACH ROW
BEGIN
	DELETE FROM versus WHERE inimigo_id = OLD.id;
	DELETE FROM personagem WHERE usuario_id = OLD.id;
END$$

USE `dragao_de_erebor`$$
CREATE TRIGGER `dragao_de_erebor`.`subir_nivel`
BEFORE UPDATE ON `dragao_de_erebor`.`personagem`
FOR EACH ROW
BEGIN
	IF 	(NEW.experiencia > 99) THEN
		SET NEW.nivel = NEW.nivel+1;
		SET NEW.experiencia = (NEW.experiencia-100);
		SET NEW.pontos_de_atributo = OLD.pontos_de_atributo + 5;
		SET NEW.hp = 300 + 25*OLD.nivel;
        SET NEW.mana = 100 + 15*OLD.nivel;
	END IF;

	IF 	(NEW.hp < 0) THEN
		SET NEW.ativo = -1;
		SET NEW.hp = 0;
	END IF;
    
    IF(NEW.hp > 300 + 25*(NEW.nivel-1)) THEN
		SET NEW.hp = 300 + 25*(NEW.nivel-1);
	END IF;
END$$

USE `dragao_de_erebor`$$
CREATE TRIGGER `dragao_de_erebor`.`fim_batalha`
BEFORE UPDATE ON `dragao_de_erebor`.`versus`
FOR EACH ROW
BEGIN
	IF (NEW.hp_atual < 1) THEN
		SET SQL_SAFE_UPDATES=0;
		UPDATE 	personagem, inimigo
		SET		experiencia = experiencia + inimigo.exp_concedida
        WHERE	personagem.usuario_id = usuario_id AND ativo <> 0 AND ativo <> -1 
			AND inimigo.id = NEW.inimigo_id; 
		SET SQL_SAFE_UPDATES=1;
       
       
		SET SQL_SAFE_UPDATES=0;
		UPDATE  inimigo
        SET		NEW.hp_atual = inimigo.hp_maximo 
        WHERE 	inimigo.id = NEW.inimigo_id;
		SET SQL_SAFE_UPDATES=1;
    END IF;
END$$


DELIMITER ;

CREATE EVENT loginDiario
  ON SCHEDULE
    AT ('2018-06-29 00:00:00'+ INTERVAL 1 DAY) ON COMPLETION PRESERVE ENABLE 
  DO UPDATE usuario SET login_diario = 1;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;