CREATE TABLE clienti (
    id_cliente INT PRIMARY KEY,
    nome VARCHAR(50),
    cognome VARCHAR(50)
);

INSERT INTO clienti (id_cliente, nome, cognome) VALUES
(1, 'Mario', 'Rossi'),
(2, 'Luca', 'Verdi'),
(3, 'Anna', 'Bianchi');

CREATE TABLE ordini (
    id_ordine INT PRIMARY KEY,
    id_cliente INT,
    prodotto VARCHAR(50),
    quantita INT,
    FOREIGN KEY (id_cliente) REFERENCES clienti(id_cliente)
);

INSERT INTO ordini (id_ordine, id_cliente, prodotto, quantita) VALUES
(101, 1, 'Laptop', 2),
(102, 2, 'Smartphone', 1),
(103, 1, 'Tablet', 3),
(104, 3, 'TV', 1);


-- Ora vogliamo ottenere un elenco degli ordini con i nomi dei clienti corrispondenti. 
-- La query JOIN per questo caso potrebbe essere la seguente:
SELECT clienti.nome, clienti.cognome, ordini.prodotto, ordini.quantita
FROM clienti
INNER JOIN ordini ON clienti.id_cliente = ordini.id_cliente;
 -- oppure
SELECT ordini.id_ordine, clienti.nome, clienti.cognome, ordini.prodotto, ordini.quantita
FROM ordini
INNER JOIN clienti ON ordini.id_cliente = clienti.id_cliente;
-- ordini e clienti sono i nomi delle tabelle da unire.
-- id_cliente è la colonna comune su cui eseguire l'unione.
