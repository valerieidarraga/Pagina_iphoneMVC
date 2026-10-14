<?php

require_once 'conexion.php';
require_once 'controllers/SiteController.php';

$controlador = new SiteController($conexion);

$controlador->manejarPeticion();

?>