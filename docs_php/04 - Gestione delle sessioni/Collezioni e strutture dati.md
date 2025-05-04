# Collezioni e strutture dati

In PHP, oltre agli array standard, sono disponibili diverse strutture dati specializzate che offrono funzionalità avanzate per organizzare e manipolare i dati. Questa guida esplora le varie collezioni e strutture dati disponibili in PHP e il loro utilizzo ottimale.

## Standard PHP Library (SPL)

La libreria SPL fornisce una collezione di interfacce e classi per gestire strutture dati comuni:

### SplQueue - Coda

Implementa una struttura FIFO (First In, First Out):

```php
$coda = new SplQueue();
$coda->enqueue("primo");
$coda->enqueue("secondo");
$coda->enqueue("terzo");

echo $coda->dequeue(); // Output: primo
echo $coda->dequeue(); // Output: secondo
echo $coda->count();   // Output: 1 (rimane solo "terzo")
```

### SplStack - Pila

Implementa una struttura LIFO (Last In, First Out):

```php
$pila = new SplStack();
$pila->push("primo");
$pila->push("secondo");
$pila->push("terzo");

echo $pila->pop();   // Output: terzo
echo $pila->pop();   // Output: secondo
echo $pila->count(); // Output: 1 (rimane solo "primo")
```

### SplFixedArray - Array a dimensione fissa

Ottimizzato per performance con dimensione predefinita:

```php
// Crea un array di dimensione 5
$array = new SplFixedArray(5);
$array[0] = "primo";
$array[1] = "secondo";

// $array[5] = "errore"; // Lancia una RuntimeException

// Ridimensionare l'array
$array->setSize(10);
$array[5] = "sesto"; // Ora funziona

// Convertire da/a array standard PHP
$normalArray = $array->toArray();
$fixedArray = SplFixedArray::fromArray(['a', 'b', 'c']);
```

### SplObjectStorage - Mappa di oggetti

Memorizza oggetti come chiavi:

```php
$storage = new SplObjectStorage();

$obj1 = new stdClass();
$obj1->id = 1;
$obj2 = new stdClass();
$obj2->id = 2;

$storage->attach($obj1, "dati associati a obj1");
$storage->attach($obj2, "dati associati a obj2");

var_dump($storage->contains($obj1)); // bool(true)
echo $storage[$obj1];               // Output: dati associati a obj1

$storage->detach($obj1);           // Rimuove obj1
var_dump($storage->contains($obj1)); // bool(false)
```

### SplDoublyLinkedList - Lista doppiamente collegata

Permette inserimenti e rimozioni efficienti in qualsiasi posizione:

```php
$list = new SplDoublyLinkedList();
$list->push("primo");
$list->push("secondo");
$list->unshift("zero");  // Aggiunge all'inizio

echo $list->top();    // Output: secondo
echo $list->bottom(); // Output: zero

// Iterare sulla lista
foreach ($list as $valore) {
    echo "$valore ";  // Output: zero primo secondo
}

// Iterazione in ordine inverso
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_LIFO);
foreach ($list as $valore) {
    echo "$valore ";  // Output: secondo primo zero
}
```

### SplHeap, SplMinHeap, SplMaxHeap - Heap

Strutture per gestire priorità:

```php
// Max Heap (il valore più grande è in cima)
$maxHeap = new SplMaxHeap();
$maxHeap->insert(30);
$maxHeap->insert(100);
$maxHeap->insert(50);

echo $maxHeap->extract(); // Output: 100
echo $maxHeap->extract(); // Output: 50

// Min Heap (il valore più piccolo è in cima)
$minHeap = new SplMinHeap();
$minHeap->insert(30);
$minHeap->insert(100);
$minHeap->insert(50);

echo $minHeap->extract(); // Output: 30
echo $minHeap->extract(); // Output: 50
```

### SplPriorityQueue - Coda a priorità

Consente di associare priorità agli elementi:

```php
$queue = new SplPriorityQueue();
$queue->insert('bassa priorità', 1);
$queue->insert('media priorità', 2);
$queue->insert('alta priorità', 3);

echo $queue->extract(); // Output: alta priorità
echo $queue->extract(); // Output: media priorità
```

## Implementazioni personalizzate di strutture dati

### Set (insieme)

PHP non ha una classe Set nativa, ma possiamo implementarla:

```php
class Set {
    private $items = [];
    
    public function add($item) {
        $this->items[$this->getHash($item)] = $item;
        return $this;
    }
    
    public function remove($item) {
        $hash = $this->getHash($item);
        if (isset($this->items[$hash])) {
            unset($this->items[$hash]);
        }
        return $this;
    }
    
    public function contains($item) {
        return isset($this->items[$this->getHash($item)]);
    }
    
    public function values() {
        return array_values($this->items);
    }
    
    public function size() {
        return count($this->items);
    }
    
    private function getHash($item) {
        if (is_object($item)) {
            return spl_object_hash($item);
        } else {
            return md5(serialize($item));
        }
    }
}

// Utilizzo
$set = new Set();
$set->add("mela")->add("banana")->add("mela"); // "mela" aggiunto una sola volta
echo $set->size(); // Output: 2
var_dump($set->contains("mela")); // bool(true)
```

