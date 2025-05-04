<?php
// http://204.216.213.176/inf3php/ES01/var_global.php
// Variabili globali e superglobali

// Avvio della sessione per accedere a $_SESSION
session_start();

// Impostiamo alcune variabili di esempio per $_SESSION e $_COOKIE
$_SESSION['user'] = 'JohnDoe';
$_COOKIE['user_preference'] = 'dark_mode';

// Variabile superglobale $_GET (dati dalla query string)
// Esempio: accedendo a questa pagina con "?name=Mario&age=30", $_GET conterrà questi dati

// Variabile superglobale $_POST (dati inviati tramite metodo POST)
// Dobbiamo creare un modulo per dimostrare $_POST

// Variabile superglobale $_SERVER (contiene informazioni sul server e sull'ambiente)

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variabili Globali e Superglobali</title>
</head>
<body>
    <h1>Visualizzazione delle Variabili Globali e Superglobali</h1>

    <h2>$_GET</h2>
    <pre><?php print_r($_GET); ?></pre>

    <h2>$_POST</h2>
    <form method="POST" action="">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name">
        <label for="age">Età:</label>
        <input type="text" id="age" name="age">
        <input type="submit" value="Invia">
    </form>
    <pre><?php print_r($_POST); ?></pre>

    <h2>$_SESSION</h2>
    <pre><?php print_r($_SESSION); ?></pre>

    <h2>$_COOKIE</h2>
    <pre><?php print_r($_COOKIE); ?></pre>

    <h2>$_SERVER</h2>
    <pre><?php print_r($_SERVER); ?></pre>

    <h2>$GLOBALS</h2>
    <pre><?php print_r($GLOBALS); ?></pre>
</body>
</html>
