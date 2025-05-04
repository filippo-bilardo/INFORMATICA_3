<!-- http://204.216.213.176/inf3php/ES03/es_postback.php -->
<?php

$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$retval = isset($_POST['nome']);
echo "retval: " . (string)$retval . "<br>";

echo $_SERVER['REQUEST_METHOD'] . "<br>";
echo "Nome: " . $nome . "Cognome: " . $cognome . "<br>";


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
  echo $stringa;
} else {
  echo $form;
}
?>
