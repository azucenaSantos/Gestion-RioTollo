<?php

function comprobarAcceso($rol)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if ($_SESSION['rol'] != $rol) {
        header('Location: ../view/errores/errorAcceso.php');
        exit();
    }
}
?>