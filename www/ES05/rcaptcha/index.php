<!-- http://fblabs.ddns.net/inf3php/ES05/rcaptcha/ -->
<?php
require_once 'passwords.env'; // Include il file delle password

$msg_error = $_GET['error'] ?? '';

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login con reCAPTCHA</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <h2>Login Utente</h2>
    <?php if ($msg_error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($msg_error); ?></p>
    <?php endif; ?>
    <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <div class="g-recaptcha" data-sitekey="<?=$siteKey ?>"></div>
        <br/>
        <button type="submit">Accedi</button>
    </form>
</body>
</html>