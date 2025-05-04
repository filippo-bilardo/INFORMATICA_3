L'istruzione `UPDATE` in MySQL viene utilizzata per modificare i dati esistenti in una o più righe di una tabella. È possibile specificare condizioni per aggiornare solo le righe che soddisfano determinati criteri, altrimenti tutte le righe della tabella verranno aggiornate con i nuovi valori.

### Sintassi di Base

```sql
UPDATE nome_tabella
SET colonna1 = valore1, colonna2 = valore2, ...
WHERE condizione;
```

- **`nome_tabella`**: Nome della tabella in cui vuoi aggiornare i dati.
- **`SET colonna = valore`**: Specifica la colonna da aggiornare e il nuovo valore. Puoi aggiornare più colonne separandole con una virgola.
- **`WHERE condizione`**: Definisce le righe da aggiornare. Se omessa, tutte le righe verranno aggiornate.

> ⚠️ **Attenzione**: Senza una clausola `WHERE`, l'istruzione `UPDATE` modificherà **tutte** le righe della tabella, quindi è importante usare `WHERE` per evitare aggiornamenti accidentali.

---

### Esempi di Utilizzo

#### 1. Aggiornare una Riga Specifica

Supponiamo di voler aggiornare l'indirizzo email del cliente con `cliente_id = 1` nella tabella `Clienti`.

```sql
UPDATE Clienti
SET email = 'nuovo.email@example.com'
WHERE cliente_id = 1;
```

In questo esempio, solo la riga con `cliente_id = 1` verrà aggiornata.

#### 2. Aggiornare Più Colonne in una Riga

Aggiorniamo sia l'email che la città del cliente con `cliente_id = 2`.

```sql
UPDATE Clienti
SET email = 'luisa.nuovo@example.com', citta = 'Torino'
WHERE cliente_id = 2;
```

Questo comando modifica l'email e la città solo per il cliente con `cliente_id = 2`.

#### 3. Aggiornare Più Righe con una Condizione

Supponiamo di voler aggiornare la città di tutti i clienti che risiedono attualmente a "Roma" e spostarli a "Milano".

```sql
UPDATE Clienti
SET citta = 'Milano'
WHERE citta = 'Roma';
```

In questo esempio, tutte le righe in cui `citta` è uguale a "Roma" verranno aggiornate a "Milano".

#### 4. Aggiornare Tutte le Righe di una Tabella

Se vuoi impostare un valore predefinito su tutte le righe di una colonna, puoi omettere la clausola `WHERE`. Ad esempio, se vuoi aggiornare il `genere` di tutti i film nella tabella `Film` a "Non specificato":

```sql
UPDATE Film
SET genere = 'Non specificato';
```

> **Nota**: Questo comando aggiornerà **tutte le righe** nella tabella `Film`, quindi utilizzalo con attenzione.

---

### Utilizzo Avanzato: UPDATE con JOIN

In MySQL, è possibile usare `UPDATE` con `JOIN` per aggiornare dati in una tabella in base a una condizione che coinvolge un'altra tabella.

#### Esempio di UPDATE con JOIN

Supponiamo di voler aggiornare il costo di tutti i noleggi effettuati da un cliente specifico. Ad esempio, aumentiamo il costo di tutti i noleggi del cliente con `nome = 'Mario'` del 10%.

```sql
UPDATE Noleggi N
JOIN Clienti C ON N.cliente_id = C.cliente_id
SET N.costo = N.costo * 1.10
WHERE C.nome = 'Mario';
```

In questo esempio:
- `JOIN` unisce le tabelle `Noleggi` e `Clienti` usando la colonna `cliente_id`.
- La clausola `SET` aumenta il costo di noleggio del 10% per tutti i noleggi fatti da "Mario".

---

### Esempi di Query di Aggiornamento Completi

Di seguito alcuni altri esempi per illustrare vari utilizzi dell'istruzione `UPDATE`:

#### 1. Aggiornare la Durata di un Film Specifico

Aggiorna la durata del film "Inception" nella tabella `Film` a 150 minuti:

```sql
UPDATE Film
SET durata = 150
WHERE titolo = 'Inception';
```

#### 2. Applicare uno Sconto del 20% a Tutti i Noleggi Oltre i 5 Euro

Ridurre il costo dei noleggi con costo superiore a 5 euro del 20%.

```sql
UPDATE Noleggi
SET costo = costo * 0.80
WHERE costo > 5;
```

#### 3. Aggiornare i Dati di Contatto di un Cliente in Base al Nome

Supponiamo di voler aggiornare l'email e la città di "Carla Neri":

```sql
UPDATE Clienti
SET email = 'carla.nuova@example.com', citta = 'Firenze'
WHERE nome = 'Carla' AND cognome = 'Neri';
```

---

### Esempio Completo di UPDATE con Dati di Prova

1. **Preparazione dei Dati** (se non sono già presenti):

   ```sql
   CREATE DATABASE Videoteca;
   USE Videoteca;

   CREATE TABLE Clienti (
       cliente_id INT PRIMARY KEY AUTO_INCREMENT,
       nome VARCHAR(50),
       cognome VARCHAR(50),
       citta VARCHAR(50),
       email VARCHAR(100)
   );

   INSERT INTO Clienti (nome, cognome, citta, email) VALUES
   ('Mario', 'Rossi', 'Roma', 'mario.rossi@example.com'),
   ('Luisa', 'Bianchi', 'Milano', 'luisa.bianchi@example.com'),
   ('Carla', 'Neri', 'Napoli', 'carla.neri@example.com');
   ```

2. **Eseguire le Query di UPDATE**:

   - Aggiorna la città di Mario Rossi da "Roma" a "Torino":
     ```sql
     UPDATE Clienti
     SET citta = 'Torino'
     WHERE nome = 'Mario' AND cognome = 'Rossi';
     ```

   - Aumenta l'email di Luisa Bianchi:
     ```sql
     UPDATE Clienti
     SET email = 'luisa.nuova@example.com'
     WHERE nome = 'Luisa' AND cognome = 'Bianchi';
     ```

---

### Riepilogo

- **Usare `SET`** per specificare i valori delle colonne da aggiornare.
- **Attenzione alla clausola `WHERE`**: ometterla può causare modifiche su tutte le righe della tabella.
- **JOIN** può essere usato con `UPDATE` per aggiornamenti basati su condizioni che coinvolgono più tabelle.

L'istruzione `UPDATE` è uno strumento potente in SQL, ma va usata con attenzione per evitare modifiche accidentali ai dati.