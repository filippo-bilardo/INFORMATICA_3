### **Esercitazione Pratica: Progettazione e Manipolazione di Tabelle in MySQL**

#### **Scenario**
Stai lavorando per un'azienda che gestisce un sistema di noleggio di veicoli. Devi creare e manipolare il database aziendale per gestire le informazioni su veicoli, clienti, noleggi e pagamenti.

---

### **Parte 1: Creazione del Database**

1. **Crea un nuovo database denominato `NoleggioVeicoli`:**
   ```sql
   CREATE DATABASE NoleggioVeicoli;
   USE NoleggioVeicoli;
   ```

---

### **Parte 2: Creazione di Tabelle con `CREATE TABLE`**

2. **Crea le seguenti tabelle:**

   - **Clienti**: Informazioni sui clienti registrati.
     ```sql
     CREATE TABLE Clienti (
         cliente_id INT AUTO_INCREMENT PRIMARY KEY,
         nome VARCHAR(50) NOT NULL,
         cognome VARCHAR(50) NOT NULL,
         email VARCHAR(100) UNIQUE NOT NULL,
         telefono VARCHAR(15),
         data_registrazione DATE DEFAULT CURRENT_DATE
     );
     ```

   - **Veicoli**: Dettagli sui veicoli disponibili per il noleggio.
     ```sql
     CREATE TABLE Veicoli (
         veicolo_id INT AUTO_INCREMENT PRIMARY KEY,
         modello VARCHAR(50) NOT NULL,
         marca VARCHAR(50) NOT NULL,
         anno INT CHECK (anno >= 2000 AND anno <= YEAR(CURDATE())),
         targa VARCHAR(15) UNIQUE NOT NULL,
         prezzo_giornaliero DECIMAL(10, 2) NOT NULL
     );
     ```

   - **Noleggi**: Registra i noleggi effettuati.
     ```sql
     CREATE TABLE Noleggi (
         noleggio_id INT AUTO_INCREMENT PRIMARY KEY,
         cliente_id INT NOT NULL,
         veicolo_id INT NOT NULL,
         data_inizio DATE NOT NULL,
         data_fine DATE NOT NULL,
         totale DECIMAL(10, 2) NOT NULL CHECK (totale > 0),
         FOREIGN KEY (cliente_id) REFERENCES Clienti(cliente_id) ON DELETE CASCADE,
         FOREIGN KEY (veicolo_id) REFERENCES Veicoli(veicolo_id) ON DELETE SET NULL
     );
     ```

   - **Pagamenti**: Dettagli sui pagamenti effettuati.
     ```sql
     CREATE TABLE Pagamenti (
         pagamento_id INT AUTO_INCREMENT PRIMARY KEY,
         noleggio_id INT NOT NULL,
         data_pagamento DATE NOT NULL,
         importo DECIMAL(10, 2) NOT NULL CHECK (importo > 0),
         metodo_pagamento ENUM('Carta', 'Bonifico', 'Contanti') NOT NULL,
         FOREIGN KEY (noleggio_id) REFERENCES Noleggi(noleggio_id) ON DELETE CASCADE
     );
     ```

---

### **Parte 3: Popolamento delle Tabelle**

