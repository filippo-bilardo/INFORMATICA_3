# Array multi-dimensionali

Gli array multi-dimensionali in PHP sono array che contengono altri array come elementi. Questo tipo di struttura dati è fondamentale per rappresentare dati complessi e gerarchici come tabelle, matrici o strutture nidificate.

## Creazione di array multi-dimensionali

### Array bidimensionali

```php
// Array bidimensionale: tabella di studenti
$studenti = [
    ["Mario", "Rossi", 23],
    ["Luigi", "Verdi", 22],
    ["Anna", "Bianchi", 24]
];

// Array bidimensionale associativo
$schedaStudente = [
    "personali" => ["nome" => "Mario", "cognome" => "Rossi", "età" => 23],
    "accademici" => ["corso" => "Informatica", "anno" => 3, "media" => 26.5],
    "contatti" => ["email" => "mario.rossi@example.com", "telefono" => "123456789"]
];
```

### Array tridimensionali e oltre

```php
// Array tridimensionale: università, corsi e studenti
$università = [
    "Informatica" => [
        "Primo Anno" => ["Mario Rossi", "Luigi Verdi"],
        "Secondo Anno" => ["Anna Bianchi", "Roberto Neri"]
    ],
    "Economia" => [
        "Primo Anno" => ["Carla Gialli", "Matteo Blu"],
        "Secondo Anno" => ["Elena Rosa", "Paolo Viola"]
    ]
];

// Array a quattro dimensioni
$scuole = [
    "Liceo A" => [
        "Classe 1A" => [
            "Matematica" => [
                ["nome" => "Mario", "voto" => 8],
                ["nome" => "Anna", "voto" => 9]
            ],
            "Italiano" => [
                ["nome" => "Mario", "voto" => 7],
                ["nome" => "Anna", "voto" => 8]
            ]
        ]
    ]
];
```

## Accesso agli elementi

### Accesso con indici numerici

```php
// Accesso a un elemento di array bidimensionale
echo $studenti[0][0]; // Output: Mario (nome del primo studente)
echo $studenti[1][2]; // Output: 22 (età del secondo studente)

// Accesso a un elemento di array tridimensionale
echo $università["Informatica"]["Primo Anno"][0]; // Output: Mario Rossi
```

### Accesso con chiavi associative

```php
// Accesso a dati nidificati
echo $schedaStudente["personali"]["nome"]; // Output: Mario
echo $schedaStudente["accademici"]["media"]; // Output: 26.5

// Accesso a un elemento molto nidificato
echo $scuole["Liceo A"]["Classe 1A"]["Matematica"][0]["voto"]; // Output: 8
```

### Accesso sicuro a elementi annidati

```php
// Verifica prima di accedere a un elemento profondamente nidificato
if (isset($scuole["Liceo A"]["Classe 1B"]["Matematica"])) {
    // Accesso sicuro
    $voti = $scuole["Liceo A"]["Classe 1B"]["Matematica"];
}

// Uso dell'operatore null coalescing per valori predefiniti
$classe = $scuole["Liceo A"]["Classe 1C"] ?? "Classe non trovata";
```

## Iterazione attraverso array multi-dimensionali

### Cicli foreach annidati

```php
// Iterazione su array bidimensionale
foreach ($studenti as $studente) {
    echo "Nome: {$studente[0]}, Cognome: {$studente[1]}, Età: {$studente[2]}<br>";
}

// Iterazione su array bidimensionale associativo
foreach ($schedaStudente as $categoria => $dati) {
    echo "Categoria: $categoria<br>";
    foreach ($dati as $chiave => $valore) {
        echo "- $chiave: $valore<br>";
    }
}
```

### Iterazione ricorsiva

```php
function stampaArray($array, $indentazione = 0) {
    $spazi = str_repeat("  ", $indentazione);
    foreach ($array as $chiave => $valore) {
        if (is_array($valore)) {
            echo "{$spazi}$chiave:<br>";
            stampaArray($valore, $indentazione + 1);
        } else {
            echo "{$spazi}$chiave: $valore<br>";
        }
    }
}

stampaArray($schedaStudente);
```

### Utilizzo di RecursiveIteratorIterator

```php
$iterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator($università),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($iterator as $chiave => $valore) {
    $indici = [];
    for ($i = 0; $i <= $iterator->getDepth(); $i++) {
        $indici[] = $iterator->getSubIterator($i)->key();
    }
    $percorso = implode(" > ", $indici);
    echo "$percorso > $chiave: $valore<br>";
}
```

## Manipolazione di array multi-dimensionali

### Aggiungere elementi

```php
// Aggiungere un elemento a un array bidimensionale
$studenti[] = ["Paolo", "Gialli", 25];

// Aggiungere un elemento a un array associativo nidificato
$schedaStudente["personali"]["nazionalità"] = "Italiana";

// Aggiungere un elemento a un livello più profondo
$università["Informatica"]["Terzo Anno"] = ["Davide Arancio", "Stefania Viola"];
```

### Modificare elementi

```php
// Modificare un elemento in un array bidimensionale
$studenti[0][2] = 24; // Cambia l'età di Mario Rossi

// Modificare un elemento in un array associativo nidificato
$schedaStudente["accademici"]["media"] = 27.0;
```

