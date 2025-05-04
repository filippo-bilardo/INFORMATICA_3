# https://docs.google.com/presentation/d/1wSSlHAm7urCmYDmHlTgmtNnqnApGIQXuzJjI2vuQm4o/edit#slide=id.g4c639a00cd_0_292
# https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-22-04
# https://www.digitalocean.com/community/tutorials/how-to-create-a-new-user-and-grant-permissions-in-mysql
# https://blog.bit4id.com/archiviazione-sicura-delle-password-hash-salt-e-funzioni-di-derivazione-parte-1/
# https://codecurated.com/blog/how-to-better-store-password-in-database/ 


# Creazione del database WEB_APP2
CREATE DATABASE WEB_APP2;
SHOW DATABASES;
USE WEB_APP2;    

# Creazione dell’utente web_user
CREATE USER 'web_user'@'localhost' IDENTIFIED BY 'eKcGZr59zAa2BEWU';
FLUSH PRIVILEGES;
GRANT SELECT, INSERT, UPDATE ON WEB_APP2.* TO 'web_user'@'localhost';
FLUSH PRIVILEGES;
SHOW GRANTS FOR 'web_user'@'localhost';
desc mysql.user;

# Creazione della tabella utente
CREATE TABLE utente (username VARCHAR( 64 ) NOT NULL, password VARCHAR( 64 ) NOT NULL, PRIMARY KEY (username));
SHOW TABLES;
DESC utente;

INSERT INTO utente (username, password) VALUES ('mrossi', 'prova'),
('sec_user', 'FFcGZr59zAa2BEWU'), 
('admin', 'pwd');

SELECT * FROM utente;





#https://www.wikihow.it/Creare-uno-Script-Sicuro-per-il-Login-Usando-PHP-e-MySQL

#1. Crea il database MySQL.
CREATE DATABASE `secure_login`;

#2. Crea un utente che abbia solo i privilegi per eseguire 'SELECT', 'UPDATE' e 'INSERT'.
CREATE USER 'sec_user'@'localhost' IDENTIFIED BY 'FFcGZr59zAa2BEWU';
GRANT SELECT, INSERT, UPDATE ON `secure_login`.* TO 'sec_user'@'localhost';

#3. Crea una tabella MySQL chiamata 'members'
CREATE TABLE `secure_login`.`members` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `username` VARCHAR(30) NOT NULL, 
  `email` VARCHAR(50) NOT NULL, 
  `password` CHAR(128) NOT NULL, 
  `salt` CHAR(128) NOT NULL
) ENGINE = InnoDB;

# 4. Crea la tabella di log che memorizzer� tutti i tentativi di login.
CREATE TABLE `secure_login`.`login_attempts` (
  `user_id` INT(11) NOT NULL,
  `time` VARCHAR(30) NOT NULL 
) ENGINE=InnoDB;

# 5. Esegui un test di inserimento dati nella tabella 'members'
# Password: 6ZaxN2Vzm9NUJT2y
INSERT INTO `secure_login`.`members` VALUES(1, 'test_user', 'test@example.com', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef');


