<?php

require_once 'functions/roleSesionValidation.php';

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
        comprobarAcceso(rol: 30);
        $rol = "coordinador";
        $pagina = "reportar-trabajos";
        require_once '../view/header.php';
        require_once '../view/coordinador/parte.php';
        require_once '../view/footer.php';

    }

    public function verParte()
    {
        comprobarAcceso(rol: 30);
        $rol = "coordinador";
        $pagina = "verParte";
        require_once '../view/header.php';
        require_once '../view/coordinador/reporte.php';
        require_once '../view/footer.php';
    }



}
?>