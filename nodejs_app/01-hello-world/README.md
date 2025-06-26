# 🚀 Esempio 01: Hello World & Server Base Node.js

## 📚 Obiettivi Didattici

Questo primo esempio introduce i concetti fondamentali di Node.js e serve come ponte tra la programmazione C++ e JavaScript, mantenendo focus sui principi della **programmazione ad oggetti**.

### Concetti Trattati:
- ✅ Creazione e gestione di un server HTTP
- ✅ Programmazione ad oggetti in JavaScript (classi, metodi, incapsulamento)
- ✅ Gestione asincrona delle richieste
- ✅ Routing e middleware pattern
- ✅ Gestione di diversi content-type (HTML, JSON)
- ✅ Error handling e best practices

---

## 🔄 Confronto C++ vs Node.js

| Aspetto | C++ | Node.js |
|---------|-----|---------|
| **Server Socket** | `socket()`, `bind()`, `listen()`, `accept()` | `http.createServer()` |
| **Gestione Richieste** | Thread/Fork per ogni connessione | Event Loop (single thread) |
| **Memory Management** | Manuale (`new`/`delete`) | Garbage Collection automatico |
| **Parsing HTTP** | Implementazione manuale | API native ad alto livello |
| **Concorrenza** | Multi-threading, Mutex | Asincrono con callback/Promise |

### Esempio Concettuale C++:
```cpp
// Approssimazione di quello che Node.js fa automaticamente
class WebServer {
private:
    int server_socket;
    struct sockaddr_in server_addr;
    
public:
    WebServer(int port) {
        server_socket = socket(AF_INET, SOCK_STREAM, 0);
        server_addr.sin_family = AF_INET;
        server_addr.sin_port = htons(port);
        // ... configurazione socket
    }
    
    void start() {
        bind(server_socket, ...);
        listen(server_socket, ...);
        // Loop infinito per accept() delle connessioni
    }
};
```

---

## 🏗️ Architettura del Codice

### Classe `WebServer`
La classe principale che incapsula tutta la logica del server, seguendo i principi OOP:

```javascript
class WebServer {
    constructor(port = 3000)     // Costruttore con parametro di default
    initializeRoutes()           // Inizializzazione delle route
    addRoute(path, handler)      // Aggiunta dinamica di route
    handleRequest(req, res)      // Gestione principale delle richieste
    start()                      // Avvio del server
    stop()                       // Chiusura graceful
}
```

### Incapsulamento
- **Proprietà private**: `port`, `routes`, `server`
- **Metodi pubblici**: `start()`, `stop()`, `addRoute()`
- **Metodi privati**: `handleHome()`, `handleHello()`, etc.

### Polimorfismo
Ogni handler è una funzione che rispetta la stessa interfaccia:
```javascript
handler(request, response) -> void
```

---

## 🌐 Route Implementate

### 1. Homepage (`/`)
- **Scopo**: Presentazione del server con link alle altre route
- **Tipo**: HTML statico con CSS inline
- **Concetto**: Template rendering base

### 2. Hello Route (`/hello`)
- **Scopo**: Gestione parametri query string
- **Funzionalità**: 
  - Personalizzazione del messaggio via `?name=`
  - Content negotiation (HTML vs JSON)
- **Esempio**: `/hello?name=Mario` → "Ciao Mario!"

### 3. API Info (`/api/info`)
- **Scopo**: Endpoint JSON per informazioni sistema
- **Dati restituiti**: versione Node.js, memoria, uptime, route disponibili
- **Concetto**: Serializzazione oggetti JavaScript → JSON

### 4. Time Route (`/time`)
- **Scopo**: Gestione date e formattazione locale
- **Funzionalità**: Mostra ora in diversi formati
- **Concetto**: Internazionalizzazione (i18n)

### 5. Demo Route (`/demo`)
- **Scopo**: Interazione client-side JavaScript
- **Funzionalità**: AJAX calls, DOM manipulation
- **Concetto**: Separazione client/server logic

---

## 🔧 Funzionalità Avanzate

### 1. Routing Dinamico
```javascript
this.routes = new Map(); // Struttura dati efficiente per le route
this.routes.set(path, handler); // O(1) lookup time
```

### 2. Error Handling
- Gestione 404 personalizzata
- Try-catch per errori nelle route
- Graceful shutdown con SIGTERM/SIGINT

### 3. HTTP Headers
```javascript
res.setHeader('Content-Type', contentType + '; charset=utf-8');
res.setHeader('X-Powered-By', 'Node.js Hello World Server');
```

