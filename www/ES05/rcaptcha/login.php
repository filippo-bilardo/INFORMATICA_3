<?php
// Configurazione
require_once 'passwords.env'; // Include il file delle password

$redirectError = "index.php?error=";

// Verifica se il campo g-recaptcha-response è presente
if (!isset($_POST['g-recaptcha-response'])) {
    echo "<h2>Errore: reCAPTCHA non completato.</h2>";
}

// Dati del modulo
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Verifica la risposta di reCAPTCHA
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'secret' => $secretKey,
    'response' => $_POST['g-recaptcha-response'],
    'remoteip' => $_SERVER['REMOTE_ADDR']
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if ($result['success']) {
    // Validazione riuscita: elabora i dati (es. invia email)
    echo "<h2>Grazie per aver inviato il modulo!</h2>";
    echo "<p>Username: $username</p>";
    echo "<p>Password: $password</p>";

    echo "<br/><br/>" . $response;
} else {
    // Errore nella validazione
    //header("Location: " . $redirectError . urlencode("hCaptcha non valido. Riprova."));
    //exit;
    echo "<h2>Errore: hCaptcha non valido. Riprova.</h2>";
    echo "<br/><br/>" . $response;
}
?>