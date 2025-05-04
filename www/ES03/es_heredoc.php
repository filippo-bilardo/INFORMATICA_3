<!-- http://204.216.213.176/inf3php/ES03/es_heredoc.php -->
<?php
$form = <<<FORM
<form method="post">
  <label for="nome">Nome:</label><input type="text" id="nome" name="nome"><br>
  <label for="cognome">Cognome:</label><input type="text" id="cognome" name="cognome"><br>
  <label for="email">Email:</label><input type="email" id="email" name="email"><br>
  <input type="submit" value="Invia">
</form>
FORM;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'];
  $cognome = $_POST['cognome'];
  $email = $_POST['email'];
  $stringa = <<<TESTO
    I dati inseriti nel form sono: <br/>
    Nome e Cognome: $nome $cognome <br/>
    Email: $email
  TESTO;
  $html = $stringa;
} else {
  $html = $form;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>es_heredoc</title>
</head>
<body>
  <?=$html ?>
</body>
</html>
