<?php

// Permetto l'accesso ai dati dal dominio specificato
header("Access-Control-Allow-Origin: http://localhost:5175");
header("Access-Control-Allow-Headers: X-Requested-With");

// Imposto l'intestazione per indicare al client che la risposta è in formato JSON
header('Content-Type: application/json');

// Percorso del file contenente i dati JSON
$file = "data.json";

// Ottengo i dati inviati tramite richiesta POST
$newThing = $_POST;

// Aggiungo la chiave 'complete' con valore true ai nuovi dati
$newThing['complete'] = false;

// Leggo i dati dal file JSON come stringa
$dataStr = file_get_contents($file);

// Decodifico la stringa JSON in una variabile
// Aggiungendo il parametro true alla funzione json_decode, si ottiene un array associativo invece di un oggetto stdClass, consentendo così l'utilizzo dell'operatore [] per l'aggiunta di nuovi dati.
$data = json_decode($dataStr,true);

// Aggiungo i nuovi dati alla variabile $data
$data[] = $newThing;

// Codifico i dati in formato JSON
$encData = json_encode($data);

// Scrivo i dati nel file JSON
file_put_contents($file, $encData);

// Restituisco i dati codificati come risposta
echo $encData;

?>
