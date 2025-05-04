<!-- http://204.216.213.176/inf3php/ES05/Eccezioni/es1.php -->
<?php
function divide($numerator, $denominator) {
    if ($denominator == 0) {
        throw new Exception("Divisione per zero non consentita.");
    }
    return $numerator / $denominator;
}

try {
    echo divide(10, 0);
} catch (Exception $e) {
    echo "Errore: " . $e->getMessage();
}
?>