<?php

// Permetto l'accesso ai dati dal dominio specificato
header("Access-Control-Allow-Origin: http://localhost:5174");
header("Access-Control-Allow-Headers: X-Requested-With");

// Imposto l'intestazione per indicare al client che la risposta è in formato JSON
header('Content-Type: application/json');

// Percorso del file contenente i dati JSON
$file = "data.json";

// Ottengo l'indice dell'elemento da rimuovere inviato tramite richiesta POST
$removeIndex = $_POST['commit']['index'];

// Leggo i dati dal file JSON come stringa
$dataStr = file_get_contents($file);

// Decodifico la stringa JSON in una variabile
$data = json_decode($dataStr);

// Rimuovo l'elemento dall'array utilizzando l'indice
if (isset($data[$removeIndex])) {
    unset($data[$removeIndex]);
}

// Riordino gli indici dell'array
$data = array_values($data);

// Codifico i dati in formato JSON
$encData = json_encode($data);

// Scrivo i dati nel file JSON
file_put_contents($file, $encData);

// Restituisco i dati codificati come risposta
echo $encData;
?>
