<?php

// Permetto l'accesso ai dati dal dominio specificato
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");

// Imposto l'intestazione per indicare al client che la risposta è in formato JSON
header('Content-Type: application/json');

// Percorso del file contenente i dati JSON
$file = "data.json";

// Ottengo i dati inviati tramite richiesta POST
$newThing = $_POST;

// Leggo i dati dal file JSON come stringa
$dataStr = file_get_contents($file);

// Decodifico la stringa JSON in un array associativo
$data = json_decode($dataStr, true);

// Verifico se il nuovo dato è già presente nell'array
$isDuplicate = false;
foreach ($data as $item) {
  if ($item == $newThing) {
    $isDuplicate = true;
    break;
  }
}

// Se il dato è duplicato, non aggiungere nulla
if ($isDuplicate === false) {
    // Aggiungo i nuovi dati alla variabile $data
    $data[] = $newThing;
}

  // Codifico i dati in formato JSON
  $encData = json_encode($data);

  // Scrivo i dati nel file JSON
  file_put_contents($file, $encData);

  // Restituisco i dati codificati come risposta
  echo $encData;

?>