### Dizionario/Mappa

Una struttura chiave-valore più sofisticata:

```php
class Dictionary {
    private $items = [];
    
    public function set($key, $value) {
        $this->items[$this->getHash($key)] = ['key' => $key, 'value' => $value];
        return $this;
    }
    
    public function get($key, $default = null) {
        $hash = $this->getHash($key);
        return isset($this->items[$hash]) ? $this->items[$hash]['value'] : $default;
    }
    
    public function has($key) {
        return isset($this->items[$this->getHash($key)]);
    }
    
    public function remove($key) {
        $hash = $this->getHash($key);
        if (isset($this->items[$hash])) {
            unset($this->items[$hash]);
            return true;
        }
        return false;
    }
    
    public function keys() {
        return array_column($this->items, 'key');
    }
    
    public function values() {
        return array_column($this->items, 'value');
    }
    
    private function getHash($key) {
        if (is_object($key)) {
            return spl_object_hash($key);
        } else {
            return md5(serialize($key));
        }
    }
}

// Utilizzo
$dict = new Dictionary();
$dict->set("nome", "Mario")->set("età", 30);
echo $dict->get("nome"); // Output: Mario
echo $dict->get("indirizzo", "N/A"); // Output: N/A (valore predefinito)
```

### Albero binario di ricerca

Struttura dati gerarchica per ricerche efficienti:

```php
class Node {
    public $value;
    public $left = null;
    public $right = null;
    
    public function __construct($value) {
        $this->value = $value;
    }
}

class BinarySearchTree {
    private $root = null;
    
    public function insert($value) {
        $this->root = $this->insertNode($this->root, $value);
    }
    
    private function insertNode($node, $value) {
        if ($node === null) {
            return new Node($value);
        }
        
        if ($value < $node->value) {
            $node->left = $this->insertNode($node->left, $value);
        } else if ($value > $node->value) {
            $node->right = $this->insertNode($node->right, $value);
        }
        
        return $node;
    }
    
    public function search($value) {
        return $this->searchNode($this->root, $value);
    }
    
    private function searchNode($node, $value) {
        if ($node === null || $node->value === $value) {
            return $node;
        }
        
        if ($value < $node->value) {
            return $this->searchNode($node->left, $value);
        } else {
            return $this->searchNode($node->right, $value);
        }
    }
    
    public function inOrderTraversal() {
        $result = [];
        $this->inOrder($this->root, $result);
        return $result;
    }
    
    private function inOrder($node, &$result) {
        if ($node !== null) {
            $this->inOrder($node->left, $result);
            $result[] = $node->value;
            $this->inOrder($node->right, $result);
        }
    }
}

// Utilizzo
$tree = new BinarySearchTree();
$tree->insert(10);
$tree->insert(5);
$tree->insert(15);
$tree->insert(3);

$node = $tree->search(5);
echo $node ? "Trovato: " . $node->value : "Non trovato";

$ordinati = $tree->inOrderTraversal();
echo implode(", ", $ordinati); // Output: 3, 5, 10, 15
```

## Collezioni immutabili

Le collezioni immutabili non possono essere modificate dopo la creazione, il che le rende sicure in contesti multithread o per prevenire modifiche accidentali:

```php
class ImmutableList {
    private $items;
    
    public function __construct(array $items) {
        $this->items = $items;
    }
    
    public function get($index) {
        return isset($this->items[$index]) ? $this->items[$index] : null;
    }
    
    public function toArray() {
        return $this->items;
    }
    
    public function map(callable $fn) {
        return new self(array_map($fn, $this->items));
    }
    
    public function filter(callable $fn) {
        return new self(array_filter($this->items, $fn));
    }
    
    // Non ci sono metodi per modificare i dati interni
}

// Utilizzo
$list = new ImmutableList([1, 2, 3, 4]);
$doubled = $list->map(function($x) { return $x * 2; });
echo implode(", ", $doubled->toArray()); // Output: 2, 4, 6, 8
```

## Strutture dati persistent/funzionali

Le strutture dati funzionali sono immutabili e creano nuove versioni ad ogni modifica:

```php
class PersistentVector {
    private $elements;
    
    public function __construct(array $elements = []) {
        $this->elements = $elements;
    }
    
    public function with($element) {
        $newElements = $this->elements;
        $newElements[] = $element;
        return new self($newElements);
    }
    
    public function without($index) {
        $newElements = $this->elements;
        if (isset($newElements[$index])) {
            array_splice($newElements, $index, 1);
        }
        return new self($newElements);
    }
    
    public function at($index) {
        return isset($this->elements[$index]) ? $this->elements[$index] : null;
    }
    
    public function count() {
        return count($this->elements);
    }
}

// Utilizzo
$v1 = new PersistentVector([1, 2, 3]);
$v2 = $v1->with(4);
$v3 = $v2->without(0);

// $v1 contiene ancora [1, 2, 3]
// $v2 contiene [1, 2, 3, 4]
// $v3 contiene [2, 3, 4]
```

