<?php

class RrhhController
{
    private $model;

    public function __construct()
    {
        //$this->model = new JefeDAO();
    }

    public function index()
    {
        header('Location: ../view/rrhh/rrhh.php');
        //require_once '../view/jefe/jefe.php';

    }

    public function gestionTrabajos()
    {
        $rol = "rrhh";
        $pagina = "añadir-trabajos";
        require_once '../view/header.php';
        require_once '../view/rrhh/gestionTrabajadores.php';
        require_once '../view/footer.php';

    }

    public function gestionJefes()
    {
        $rol = "rrhh";
        $pagina = "añadir-jefe";
        require_once '../view/header.php';
        require_once '../view/rrhh/gestionJefes.php';
        require_once '../view/footer.php';

    }



}
?>