<?php
require_once '../model/jefeDAO.php';
require_once '../model/entitys/trabajo.php';
require_once '../model/entitys/grupo.php';
require_once '../model/entitys/zona.php';

class JefeController
{
    private $model;

    public function __construct()
    {
        $this->model = new JefeDAO();
    }

    public function index()
    {
        header('Location: ../view/jefe/jefe.php');
        //require_once '../view/jefe/jefe.php';

    }

    //Trabajos
    public function gestionTrabajos()
    {
        $rol = "jefe";
        $pagina = "gestion-trabajos";
        require_once '../view/header.php';
        $trabajosInfo = $this->model->getAllTrabajos(); //almacenamos los trabajos para pasarlos a la vista
        require_once '../view/jefe/gestionTrabajos.php';
        require_once '../view/footer.php';

    }

    public function editarTrabajo()
    {
        $rol = "jefe";
        $pagina = "editar-trabajo";
        $trabajoId = $_GET['id'] ?? null; //obtenemos el id del trabajo a editar si se ha pasado por la URL
        if ($trabajoId) {
            $trabajo = $this->model->getTrabajoById($trabajoId); //obtenemos el trabajo, para mostrarlo en el form
            $grupoNombre = $this->model->getGrupoByTrabajoId($trabajoId); //obtenemos el grupo al que pertenece el trabajo
            $trabajo->setGrupoNombre($grupoNombre); // Asignar el nombre del grupo al trabajo
        } else {
            $trabajo = null; //si no se ha pasado el id, no hay trabajo a editar
        }
        //Obtenemos los grupos/zonas para mostrarlos en el select del formulario
        $grupos = $this->model->getAllGrupos();
        $zonas = $this->model->getAllZonas();
        require_once '../view/header.php';
        require_once '../view/jefe/editarTrabajo.php';
        require_once '../view/footer.php';
    }

    public function guardarTrabajo()
    {
        $id_trabajo = $_POST['id'] ?? null; //Trabajo a editar
        $id_grupo = $_POST['grupo']; //Id del grupo seleccionado
        //Demás campos del formulario
        $nombre = $_POST['trabajo'];
        $zona = $this->model->getNameOfZona($_POST['zona']); //obtener nombre de la zona por id
        $parcelas = "";
        $porcentaje = $_POST['porcentaje'];
        $finalizado = $_POST['finalizado']; //0 o 1
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        $fecha = $_POST['fecha'];
        $grupo = $this->model->getNameOfGrupo($_POST['grupo']); //obtener nombre de grupo por id
        $anotaciones = $_POST['anotaciones'];
        //Validar campos:
        //...

        //Si son validos creamos el trabajo 
        $trabajo = new Trabajo(
            null,
            $nombre,
            $zona,
            $parcelas,
            $porcentaje,
            $finalizado,
            $hora_inicio,
            $hora_fin,
            $fecha,
            $anotaciones,
            $_POST['zona']
        );
        $trabajo->setGrupoNombre($grupo); // Asignar el nombre del grupo al trabajo
        /*echo $trabajo->getGrupoNombre(); // Para depurar, puedes eliminarlo después
        die();*/

        //Guardar o updatear el trabajo en la base de datos
        try {
            $this->model->getPdo()->beginTransaction(); // Iniciar transacción

            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $trabajo->setId($_POST['id']);
                $this->model->updateTrabajo($trabajo); // Actualizar datos del trabajo
                $this->model->actualizarGrupoTrabajo($trabajo->getId(), $id_grupo); // Actualizar grupo
            } else {
                $id_trabajo = $this->model->guardarTrabajo($trabajo); // Guardar trabajo y obtener el nuevo ID
                if (!$id_trabajo) {
                    throw new Exception("Error al guardar el trabajo. ID no generado.");
                }
                $this->model->asignarGrupoTrabajo($id_trabajo, $id_grupo); // Asignar grupo al nuevo trabajo
            }

            $this->model->getPdo()->commit();
            $this->gestionTrabajos();

        } catch (PDOException $e) {
            if ($this->model->getPdo()->inTransaction()) {
                $this->model->getPdo()->rollBack(); // Revertir transacción en caso de error
            }
            echo "Error al guardar el trabajo: " . $e->getMessage();
        }

    }

    public function eliminarTrabajo()
    {
        $rol = "jefe";
        $pagina = "eliminar-trabajo";
        $trabajoId = $_GET['id']; //obtener id por la url
        $this->model->eliminarTrabajo($trabajoId); //eliminar trabajo por id
        $trabajosInfo = $this->model->getAllTrabajos(); //obtenemos todos los trabajos para mostrarlos en la vista
        require_once '../view/header.php';
        require_once '../view/jefe/gestionTrabajos.php'; //mostramos la vista de trabajos
        require_once '../view/footer.php';
    }

    //Grupos
    public function gestionGrupos()
    {
        $rol = "jefe";
        $pagina = "gestion-grupos";
        $gruposInfo = $this->model->getAllGrupos(); //obtenemos todos los grupos para mostrarlos en la vista
        require_once '../view/header.php';
        require_once '../view/jefe/gestionGrupos.php';
        require_once '../view/footer.php';

    }

    public function visualizarProcesos()
    {
        $rol = "jefe";
        $pagina = "visualizar-procesos";
        require_once '../view/header.php';
        require_once '../view/jefe/visualizarProcesos.php';
        require_once '../view/footer.php';

    }



}
?>