<?php

// Accettiamo la richiesta di dati dal nostro progetto vue inserendo l'indirizzo nel quale esso viene caricato
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');
	
// Leggiamo il contenuto del file json e lo restituiamo come stringa
$thingStr = file_get_contents('data.json');

// Stampiamo il contenuto
echo $thingtStr;

?>