<!-- 
 Dichiarazione di variabili in PHP e Javascript 
 http://204.216.213.176/inf3php/ES01/variabili.php
-->

<html>
<head>
    <title>Variabili php</title>
</head>
<body>

    <h1>Variabili</h1><br />
    
    <?php
    // Dichiarazione di una variabile
    $a = 5;
    echo 'Variabile a = $a <br />';
    echo "Variabile a = $a <br />";

    $b = "2";
    $somma = $a + $b;
    echo "Somma = $somma <br />";

    $c = "ciao";
    $somma = $a . $c;
    echo "Somma = $somma <br />";

    $numero_stringa = "10";
    $intero = (int)$numero_stringa;  // Cast esplicito da stringa a intero
    echo "Intero = $intero <br />";
    ?> 

    <script>
        // Dichiarazione di una variabile
        let a = 5;
        document.write("Variabile a = " + a + "<br />");

        let b = "2";
        let somma = a + b;
        document.write("Somma = " + somma + "<br />");

        let c = "ciao";
        let somma = a + c;
        document.write("Somma = " + somma + "<br />");
    </script>

</body>
</html>

