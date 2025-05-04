INSERT INTO Editori (ID, Nome) VALUES
(1, 'Mondadori'),
(2, 'Feltrinelli'),
(3, 'Apogeo'),
(4, 'Tecniche nuove'),
(5, 'Piemme');

INSERT INTO Libri (ID, Titolo, Editore) VALUES
(1, 'Di noi tre', 1),
(2, 'Due di due', 1),
(3, 'Il diario di Bolivia', 2),
(4, 'Il tropico del cancro', 2),
(5, 'HTML 4 tutto e oltre', 3),
(6, 'MySQL guida completa', 3),
(7, 'Imparare PHP in 24 ore', 4),
(8, 'Comunità sul web', 4),
(9, 'La solitudine dei numeri primi', 1),
(10, 'Il nome della rosa', 2),
(11, 'Il signore degli anelli', 5),
(12, 'Il codice Da Vinci', 5),
(13, '1984', 4),
(14, 'Il vecchio e il mare', 3),
(15, 'Cronache di Narnia', 2),
(16, 'Il Gattopardo', 1),
(17, 'Cent\'anni di solitudine', 1),
(18, 'Moby Dick', 2);

CREATE TABLE Categoria (
    ID INT,
    Padre INT,
    Nome VARCHAR(255)
);

CREATE TABLE Libro_in_categoria (
    Libro INT,
    Categoria INT
);

INSERT INTO Categoria (ID, Padre, Nome) VALUES
(1, 0, 'Romanzo'),
(2, 0, 'Programmazione'),
(3, 0, 'Web'),
(4, 0, 'Sociologia'),
(5, 2, 'PHP'),
(6, 0, 'Diario');

INSERT INTO Libro_in_categoria (Libro, Categoria) VALUES
(1, 1),
(2, 1),
(3, 6),
(4, 1),
(5, 3),
(6, 3),
(7, 3),
(7, 5),
(8, 3),
(8, 4);

INSERT INTO Libro_in_categoria (Libro, Categoria) VALUES
(9, 1),
(10, 1),
(11, 6),
(12, 1),
(13, 3),
(14, 3),
(15, 3),    
(15, 5),
(16, 3),
(16, 4);