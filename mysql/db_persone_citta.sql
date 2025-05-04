-- https://www.planttext.com/?text=SoWkIImgAStDuUNYvKhDAyaigLH8pYmfERn0ePgNIq51EpF5Ii7JBmJ4rjLLoClFJRLI27CCSlPm3D8mDT3avQf5qbcGMbISdvTAh5QmU6PAFCH2g6AmUL0drDJewkPNmusrKb0goonBLSZCKm8fSaZDIm6x7000#

-- Creazione del database
CREATE DATABASE IF NOT EXISTS esempio_database;
USE esempio_database;

-- Creazione della tabella "città"
CREATE TABLE IF NOT EXISTS città (
    id INT PRIMARY KEY,
    nome VARCHAR(50)
);

-- Inserimento dei dati nella tabella "città"
INSERT INTO città (id, nome) VALUES
(1, 'Roma'),
(2, 'Milano'),
(3, 'Napoli');

-- Creazione della tabella "persone"
CREATE TABLE IF NOT EXISTS persone (
    id INT PRIMARY KEY,
    nome VARCHAR(50),
    id_città INT,
    FOREIGN KEY (id_città) REFERENCES città(id)
);

-- Inserimento dei dati nella tabella "persone"
INSERT INTO persone (id, nome, id_città) VALUES
(1, 'Mario Rossi', 1),
(2, 'Luca Verdi', 2),
(3, 'Anna Bianchi', 3);

-- Query per selezionare il nome delle persone e il nome della città
SELECT persone.nome, città.nome AS nome_città
FROM persone
INNER JOIN città ON persone.id_città = città.id;

-- Aggiunta di altri dati nella tabella "città"
INSERT INTO città (id, nome) VALUES
(4, 'Firenze'),
(5, 'Torino'),
(6, 'Palermo');

-- Aggiunta di altri dati nella tabella "persone"
INSERT INTO persone (id, nome, id_città) VALUES
(4, 'Giulia Esposito', 1),
(5, 'Paolo Martini', 2),
(6, 'Francesca Russo', 4);

-- Query per selezionare il nome delle persone e il nome della città
SELECT persone.nome, città.nome AS nome_città
FROM persone
INNER JOIN città ON persone.id_città = città.id;

-- Aggiunta di altre 20 persone
INSERT INTO persone (id, nome, id_città) VALUES
(7, 'Simone Conti', 3),
(8, 'Elena Santoro', 5),
(9, 'Marco De Luca', 1),
(10, 'Luisa Mancini', 6),
(11, 'Giovanni Russo', 4),
(12, 'Valentina Costa', 2),
(13, 'Andrea Marini', 1),
(14, 'Alessia Ferri', 3),
(15, 'Luigi Greco', 5),
(16, 'Francesca Pellegrini', 6),
(17, 'Roberto Bianco', 2),
(18, 'Giorgia Romano', 4),
(19, 'Fabio Moretti', 1),
(20, 'Martina De Rosa', 3),
(21, 'Riccardo Bellini', 5),
(22, 'Silvia Neri', 6),
(23, 'Antonio Ricci', 2),
(24, 'Caterina Esposito', 4),
(25, 'Davide Ferrara', 1);

-- Query per selezionare il nome delle persone e il nome della città
SELECT persone.nome, città.nome AS nome_città
FROM persone
INNER JOIN città ON persone.id_città = città.id;
