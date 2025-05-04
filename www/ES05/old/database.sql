CREATE DATABASE infrazioni;
SHOW DATABASES;
USE infrazioni;

DROP TABLE `infrazioni`.`Proprietario`;
CREATE TABLE `infrazioni`.`Proprietario` ( 
    `Cognome` VARCHAR(20) NOT NULL , 
    `Codice_Fiscale` VARCHAR(16) NOT NULL , 
    `Data_Nascita` DATE NULL , 
    PRIMARY KEY (`Codice_Fiscale`(16))
) ENGINE = InnoDB;
SHOW tables;

DROP TABLE infrazioni.Automobile;
CREATE TABLE infrazioni.Automobile (
    Targa VARCHAR(7) NOT NULL PRIMARY KEY ,
    Cod_Modello INT ,
    fk_Proprietario VARCHAR(16) REFERENCES Proprietario(Codice_Fiscale)
) ENGINE = InnoDB;
SHOW tables;


