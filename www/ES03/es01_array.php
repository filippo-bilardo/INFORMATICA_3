<?php

echo "<h1>Lavorare con gli array</h1><br>";
echo "<h1>Helloooo! Prove con array</h1><br>";

$anArray = array(99, 'nome' => "Mario", 'subArr' => ['t' => 876]);
echo "\$anArray = array(99, 'nome' => \"Mario\", 'subArr' => ['t' => 876]);<br>";
echo "echo \$anArray[0] -> $anArray[0]<br>" ;
echo "echo \$anArray['nome'] -> " . $anArray['nome'] . "<br>";
echo "echo \$anArray['subArr']['t'] -> " . $anArray['subArr']['t'] . "<br>";
echo "<br>";

$arrayWithSpaceKey = array('space key' => 1);
echo "\$arrayWithSpaceKey = array('space key' => 1);<br>";
echo "echo \$arrayWithSpaceKey['space key'] -> ".$arrayWithSpaceKey['space key']."<br>" ;
echo "<br>";

$aLargeArray = array_fill(0, 100, 'test');
echo "\$aLargeArray = array_fill(0, 100, 'test');<br>";
echo "echo var_dump(\$aLargeArray); -> <br>";
var_dump($aLargeArray);
echo "<br>";
echo "<br>";

$studenti = [
    ["nome" => "Mario", "voto" => 8],
    ["nome" => "Luigi", "voto" => 9],
    ["nome" => "Peach", "voto" => 10]
];
foreach ($studenti as $record) {
    foreach ($record as $nome => $valore) {
        echo "\$nome=$nome , \$valore=$valore<br/>\n";
    }
    echo "\n";
}

exit;
?>