// ===============================================
// ESEMPIO 01: Hello World & Server Base Node.js
// ===============================================
// 
// Questo esempio introduce i concetti fondamentali di Node.js:
// - Creazione di un server HTTP
// - Gestione delle richieste
// - Routing base
// - Moduli Node.js
//
// Confronto con C++: 
// - In C++ useresti socket TCP/IP nativi
// - Node.js fornisce API ad alto livello
// - Gestione asincrona vs sincrona

// Importazione del modulo HTTP nativo di Node.js
const http = require('http');
const url = require('url');

// ===============================================
// CLASSE SERVER (Approccio Object-Oriented)
// ===============================================
class WebServer {
    constructor(port = 3000) {
        this.port = port;
        this.routes = new Map(); // Mappa per gestire le route
        this.server = null;
        
        // Inizializza le route predefinite
        this.initializeRoutes();
    }
    
    // Metodo per inizializzare le route di base
    initializeRoutes() {
        this.addRoute('/', this.handleHome.bind(this));
        this.addRoute('/hello', this.handleHello.bind(this));
        this.addRoute('/api/info', this.handleApiInfo.bind(this));
        this.addRoute('/time', this.handleTime.bind(this));
    }
    
    // Metodo per aggiungere una nuova route
    addRoute(path, handler) {
        this.routes.set(path, handler);
        console.log(`✅ Route aggiunta: ${path}`);
    }
    
    // Handler per la homepage
    handleHome(req, res) {
        const html = `
        <!DOCTYPE html>
        <html lang="it">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Node.js Hello World</title>
            <style>
                body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
                .container { background: #f5f5f5; padding: 30px; border-radius: 10px; }
                h1 { color: #2c3e50; }
                .link { display: block; margin: 10px 0; color: #3498db; text-decoration: none; }
                .link:hover { text-decoration: underline; }
                .code { background: #2c3e50; color: #ecf0f1; padding: 15px; border-radius: 5px; margin: 10px 0; }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>🚀 Benvenuto nel primo esempio Node.js!</h1>
                <p><strong>Server attivo sulla porta ${this.port}</strong></p>
                
                <h3>Route disponibili:</h3>
                <a href="/hello" class="link">📝 /hello - Messaggio di saluto</a>
                <a href="/api/info" class="link">📊 /api/info - Informazioni server (JSON)</a>
                <a href="/time" class="link">⏰ /time - Ora corrente</a>
                
                <h3>Concetti dimostrati:</h3>
                <ul>
                    <li>✅ Creazione server HTTP</li>
                    <li>✅ Routing delle richieste</li>
                    <li>✅ Gestione di diversi content-type</li>
                    <li>✅ Programmazione ad oggetti in JavaScript</li>
                </ul>
                
                <div class="code">
                    <strong>Equivalente C++ (concettuale):</strong><br>
                    // In C++ dovresti gestire socket TCP/IP manualmente<br>
                    // socket(), bind(), listen(), accept()<br>
                    // Node.js astrae questa complessità
                </div>
            </div>
        </body>
        </html>`;
        
        this.sendResponse(res, html, 'text/html');
    }
    
    // Handler per la route hello
    handleHello(req, res) {
        const queryObject = url.parse(req.url, true).query;
        const name = queryObject.name || 'Mondo';
        
        const response = {
            message: `Ciao ${name}!`,
            timestamp: new Date().toISOString(),
            method: req.method,
            userAgent: req.headers['user-agent'] || 'Unknown'
        };
        
        // Verifica se è richiesta JSON
        if (req.headers.accept && req.headers.accept.includes('application/json')) {
            this.sendResponse(res, JSON.stringify(response, null, 2), 'application/json');
        } else {
            const html = `
            <!DOCTYPE html>
            <html lang="it">
            <head>
                <meta charset="UTF-8">
                <title>Hello ${name}</title>
                <style>body { font-family: Arial, sans-serif; text-align: center; margin-top: 100px; }</style>
            </head>
            <body>
                <h1>👋 ${response.message}</h1>
                <p>Timestamp: ${response.timestamp}</p>
                <p>User Agent: ${response.userAgent}</p>
                <a href="/">🏠 Torna alla home</a>
                <br><br>
                <small>Prova: <a href="/hello?name=TuoNome">/hello?name=TuoNome</a></small>
            </body>
            </html>`;
            this.sendResponse(res, html, 'text/html');
        }
    }
    
    // Handler per API info (JSON)
    handleApiInfo(req, res) {
        const serverInfo = {
            name: 'Node.js Hello World Server',
            version: '1.0.0',
            author: 'Docente Informatica',
            nodeVersion: process.version,
            platform: process.platform,
            uptime: process.uptime(),
            memory: process.memoryUsage(),
            routes: Array.from(this.routes.keys()),
            timestamp: new Date().toISOString()
        };
        
        this.sendResponse(res, JSON.stringify(serverInfo, null, 2), 'application/json');
    }
    
    // Handler per l'ora corrente
    handleTime(req, res) {
        const now = new Date();
        const timeInfo = {
            iso: now.toISOString(),
            locale: now.toLocaleString('it-IT'),
            timestamp: now.getTime(),
            timezone: Intl.DateTimeFormat().resolvedOptions().timeZone
        };
        
        const html = `
        <!DOCTYPE html>
        <html lang="it">
        <head>
            <meta charset="UTF-8">
            <title>Ora Corrente</title>
            <style>
                body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
                .time { font-size: 2em; color: #2c3e50; margin: 20px 0; }
                .info { background: #ecf0f1; padding: 20px; border-radius: 10px; margin: 20px; }
            </style>
        </head>
        <body>
            <h1>⏰ Ora Corrente</h1>
            <div class="time">${timeInfo.locale}</div>
            <div class="info">
                <p><strong>ISO:</strong> ${timeInfo.iso}</p>
                <p><strong>Timestamp:</strong> ${timeInfo.timestamp}</p>
                <p><strong>Timezone:</strong> ${timeInfo.timezone}</p>
            </div>
            <a href="/">🏠 Torna alla home</a>
        </body>
        </html>`;
        
        this.sendResponse(res, html, 'text/html');
    }
    
