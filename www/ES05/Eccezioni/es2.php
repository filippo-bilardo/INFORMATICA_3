<!-- http://204.216.213.176/inf3php/ES05/Eccezioni/es2.php -->
<?php
// Esempio di errore (non gestibile con try-catch)
echo $undefinedVariable; // Genera un notice

// Esempio di eccezione (gestibile con try-catch)
try {
    throw new Exception("Questo è un errore gestibile.");
} catch (Exception $e) {
    echo "<br>Eccezione catturata: " . $e->getMessage();
}
?>