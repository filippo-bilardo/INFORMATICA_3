# Iterazioni avanzate e metodi di accesso

In PHP, esistono diverse tecniche avanzate per iterare attraverso array e accedere ai loro elementi. Questa guida esplorerà metodi di iterazione più sofisticati rispetto ai semplici cicli `for` e `foreach`.

## Foreach con chiavi e valori

Il ciclo `foreach` è il metodo più comune per iterare gli array in PHP:

```php
$persona = [
    "nome" => "Mario",
    "cognome" => "Rossi",
    "età" => 30
];

// Iterazione su valori
foreach ($persona as $valore) {
    echo $valore . "<br>";
}

// Iterazione su chiavi e valori
foreach ($persona as $chiave => $valore) {
    echo "$chiave: $valore<br>";
}
```

## Iteratori integrati in PHP

PHP offre diverse classi di iteratori che facilitano l'accesso e la manipolazione dei dati:

### ArrayIterator

```php
$array = ["uno", "due", "tre"];
$iterator = new ArrayIterator($array);

while ($iterator->valid()) {
    echo $iterator->current() . "<br>";
    $iterator->next();
}

// Permette anche modifiche durante l'iterazione
$iterator->rewind(); // Torna all'inizio
while ($iterator->valid()) {
    if ($iterator->current() == "due") {
        $iterator->offsetSet($iterator->key(), "DUE MODIFICATO");
    }
    $iterator->next();
}
```

### RecursiveArrayIterator

Particolarmente utile per array multi-dimensionali:

```php
$array = [
    "frutta" => ["mela", "banana", "arancia"],
    "verdura" => ["carota", "broccolo", "spinaci"]
];

$iterator = new RecursiveArrayIterator($array);
$recursiveIterator = new RecursiveIteratorIterator($iterator);

foreach ($recursiveIterator as $key => $value) {
    echo "$key: $value<br>";
}
```

## Funzioni di callback per iterazione

### array_walk() e array_walk_recursive()

Applicano un callback a ogni elemento di un array:

```php
$frutta = ["mela", "banana", "arancia"];

array_walk($frutta, function(&$valore, $chiave) {
    $valore = strtoupper($valore); // Converte in maiuscolo
});

// $frutta ora contiene ["MELA", "BANANA", "ARANCIA"]

// Per array multi-dimensionali
$cesto = [
    "frutta" => ["mela", "banana"],
    "verdura" => ["carota", "broccolo"]
];

array_walk_recursive($cesto, function(&$valore) {
    $valore = strtoupper($valore);
});
```

### array_reduce()

Riduce un array a un singolo valore applicando una funzione:

```php
$numeri = [1, 2, 3, 4, 5];

// Calcola la somma
$somma = array_reduce($numeri, function($carry, $item) {
    return $carry + $item;
}, 0); // 0 è il valore iniziale

echo "Somma: $somma"; // Output: Somma: 15

// Esempio più complesso: costruire una stringa
$parole = ["PHP", "è", "fantastico"];
$frase = array_reduce($parole, function($carry, $item) {
    return $carry === "" ? $item : "$carry $item";
}, "");

echo $frase; // Output: PHP è fantastico
```

## Comprensioni di liste con array_map()

Trasforma un array applicando una funzione a ciascun elemento:

```php
$numeri = [1, 2, 3, 4, 5];

// Eleva al quadrato ogni numero
$quadrati = array_map(function($n) { 
    return $n * $n; 
}, $numeri);

// $quadrati ora è [1, 4, 9, 16, 25]

// Con più array come input
$nomi = ["Mario", "Luigi", "Anna"];
$cognomi = ["Rossi", "Verdi", "Bianchi"];

$nomiCompleti = array_map(function($nome, $cognome) {
    return "$nome $cognome";
}, $nomi, $cognomi);

// $nomiCompleti ora è ["Mario Rossi", "Luigi Verdi", "Anna Bianchi"]
```

## Accesso rapido con array_column()

Estrae una colonna da un array multi-dimensionale:

