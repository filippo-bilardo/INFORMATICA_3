<!--
  http://204.216.213.176/inf3php/ES01/es01_var.php
-->
<?php

define('TEST_CONSTANT', 123);
$aFloat = 1.23;
$anInt = 123;
$aString = '123';
$anEmptyString = '';
$aVeryLongString = str_repeat('lol', 1000);
$aBoolean = true;
$nullValue = null;
$variableThatsNotSet;
$miavar; $_ENV; $var34;

echo "<h1>Helloooo! Prove con variabili e costanti</h1><br>";
echo "define('TEST_CONSTANT', 123) -> " . TEST_CONSTANT . "<br><br>";
$anInt += TEST_CONSTANT;
echo "\$anInt += TEST_CONSTANT -> $anInt<br><br>";

echo "\$aFloat + \$anInt -> ";
echo $aFloat + $anInt;
echo "<br><br>";
echo "\$aFloat . \$anInt = " . $aFloat . $anInt . "<br><br>";

echo "<br>"; $a="10"; $b=20; echo $a . $b;
echo "<br>"; $c="Ciao"; $d=20; echo $c . $d;
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
$nome="Mario";
$cogn="Rossi";
echo "Cioa $nome       $cogn";
echo "<br>";
echo 'Cioa $nome       $cogn';

exit;