3. **Inserisci alcuni dati nelle tabelle:**

   - **Clienti:**
     ```sql
     INSERT INTO Clienti (nome, cognome, email, telefono)
     VALUES 
         ('Mario', 'Rossi', 'mario.rossi@email.com', '3331234567'),
         ('Anna', 'Bianchi', 'anna.bianchi@email.com', '3349876543'),
         ('Luca', 'Verdi', 'luca.verdi@email.com', '3355678901');
     ```

   - **Veicoli:**
     ```sql
     INSERT INTO Veicoli (modello, marca, anno, targa, prezzo_giornaliero)
     VALUES 
         ('Panda', 'Fiat', 2020, 'AB123CD', 30.00),
         ('Golf', 'Volkswagen', 2019, 'EF456GH', 45.00),
         ('Civic', 'Honda', 2021, 'IJ789KL', 50.00);
     ```

   - **Noleggi:**
     ```sql
     INSERT INTO Noleggi (cliente_id, veicolo_id, data_inizio, data_fine, totale)
     VALUES 
         (1, 1, '2024-11-01', '2024-11-05', 120.00),
         (2, 2, '2024-11-10', '2024-11-12', 90.00);
     ```

   - **Pagamenti:**
     ```sql
     INSERT INTO Pagamenti (noleggio_id, data_pagamento, importo, metodo_pagamento)
     VALUES 
         (1, '2024-11-05', 120.00, 'Carta'),
         (2, '2024-11-12', 90.00, 'Bonifico');
     ```

---

### **Parte 4: Modifica delle Tabelle con `ALTER TABLE`**

4. **Esegui le seguenti modifiche:**
   - Aggiungi una colonna `indirizzo` nella tabella `Clienti`.
     ```sql
     ALTER TABLE Clienti ADD COLUMN indirizzo VARCHAR(100);
     ```
   - Modifica la colonna `prezzo_giornaliero` in `Veicoli` per permettere valori nulli.
     ```sql
     ALTER TABLE Veicoli MODIFY COLUMN prezzo_giornaliero DECIMAL(10, 2) NULL;
     ```

---

### **Parte 5: Eliminazione delle Tabelle con `DROP TABLE`**

5. **Elimina la tabella `Pagamenti` e ricreala.**
   - Elimina:
     ```sql
     DROP TABLE Pagamenti;
     ```
   - Ricrea:
     ```sql
     CREATE TABLE Pagamenti (
         pagamento_id INT AUTO_INCREMENT PRIMARY KEY,
         noleggio_id INT NOT NULL,
         data_pagamento DATE NOT NULL,
         importo DECIMAL(10, 2) NOT NULL CHECK (importo > 0),
         metodo_pagamento ENUM('Carta', 'Bonifico', 'Contanti') NOT NULL,
         FOREIGN KEY (noleggio_id) REFERENCES Noleggi(noleggio_id) ON DELETE CASCADE
     );
     ```

---

### **Parte 6: Vincoli di Integrità**

6. **Testa i seguenti vincoli:**
   - Inserisci un cliente senza email (dovrebbe fallire).
     ```sql
     INSERT INTO Clienti (nome, cognome) VALUES ('Giulia', 'Rossi');
     ```
   - Inserisci un veicolo con una targa duplicata (dovrebbe fallire).
     ```sql
     INSERT INTO Veicoli (modello, marca, anno, targa, prezzo_giornaliero)
     VALUES ('Focus', 'Ford', 2022, 'AB123CD', 40.00);
     ```
   - Inserisci un noleggio con una data di fine antecedente alla data di inizio (dovrebbe fallire).
     ```sql
     INSERT INTO Noleggi (cliente_id, veicolo_id, data_inizio, data_fine, totale)
     VALUES (1, 3, '2024-11-15', '2024-11-10', 150.00);
     ```

---

### **Parte 7: Azioni di Integrità Referenziale in MySQL**

7. **Verifica il comportamento dei vincoli referenziali:**
   - Elimina un cliente che ha noleggi attivi (dovrebbe eliminare anche i relativi noleggi).
     ```sql
     DELETE FROM Clienti WHERE cliente_id = 1;
     ```
   - Modifica il veicolo associato a un noleggio (la chiave straniera `ON DELETE SET NULL`).
     ```sql
     DELETE FROM Veicoli WHERE veicolo_id = 2;
     ```

---

### **Consegna**
1. Esegui ogni query in ordine e salva i risultati.
2. Documenta eventuali errori riscontrati e come li hai risolti.
3. In ogni parte dell'esercizio aggiungere vostre query 
3. Consegna il file di script SQL completo.
