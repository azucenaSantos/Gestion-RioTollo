<?php
require_once 'functions/roleSesionValidation.php';
require_once '../model/trabajadorDAO.php';
require_once '../model/entitys/trabajo.php';
require_once '../model/entitys/trabajoRegistro.php';
require_once '../model/entitys/trabajador.php';


class TrabajadorController
{
    private $model;

    public function __construct()
    {
        $this->model = new TrabajadorDAO();
    }

    public function index()
    {
        header('Location: ../view/trabajador/trabajador.php');
    }
 
    //Parte
    public function verParte()
    {
        comprobarAcceso(rol: 40);
        $rol = "trabajador";
        $pagina = "verParte";
        //Para mostrar el parte de trabajo, se obtienen diferentes datos según el trabajador que lo solicita
        $idTrabajador = $_SESSION['user_id'];
        //Datos del trabajador
        $trabajador = $this->model->getTrabajador($idTrabajador); 
        //Trabajos asociados
        $trabajosAsociados = $this->model->getTrabajosTrabajador($idTrabajador); 
        if ($trabajosAsociados == null) {
            $trabajosAsociados = [];
            $fechaTrabajos = date("d-m-Y"); //fecha actual en la que se genera el parte
        } else {
            //Buscamos los integrantes de los grupos asociados al coordinador
            $fechaTrabajos = date("d-m-Y", strtotime($trabajosAsociados[0]->getFecha())); //fecha del primer trabajo
        }
        //Vista para crear el PDF del parte de trabajo
        require_once '../view/trabajador/generadorParte.php';
        require_once '../view/header.php';
        require_once '../view/trabajador/parte.php';
        require_once '../view/footer.php';
    }



}
?>