## Confronto delle prestazioni

Ogni struttura dati ha vantaggi e svantaggi in termini di prestazioni:

| Struttura | Accesso | Inserimento | Ricerca | Eliminazione | Caso d'uso |
|-----------|---------|-------------|---------|-------------|------------|
| Array PHP | O(1)    | O(1)        | O(n)    | O(n)        | Utilizzo generale |
| SplFixedArray | O(1) | O(1)       | O(n)    | O(n)        | Arrays numerici di dimensione nota |
| SplDoublyLinkedList | O(n) | O(1) | O(n)    | O(1)        | Frequenti inserimenti/rimozioni |
| SplHeap   | O(1)*   | O(log n)    | O(n)    | O(log n)    | Gestione priorità |
| SplObjectStorage | O(1) | O(1)    | O(1)    | O(1)        | Mappare oggetti a dati |
| Albero binario | O(log n) | O(log n) | O(log n) | O(log n) | Ricerche frequenti |

*Accesso solo all'elemento superiore

## Best practice

1. **Scegliere la struttura dati appropriata**: Per ottimizzare le prestazioni, scegliere la struttura dati più adatta al problema
2. **Valutare le operazioni più frequenti**: Se si effettuano molte ricerche, un albero binario o una hash map possono essere più adatti
3. **Considerare i requisiti di memoria**: Alcune strutture dati sono più efficienti di altre in termini di utilizzo della memoria
4. **Immutabilità quando appropriata**: Le strutture dati immutabili sono preferibili in contesti concorrenti o quando serve garantire l'integrità dei dati
5. **Documentare la scelta**: Spiegare nel codice perché è stata scelta una particolare struttura dati
6. **Usare le strutture dati integrate**: Preferire le classi SPL invece di implementazioni personalizzate quando possibile

## Esempio pratico: Sistema di gestione delle priorità

```php
<?php
// Sistema di gestione ticket con priorità

class Ticket {
    public $id;
    public $titolo;
    public $priorità;
    public $timestamp;
    
    public function __construct($id, $titolo, $priorità) {
        $this->id = $id;
        $this->titolo = $titolo;
        $this->priorità = $priorità;
        $this->timestamp = time();
    }
}

class SistemaPriorità {
    private $codaPriorità;
    private $mappaTicket;
    
    public function __construct() {
        // Usiamo una coda a priorità per l'ordinamento
        $this->codaPriorità = new SplPriorityQueue();
        // Usiamo un dizionario per l'accesso rapido per ID
        $this->mappaTicket = new SplObjectStorage();
    }
    
    public function aggiungiTicket($id, $titolo, $priorità) {
        $ticket = new Ticket($id, $titolo, $priorità);
        
        // La priorità combinata considera sia il livello di priorità che il timestamp
        // In questo modo, a parità di priorità, i ticket più vecchi vengono gestiti prima
        $prioritàCombinata = $priorità * 1000000 + (1000000 - ($ticket->timestamp % 1000000));
        
        $this->codaPriorità->insert($ticket, $prioritàCombinata);
        $this->mappaTicket->attach($ticket);
        
        return $ticket;
    }
    
    public function prossimoTicket() {
        if ($this->codaPriorità->isEmpty()) {
            return null;
        }
        
        $ticket = $this->codaPriorità->extract();
        $this->mappaTicket->detach($ticket);
        return $ticket;
    }
    
    public function contaTicket() {
        return $this->codaPriorità->count();
    }
    
    public function stampaTickets() {
        // Dobbiamo clonare la coda perché l'iterazione la consumerà
        $copia = clone $this->codaPriorità;
        $risultato = [];
        
        while (!$copia->isEmpty()) {
            $ticket = $copia->extract();
            $risultato[] = "ID: {$ticket->id}, Titolo: {$ticket->titolo}, Priorità: {$ticket->priorità}";
        }
        
        return $risultato;
    }
}

// Utilizzo del sistema
$sistema = new SistemaPriorità();

// Aggiungiamo alcuni ticket
$sistema->aggiungiTicket(101, "Bug critico nel login", 5);  // Alta priorità
$sistema->aggiungiTicket(102, "Miglioramento grafico", 2);   // Bassa priorità
$sistema->aggiungiTicket(103, "Crash nell'importazione", 4); // Media-alta priorità

// Stampiamo tutti i ticket in ordine di priorità
echo "Ticket in attesa (" . $sistema->contaTicket() . "):\n";
foreach ($sistema->stampaTickets() as $riga) {
    echo "- $riga\n";
}

// Elaboriamo il ticket con la più alta priorità
$prossimo = $sistema->prossimoTicket();
echo "\nElaborazione ticket: ID: {$prossimo->id}, Titolo: {$prossimo->titolo}\n";

// Verificare quanti ticket rimangono
echo "Ticket rimanenti: " . $sistema->contaTicket();
?>
```

---

Per approfondire, consultare la [documentazione ufficiale SPL](https://www.php.net/manual/en/book.spl.php) e gli [esempi di strutture dati in PHP](https://www.php.net/manual/en/spl.datastructures.php).
