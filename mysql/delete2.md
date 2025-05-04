L'istruzione `DELETE` in MySQL viene utilizzata per rimuovere una o più righe da una tabella. È possibile specificare condizioni per eliminare solo le righe che soddisfano determinati criteri, altrimenti tutte le righe della tabella verranno eliminate.

### Sintassi di Base

```sql
DELETE FROM nome_tabella
WHERE condizione;
```

- **`nome_tabella`**: È il nome della tabella dalla quale si vogliono eliminare i record.
- **`condizione`**: Specifica quali righe devono essere eliminate. Solo le righe che soddisfano la condizione verranno rimosse. Se omessa, **tutte le righe** della tabella verranno eliminate.

> ⚠️ **Attenzione**: Senza una clausola `WHERE`, il comando `DELETE` eliminerà tutte le righe dalla tabella, ma non la struttura della tabella.

---

Ecco un esempio di database completo con dati di esempio, progettato per una videoteca. Questo database include tabelle che consentono di testare varie query `DELETE`. Seguono le istruzioni SQL per creare le tabelle, inserirvi i dati e testare le eliminazioni.

---

### 1. Creazione del Database

```sql
CREATE DATABASE Videoteca;
USE Videoteca;
```

---

### 2. Creazione delle Tabelle

#### Tabella `Clienti`

```sql
CREATE TABLE Clienti (
    cliente_id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    citta VARCHAR(50),
    email VARCHAR(100)
);
```

#### Tabella `Film`

```sql
CREATE TABLE Film (
    film_id INT PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(100) NOT NULL,
    genere VARCHAR(50),
    data_uscita DATE,
    durata INT
);
```

#### Tabella `Noleggi`

```sql
CREATE TABLE Noleggi (
    noleggio_id INT PRIMARY KEY AUTO_INCREMENT,
    cliente_id INT,
    film_id INT,
    data_inizio DATE,
    data_scadenza DATE,
    costo DECIMAL(6, 2),
    FOREIGN KEY (cliente_id) REFERENCES Clienti(cliente_id) ON DELETE CASCADE,
    FOREIGN KEY (film_id) REFERENCES Film(film_id) ON DELETE CASCADE
);
```

---

### 3. Inserimento dei Dati di Esempio

#### Dati per la Tabella `Clienti`

```sql
INSERT INTO Clienti (nome, cognome, citta, email) VALUES
('Mario', 'Rossi', 'Roma', 'mario.rossi@example.com'),
('Luisa', 'Bianchi', 'Milano', 'luisa.bianchi@example.com'),
('Giovanni', 'Verdi', 'Roma', 'giovanni.verdi@example.com'),
('Carla', 'Neri', 'Napoli', 'carla.neri@example.com');
```

#### Dati per la Tabella `Film`

```sql
INSERT INTO Film (titolo, genere, data_uscita, durata) VALUES
('Inception', 'Azione', '2010-07-16', 148),
('The Matrix', 'Fantascienza', '1999-03-31', 136),
('Titanic', 'Romantico', '1997-12-19', 195),
('Il Padrino', 'Drammatico', '1972-03-24', 175),
('Interstellar', 'Fantascienza', '2014-11-07', 169);
```

#### Dati per la Tabella `Noleggi`

```sql
INSERT INTO Noleggi (cliente_id, film_id, data_inizio, data_scadenza, costo) VALUES
(1, 1, '2024-01-10', '2024-01-17', 5.50),  -- Mario Rossi noleggia Inception
(1, 3, '2024-01-12', '2024-01-19', 4.00),  -- Mario Rossi noleggia Titanic
(2, 2, '2024-02-01', '2024-02-08', 6.00),  -- Luisa Bianchi noleggia The Matrix
(3, 4, '2024-03-05', '2024-03-12', 7.00),  -- Giovanni Verdi noleggia Il Padrino
(4, 5, '2024-04-20', '2024-04-27', 8.00);  -- Carla Neri noleggia Interstellar
```

---

### 4. Esempi di Query `DELETE`

Ora che il database è popolato, puoi testare diverse query di eliminazione.

#### 4.1 Eliminare un Cliente Specifico

Elimina il cliente con `cliente_id = 1` (Mario Rossi) e osserva che i suoi noleggi verranno eliminati automaticamente grazie al vincolo `ON DELETE CASCADE` nella tabella `Noleggi`.

```sql
DELETE FROM Clienti
WHERE cliente_id = 1;
```

#### 4.2 Eliminare Tutti i Film di un Genere Specifico

Elimina tutti i film di genere "Fantascienza" dalla tabella `Film`. Tutti i noleggi associati a questi film verranno eliminati automaticamente grazie al `ON DELETE CASCADE`.

```sql
DELETE FROM Film
WHERE genere = 'Fantascienza';
```

#### 4.3 Eliminare Tutti i Noleggi di un Cliente di una Città Specifica

Elimina tutti i noleggi dei clienti che risiedono a "Roma" usando un `DELETE` con `JOIN`.

```sql
DELETE N
FROM Noleggi N
JOIN Clienti C ON N.cliente_id = C.cliente_id
WHERE C.citta = 'Roma';
```

#### 4.4 Eliminare Tutti i Noleggi di un Film Specifico

Elimina tutti i noleggi associati al film "Titanic" (film_id = 3).

```sql
DELETE FROM Noleggi
WHERE film_id = 3;
```

#### 4.5 Eliminare Tutti i Noleggi dalla Tabella `Noleggi`

Per eliminare tutti i noleggi ma mantenere la struttura della tabella:

```sql
DELETE FROM Noleggi;
```

#### 4.6 Eliminare Tutti i Dati di una Tabella (TRUNCATE)

Se vuoi eliminare tutte le righe della tabella `Film` e resettare l'AUTO_INCREMENT:

```sql
TRUNCATE TABLE Film;
```

---

### 5. Verifica dei Risultati

Dopo ogni `DELETE`, puoi usare delle query `SELECT` per controllare i risultati:

```sql
-- Verifica i dati nella tabella Clienti
SELECT * FROM Clienti;

-- Verifica i dati nella tabella Film
SELECT * FROM Film;

-- Verifica i dati nella tabella Noleggi
SELECT * FROM Noleggi;
```

---

### 6. Creazione del Backup del Database

Esegui il backup del database `Videoteca` usando `mysqldump`:

```bash
mysqldump -u tuo_utente -p Videoteca > backup_videoteca.sql
```

---

Questo database di esempio e le query `DELETE` forniscono un ambiente completo per testare e comprendere l’uso delle operazioni di eliminazione e i relativi vincoli di integrità referenziale.