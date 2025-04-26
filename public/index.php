<?php
require_once '../db/database.php';


// FrontController
if (!isset($_REQUEST['c'])) {

    session_start();
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión
    require_once '../view/sesion/sesion.php';
    exit();
} else {
    // Obtenemos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';

    // Instanciamos el controlador
    require_once "../controller/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;

    // Llamada a la accion a realizar
    call_user_func(array($controller, $accion));
}