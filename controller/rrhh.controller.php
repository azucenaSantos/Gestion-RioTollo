<?php
require_once '../model/rrhhDAO.php';
require_once '../model/entitys/trabajador.php';

class RrhhController
{
    private $model;

    public function __construct()
    {
        $this->model = new RrhhDAO();
    }

    public function index()
    {
        header('Location: ../view/rrhh/rrhh.php');
        //require_once '../view/jefe/jefe.php';

    }

    //Trabajadores
    public function gestionTrabajadores()
    {
        $rol = "rrhh";
        $pagina = "gestion-trabajadores";
        require_once '../view/header.php';
        $trabajadoresInfo = $this->model->geAlltTrabajadores();
        require_once '../view/rrhh/gestionTrabajadores.php';
        require_once '../view/footer.php';

    }

    public function editarTrabajador()
    {
        $rol = "rrhh";
        $pagina = "editar-trabajador";
        require_once '../view/header.php';
        // $trabajador = $this->model->getTrabajadorById($_GET['id']);
        // require_once '../view/rrhh/editarTrabajador.php';
        require_once '../view/footer.php';

    }

    public function eliminarTrabajador()
    {
        // $this->model->deleteTrabajador($_GET['id']);
        header('Location: ../public/index.php?c=Rrhh&a=gestionTrabajadores');
    }

    //Jefes
    public function gestionJefes()
    {
        $rol = "rrhh";
        $pagina = "gestion-jefes";
        require_once '../view/header.php';
        require_once '../view/rrhh/gestionJefes.php';
        require_once '../view/footer.php';
    }

    public function editarJefe()
    {
        $rol = "rrhh";
        $pagina = "editar-jefes";
        require_once '../view/header.php';
        // $jefe = $this->model->getJefeById($_GET['id']);
        // require_once '../view/rrhh/editarJefe.php';
        require_once '../view/footer.php';
    }

    public function eliminarJefe()
    {
        // $this->model->deleteJefe($_GET['id']);
        header('Location: ../public/index.php?c=Rrhh&a=gestionJefes');
    }





}
?>