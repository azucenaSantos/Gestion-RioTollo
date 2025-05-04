<?php
//Archivo para la peticion ajax que devuelve las parcelas de una zona seleccionada
if (isset($_GET['zonaId'])) {
    $zonaId = intval($_GET['zonaId']);

    //Conexion bd
    require_once '../db/database.php';
    $db = Database::connect();

    $query = $db->prepare("SELECT num_parcela FROM zonas_parcelas WHERE id_zona = ?");
    $query->execute([$zonaId]);
    $result = $query->fetchAll(PDO::FETCH_COLUMN, 0);
    echo json_encode(['parcelas' => $result]); //devuelve un array con las parcelas de la zona seleccionada
} else {
    echo json_encode(['error' => 'Zona ID no proporcionado']);
}