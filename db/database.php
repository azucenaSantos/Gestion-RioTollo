<?php
class Database
{
    public static function connect()
    {
        // Detectar si estamos en localhost o en un servidor en la nube
        if ($_SERVER['SERVER_NAME'] === 'localhost') {
            // Configuración para localhost
            $data = 'mysql:host=localhost;dbname=gestion_rio_tollo;charset=utf8';
            $username = 'azu';
            $password = '';
        } else {
            // Configuración para el servidor en la nube
            $data = 'mysql:host=sql309.infinityfree.com;dbname=if0_38520432_gestion_rio_tollo02;charset=utf8';
            $username = 'if0_38520432';
            $password = 'suneu2468';
        }

        try {
            // Crear la conexión PDO
            $pdo = new PDO($data, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            // Manejo de errores
            die('Error en la conexión: ' . $e->getMessage());
        }
    }
}