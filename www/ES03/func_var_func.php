<!-- http://204.216.213.176/inf3php/ES03/func_var_func.php -->
<?php
$funzioni = array("sin","cos","tan","exp","log");
?>
<form method="post">
    <select name="funzione" id="funzione">
        <?php
        foreach($funzioni as $fname)      
            echo "<option value=\"$fname\">$fname</option>";
        ?>
    </select>
    <input type="text" name="valore" id="valore">
    <input type="submit" value="Calcola">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $funzione = $_POST["funzione"];
    $valore = $_POST["valore"];
    $risultato = $funzione($valore);
    echo "<p>Il risultato di $funzione($valore) è $risultato</p>";
}
?>