### Rimuovere elementi

```php
// Rimuovere un elemento da un array bidimensionale
unset($studenti[1]); // Rimuove il secondo studente

// Rimuovere un elemento da un array associativo nidificato
unset($schedaStudente["contatti"]["telefono"]);

// Rimuovere un intero ramo di un array nidificato
unset($università["Economia"]["Secondo Anno"]);
```

## Applicazioni pratiche

### Rappresentazione di tabelle di database

```php
$utenti = [
    ["id" => 1, "nome" => "Mario", "email" => "mario@example.com"],
    ["id" => 2, "nome" => "Luigi", "email" => "luigi@example.com"],
    ["id" => 3, "nome" => "Anna", "email" => "anna@example.com"]
];

// Funzione per trovare un utente per ID
function trovaUtentePerId($utenti, $id) {
    foreach ($utenti as $utente) {
        if ($utente["id"] === $id) {
            return $utente;
        }
    }
    return null;
}

$utente = trovaUtentePerId($utenti, 2);
echo "Utente trovato: {$utente['nome']}";
```

### Struttura di dati JSON

```php
// Array multi-dimensionale che rappresenta dati JSON
$prodotto = [
    "id" => 101,
    "nome" => "Smartphone XYZ",
    "prezzo" => 599.99,
    "specifiche" => [
        "display" => "6.5 pollici",
        "processore" => "Octa-core",
        "memoria" => ["RAM" => "8GB", "Storage" => "128GB"]
    ],
    "recensioni" => [
        ["utente" => "User1", "valutazione" => 5, "commento" => "Ottimo prodotto"],
        ["utente" => "User2", "valutazione" => 4, "commento" => "Buon rapporto qualità-prezzo"]
    ]
];

// Convertire in JSON
$jsonProdotto = json_encode($prodotto, JSON_PRETTY_PRINT);
echo "<pre>$jsonProdotto</pre>";

// Decodificare da JSON a array PHP
$arrayDaJson = json_decode($jsonProdotto, true);
```

### Matrice bidimensionale

```php
// Matrice 3x3
$matrice = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

// Stampa la matrice in formato tabellare
echo "<table border='1'>";
foreach ($matrice as $riga) {
    echo "<tr>";
    foreach ($riga as $cella) {
        echo "<td>$cella</td>";
    }
    echo "</tr>";
}
echo "</table>";

// Calcola la somma degli elementi della matrice
$somma = 0;
foreach ($matrice as $riga) {
    foreach ($riga as $cella) {
        $somma += $cella;
    }
}
echo "Somma: $somma";
```

## Best practice

1. **Limitare la profondità**: Evitare di creare array con più di 3-4 livelli di profondità, poiché diventano difficili da gestire
2. **Utilizzare chiavi significative**: Nelle strutture associative, usare chiavi descrittive
3. **Documentare la struttura**: Per array complessi, documentare la struttura attesa
4. **Verificare l'esistenza prima dell'accesso**: Usare `isset()` o l'operatore `??` prima di accedere a elementi nidificati
5. **Considerare strutture alternative**: Per dati molto complessi, valutare l'uso di classi e oggetti invece di array nidificati
6. **Usare funzioni helper**: Creare funzioni specifiche per accedere e manipolare i dati nidificati

## Esempi di funzioni helper per array multi-dimensionali

```php
<?php
// Funzione per accedere in sicurezza a elementi nidificati
function arrayGet($array, $path, $default = null) {
    $current = $array;
    $keys = explode('.', $path);
    
    foreach ($keys as $key) {
        if (!is_array($current) || !array_key_exists($key, $current)) {
            return $default;
        }
        $current = $current[$key];
    }
    
    return $current;
}

// Funzione per impostare un valore in un array multi-dimensionale
function arraySet(&$array, $path, $value) {
    $keys = explode('.', $path);
    $current = &$array;
    
    foreach ($keys as $key) {
        if (!isset($current[$key]) || !is_array($current[$key])) {
            $current[$key] = [];
        }
        $current = &$current[$key];
    }
    
    $current = $value;
    return $array;
}

// Esempio di utilizzo
$dati = [
    "utente" => [
        "profilo" => [
            "nome" => "Mario",
            "indirizzo" => [
                "città" => "Roma"
            ]
        ]
    ]
];

// Accesso sicuro
$città = arrayGet($dati, "utente.profilo.indirizzo.città", "Sconosciuta");
echo "Città: $città<br>"; // Output: Città: Roma

// Accesso a un percorso inesistente
$cap = arrayGet($dati, "utente.profilo.indirizzo.cap", "Non specificato");
echo "CAP: $cap<br>"; // Output: CAP: Non specificato

// Impostazione di un valore
arraySet($dati, "utente.profilo.indirizzo.cap", "00100");
echo "Nuovo CAP: " . $dati["utente"]["profilo"]["indirizzo"]["cap"]; // Output: Nuovo CAP: 00100
?>
```

---

Per approfondire, consultare la [documentazione ufficiale di PHP sugli array](https://www.php.net/manual/en/language.types.array.php) e le [funzioni per array](https://www.php.net/manual/en/ref.array.php).
