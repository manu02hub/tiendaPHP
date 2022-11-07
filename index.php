<?php

//La API de TWIG me obliga a colocar estas lineas para utilizar la libreria

//Carga el fichero autoload.php
require_once 'vendor/autoload.php';

//Ubicacion de mis plantillas de Twig
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

//Ejecuta el render de la vista que yo quiero
//echo $twig->render('plantilla.twig');

//echo $twig->render('users/index.twig', ['mensaje' => 'MENSAJE', 'alumno' => 'DANIEL','dias'=>['lunes','martes','miercoles']]);
echo $twig->render('users/create.twig');