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
        header('Location: ../view/jefe/jefe.php');
        //require_once '../view/jefe/jefe.php';

    }

    public function gestionTrabajos()
    {
        $pagina = "gestion-trabajos";
        require_once '../view/header.php';
        require_once '../view/jefe/gestionTrabajos.php';
        require_once '../view/footer.php';

    }

    public function gestionGrupos()
    {
        $pagina = "gestion-grupos";
        require_once '../view/header.php';
        require_once '../view/jefe/gestionGrupos.php';
        require_once '../view/footer.php';

    }

    public function visualizarProcesos()
    {
        $pagina = "visualizar-procesos";
        require_once '../view/header.php';
        require_once '../view/jefe/visualizarProcesos.php';
        require_once '../view/footer.php';

    }

}
?>