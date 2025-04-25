<?php
class Database
{
    public static function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=gestion_rio_tollo;charset=utf8', 'azu', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}