    // Handler per route non trovate (404)
    handle404(req, res) {
        const html = `
        <!DOCTYPE html>
        <html lang="it">
        <head>
            <meta charset="UTF-8">
            <title>404 - Pagina Non Trovata</title>
            <style>
                body { font-family: Arial, sans-serif; text-align: center; margin-top: 100px; }
                .error { color: #e74c3c; font-size: 3em; }
            </style>
        </head>
        <body>
            <div class="error">404</div>
            <h2>Pagina Non Trovata</h2>
            <p>La route <strong>${req.url}</strong> non esiste.</p>
            <a href="/">🏠 Torna alla home</a>
        </body>
        </html>`;
        
        res.statusCode = 404;
        this.sendResponse(res, html, 'text/html');
    }
    
    // Metodo helper per inviare risposte
    sendResponse(res, content, contentType = 'text/html') {
        res.setHeader('Content-Type', contentType + '; charset=utf-8');
        res.setHeader('X-Powered-By', 'Node.js Hello World Server');
        res.end(content);
    }
    
    // Metodo principale per gestire le richieste
    handleRequest(req, res) {
        const parsedUrl = url.parse(req.url);
        const path = parsedUrl.pathname;
        
        console.log(`📋 ${new Date().toISOString()} - ${req.method} ${path}`);
        
        // Cerca la route nella mappa
        if (this.routes.has(path)) {
            try {
                this.routes.get(path)(req, res);
            } catch (error) {
                console.error('❌ Errore nella route:', error);
                res.statusCode = 500;
                this.sendResponse(res, 'Errore interno del server', 'text/plain');
            }
        } else {
            this.handle404(req, res);
        }
    }
    
    // Metodo per avviare il server
    start() {
        this.server = http.createServer((req, res) => {
            this.handleRequest(req, res);
        });
        
        this.server.listen(this.port, () => {
            console.log('🚀 =====================================');
            console.log(`🌐 Server Node.js attivo!`);
            console.log(`📡 Porta: ${this.port}`);
            console.log(`🔗 URL: http://localhost:${this.port}`);
            console.log('🚀 =====================================');
            console.log('\n📋 Route disponibili:');
            this.routes.forEach((handler, path) => {
                console.log(`   👉 http://localhost:${this.port}${path}`);
            });
            console.log('\n⏹️  Premi Ctrl+C per fermare il server\n');
        });
        
        // Gestione chiusura graceful
        process.on('SIGTERM', () => this.stop());
        process.on('SIGINT', () => this.stop());
    }
    
    // Metodo per fermare il server
    stop() {
        console.log('\n🛑 Chiusura del server in corso...');
        if (this.server) {
            this.server.close(() => {
                console.log('✅ Server chiuso correttamente');
                process.exit(0);
            });
        }
    }
}

// ===============================================
// AVVIO DEL SERVER
// ===============================================

// Creazione dell'istanza del server
const webServer = new WebServer(3000);

// Aggiunta di una route personalizzata per dimostrare l'estensibilità
webServer.addRoute('/demo', (req, res) => {
    const html = `
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>Demo Interattiva</title>
        <style>
            body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
            .demo { background: #3498db; color: white; padding: 20px; border-radius: 10px; margin: 20px 0; }
            button { background: #2ecc71; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
            button:hover { background: #27ae60; }
        </style>
        <script>
            function showAlert() {
                alert('Ciao dal client JavaScript!\\nQuesta è l\'interazione client-server.');
            }
            
            function fetchData() {
                fetch('/api/info')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('apiData').innerHTML = 
                            '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
                    })
                    .catch(error => console.error('Errore:', error));
            }
        </script>
    </head>
    <body>
        <h1>🎯 Demo Interattiva</h1>
        <div class="demo">
            <h3>Test delle funzionalità:</h3>
            <button onclick="showAlert()">Test Alert</button>
            <button onclick="fetchData()">Carica Dati API</button>
        </div>
        <div id="apiData"></div>
        <a href="/">🏠 Torna alla home</a>
    </body>
    </html>`;
    
    webServer.sendResponse(res, html, 'text/html');
});

// Avvio del server
webServer.start();

// ===============================================
// ESERCIZI PROPOSTI:
// ===============================================
/*
1. 📝 ESERCIZIO BASE:
   Aggiungi una nuova route '/studenti' che restituisce un elenco di studenti in formato JSON

2. 🔧 ESERCIZIO INTERMEDIO:
   Implementa una route '/calc/:operazione/:a/:b' per fare calcoli matematici
   Esempio: /calc/sum/5/3 dovrebbe restituire {"result": 8}

3. 🚀 ESERCIZIO AVANZATO:
   Crea un sistema di logging che salva tutte le richieste in un file
   Utilizza il modulo 'fs' per la scrittura su file

4. 💡 SFIDA:
   Confronta questo codice con un equivalente in C++
   Quali sono le principali differenze architetturali?

RISPOSTE NEGLI ESEMPI SUCCESSIVI! 📚
*/