### 4. Content Negotiation
```javascript
if (req.headers.accept && req.headers.accept.includes('application/json')) {
    // Restituisci JSON
} else {
    // Restituisci HTML
}
```

---

## 🚀 Come Eseguire

### Prerequisiti
- Node.js versione 16+ installato
- Container Docker con Node.js (se usi il setup docker-compose)

### Esecuzione
```bash
# Metodo 1: Direttamente
node server.js

# Metodo 2: Con npm (se hai package.json)
npm start

# Metodo 3: Con nodemon per auto-reload
npx nodemon server.js
```

### Test delle Route
```bash
# Homepage
curl http://localhost:3000/

# Hello con parametri
curl http://localhost:3000/hello?name=Studente

# API JSON
curl -H "Accept: application/json" http://localhost:3000/api/info

# Time
curl http://localhost:3000/time
```

---

## 💡 Concetti Chiave da Ricordare

### 1. **Event-Driven Architecture**
```javascript
// Node.js usa callback per gestire eventi asincroni
server.listen(port, () => {
    console.log('Server started!'); // Callback eseguito quando pronto
});
```

### 2. **Closure e Binding**
```javascript
this.addRoute('/', this.handleHome.bind(this));
// .bind(this) mantiene il contesto della classe
```

### 3. **Gestione Asincrona**
```javascript
// Non c'è bisogno di thread, tutto è event-based
this.handleRequest(req, res); // Non-blocking
```

### 4. **Modularità**
```javascript
const http = require('http'); // Sistema di moduli CommonJS
const url = require('url');   // Parsing URL integrato
```

---

## 📝 Domande di Autovalutazione

### Domande a Scelta Multipla

**1. Quale metodo HTTP viene usato di default per le richieste browser?**
- A) POST
- B) GET ✅
- C) PUT  
- D) DELETE

**2. In Node.js, qual è il vantaggio principale dell'Event Loop?**
- A) Usa meno memoria
- B) È più veloce del multi-threading
- C) Gestisce migliaia di connessioni concurrent senza blocking ✅
- D) È più semplice da programmare

**3. Cosa restituisce `JSON.stringify()` in JavaScript?**
- A) Un oggetto JavaScript
- B) Una stringa JSON ✅
- C) Un array
- D) Undefined

**4. Qual è la differenza principale tra `const` e `let` in JavaScript?**
- A) `const` è più veloce
- B) `const` non può essere riassegnata ✅
- C) `let` ha scope globale
- D) Non c'è differenza

**5. Cosa fa il metodo `.bind(this)` in JavaScript?**
- A) Crea una nuova funzione
- B) Cambia il valore di `this` nella funzione
- C) Mantiene il contesto dell'oggetto quando la funzione viene chiamata ✅
- D) Tutte le precedenti ✅

---

## 🎯 Prossimi Passi

### Esempio 02: Classi e Oggetti Avanzati
- Ereditarietà in JavaScript vs C++
- Costruttori e distruttori
- Metodi statici e istanza

### Esempio 03: File I/O e Gestione Errori
- Operazioni asincrone su file
- Promise e async/await
- Error handling patterns

### Progetto 01: API REST
- Express.js framework
- Middleware chain
- Database integration

---

## 📚 Risorse Aggiuntive

### Documentazione Ufficiale
- [Node.js HTTP Module](https://nodejs.org/api/http.html)
- [JavaScript Classes MDN](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Classes)

### Libri Consigliati
- "Node.js Design Patterns" - Mario Casciaro
- "You Don't Know JS" - Kyle Simpson

### Tool Utili
- **Postman**: Test API REST
- **Nodemon**: Auto-reload durante sviluppo  
- **VS Code**: Editor con ottimo supporto Node.js

---

## 🔗 Collegamenti ai Concetti C++

| Concetto JavaScript | Equivalente C++ | Note |
|---------------------|-----------------|-------|
| `class WebServer` | `class WebServer` | Sintassi molto simile |
| `constructor()` | Costruttore | JavaScript ha un solo costruttore |
| `this.property` | `this->property` | Accesso ai membri dell'istanza |
| `new WebServer()` | `new WebServer()` | Creazione istanze identica |
| `Map<string, function>` | `std::map<string, function*>` | Strutture dati simili |

---

*Questo esempio è parte del libro **"Programmazione ad Oggetti con C++"** - Sezione Node.js per confronti pratici tra linguaggi.*