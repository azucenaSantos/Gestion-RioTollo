<?php
//Funcion para ejecutar archivos SQL de la creacion de las tablas de la base de datos
//Necesario para que la ejecucion de los archivos SQL funcione correctamente
function ejecutarArchivoSQL($mysqli, $archivo)
{
    $sql = file_get_contents($archivo);
    if (!$sql) {
        die("No se pudo leer el archivo $archivo");
    }
    if ($mysqli->multi_query($sql)) {
        do {
            if ($result = $mysqli->store_result()) {
                $result->free();
            }
        } while ($mysqli->more_results() && $mysqli->next_result());
        echo "Archivo $archivo ejecutado correctamente.\n";
    } else {
        die("Error en la ejecución del archivo $archivo: " . $mysqli->error);
    }
}
?>