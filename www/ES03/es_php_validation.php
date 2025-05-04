<!DOCTYPE html>
<html>
  <head>
    <title>Example Form</title>
  </head>
  <body>
    <h1>Example Form</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required><br><br>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required><br><br>
      <input type="submit" value="Submit">
    </form>
    <?php
      // Verifica che il form sia stato inviato
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Rimuove eventuali spazi superflui dai dati inseriti dall'utente
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);

        // Verifica che i dati obbligatori siano stati inseriti dall'utente
        if (empty($name)) {
          $name_error = "Il nome è obbligatorio";
        }

        // Verifica che l'indirizzo email sia valido
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $email_error = "L'indirizzo email non è valido";
        }

        // Verifica che i dati inseriti siano sicuri
        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);

        // Stampa i dati inseriti dall'utente
        echo "<h2>Dati inseriti:</h2>";
        echo "Nome: " . $name . "<br>";
        echo "Email: " . $email . "<br>";
      }
    ?>
  </body>
</html>