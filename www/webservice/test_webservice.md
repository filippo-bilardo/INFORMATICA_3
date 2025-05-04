Di seguito sono riportate le pagine PHP di un sito web che gestisce il login, la registrazione e la modifica del profilo senza utilizzare JavaScript. Invece, si fa uso di richieste HTTP dirette (metodi `GET` e `POST`) per interagire con il webservice.

---

### Struttura del Sito

1. **index.php**: Pagina principale con collegamenti alle altre pagine.
2. **login.php**: Pagina per effettuare il login.
3. **register.php**: Pagina per registrare un nuovo utente.
4. **profile.php**: Pagina per visualizzare e modificare il profilo utente.
5. **logout.php**: Pagina per effettuare il logout.

---

### 1. `index.php`

```php
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <h1>Benvenuto sul nostro sito</h1>
    <a href="login.php">Login</a> | 
    <a href="register.php">Registra</a>
</body>
</html>
```

---

### 2. `login.php`

```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    // Invia una richiesta al webservice
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'webservice.php');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'action' => 'login',
        'userid' => $userid,
        'password' => $password
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if ($result['success']) {
        session_start();
        $_SESSION['userid'] = $userid;
        header('Location: profile.php');
        exit;
    } else {
        $error = 'Credenziali non valide';
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="userid">UserID:</label>
        <input type="text" id="userid" name="userid" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
    <p><a href="register.php">Non hai un account? Registra qui</a></p>
</body>
</html>
```

---

### 3. `register.php`

```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_POST['userid'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Invia una richiesta al webservice
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'webservice.php');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'action' => 'register',
        'userid' => $userid,
        'password' => $password,
        'email' => $email
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if ($result['success']) {
        header('Location: login.php');
        exit;
    } else {
        $error = 'Impossibile registrarti';
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registra</title>
</head>
<body>
    <h1>Registra</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="userid">UserID:</label>
        <input type="text" id="userid" name="userid" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit">Registra</button>
    </form>
    <p><a href="login.php">Hai già un account? Accedi qui</a></p>
</body>
</html>
```

---

### 4. `profile.php`

```php
<?php
session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit;
}

$userid = $_SESSION['userid'];
$password = ''; // La password verrà inviata al webservice

// Visualizza il profilo
function viewProfile($userid, $password) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'webservice.php');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'action' => 'view',
        'userid' => $userid,
        'password' => $password
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Aggiorna il profilo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newEmail = $_POST['newEmail'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'webservice.php');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'action' => 'update',
        'userid' => $userid,
        'password' => $password,
        'newEmail' => $newEmail
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if ($result['success']) {
        $message = 'Profilo aggiornato con successo';
    } else {
        $message = 'Impossibile aggiornare il profilo';
    }
}

$profile = viewProfile($userid, $password);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Profilo</title>
</head>
<body>
    <h1>Profilo</h1>
    <?php if (isset($message)): ?>
        <p style="color: green;"><?php echo $message; ?></p>
    <?php endif; ?>
    <?php if (isset($profile['success']) && $profile['success']): ?>
        <p><strong>UserID:</strong> <?php echo htmlspecialchars($profile['profile']['userid']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($profile['profile']['email']); ?></p>
    <?php else: ?>
        <p style="color: red;">Impossibile caricare il profilo</p>
    <?php endif; ?>

    <h2>Modifica Email</h2>
    <form method="POST" action="">
        <label for="newEmail">Nuova Email:</label>
        <input type="email" id="newEmail" name="newEmail" required><br><br>

        <button type="submit">Aggiorna Email</button>
    </form>

    <p><a href="logout.php">Logout</a></p>
</body>
</html>
```

---

### 5. `logout.php`

```php
<?php
session_start();
session_destroy();
header('Location: login.php');
exit;
?>
```

---

### Spiegazione delle Pagine

1. **`index.php`**:
   - Pagina principale che offre i collegamenti per accedere alla pagina di login e registrazione.

2. **`login.php`**:
   - Form per effettuare il login. Utilizza cURL per inviare i dati al webservice e memorizza l'ID utente nella sessione dopo il login.

3. **`register.php`**:
   - Form per registrare un nuovo utente. Utilizza cURL per inviare i dati al webservice.

4. **`profile.php`**:
   - Visualizza il profilo dell'utente corrente e consente di aggiornare l'email. Richiede che l'utente sia autenticato tramite sessione. Utilizza cURL per comunicare con il webservice.

5. **`logout.php`**:
   - Elimina la sessione dell'utente e reindirizza alla pagina di login.

---

### Funzionamento Generale

1. L'utente accede al sito tramite `index.php`.
2. Può scegliere di effettuare il login (`login.php`) o registrarsi (`register.php`).
3. Dopo il login, viene reindirizzato a `profile.php`, dove può visualizzare e modificare il proprio profilo.
4. Per uscire, l'utente può cliccare su "Logout", che elimina la sessione e lo reindirizza alla pagina di login.

Queste pagine dimostrano come è possibile implementare un sistema di autenticazione e gestione del profilo senza l'utilizzo di JavaScript, affidandosi esclusivamente a PHP e cURL per le comunicazioni con il webservice.