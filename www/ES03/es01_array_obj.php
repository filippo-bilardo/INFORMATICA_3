<?php

echo "<h1>Array di oggetti</h1><br>";

class Prodotto {
    public $nome;
    public $prezzo;
    public $disponibile;

    public function __construct($nome, $prezzo, $disponibile) {
        $this->nome = $nome;
        $this->prezzo = $prezzo;
        $this->disponibile = $disponibile;
    }
}

$prodotti = array(
    new Prodotto("Maglietta", 20, true),
    new Prodotto("Pantaloni", 30, false),
    new Prodotto("Scarpe", 50, true)
);

echo "\$prodotti[0]->nome=";
echo $prodotti[0]->nome; // Output: Maglietta
echo "<br/><br/>";

foreach ($prodotti as $prodotto) {
    echo $prodotto->nome . " - " . $prodotto->prezzo . " euro";
    if ($prodotto->disponibile) {
        echo " (disponibile)<br/>\n";
    } else {
        echo " (non disponibile)<br/>n";
    }
}

exit;
?>