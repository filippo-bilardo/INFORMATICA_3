<!-- http://204.216.213.176/inf3php/ES03/func_named_arg.php -->
<?php
function inviaEmail($destinatario, $oggetto, $testo, $firma="Saluti da, Mario Rossi") {
    echo <<<TESTO
    Gli argomenti della funzione sono:<br>
    destinatario: $destinatario<br>
    oggetto: $oggetto<br>
    testo: $testo<br>
    firma: $firma<br>
    TESTO;

}
inviaEmail(oggetto: "Saluti", testo: "Ciao!", destinatario: "esempio@email.com");

?>