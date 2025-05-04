La **destrutturazione di array** in PHP è una funzionalità che permette di estrarre i valori di un array e assegnarli direttamente a delle variabili, rendendo il codice più conciso e leggibile. Questa funzionalità è stata introdotta con PHP 7.1.

### Sintassi di base

Per destrutturare un array, si utilizza la sintassi con le graffe `{}` insieme all'operatore `list()` o direttamente con l'assegnamento tra parentesi graffe.

#### Esempio semplice:

```php
<?php
$array = [10, 20, 30];

// Usando list()
list($a, $b, $c) = $array;
echo $a; // Output: 10
echo $b; // Output: 20
echo $c; // Output: 30

// Usando la destrutturazione diretta (PHP 7.1+)
[$x, $y, $z] = $array;
echo $x; // Output: 10
echo $y; // Output: 20
echo $z; // Output: 30
?>
```

### Ignorare elementi durante la destrutturazione

Se non hai bisogno di tutti gli elementi dell'array, puoi ignorarli utilizzando una virgola vuota `,`.

#### Esempio:

```php
<?php
$array = [10, 20, 30, 40];

// Ignora il secondo elemento
[$first, , $third] = $array;
echo $first; // Output: 10
echo $third; // Output: 30
?>
```

### Assegnazione con chiavi associative

Con gli array associativi, puoi specificare i nomi delle chiavi per estrarre solo i valori desiderati.

#### Esempio:

```php
<?php
$array = [
    'nome' => 'Mario',
    'cognome' => 'Rossi',
    'età' => 30
];

// Estrai solo 'nome' e 'cognome'
['nome' => $nome, 'cognome' => $cognome] = $array;

echo $nome;    // Output: Mario
echo $cognome; // Output: Rossi
?>
```

### Valori predefiniti

Puoi fornire valori predefiniti nel caso in cui una chiave non esista nell'array.

#### Esempio:

```php
<?php
$array = [
    'nome' => 'Mario',
    'cognome' => 'Rossi'
];

// Se 'età' non esiste, usa il valore predefinito 0
['nome' => $nome, 'cognome' => $cognome, 'età' => $età = 0] = $array;

echo $nome; // Output: Mario
echo $cognome; // Output: Rossi
echo $età; // Output: 0
?>
```

### Destrutturazione annidata

È possibile destrutturare anche array nidificati.

#### Esempio:

```php
<?php
$array = [
    'nome' => 'Mario',
    'indirizzo' => [
        'città' => 'Roma',
        'cap' => '00100'
    ]
];

// Destrutturazione annidata
['nome' => $nome, 'indirizzo' => ['città' => $città, 'cap' => $cap]] = $array;

echo $nome;   // Output: Mario
echo $città;  // Output: Roma
echo $cap;    // Output: 00100
?>
```

### Limitazioni

- La destrutturazione funziona solo con array numerici o associativi.
- Non è supportata per oggetti standard, ma puoi usare la destrutturazione su proprietà di oggetti tramite cast a array (`(array)`).

### Conclusione

La destrutturazione di array in PHP è una funzionalità potente che ti consente di scrivere codice più pulito e conciso quando lavori con array. Utilizzandola correttamente, puoi evitare lunghi blocchi di codice per l'estrazione di valori da array complessi.