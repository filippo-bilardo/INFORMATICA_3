# Guida Dettagliata per Utilizzare **hCaptcha con PHP**

---

## **1. Introduzione**
**hCaptcha** è un'alternativa a Google reCAPTCHA, utilizzata per proteggere i form web da bot e spam. Questa guida spiega come integrare **hCaptcha** in un modulo PHP, verificando la risposta dell'utente tramite l'API server-side.

---

## **2. Prerequisiti**
1. Un account su [hCaptcha](https://www.hcaptcha.com/) per ottenere:
   - **Site Key**: Chiave pubblica per il frontend.
   - **Secret Key**: Chiave privata per il backend.
2. Un server PHP configurato (es. XAMPP, WAMP, o hosting online).
3. Connessione HTTPS per la sicurezza (richiesto da hCaptcha).

---

## **3. Passaggi per l'Integrazione**

### **3.1 Creare il Form HTML con hCaptcha**
Aggiungi il widget hCaptcha al tuo modulo HTML usando il tag `<div>` con classe `h-captcha` e attributo `data-sitekey`.

#### **Codice HTML (`index.html`)**
```html
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modulo con hCaptcha</title>
    <script src="https://hcaptcha.com/1/api.js" async defer></script>
</head>
<body>
    <h2>Modulo di Contatto</h2>
    <form action="submit.php" method="POST">
        <label for="name">Nome:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Messaggio:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>

        <!-- Widget hCaptcha -->
        <div class="h-captcha" data-sitekey="YOUR_SITE_KEY"></div><br>

        <button type="submit">Invia</button>
    </form>
</body>
</html>
```

---

### **3.2 Verifica la Risposta con PHP**
Nel file PHP (`submit.php`), verifica la risposta dell'utente inviando una richiesta POST all'API di hCaptcha.

#### **Codice PHP (`submit.php`)**
```php
<?php
// Configurazione
$secretKey = "YOUR_SECRET_KEY"; // Sostituisci con la tua Secret Key
$redirectError = "index.html?error=";

// Verifica se il campo h-captcha-response è presente
if (!isset($_POST['h-captcha-response'])) {
    header("Location: " . $redirectError . urlencode("hCaptcha non completato."));
    exit;
}

// Dati del modulo
$name = htmlspecialchars($_POST['name']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$message = htmlspecialchars($_POST['message']);

// Verifica la risposta di hCaptcha
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://hcaptcha.com/siteverify");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'secret' => $secretKey,
    'response' => $_POST['h-captcha-response'],
    'remoteip' => $_SERVER['REMOTE_ADDR']
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if ($result['success']) {
    // Validazione riuscita: elabora i dati (es. invia email)
    echo "<h2>Grazie per aver inviato il modulo!</h2>";
    echo "<p>Nome: $name</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Messaggio: $message</p>";
} else {
    // Errore nella validazione
    header("Location: " . $redirectError . urlencode("hCaptcha non valido. Riprova."));
    exit;
}
?>
```

---

## **4. Come Funziona**
1. **Frontend (HTML)**:
   - L'utente completa il modulo e risolve hCaptcha.
   - Il campo nascosto `h-captcha-response` viene popolato con un token.
2. **Backend (PHP)**:
   - Il server invia il token a `https://hcaptcha.com/siteverify` tramite cURL.
   - La risposta JSON contiene `"success": true` se la validazione è riuscita.

---

## **5. Risultati Possibili**
- **Successo**: Mostra i dati del modulo.
- **Errore**:
  - `hCaptcha non completato`: Campo mancante.
  - `hCaptcha non valido`: Token scaduto o non riconosciuto.

---

## **6. Sicurezza**
- **Nascondi la Secret Key**: Non esporla mai nel frontend.
- **HTTPS**: Usa sempre HTTPS per proteggere i dati sensibili.
- **Validazione Input**: Filtra email e testo per prevenire attacchi (XSS/SQL injection).

---

## **7. Test**
1. Carica i file su un server web.
2. Compila il modulo e completa hCaptcha.
3. Se tutto funziona, vedrai i dati inviati. Altrimenti, riceverai un messaggio di errore.

---

## **8. Estensioni Possibili**
- **Invio Email**: Usa `mail()` o PHPMailer per inviare il messaggio.
- **Database**: Salva i dati in un database (es. MySQL) con mysqli o PDO.
- **Log degli Errori**: Registra gli errori di validazione per analisi.

