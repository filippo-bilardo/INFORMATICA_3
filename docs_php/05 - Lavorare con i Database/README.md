## 5. **Lavorare con i Database**

---
### Esercitazioni
- [ES05 - Login con PHP e MySql](<https://docs.google.com/presentation/d/1tXEsuEtcawqlxX1wcktWsgjuNFoiaFXEQ-eKfgrebU4>)
- ES06 - Registrazione nuovo utente e inserimento dati nel DB
- ES07 - Web app PHP per la gestione dell'account
- ES08 - Web app PHP per la visualizzazione e gestione dei dati presenti nel DB

--- 
### Teoria
1. **Gestione delle eccezioni**
   - [01.1 Introduzione alle eccezioni](<01.1 Introduzione alle eccezioni.md>)
   - [01.2 Blocchi Try-Catch](<01.2 Blocchi Try-Catch.md>)
   - [01.3 Lanciare Eccezioni](<01.3 Lanciare Eccezioni.md>)
   - [01.4 La Clausola Finally](<01.4 La Clausola Finally.md>)
   - [01.5 Classi di Eccezione Predefinite](<01.5 Classi di Eccezione Predefinite.md>)
   - [01.6 Creazione di Eccezioni Personalizzate](<01.6 Creazione di Eccezioni Personalizzate.md>)
   - [01.7 Gestione degli Errori Legacy](<01.7 Gestione degli Errori Legacy.md>)
   - [01.8 Logging e Debugging delle Eccezioni](<01.8 Logging e Debugging delle Eccezioni.md>)
   - Errori fatali e gestione di errori personalizzati.
   - Gestione avanzata degli errori
   - Error handling e debugging avanzato
   - Differenze con i linguaggi Java, C++ e JavaScript
   - Quiz di autovalutazione


   - 12.2 Creazione di una classe di eccezione personalizzata
   - 12.3 Gestione delle eccezioni in un'applicazione web
   - 12.4 Simulazione di errori e debug con logging
   - 13.2 Importanza della gestione delle eccezioni nella programmazione moderna


2. **Lavorare con i database**
   - [02.1 Metodi a Confronto per la Connessione al Database](<02.1 Metodi a Confronto per la Connessione al Database.md>)
   - [02.2 Connessione al DB](<02.2 Connessione al DB.md>)
   - [02.3 Esecuzione di query DDL](<02.3 Esecuzione di query DDL.md>)
   - [02.4 Esecuzione di query DML](<02.4 Esecuzione di query DML.md>)
   - [02.5 Operazioni CRUD](<02.5 Operazioni CRUD.md>)
   - [02.6 Ottenimento dei risultati](<02.6 Ottenimento dei risultati.md>)
   - [02.7 Query parametrizzate e prevenzione SQL Injection](<02.7 Query parametrizzate e prevenzione SQL Injection.md>)
   - [02.8 Gestione di transazioni](<02.8 Gestione di transazioni.md>)
   - [02.9 Riepilogo metodi mysqli](<02.9 Riepilogo metodi mysqli.md>)
   - [02.10 Quiz di autovalutazione](<02.10 Quiz di autovalutazione.md>)
   - [02.11 Esercitazioni pratiche](<02.11 Esercitazioni pratiche.md>)
   - [02.12 Tipi di database supportati da PHP](<02.12 Tipi di database supportati da PHP.md>)
   - [02.13 Interfaccia MySQLi ad oggetti](<02.13 Interfaccia MySQLi ad oggetti.md>)
   - [02.14 Interfaccia PDO](<02.14 Interfaccia PDO.md>)

3. **Logging e Debugging delle Eccezioni**
   - 03.1 Registrazione delle eccezioni in file di log
   - 03.2 Uso di librerie di logging (es. Monolog)
   - 03.3 Tecniche di debugging per identificare la causa delle eccezioni
   - 03.4 Visualizzazione sicura delle eccezioni in ambiente di produzione

4. ** Invio email**
   - [04.1 Invio email con PHPMailer](<04.1 Invio email con PHPMailer.md>)
   - [04.2 Invio email con funzione mail di PHP](<04.2 Invio email con funzione mail di PHP.md>)
---
[INDICE](../README.md)

---

### **9. Gestione delle Eccezioni nei Database**
   - 9.1 Gestione delle eccezioni con MySQLi e PDO
   - 9.2 Cattura di errori di connessione al database
   - 9.3 Gestione di query fallite o dati corrotti
   - 9.4 Esempi pratici di gestione delle eccezioni in transazioni
### **10. Best Practice per la Gestione delle Eccezioni**
   - 10.1 Non ignorare le eccezioni
   - 10.2 Evitare l'uso eccessivo di `try-catch`
   - 10.3 Separare la logica di business dalla gestione delle eccezioni
   - 10.4 Documentazione delle eccezioni nei commenti del codice
## **2. Prerequisiti per la Connessione**
   - Installazione e configurazione del server MySQL/MariaDB
   - Configurazione del server web (Apache/Nginx)
   - Estensioni necessarie in PHP (mysqli, pdo_mysql)
## **5. Best Practice per la Sicurezza**
   - Utilizzo di credenziali sicure
   - Evitare il hard-coding delle password
   - Uso di variabili d'ambiente o file di configurazione
## **8. Ottimizzazione delle Prestazioni**
   - Uso efficiente delle risorse
   - Chiusura della connessione
   - Cache dei risultati delle query

