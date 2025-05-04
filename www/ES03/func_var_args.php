<!-- http://204.216.213.176/inf3php/ES03/func_var_args.php -->
<?php
function somma(...$numeri) {
    $acc = 0;
    foreach ($numeri as $n) {
        $acc += $n;
    }
    return $acc;
}
echo somma(1, 2, 3, 4, 6);

function miaFunzione() {
    $argomento1 = func_get_arg(0);
    $argomento2 = func_get_arg(1);
    echo "<br>$argomento1 - $argomento2";
}
miaFunzione(5, "ciao");

function miaFunzione2(...$argomenti) {
    list($valore1, $valore2, $valore3) = $argomenti;
    echo "<br>$valore1 - $valore2 - $valore3";
}

miaFunzione2(99, 2, "Ciao");

function average(){
    return array_sum(func_get_args())/func_num_args();
}
echo "<br>" . average(10, 15, 20, 25); // 17.5
?>