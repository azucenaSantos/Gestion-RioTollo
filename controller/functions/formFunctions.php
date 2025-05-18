<?php
//Archivo para funciones de validacion de formularios

//Validar vacio de campos
function validarCampoVacio($campo, $nombreCampo)
{
    if (empty($campo)) {
        return "El campo <strong> $nombreCampo </strong> no puede estar vacío.";
    }
    return false;
}

//Validar longitud de campos
function validarLongitudCampo($campo, $nombreCampo, $longitudMinima, $longitudMaxima)
{
    if (strlen($campo) < $longitudMinima || strlen($campo) > $longitudMaxima) {
        return "El campo" . $nombreCampo . " debe tener entre $longitudMinima y $longitudMaxima caracteres.";
    }
    return false;
}

//Validar un campo null
function validarCampoNull($campo, $nombreCampo)
{
    if ($campo == null) {
        return "No se ha seleccionado el campo <strong>$nombreCampo.</strong>";
    }
    return false;
}

//Validar un array vacio
function validarArrayVacio($array, $nombreCampo)
{
    if (empty($array)) {
        return "El campo <strong>$nombreCampo </strong> debe tener al menos 1 elemento seleccionado.";
    }
    return false;
}

//Validar una fecha válida
function validarFecha($fecha, $nombreCampo)
{
    $fechaFormateada = DateTime::createFromFormat('Y-m-d', $fecha);
    if (!$fechaFormateada || $fechaFormateada->format('Y-m-d') !== $fecha) {
        return "El campo <strong>$nombreCampo</strong> no es una fecha válida.";
    }
    return false;
}

//Funcion validar campo de solo letras
function validarCampoLetras($campo, $nombreCampo)
{
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]*$/", $campo)) {
        return "El campo <strong>$nombreCampo</strong> solo puede contener letras.";
    }
    return false;
}

//Funcion para validar un campo de solo letras y numeros
function validarCampoLetrasNumeros($campo, $nombreCampo)
{
    if (!preg_match("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]*$/", $campo)) {
        return "El campo <strong>$nombreCampo</strong> solo puede contener letras y números.";
    }
    return false;
}

?>