<?php
//Archivo para funciones de validacion de formularios

//Validar vacio de campos
function validarCampoVacio($campo, $nombreCampo)
{
    if (empty($campo)) {
        return "El campo $nombreCampo no puede estar vacío.";
    }
    return false;
}

//Validar longitud de campos
function validarLongitudCampo($campo, $nombreCampo, $longitudMinima, $longitudMaxima)
{
    if (strlen($campo) < $longitudMinima || strlen($campo) > $longitudMaxima) {
        return "El campo $nombreCampo debe tener entre $longitudMinima y $longitudMaxima caracteres.";
    }
    return false;
}
?>