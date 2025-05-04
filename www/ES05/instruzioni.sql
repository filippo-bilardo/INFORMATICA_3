-- Connessione al container MariaDB
-- docker exec -it lamp_mariadb bash -l
-- mysql -u root -p
-- Connessione al server Codespace
-- mysql -u root -p

-- DROP DATABASE IF EXISTS ES05;
CREATE DATABASE IF NOT EXISTS ES05;
USE ES05;
SHOW DATABASES;

-- Quando il db si trova sulla stessa macchina del server web
-- Ad esempio se server web e db sono entrambi sul server Codespace
DROP USER IF EXISTS ES05_user@localhost;
CREATE USER IF NOT EXISTS ES05_user@localhost IDENTIFIED BY 'mia_password';
ALTER USER ES05_user@localhost IDENTIFIED BY 'nuova_password';
SELECT user, host FROM mysql.user;
GRANT SELECT, INSERT, UPDATE, DELETE ON ES05.* TO ES05_user@localhost;
GRANT ALL ON ES05.* TO ES05_user@localhost;
SHOW GRANTS FOR ES05_user@localhost;

-- Qunado il db si trova su un'altra macchina rispetto al server web
-- Ad esempio se il db si trova sul container MariaDB
DROP USER IF EXISTS ES05_user@172.23.0.2;
CREATE USER IF NOT EXISTS ES05_user@172.23.0.2 IDENTIFIED BY 'nuova_password'; 
GRANT SELECT, INSERT, UPDATE, DELETE ON ES05.* TO ES05_user@172.23.0.2;
SELECT user, host FROM mysql.user;
SHOW GRANTS FOR ES05_user@172.23.0.2;

-- Quando accettiamo connessioni da qualsiasi host 
DROP USER IF EXISTS ES05_user@'%';
CREATE USER IF NOT EXISTS ES05_user@'%' IDENTIFIED BY 'nuova_password'; 
GRANT SELECT, INSERT, UPDATE, DELETE ON ES05.* TO ES05_user@'%';
SELECT user, host FROM mysql.user;
SHOW GRANTS FOR ES05_user;


-- DROP TABLE IF EXISTS utente;
CREATE TABLE IF NOT EXISTS utente (
  UserID INT NOT NULL AUTO_INCREMENT ,
  Username VARCHAR(64) NOT NULL UNIQUE,
  Password VARCHAR(64) NOT NULL ,
  PRIMARY KEY (UserID)
) ENGINE=InnoDB AUTO_INCREMENT=1000;
SHOW TABLES;
SHOW CREATE TABLE utente;

INSERT INTO utente (UserID, Username, Password 
) VALUES (NULL, 'utente', 'prova');

INSERT INTO utente VALUES 
(NULL, 'mrossi', '123'),
(NULL, 'admin', 'admin');

SELECT * FROM utente;
