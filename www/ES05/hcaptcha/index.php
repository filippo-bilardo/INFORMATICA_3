<!-- http://fblabs.ddns.net/inf3php/ES05/hcaptcha/ -->
<?php
// Recupero l'eventuale messaggio di errore passato tramite GET
$msg_error = $_GET['error'] ?? '';
$secretKey = "5388ecce-dc88-4f1e-91aa-a26a5ffcf66e";
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modulo con hCaptcha</title>
    <script src="https://hcaptcha.com/1/api.js" async defer></script>
</head>
<body>
    <h2>Modulo di Contatto</h2>
    <?php if ($msg_error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($msg_error); ?></p>
    <?php endif; ?>
    <form action="submit.php" method="POST">
        <label for="name">Nome:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Messaggio:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>

        <!-- Widget hCaptcha -->
        <div class="h-captcha" data-sitekey="<?=$secretKey ?>"></div><br>

        <button type="submit">Invia</button>
    </form>
</body>
</html>