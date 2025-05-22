<?php
require_once '../db/database.php';

//Para la simulacion de la instalacion de la base de datos debemos comprobar:
//1. Si la base de datos existe en modo local
//2. Si estamos en el modo servidor, no realizar directamente la instalación.
//Verificamos si la base de datos existe
$bdExiste = false;
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $bdName = 'gestion_rio_tollo'; //CAMBIAR PARA PRUEBAS DE INSTALACION !!
    $conexion = new mysqli($host, $user, $password);
    if (!$conexion->connect_error) {
        $resultado = $conexion->query("SHOW DATABASES LIKE '$bdName'");
        if ($resultado && $resultado->num_rows > 0) {
            $bdExiste = true;
        }
    }
    $conexion->close();    
}else{
    $bdExiste = true; //En servidor no se comprueba la base de datos
}


//Gestion de controladores y acciones
if (!isset($_REQUEST['c'])) {
    session_start();
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión
    if ($bdExiste) {
        require_once '../view/sesion/sesion.php'; //Login si ya hay bd
    } else {
        require_once 'instalacion.php'; //Instalacion si no hay bd
    }
} else {
    // Obtenemos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';

    //Instanciamos el controlador
    require_once "../controller/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;

    //Llamada a la accion a realizar
    call_user_func(array($controller, $accion));
}