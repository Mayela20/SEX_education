CREATE TABLE `juguetes` (
  `idjuguetes` BIGINT(15) NOT NULL,
  `nombrejuguetes` VARCHAR(60) NULL,
  `precio` DECIMAL(15,2) NULL,
  `estadojuguete` CHAR(3) NULL,
  PRIMARY KEY (`idjuguetes`));
