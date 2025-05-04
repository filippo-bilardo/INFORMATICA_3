<!-- http://204.216.213.176/inf3php/ES05/Eccezioni/es1c.php -->
<?php
function divide($numerator, $denominator) {
    return $numerator / $denominator;
}

try {
    echo divide(10, 0);
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
} catch (Error $e) {
    echo "Ciao<br>";
    echo "Errore: " . $e->getMessage();
}
?>