<!-- http://204.216.213.176/inf3php/ES03/es_string_escape.php -->
<?php
//Esempio di stringa con escape
$nome = "O'Conner"; 
echo "Nome: $nome <br>";

//Esempio di stringa con escape
$nome = 'O\'Conner';
echo "Nome: $nome <br>";

//Esempio di stringa con escape
$nome = "frase \"Ciao mondo\"";
//$nome = 'frase "Ciao mondo"';
echo "Nome: $nome <br>";

//Altri caratteri di escape
$nome = "frase con carattere di escape \\"; 
echo "Nome: $nome <br>";

$nome = "frase con carattere di escape \n";
echo "Nome: $nome <br>";

$nome = "frase con carattere di escape \t";
echo "Nome: $nome <br>";

$nome = "frase con carattere di escape \r";
echo "Nome: $nome <br>";

$nome = "frase con carattere di escape \v";
echo "Nome: $nome <br>";

$nome = "frase con carattere di escape \f";
echo "Nome: $nome <br>";

$nome = "frase con carattere di escape \b";
echo "Nome: $nome <br>";

$nome = "frase con carattere di escape \a";
echo "Nome: $nome <br>";

$nome = "frase con carattere di escape \e";
echo "Nome: $nome <br>";

$nome = "frase con carattere di escape \0";
echo "Nome: $nome <br>";

$nome = "frase con carattere di escape \x00";
echo "Nome: $nome <br>";

//esempio senza escape
echo "<table border='1'>";
for ($i = 0; $i < 5; $i++) {
  echo "<tr>";
  for ($j = 0; $j < 5; $j++) {
    echo "<td>$i$j</td>";
  }
  echo "</tr>";
}
echo "<br /><br />";


//Stampiamo una tabella html 5x5 e usiamo
//il carattere di escape \t per separare le celle
//e il carattere di escape \n per andare a capo
echo "\n\n\n<table border='1'>";
for ($i = 0; $i < 5; $i++) {
  echo "<tr>";
  for ($j = 0; $j < 5; $j++) {
    echo "<td>\t$i$j</td>";
  }
  echo "</tr>\n";
}
echo "</table>";





?>
