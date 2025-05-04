-- Creazione del database
CREATE DATABASE Videoteca;
USE Videoteca;
SHOW databases;

-- Creiamo le tabelle
-- Tabella Clienti
SHOW tables;
CREATE TABLE Clienti (
    cliente_id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    citta VARCHAR(50),
    email VARCHAR(100)
);
SHOW tables;
DESC Clienti;

CREATE TABLE Film (
    film_id INT PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(100) NOT NULL,
    genere VARCHAR(50),
    data_uscita DATE,
    durata INT
);

DROP TABLE Noleggi;
CREATE TABLE Noleggi (
    noleggio_id INT PRIMARY KEY AUTO_INCREMENT,
    cliente_id INT,
    film_id INT,
    data_inizio DATE,
    data_scadenza DATE,
    costo DECIMAL(6, 2),
    --FOREIGN KEY (cliente_id) REFERENCES Clienti(cliente_id) ON DELETE CASCADE,
    -- 
    FOREIGN KEY (cliente_id) REFERENCES Clienti(cliente_id) ON DELETE NO ACTION  ON UPDATE CASCADE,
    --FOREIGN KEY (film_id) REFERENCES Film(film_id) ON DELETE CASCADE
    FOREIGN KEY (film_id) REFERENCES Film(film_id) ON DELETE NO ACTION ON UPDATE CASCADE
);

