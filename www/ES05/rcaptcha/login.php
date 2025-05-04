<?php
// Configurazione
$siteKey = "6LcSJi4rAAAAAI9NP1b1ANOrBEnR2gwkuCwVPhCp";
$secretKey = "6LcSJi4rAAAAAF_EYVbnl3tvHCQdhAp0A-qjFEri";
$redirectError = "index.php?error=";

// Verifica se il campo g-recaptcha-response è presente
if (!isset($_POST['g-recaptcha-response'])) {
    header("Location: " . $redirectError . urlencode("reCAPTCHA non completato."));
    exit;
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
    // Esempio di autenticazione semplice (da sostituire con controllo su database)
    $user_demo = 'utente';
    $pass_demo = 'password123';
    if ($username === $user_demo && $password === $pass_demo) {
        echo "<h2>Login riuscito!</h2>";
        echo "<p>Benvenuto, $username</p>";
    } else {
        header("Location: " . $redirectError . urlencode("Credenziali non valide."));
        exit;
    }
} else {
    header("Location: " . $redirectError . urlencode("reCAPTCHA non valido. Riprova."));
    exit;
}
?>