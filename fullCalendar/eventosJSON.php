<?php

// require_once 'models/Evento.php';
require_once 'controllers/EventoController.php';
header('Content-type: application/json');
$arr = EventoController::index();
echo '['.json_encode($arr).']';
?>

