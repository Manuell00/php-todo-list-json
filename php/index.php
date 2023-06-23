<?php

// Permettiamo l'accesso ai dati dal nostro progetto Vue specificando l'indirizzo da cui viene caricato
header("Access-Control-Allow-Origin: http://localhost:5175");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');
	
// Leggiamo il contenuto del file JSON e lo restituiamo come stringa
$thingStr = file_get_contents('data.json');

// Stampiamo il contenuto del file JSON
echo $thingtStr;

?>
