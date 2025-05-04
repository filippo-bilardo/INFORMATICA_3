

### Esempi di Utilizzo

#### 1. Eliminare una Riga Specifica

Elimina i record di uno specifico cliente nella tabella `Clienti`:

```sql
DELETE FROM Clienti
WHERE cliente_id = 1;
```

In questo esempio, viene eliminato solo il record in cui `cliente_id` è uguale a 1.

#### 2. Eliminare Più Righe con una Condizione

Elimina tutti i film di genere "commedia" dalla tabella `Film`:

```sql
DELETE FROM Film
WHERE genere = 'commedia';
```

Tutti i film di genere "commedia" verranno eliminati dalla tabella `Film`.

#### 3. Eliminare Tutte le Righe dalla Tabella

Per eliminare tutte le righe di una tabella senza cancellare la struttura della tabella, si può omettere la clausola `WHERE`:

```sql
DELETE FROM Noleggi;
```

> **Nota**: Questo comando rimuove tutte le righe dalla tabella `Noleggi`, ma la tabella stessa rimane intatta.

---

### Utilizzo Avanzato con Join

In MySQL, è possibile utilizzare `DELETE` con `JOIN` per eliminare record da una tabella in base a una condizione che coinvolge più tabelle.

#### Esempio di DELETE con JOIN

Supponiamo di voler eliminare tutti i noleggi associati a un cliente specifico (es. con `cliente_id = 2`) nella tabella `Noleggi`, basandoci sui dati della tabella `Clienti`.

```sql
DELETE N
FROM Noleggi N
JOIN Clienti C ON N.cliente_id = C.cliente_id
WHERE C.cliente_id = 2;
```

In questo esempio:
- `DELETE N` specifica che vogliamo eliminare dalla tabella `Noleggi` (`N` è un alias per `Noleggi`).
- `JOIN` collega `Noleggi` e `Clienti` tramite `cliente_id`.
- La clausola `WHERE` impone che vengano eliminate solo le righe in cui `cliente_id` è uguale a 2.

---

### Differenza tra DELETE e TRUNCATE

- **`DELETE`**: Elimina righe una per una e supporta la clausola `WHERE`. I trigger attivati per l'eliminazione di righe funzionano con `DELETE`.
- **`TRUNCATE`**: Elimina tutte le righe della tabella in modo rapido, resettando anche eventuali contatori AUTO_INCREMENT. Non è possibile usare `TRUNCATE` con `WHERE` e non attiva trigger.

```sql
TRUNCATE TABLE nome_tabella;
```

---

### Esempio Completo

Supponiamo di avere una tabella `Clienti` e di voler rimuovere tutti i clienti che hanno come città "Roma":

```sql
DELETE FROM Clienti
WHERE citta = 'Roma';
```

Questo comando elimina tutti i record nella tabella `Clienti` in cui la città è "Roma".

---

### Riepilogo

- Usare la clausola `WHERE` per specificare le righe da eliminare.
- Omessa la clausola `WHERE`, tutte le righe della tabella verranno eliminate.
- **Fai attenzione** nell’utilizzo di `DELETE` senza `WHERE` per evitare cancellazioni accidentali di tutti i dati.