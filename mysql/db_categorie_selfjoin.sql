-- Immagina di avere una tabella Categories che rappresenta una gerarchia di categorie, dove ogni categoria può avere una sottocategoria. In questo caso, puoi utilizzare un self join per ottenere informazioni su ogni categoria insieme alla sua sottocategoria. La tabella potrebbe avere una struttura simile alla seguente:

CREATE TABLE Categories (
    CategoryID INT PRIMARY KEY,
    CategoryName VARCHAR(50),
    ParentCategoryID INT,
    FOREIGN KEY (ParentCategoryID) REFERENCES Categories(CategoryID)
);

INSERT INTO Categories (CategoryID, CategoryName, ParentCategoryID) VALUES
(1, 'Elettronica', NULL),
(2, 'Telefonia', 1),
(3, 'Computer', 1),
(4, 'Smartphone', 2),
(5, 'Laptop', 3),
(6, 'Casa', NULL),
(7, 'Arredamento', 6),
(8, 'Elettrodomestici', 6);


-- -- Ora vogliamo ottenere un elenco delle categorie con le sottocategorie corrispondenti.
-- -- La query JOIN per questo caso potrebbe essere la seguente:
SELECT c1.CategoryName AS Category, c2.CategoryName AS Subcategory
FROM Categories c1
INNER JOIN Categories c2 ON c1.CategoryID = c2.ParentCategoryID;
-- -- c1 e c2 sono gli alias delle tabelle da unire.
-- -- CategoryID è la colonna comune su cui eseguire l'unione.
-- -- ParentCategoryID è la colonna che collega una categoria alla sua sottocategoria.
-- -- CategoryName è la colonna che contiene il nome della categoria.
-- -- Subcategory è l'alias della colonna CategoryName della tabella c2.
-- -- Category è l'alias della colonna CategoryName della tabella c1.
-- -- La query restituisce il nome della categoria e il nome della sottocategoria corrispondente.
-- -- Per ogni categoria, la query restituisce una riga per ogni sottocategoria.
-- -- Se una categoria non ha sottocategorie, la query restituisce solo il nome della categoria.
-- -- Se una categoria ha più sottocategorie, la query restituisce una riga per ogni sottocategoria.
-- -- Se una categoria ha una sottocategoria, la query restituisce una riga per la categoria e la sottocategoria.
-- -- Se una categoria ha più sottocategorie, la query restituisce una riga per la categoria e ogni sottocategoria.
-- -- Se una categoria ha una sottocategoria che ha una sottocategoria, la query restituisce una riga per la categoria, la sottocategoria e la sottocategoria della sottocategoria.
-- -- Se una categoria ha una sottocategoria che ha più sottocategorie, la query restituisce una riga per la categoria, la sottocategoria e ogni sottocategoria della sottocategoria.
-- -- Se una categoria ha più sottocategorie che hanno più sottocategorie, la query restituisce una riga per la categoria, ogni sottocategoria e ogni sottocategoria della sottocategoria.
-- -- Se una categoria ha più sottocategorie che hanno una sottocategoria, la query restituisce una riga per la categoria, ogni sottocategoria e la sottocategoria della sottocategoria.
-- -- Se una categoria ha più sottocategorie che hanno una sottocategoria che ha più sottocategorie, la query restituisce una riga per la categoria, ogni sottocategoria, la sottocategoria della sottocategoria e ogni sottocategoria della sottocategoria.
-- -- Se una categoria ha più sottocategorie che hanno una sottocategoria che ha una sottocategoria, la query restituisce una riga per la categoria, ogni sottocategoria, la sottocategoria della sottocategoria e la sottocategoria della sottocategoria.
-- -- Se una categoria ha più sottocategorie che hanno una sottocategoria che ha una sottocategoria che ha più sottocategorie, la query restituisce una riga per la categoria, ogni sottocategoria, la sottocategoria della sottocategoria, la sottocategoria della sottocategoria e ogni sottocategoria della sottocategoria.
-- -- Se una categoria ha più sottocategorie che hanno una sottocategoria che ha una sottocategoria che ha una sottocategoria, la query restituisce una riga per la categoria, ogni sottocategoria, la sottocategoria della sottocategoria, la sottocategoria della sottocategoria e la sottocategoria della sottocategoria.
-- -- Se una categoria ha più sottocategorie che hanno una sottocategoria che ha una sottocategoria che ha una sottocategoria che ha più sottocategorie, la query restituisce una riga per la categoria, ogni sottocategoria, la sottocategoria della sottocategoria, la sottocategoria della sottocategoria, la sottocategoria della sottocategoria e ogni sottocategoria della sottocategoria.

-- Ora, eseguiamo un self join per ottenere una lista delle categorie insieme alle loro sottocategorie (se presenti):
SELECT
    c1.CategoryID AS CategoryID,
    c1.CategoryName AS CategoryName,
    c2.CategoryID AS SubCategoryID,
    c2.CategoryName AS SubCategoryName
FROM Categories c1
LEFT JOIN Categories c2 ON c1.CategoryID = c2.ParentCategoryID;
-- In questo esempio: 
-- Categories è il nome della tabella.
-- c1 e c2 sono alias della tabella Categories.
-- c1.CategoryID = c2.ParentCategoryID è la condizione di join, che collega la categoria principale (c1) alle sue sottocategorie (c2).
-- La query restituirà un elenco delle categorie insieme alle loro sottocategorie, se presenti. Puoi adattare questa logica a seconda delle tue esigenze specifiche e della struttura della tua tabella.

