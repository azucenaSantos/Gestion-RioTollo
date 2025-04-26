<?php

class JefeController
{
    private $model;

    public function __construct()
    {
        //$this->model = new JefeDAO();
    }

    public function index()
    {
        echo "Controlador de Jefe";
        require_once '../view/jefe/jefe.php';
    }

    public function gestionTrabajos()
    {
        echo "Controlador de Jefe";

        //require_once '../view/jefe/gestionTrabajos.php';
    }

    public function gestionGrupos()
    {
        require_once '../view/jefe/gestionGrupos.php';
    }

    public function visualizarProcesos()
    {
        require_once '../view/jefe/visualizarProcesos.php';
    }

}
?>