```php
$studenti = [
    ["id" => 1, "nome" => "Mario", "voto" => 8],
    ["id" => 2, "nome" => "Luigi", "voto" => 7],
    ["id" => 3, "nome" => "Anna", "voto" => 9]
];

// Estrae tutti i nomi
$nomi = array_column($studenti, "nome");
// $nomi ora è ["Mario", "Luigi", "Anna"]

// Estrae i voti usando gli ID come indici
$voti = array_column($studenti, "voto", "id");
// $voti ora è [1 => 8, 2 => 7, 3 => 9]
```

## Metodi alternativi di accesso

### Operatore di scomposizione (spread)

```php
function somma(...$numeri) {
    return array_sum($numeri);
}

$array = [1, 2, 3];
echo somma(...$array); // Equivalente a somma(1, 2, 3)
```

### Accesso condizionale con null coalescing

```php
$utente = ["nome" => "Mario"];

// Modo tradizionale
$email = isset($utente["email"]) ? $utente["email"] : "non specificata";

// Con operatore null coalescing
$email = $utente["email"] ?? "non specificata";

// Incatenamento
$config = [
    "database" => [
        "connessioni" => [
            "predefinito" => ["host" => "localhost"]
        ]
    ]
];

$host = $config["database"]["connessioni"]["predefinito"]["host"] ?? "127.0.0.1";
```

## Tecniche di iterazione per prestazioni ottimali

### Iterazione con foreach per riferimento

```php
$numeriGrandi = range(1, 1000000);

// Modifica i valori direttamente nella memoria
foreach ($numeriGrandi as &$numero) {
    $numero *= 2;
}
unset($numero); // Importante: elimina il riferimento dopo il ciclo
```

### Iterazione con generatori

Ideali per lavorare con grandi set di dati:

```php
function rangeGenerator($inizio, $fine) {
    for ($i = $inizio; $i <= $fine; $i++) {
        yield $i;
    }
}

// Uso della memoria efficiente per grandi intervalli
foreach (rangeGenerator(1, 1000000) as $numero) {
    echo "$numero<br>";
    // Non carica 1 milione di numeri in memoria
}
```

## Best practice

1. **Scegliere l'iteratore giusto**: `foreach` è ottimo per la maggior parte dei casi, ma considera iteratori specializzati per casi più complessi.
2. **Referenze con cautela**: L'iterazione per riferimento è potente ma può causare bug difficili da individuare se non gestita correttamente.
3. **Utilizzare gli iteratori integrati**: PHP fornisce molti iteratori ottimizzati per vari casi d'uso.
4. **Preferire funzioni di array su cicli manuali**: Funzioni come `array_map`, `array_filter` e `array_reduce` spesso rendono il codice più chiaro e manutenibile.
5. **Considerare i generatori**: Per set di dati di grandi dimensioni, i generatori offrono notevoli vantaggi in termini di memoria.

## Esempio pratico: Elaborazione dati degli studenti

```php
<?php
$studenti = [
    ["id" => 1, "nome" => "Mario", "voti" => [7, 8, 6, 9]],
    ["id" => 2, "nome" => "Luigi", "voti" => [6, 7, 8, 8]],
    ["id" => 3, "nome" => "Anna", "voti" => [9, 9, 8, 10]]
];

// Calcolare la media dei voti per ogni studente
$medie = array_map(function($studente) {
    $media = array_sum($studente["voti"]) / count($studente["voti"]);
    return [
        "id" => $studente["id"],
        "nome" => $studente["nome"],
        "media" => round($media, 1)
    ];
}, $studenti);

// Filtrare studenti con media superiore a 8
$eccellenti = array_filter($medie, function($studente) {
    return $studente["media"] >= 8;
});

// Ordinare per media decrescente
usort($eccellenti, function($a, $b) {
    return $b["media"] <=> $a["media"];
});

// Stampare la classifica
echo "Classifica studenti eccellenti:<br>";
foreach ($eccellenti as $i => $studente) {
    $posizione = $i + 1;
    echo "$posizione. {$studente['nome']} - Media: {$studente['media']}<br>";
}
?>
```

---

Per approfondire, consultare la [documentazione ufficiale di PHP sulle funzioni per array](https://www.php.net/manual/en/ref.array.php) e sugli [iteratori](https://www.php.net/manual/en/spl.iterators.php).
