# Array: tipi, inizializzazione e manipolazione

In PHP, gli array sono strutture dati versatili che possono memorizzare valori di qualsiasi tipo. Questa guida copre i diversi tipi di array, come inizializzarli e manipolarli.

## Tipi di array in PHP

PHP supporta tre tipi principali di array:

1. **Array indicizzati**: Array con indici numerici
2. **Array associativi**: Array con chiavi personalizzate (stringhe)
3. **Array multidimensionali**: Array che contengono altri array

## Inizializzazione degli array

### Sintassi breve (consigliata)

```php
// Array indicizzato
$frutti = ["mela", "banana", "arancia"];

// Array associativo
$persona = [
    "nome" => "Mario",
    "cognome" => "Rossi",
    "età" => 30
];

// Array multidimensionale
$studenti = [
    ["nome" => "Mario", "voto" => 8],
    ["nome" => "Luigi", "voto" => 7],
    ["nome" => "Anna", "voto" => 9]
];
```

### Sintassi array()

```php
// Array indicizzato
$frutti = array("mela", "banana", "arancia");

// Array associativo
$persona = array(
    "nome" => "Mario",
    "cognome" => "Rossi",
    "età" => 30
);
```

### Array vuoto

```php
$arrayVuoto = [];
// oppure
$arrayVuoto = array();
```

## Manipolazione degli array

### Aggiungere elementi

```php
// Aggiungere un elemento alla fine di un array indicizzato
$frutti[] = "pera";

// Aggiungere un elemento con una chiave specifica
$persona["email"] = "mario.rossi@example.com";

// Usare array_push() per aggiungere uno o più elementi
array_push($frutti, "kiwi", "ananas");
```

### Rimuovere elementi

```php
// Rimuovere l'ultimo elemento
$ultimo = array_pop($frutti);

// Rimuovere il primo elemento
$primo = array_shift($frutti);

// Rimuovere un elemento specifico
unset($persona["email"]);
```

### Modificare elementi

```php
// Modificare un valore esistente
$frutti[1] = "fragola";  // Sostituisce "banana" con "fragola"
$persona["età"] = 31;    // Aggiorna l'età
```

## Funzioni utili per lavorare con gli array

### Informazioni sugli array

```php
// Contare gli elementi
$numero = count($frutti);

// Verificare se una chiave esiste
$esiste = array_key_exists("nome", $persona);

// Verificare se un valore esiste
$contiene = in_array("mela", $frutti);

// Ottenere le chiavi
$chiavi = array_keys($persona);

// Ottenere i valori
$valori = array_values($persona);
```

### Ordinamento

```php
// Ordinare un array indicizzato
sort($frutti);  // Ordine crescente
rsort($frutti); // Ordine decrescente

// Ordinare un array associativo per valore
asort($persona);  // Ordine crescente
arsort($persona); // Ordine decrescente

// Ordinare un array associativo per chiave
ksort($persona);  // Ordine crescente
krsort($persona); // Ordine decrescente
```

### Conversione tra array e stringhe

```php
// implode: Unisce gli elementi di un array in una stringa
$frutti = ["mela", "banana", "arancia"];
$stringa = implode(", ", $frutti);  // "mela, banana, arancia"

// Uso di implode per creare una lista in formato HTML
$elenco = "<ul><li>" . implode("</li><li>", $frutti) . "</li></ul>";
// Risultato: <ul><li>mela</li><li>banana</li><li>arancia</li></ul>

// implode senza separatore 
$codice = ["+39", "345", "1234567"];
$telefono = implode($codice);  // "+393451234567"

// explode: Divide una stringa in un array usando un delimitatore
$frase = "PHP è un linguaggio di scripting";
$parole = explode(" ", $frase);  // ["PHP", "è", "un", "linguaggio", "di", "scripting"]

// Limitare il numero di elementi risultanti
$limitato = explode(" ", $frase, 3);  // ["PHP", "è", "un linguaggio di scripting"]

// join è un alias di implode
$riunito = join("-", $parole);  // "PHP-è-un-linguaggio-di-scripting"
```

#### Casi d'uso comuni per implode/explode

- Formattare dati per visualizzazione (liste separate da virgole, tabelle)
- Costruire query SQL con clausole IN
- Convertire path di file/URL in array di componenti e viceversa
- Gestire valori multipli da form HTML (quando inviati come stringa separata da virgole)
- Trasformare tag o categorie tra formato stringa e array

### Manipolazione avanzata

```php
// Unire array
$array1 = [1, 2, 3];
$array2 = [4, 5, 6];
$unito = array_merge($array1, $array2);  // [1, 2, 3, 4, 5, 6]

// Filtrare array
$numeri = [1, 2, 3, 4, 5, 6];
$pari = array_filter($numeri, function($n) {
    return $n % 2 == 0;
});  // [2, 4, 6]

// Mappare array (trasformare tutti gli elementi)
$quadrati = array_map(function($n) {
    return $n * $n;
}, $numeri);  // [1, 4, 9, 16, 25, 36]

// Estrarre una porzione dell'array
$porzione = array_slice($numeri, 1, 3);  // [2, 3, 4]
```

## Accedere agli elementi

```php
// Accedere a un elemento per indice
echo $frutti[0];  // "mela"

// Accedere a un elemento per chiave
echo $persona["nome"];  // "Mario"

// Accedere a elementi in array multidimensionali
echo $studenti[0]["nome"];  // "Mario"
```

## Best practice

1. Utilizzare la sintassi breve `[]` invece di `array()` per migliorare la leggibilità
2. Specificare le chiavi anche negli array indicizzati quando migliora la leggibilità
3. Utilizzare funzioni array specifiche invece di loop quando possibile
4. Verificare sempre l'esistenza di una chiave prima di accedervi per evitare errori
5. Utilizzare la destrutturazione per estrarre valori da array in modo elegante

## Esempio pratico

```php
<?php
// Gestione di un carrello acquisti
$carrello = [
    ["prodotto" => "Laptop", "prezzo" => 899.99, "quantità" => 1],
    ["prodotto" => "Mouse", "prezzo" => 24.99, "quantità" => 2],
    ["prodotto" => "Tastiera", "prezzo" => 49.99, "quantità" => 1]
];

// Calcolo del totale
$totale = 0;
foreach ($carrello as $item) {
    $totale += $item["prezzo"] * $item["quantità"];
}

echo "Totale carrello: €" . number_format($totale, 2);

// Aggiunta di un prodotto
$carrello[] = ["prodotto" => "Monitor", "prezzo" => 299.99, "quantità" => 1];

// Ordinare per prezzo
usort($carrello, function($a, $b) {
    return $a["prezzo"] <=> $b["prezzo"];
});

// Estrazione dei nomi dei prodotti
$nomiProdotti = array_column($carrello, "prodotto");
?>
```

---

Per approfondire, consultare la [documentazione ufficiale di PHP sugli array](https://www.php.net/manual/en/language.types.array.php).
