-- -----------------------------------------------------
-- Table `olivetnews`.`categories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `olivetnews`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `position` INT NULL ,
  `imgurl` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `olivetnews`.`news`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `olivetnews`.`posts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` TEXT NULL ,
  `content` TEXT NULL ,
  `author` VARCHAR(255) NULL ,
  `category_id` INT NULL ,
  `create_time` TIMESTAMP NULL ,
  `imageurl` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `olivetnews`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `olivetnews`.`admins` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(255) NULL ,
  `password` VARCHAR(255) NULL ,
  `email` VARCHAR(255) NULL ,
  `is_admin` VARCHAR(4) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

INSERT INTO `olivetnews`.`categories` (`id`, `name`, `position`, `imgurl`) VALUES ('3', 'Journalism', '3', NULL), ('4', 'Art&Design', '4', NULL),('5', 'IT', '5', NULL), ('6', 'Business', '6', NULL);


