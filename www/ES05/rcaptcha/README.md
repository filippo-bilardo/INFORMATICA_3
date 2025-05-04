Implementare un sistema **CAPTCHA** nel tuo sito PHP è una buona pratica per prevenire l'invio automatico di form da parte di bot. Esistono diverse opzioni, ma una delle più comuni e semplici è l'uso di **Google reCAPTCHA**.

Ecco come puoi implementarlo passo dopo passo:

---

## ✅ 1. Registrati su Google reCAPTCHA

Vai al sito:  
👉 [https://www.google.com/recaptcha/admin](https://www.google.com/recaptcha/admin)

- Accedi con il tuo account Google.
- Crea un nuovo sito:
  - Scegli la versione (ad esempio **reCAPTCHA v2 - Checkbox**).
  - Inserisci i domini del tuo sito (es. `tuo-sito.it`).
  - Genera le chiavi: otterrai una **chiave del sito (site key)** e una **chiave segreta (secret key)**.

---

## 📄 2. Aggiungi il CAPTCHA nella tua pagina HTML/PHP

Nel form in cui vuoi mostrare il CAPTCHA (es. un form di registrazione o contatto), aggiungi il codice seguente:

```html
<!-- Nel <head> della pagina -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!-- Nel form -->
<form method="POST" action="verifica_captcha.php">
    <!-- Altri campi del form -->
    
    <div class="g-recaptcha" data-sitekey="LA_TUA_SITE_KEY"></div>
    
    <br/>
    <button type="submit">Invia</button>
</form>
```

Sostituisci `"LA_TUA_SITE_KEY"` con la chiave che hai ricevuto da Google.

---

## 🔐 3. Verifica il CAPTCHA sul server (PHP)

Crea un file PHP (es. `verifica_captcha.php`) per verificare la risposta del CAPTCHA inviata dal browser.

```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recupera la risposta del captcha
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $remote_ip = $_SERVER['REMOTE_ADDR'];

    // Parametri per la richiesta POST a Google
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => 'LA_TUA_SECRET_KEY',
        'response' => $recaptcha_response,
        'remoteip' => $remote_ip
    ];

    // Configura la richiesta
    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $json = json_decode($result, true);

    if ($json['success']) {
        echo "CAPTCHA verificato correttamente! Puoi procedere.";
        // Procedi con l'elaborazione del form
    } else {
        echo "Errore: devi completare il CAPTCHA.";
    }
}
?>
```

Sostituisci `"LA_TUA_SECRET_KEY"` con la chiave segreta fornita da Google.

---

## ✅ 4. Sicurezza extra (opzionale)

- Non mostrare mai la secret key pubblicamente.
- Usa HTTPS per proteggere i dati trasmessi.
- Considera l’uso di reCAPTCHA v3 se preferisci un sistema invisibile.

---

## 💡 Alternative a reCAPTCHA

Se non vuoi usare Google, ci sono altre opzioni:

- [hCaptcha](https://www.hcaptcha.com/)
- [Cloudflare Turnstile](https://www.cloudflare.com/products/turnstile/)
- CAPTCHA personalizzato con immagini o testo (richiede più lavoro manuale)

---

Vuoi un esempio completo di un form funzionante con reCAPTCHA? Posso aiutarti a crearlo!

---

Ecco un **esempio completo e funzionante** di un form PHP con integrazione di **Google reCAPTCHA v2 (checkbox)**.

---

## 🧩 Struttura del progetto

```
/htdocs/
│
├── index.php       ← Il form HTML con reCAPTCHA
└── invia.php       ← Elabora i dati e verifica il CAPTCHA
```

---

## 🔑 Prerequisiti

- Devi aver registrato il tuo sito su [https://www.google.com/recaptcha/admin](https://www.google.com/recaptcha/admin) per ottenere:
  - `SITE_KEY` → da usare in `index.php`
  - `SECRET_KEY` → da usare in `invia.php`

Sostituisci `"TUO_SITE_KEY"` e `"TUO_SECRET_KEY"` nei file sotto.

---

## 📄 1. `index.php` – Form con reCAPTCHA

```php
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Form con reCAPTCHA</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <h2>Contattaci</h2>

    <?php if (isset($_GET['errore'])): ?>
        <p style="color:red;"><?= htmlspecialchars($_GET['errore']) ?></p>
    <?php endif; ?>

    <form action="invia.php" method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Messaggio:</label><br>
        <textarea name="messaggio" required></textarea><br><br>

        <!-- reCAPTCHA -->
        <div class="g-recaptcha" data-sitekey="TUO_SITE_KEY"></div><br>

        <button type="submit">Invia</button>
    </form>
</body>
</html>
```

---

## 🔐 2. `invia.php` – Verifica il CAPTCHA e gestisce l’invio

```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = htmlspecialchars($_POST['nome']);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $messaggio = htmlspecialchars($_POST['messaggio']);
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $remote_ip = $_SERVER['REMOTE_ADDR'];

    // Validazione base dei campi
    if (!$email || empty($nome) || empty($messaggio)) {
        header("Location: index.php?errore=Campi+non+validi");
        exit;
    }

    // Parametri Google reCAPTCHA
    $secret_key = "TUO_SECRET_KEY";
    $url = "https://www.google.com/recaptcha/api/siteverify";

    // Dati per la richiesta POST
    $data = [
        'secret' => $secret_key,
        'response' => $recaptcha_response,
        'remoteip' => $remote_ip
    ];

    // Configurazione contesto HTTP
    $options = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        header("Location: index.php?errore=Errore+nella+comunicazione+con+Google");
        exit;
    }

    $json = json_decode($result, true);

    if ($json['success']) {
        // Qui puoi inviare una email o salvare i dati nel database
        echo "<h2>Grazie per averci contattato!</h2>";
        echo "<p><strong>Nome:</strong> $nome</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Messaggio:</strong> $messaggio</p>";
    } else {
        header("Location: index.php?errore=Devi+completare+il+CAPTCHA");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>
```

---

## ✅ Risultato Finale

Quando l'utente compila correttamente il form e completa il CAPTCHA, vedrà un messaggio tipo:

```
Grazie per averci contattato!
Nome: Mario Rossi
Email: mario@example.com
Messaggio: Ciao, vorrei informazioni...
```

Se non completa il CAPTCHA o inserisce dati non validi, verrà reindirizzato alla pagina principale con un messaggio di errore.

---

## 🛡️ Sicurezza & Consigli

- Usa sempre HTTPS per proteggere le comunicazioni.
- Valida e filtra sempre i dati in ingresso (`htmlspecialchars`, `filter_var`, ecc.).
- Per produzione, considera l'uso di una libreria HTTP (come Guzzle) invece di `file_get_contents`.

---

Vuoi che ti mostri anche come inviare una email dopo la verifica del CAPTCHA o come integrare una versione invisibile (reCAPTCHA v3)? Posso aiutarti!