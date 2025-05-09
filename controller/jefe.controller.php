<?php
require_once '../model/jefeDAO.php';
require_once '../model/entitys/trabajo.php';
require_once '../model/entitys/grupo.php';
require_once '../model/entitys/zona.php';
require_once '../model/entitys/parcela.php';
require_once '../model/entitys/trabajador.php';
require_once 'functions/formFunctions.php';

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
            $parcelas = $this->model->getParcelasByZona($trabajo->getIdZona());
            $parcelasSeleccionadas = $this->model->getParcelasByTrabajo($trabajoId); //array de ids de las parcelas
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
        $nombre = $_POST['trabajo'];
        $zona = $this->model->getNameOfZona($_POST['zona']); //obtener nombre de la zona por id
        $parcelasArray = $_POST['opcionesSeleccionadas'] ?? []; //Ids de las parcelas

        //Obtengo el nombre de cada una de las parcelas
        $parcelasNumeros = [];
        foreach ($parcelasArray as $parcela) {
            $parcelasNumeros[] = $this->model->getNumerosParcela($parcela);
        }
        $parcelas = implode(", ", $parcelasNumeros);

        $porcentaje = $_POST['porcentaje'];
        $finalizado = $_POST['finalizado']; //0 o 1
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        $fecha = $_POST['fecha'];
        $anotaciones = $_POST['anotaciones'];
        //Validar campos:
        //...

        //Si son validos creamos el trabajo 
        $trabajo = new Trabajo(
            $id_trabajo,
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
        //Guardar o updatear el trabajo en la base de datos
        try {
            $this->model->getPdo()->beginTransaction(); //Iniciar transacción
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $this->model->updateTrabajo($trabajo);
                $this->model->actualizarGrupoTrabajo($trabajo->getId(), $id_grupo);
                $this->model->actualizarParcelasTrabajo($trabajo->getId(), $parcelasArray);
            } else {
                $id_trabajo = $this->model->guardarTrabajo($trabajo);
                $trabajo->setId($id_trabajo);

                if (!$id_trabajo) {
                    throw new Exception("Error al guardar el trabajo. ID no generado.");
                }
                $this->model->asignarGrupoTrabajo($id_trabajo, $id_grupo);
                $this->model->actualizarParcelasTrabajo($trabajo->getId(), $parcelasArray);
            }
            $this->model->getPdo()->commit();
            header('Location: ?c=Jefe&a=gestionTrabajos');
            exit();
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

    //Parcelas
    public function getParcelas()
    {
        //Archivo para la peticion ajax que devuelve las parcelas de una zona seleccionada
        if (isset($_GET['zonaId'])) {
            $zonaId = intval($_GET['zonaId']);

            //Conexion bd
            require_once '../db/database.php';
            $db = Database::connect();

            $query = $db->prepare("SELECT id, num_parcela FROM zonas_parcelas WHERE id_zona = ?");
            $query->execute([$zonaId]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(['parcelas' => $result]); //devuelve un array con las parcelas de la zona seleccionada
        } else {
            echo json_encode(['error' => 'Zona ID no proporcionado']);
        }
    }

    //Grupos
    public function gestionGrupos()
    {
        $rol = "jefe";
        $pagina = "gestion-grupos";
        $gruposInfo = $this->model->getAllGruposConNumeroIntegrantes();
        require_once '../view/header.php';
        require_once '../view/jefe/gestionGrupos.php';
        require_once '../view/footer.php';

    }

    public function editarGrupo()
    {
        $rol = "jefe";
        $pagina = "editar-grupo";
        $grupoId = $_GET['id'] ?? null;
        $coordinadores = $this->model->getCoordinadores(); //obtenemos los coordinadores para mostrarlos en el select del formulario
        if ($grupoId) {
            $grupo = $this->model->getGrupoById($grupoId);
            $trabajadores = $this->model->geTrabajadores();
            $integrantesIds = $this->model->getIntegrantesByGrupoId($grupoId); //integrantes de un grupo 
            $coordinadorId = $grupo->getIdCoordinador();
        } else {
            $integrantesIds = [];
            $trabajadores = $this->model->geTrabajadores();
            $trabajo = null; //si no se ha pasado el id, no hay trabajo a editar
        }
        require_once '../view/header.php';
        require_once '../view/jefe/editarGrupo.php';
        require_once '../view/footer.php';
    }

    public function guardarGrupo()
    {
        $id_grupo = $_POST['id'] ?? null; //Trabajo a editar
        $nombre = htmlspecialchars(trim(strip_tags($_POST['grupo'])), ENT_QUOTES, "ISO-8859-1");
        $integrantesSeleccionados = $_POST['integrantesSeleccionados'] ?? []; //Ids de los integrantes seleccionados
        $coordinador = $_POST['coordinador']; //id
        //Validar campos:
        $cadenaErrores = []; //array para almacenar los errores
        if(!validarCampoVacio($nombre, "Grupo")){
            $cadenaErrores[] = validarCampoVacio($nombre, "Grupo");
        }
        

        //Si son validos creamos el grupo 
        $grupo = new Grupo(
            $id_grupo,
            $nombre,
            $coordinador
        );
        //Guardar o updatear el grupo en la base de datos
        try {
            $this->model->getPdo()->beginTransaction(); //Iniciar transacción
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $this->model->updateGrupo($grupo);
                $this->model->actualizarIntegrantesGrupo($grupo->getId(), $integrantesSeleccionados);
            } else {
                $id_grupo = $this->model->guardarGrupo($grupo);
                $grupo->setId($id_grupo);
                if (!$id_grupo) {
                    throw new Exception("Error al guardar el grupo. ID no generado.");
                }
                $this->model->actualizarIntegrantesGrupo($grupo->getId(), $integrantesSeleccionados);
            }
            $this->model->getPdo()->commit();
            header('Location: ?c=Jefe&a=gestionGrupos');
            exit();
        } catch (PDOException $e) {
            if ($this->model->getPdo()->inTransaction()) {
                $this->model->getPdo()->rollBack(); // Revertir transacción en caso de error
            }
            echo "Error al guardar el trabajo: " . $e->getMessage();
        }

    }

    public function eliminarGrupo()
    {
        $rol = "jefe";
        $pagina = "eliminar-grupo";
        $grupoId = $_GET['id']; //obtener id por la url
        $this->model->eliminarGrupo($grupoId); //eliminar trabajo por id
        $gruposInfo = $this->model->getAllGruposConNumeroIntegrantes(); //obtenemos todos los trabajos para mostrarlos en la vista
        require_once '../view/header.php';
        require_once '../view/jefe/gestionGrupos.php'; //mostramos la vista de trabajos
        require_once '../view/footer.php';
    }



    //Procesos
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