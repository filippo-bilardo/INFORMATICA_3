<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funzioni per lavorare con le variabili in PHP</title>
</head>
<body>
    <h1>Funzioni per il controllo delle variabili in PHP</h1>

    <?php
    // Variabili di esempio
    $a = "ciao";
    $b = "";
    $c = null;
    $d = array(1, 2, 3);
    $e = true;
    $f = 42;
    $g = 3.14;
    $h = "PHP";
    $i = new stdClass();
    $file = fopen("test.txt", "r");

    // isset()
    echo "<h2>isset()</h2>";
    if (isset($a)) {
        echo '$a è impostata<br>';
    } else {
        echo '$a non è impostata<br>';
    }

    // empty()
    echo "<h2>empty()</h2>";
    if (empty($b)) {
        echo '$b è vuota<br>';
    } else {
        echo '$b non è vuota<br>';
    }

    // is_null()
    echo "<h2>is_null()</h2>";
    if (is_null($c)) {
        echo '$c è NULL<br>';
    } else {
        echo '$c non è NULL<br>';
    }

    // is_array()
    echo "<h2>is_array()</h2>";
    if (is_array($d)) {
        echo '$d è un array<br>';
    } else {
        echo '$d non è un array<br>';
    }

    // is_bool()
    echo "<h2>is_bool()</h2>";
    if (is_bool($e)) {
        echo '$e è un booleano<br>';
    } else {
        echo '$e non è un booleano<br>';
    }

    // is_int()
    echo "<h2>is_int()</h2>";
    if (is_int($f)) {
        echo '$f è un intero<br>';
    } else {
        echo '$f non è un intero<br>';
    }

    // is_float()
    echo "<h2>is_float()</h2>";
    if (is_float($g)) {
        echo '$g è un float<br>';
    } else {
        echo '$g non è un float<br>';
    }

    // is_string()
    echo "<h2>is_string()</h2>";
    if (is_string($h)) {
        echo '$h è una stringa<br>';
    } else {
        echo '$h non è una stringa<br>';
    }

    // is_object()
    echo "<h2>is_object()</h2>";
    if (is_object($i)) {
        echo '$i è un oggetto<br>';
    } else {
        echo '$i non è un oggetto<br>';
    }

    // is_resource()
    echo "<h2>is_resource()</h2>";
    if (is_resource($file)) {
        echo '$file è una risorsa<br>';
    } else {
        echo '$file non è una risorsa<br>';
    }

    // gettype()
    echo "<h2>gettype()</h2>";
    echo 'Il tipo di $f è: ' . gettype($f) . '<br>';

    // settype()
    echo "<h2>settype()</h2>";
    settype($h, "integer");
    echo 'Il nuovo tipo di $h è: ' . gettype($h) . ' e il suo valore è: ' . $h . '<br>';

    // unset()
    echo "<h2>unset()</h2>";
    unset($a);
    if (!isset($a)) {
        echo '$a è stata distrutta con unset()<br>';
    }

    // var_dump()
    echo "<h2>var_dump()</h2>";
    echo 'Risultato di var_dump($d): ';
    var_dump($d);
    echo '<br>';

    // print_r()
    echo "<h2>print_r()</h2>";
    echo 'Risultato di print_r($d): ';
    print_r($d);
    echo '<br>';

    // is_numeric()
    echo "<h2>is_numeric()</h2>";
    if (is_numeric($g)) {
        echo '$g è un valore numerico<br>';
    } else {
        echo '$g non è un valore numerico<br>';
    }

    // lettura di un file
    echo "<h2>Lettura di un file</h2>";
    // Apertura del file in modalità lettura
    //$file = fopen("test.txt", "r") or die("Impossibile aprire il file!");
    // Lettura del file riga per riga
    while (!feof($file)) {
        echo fgets($file) . "<br>";
    }

    // Chiusura della risorsa file
    fclose($file);
    ?>

</body>
</html>
