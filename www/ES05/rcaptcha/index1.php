<!-- http://fblabs.ddns.net/inf3php/ES05/rcaptcha/ -->
<?php
// Recupero l'eventuale messaggio di errore passato tramite GET
$msg_error = $_GET['error'] ?? '';
$secretKey = "6Le-wy0rAAAAALqSCJGeQOBAFrLmJVJrzrZl8ABz"; //
$siteKey = "6Le-wy0rAAAAAHHvM0OoL-LIpOw7UkX8GK9G0I05";
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modulo con hCaptcha</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <h2>Modulo di Contatto</h2>
    <?php if ($msg_error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($msg_error); ?></p>
    <?php endif; ?>
    <form method="POST" action="verifica_captcha.php">
        <!-- Altri campi del form -->
        <div class="g-recaptcha" data-sitekey="<?=$siteKey ?>"></div>
        <br/>
        <button type="submit">Invia</button>
    </form>
</body>
</html>