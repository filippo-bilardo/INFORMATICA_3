<!-- http://204.216.213.176/inf3php/ES05/Eccezioni/es3.php -->
<?php
try {
    throw new Exception("Errore generico", 123);
} catch (Exception $e) {
    echo "<br>Messaggio: " . $e->getMessage() . "\n";
    echo "<br>Codice: " . $e->getCode() . "\n";
    echo "<br>File: " . $e->getFile() . "\n";
    echo "<br>Riga: " . $e->getLine() . "\n";
    echo "<br>Stack Trace:\n" . $e->getTraceAsString();
}
?>