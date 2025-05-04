<?php
// Configurazione
$secretKey = "5388ecce-dc88-4f1e-91aa-a26a5ffcf66e";
$redirectError = "index.php?error=";

// Verifica se il campo h-captcha-response è presente
if (!isset($_POST['h-captcha-response'])) {
    //header("Location: " . $redirectError . urlencode("hCaptcha non completato."));
    //exit;
    echo "<h2>Errore: hCaptcha non completato.</h2>";
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
    echo "<p>hCaptcha ID: " . htmlspecialchars($result['challenge']) . "</p>";
    echo "<br/><br/>" . $response;
} else {
    // Errore nella validazione
    //header("Location: " . $redirectError . urlencode("hCaptcha non valido. Riprova."));
    //exit;
    echo "<h2>Errore: hCaptcha non valido. Riprova.</h2>";
    echo "<br/><br/>" . $response;
}
?>