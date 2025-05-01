<?php

class CoordinadorController
{
    private $model;

    public function __construct()
    {
        //$this->model = new JefeDAO();
    }

    public function index()
    {
        header('Location: ../view/coordinador/coordinador.php');
        //require_once '../view/jefe/jefe.php';

    }

    public function reportarTrabajos()
    {
        $pagina = "reportar-trabajos";
        require_once '../view/header.php';
        require_once '../view/coordinador/parte.php';
        require_once '../view/footer.php';

    }

    public function verParte()
    {
        $pagina = "verParte";
        require_once '../view/header.php';
        require_once '../view/coordinador/reporte.php';
        require_once '../view/footer.php';
    }



}
?>