<?php

require_once 'functions/roleSesionValidation.php';
require_once '../model/coordiDAO.php';
require_once '../model/entitys/trabajo.php';
require_once '../model/entitys/trabajoRegistro.php';
require_once '../model/entitys/trabajador.php';


class CoordinadorController
{
    private $model;

    public function __construct()
    {
        $this->model = new CoordiDAO();
    }

    public function index()
    {
        header('Location: ../view/coordinador/coordinador.php');
    }

    //Reporte
    public function reportarTrabajos()
    {
        comprobarAcceso(rol: 30);
        $rol = "coordinador";
        $pagina = "reportar-trabajos";
        //El id del coordinador se obtiene de la sesión cuando la inicia
        if (!isset($_SESSION)) {
            session_start();
        }
        $idCoordinador = $_SESSION['user_id'];
        //Busamos los trabajos asociados al coordinador por su id
        $trabajosCoordinador = $this->model->getTrabajosCoordinador($idCoordinador);
        require_once '../view/header.php';
        require_once '../view/coordinador/reporte.php';
        require_once '../view/footer.php';

    }

    public function registrarReporte()
    {
        comprobarAcceso(rol: 30);
        $rol = "coordinador";
        $pagina = "reportar-trabajos";

        //Recoger datos del formulario
        $trabajoId = $_POST['trabajoSelect'];
        $grupo = $_POST['idGrupo']; //Campo hidden con el id del grupo
        $porcentajeNuevo = $_POST['porcentaje'];
        $hora_inicioNueva = $_POST['hora_inicio'];
        $hora_finNueva = $_POST['hora_fin'];
        $fechaNueva = $_POST['fecha'];

        //Validar datos
        //...
        $infoTrabajoAnterior = $this->model->getInfoTrabajo($trabajoId);
        $infoTrabajoAnterior->setIdGrupo($grupo);
        $infoTrabajoRegistro = new TrabajoRegistro(
            $trabajoId,
            $infoTrabajoAnterior->getNombre(),
            $infoTrabajoAnterior->getZona(),
            $infoTrabajoAnterior->getParcelas(),
            $infoTrabajoAnterior->getPorcentaje(),
            $porcentajeNuevo,
            $infoTrabajoAnterior->getFinalizado(),
            $hora_inicioNueva,
            $hora_finNueva,
            $fechaNueva,
            $infoTrabajoAnterior->getAnotaciones(),
            $infoTrabajoAnterior->getIdZona()
        );
        $infoTrabajoRegistro->setIdGrupo($grupo);
        try {
            //Registramos el reporte
            $this->model->registrarReporte($infoTrabajoRegistro);
            //Actualizamos el estado del trabajo
            $this->model->actualizarTrabajo($infoTrabajoRegistro);
            //Redirigir a la página de reportes
            $idCoordinador = $_SESSION['user_id'];
            //Busamos los trabajos asociados al coordinador por su id
            $trabajosCoordinador = $this->model->getTrabajosCoordinador($idCoordinador);
            require_once '../view/header.php';
            require_once '../view/coordinador/reporte.php';
            require_once '../view/footer.php';
        } catch (Exception $e) {
            // Manejar el error
            echo "Error al registrar el reporte: " . $e->getMessage();
        }



    }

    //Recoger trabajos para mostrar en campos de formulario
    public function getInfoTrabajos()
    {
        if (isset($_GET['idTrabajo']) && is_numeric($_GET['idTrabajo'])) {
            $trabajoId = intval($_GET['idTrabajo']);
            try {
                require_once '../db/database.php';
                $db = Database::connect();

                $sql = "SELECT 
                        t.*,
                        g.nombre AS nombre_grupo, g.id AS id_grupo
                    FROM 
                        trabajos t
                    LEFT JOIN 
                        trabajos_grupos tg ON t.id = tg.id_trabajo
                    LEFT JOIN 
                        grupos g ON tg.id_grupo = g.id
                    WHERE 
                        t.id = ?";
                $query = $db->prepare($sql);
                $query->execute([$trabajoId]);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                header('Content-Type: application/json');
                echo json_encode(['trabajos' => $result]);
            } catch (Exception $e) {
                echo json_encode(['error' => 'Error al consultar la base de datos: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['error' => 'ID de zona no proporcionado o inválido']);
        }
    }

    //Parte
    public function verParte()
    {
        comprobarAcceso(rol: 30);
        $rol = "coordinador";
        $pagina = "verParte";
        //Para mostrar el parte de trabajo, se obtienen diferentes datos según el trabajador que lo solicita
        $idCoordinador = $_SESSION['user_id'];
        //Datos del trabajador
        $trabajador = $this->model->getTrabajador($idCoordinador); //obj trabajador
        //Trabajos asociados
        $trabajosAsociados = $this->model->getTrabajosCoordinador($idCoordinador); //obj trabajo
        if ($trabajosAsociados == null) {
            $trabajosAsociados = [];
            $fechaTrabajos = date("d-m-Y"); //fecha actual en la que se genera el parte
        } else {
            $fechaTrabajos = date("d-m-Y", strtotime($trabajosAsociados[0]->getFecha())); //fecha del primer trabajo
        }
        //Vista para crear el PDF del parte de trabajo
        require_once '../view/coordinador/generadorParte.php';
        require_once '../view/header.php';
        require_once '../view/coordinador/parte.php';
        require_once '../view/footer.php';
    }



}
?>