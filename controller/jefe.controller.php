<?php
require_once '../model/jefeDAO.php';
require_once '../model/entitys/trabajo.php';
require_once '../model/entitys/grupo.php';
require_once '../model/entitys/zona.php';
require_once '../model/entitys/parcela.php';
require_once '../model/entitys/trabajador.php';
require_once 'functions/formFunctions.php';
require_once 'functions/roleSesionValidation.php';


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
        comprobarAcceso(rol: 10);
        $rol = "jefe";
        $pagina = "gestion-trabajos";
        require_once '../view/header.php';
        $trabajosInfo = $this->model->getAllTrabajos(); //almacenamos los trabajos para pasarlos a la vista
        require_once '../view/jefe/gestionTrabajos.php';
        require_once '../view/footer.php';
    }

    public function editarTrabajo()
    {
        comprobarAcceso(rol: 10);
        // if(empty($_POST) && isset($_GET['id'])){
        //     //Quiere decir que venimos de "Más informacion" del apartado visualiar procesos
        //     $trabajoId = $_GET['id'];
        //     $trabajo = $this->model->getTrabajoById($trabajoId); //obtenemos el trabajo, para mostrarlo en el form            
        // }
        $rol = "jefe";
        $pagina = "editar-trabajo";
        $trabajoId = $_GET['id'] ?? null; //obtenemos el id del trabajo a editar si se ha pasado por la URL
        if ($trabajoId) {
            $trabajo = $this->model->getTrabajoById($trabajoId); //obtenemos el trabajo, para mostrarlo en el form
            $grupoNombre = $this->model->getGrupoByTrabajoId($trabajoId); //obtenemos el grupo al que pertenece el trabajo
            $trabajo->setGrupoNombre($grupoNombre); //Asignar el nombre del grupo al trabajo
            $parcelas = $this->model->getParcelasByZona($trabajo->getIdZona());
            $parcelasSeleccionadas = $this->model->getParcelasByTrabajo($trabajoId); //array de ids de las parcelas
        } else {
            $trabajo = null; //si no se ha pasado el id, no hay trabajo a editar
            $fecha = date('Y-m-d', strtotime('+1 day')); //si no hay trabajo, la fecha es mañana
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
        comprobarAcceso(rol: 10);
        $rol = "jefe";
        $pagina = "guardar-trabajo";
        $id_trabajo = $_POST['id'] ?? null; //Trabajo a editar
        $nombre = htmlspecialchars(trim(strip_tags($_POST['trabajo'])), ENT_QUOTES, "ISO-8859-1");
        $zona = isset($_POST['zona']) ? $this->model->getNameOfZona($_POST['zona']) : null;
        $id_zona = $_POST['zona'] ?? null;
        $parcelasSeleccionadas = $_POST['opcionesSeleccionadas'] ?? []; //Ids de las parcelas
        //Obtengo el nombre de cada una de las parcelas
        $parcelasNumeros = [];
        foreach ($parcelasSeleccionadas as $parcela) {
            $parcelasNumeros[] = $this->model->getNumerosParcela($parcela);
        }
        $parcelas = implode(", ", $parcelasNumeros);
        $porcentaje = $_POST['porcentaje'];
        $finalizado = isset($_POST['finalizado']) ? $_POST['finalizado'] : null;
        $hora_inicio = htmlspecialchars(trim(strip_tags($_POST['hora_inicio'])), ENT_QUOTES, "ISO-8859-1");
        $hora_fin = htmlspecialchars(trim(strip_tags($_POST['hora_fin'])), ENT_QUOTES, "ISO-8859-1");
        $fecha = $_POST['fecha'];
        $id_grupo = $_POST['grupo'] ?? null; //Id del grupo seleccionado o null si no existe
        $anotaciones = htmlspecialchars(trim(strip_tags($_POST['anotaciones'])), ENT_QUOTES, "ISO-8859-1");


        //Validar campos:
        $cadenaErrores = [];
        if (validarCampoVacio($nombre, "Trabajo")) {
            $cadenaErrores[] = validarCampoVacio($nombre, "Trabajo");
            $nombre = "";
        } else {
            $nombre = htmlspecialchars(trim(strip_tags($nombre)), ENT_QUOTES, "ISO-8859-1");
        }

        if (validarCampoNull($zona, "Zona")) {
            $cadenaErrores[] = validarCampoNull($zona, "Zona");
            $zonaSeleccionar = null;
        } else {
            $zonaSeleccionar = htmlspecialchars(trim(strip_tags($zona)), ENT_QUOTES, "ISO-8859-1");
        }

        if (validarArrayVacio($parcelasSeleccionadas, "Parcelas")) {
            $cadenaErrores[] = validarArrayVacio($parcelasSeleccionadas, "Parcelas");
        }

        if (validarCampoNull($finalizado, "Finalizado")) {
            $cadenaErrores[] = validarCampoNull($finalizado, "Finalizado");
        } else {
            $finalizado = htmlspecialchars(trim(strip_tags($finalizado)), ENT_QUOTES, "ISO-8859-1");
        }

        if (validarCampoVacio($hora_inicio, "Hora Inicio")) {
            $cadenaErrores[] = validarCampoVacio($hora_inicio, "Hora Inicio");
            $hora_inicio = "";
        } else {
            $hora_inicio = htmlspecialchars(trim(strip_tags($hora_inicio)), ENT_QUOTES, "ISO-8859-1");
        }

        if (validarCampoVacio($hora_fin, "Hora Fin")) {
            $cadenaErrores[] = validarCampoVacio($hora_fin, "Hora Fin");
            $hora_fin = "";
        } else {
            $hora_fin = htmlspecialchars(trim(strip_tags($hora_fin)), ENT_QUOTES, "ISO-8859-1");
        }

        if (validarFecha($fecha, "Fecha")) {
            $cadenaErrores[] = validarFecha($fecha, "Fecha");
            $fecha = "";
        } else {
            $fecha = htmlspecialchars(trim(strip_tags($fecha)), ENT_QUOTES, "ISO-8859-1");
        }

        if (validarCampoNull($id_grupo, "Grupo")) {
            $cadenaErrores[] = validarCampoNull($id_grupo, "Grupo");
            $id_grupo = null;
        } else {
            $id_grupo = htmlspecialchars(trim(strip_tags($id_grupo)), ENT_QUOTES, "ISO-8859-1");
        }

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
            $id_zona
        );



        //Si hay errores se muestran en el formulario
        if (!empty($cadenaErrores)) {
            $rol = "jefe";
            $pagina = "editar-trabajo";
            $trabajoId = $_POST['id'] ?? null;

            if ($trabajoId) {
                $grupoNombre = $this->model->getGrupoByTrabajoId($trabajoId); //obtenemos el grupo al que pertenece el trabajo
                $trabajo->setGrupoNombre($grupoNombre); // Asignar el nombre del grupo al trabajo
                $parcelas = $this->model->getParcelasByZona($trabajo->getIdZona());
            } else {
                $trabajo = null; //si no se ha pasado el id, no hay trabajo a editar
            }
            $grupos = $this->model->getAllGrupos();
            $zonas = $this->model->getAllZonas();
            //Aseguramos que tenemos parcelas tengamos o no trabajo
            if ($zona !== null) {
                $parcelas = $this->model->getParcelasByZona($id_zona);
            }
            require_once '../view/header.php';
            require_once '../view/jefe/editarTrabajo.php';
            require_once '../view/footer.php';
            return;
        }

        //Guardar o updatear el trabajo en la base de datos
        try {
            $this->model->getPdo()->beginTransaction(); //Iniciar transacción
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $this->model->updateTrabajo($trabajo);
                $this->model->actualizarGrupoTrabajo($trabajo->getId(), $id_grupo);
                $this->model->actualizarParcelasTrabajo($trabajo->getId(), $parcelasSeleccionadas);
            } else {
                $id_trabajo = $this->model->guardarTrabajo($trabajo);
                $trabajo->setId($id_trabajo);

                if (!$id_trabajo) {
                    throw new Exception("Error al guardar el trabajo. ID no generado.");
                }
                $this->model->asignarGrupoTrabajo($id_trabajo, $id_grupo);
                $this->model->actualizarParcelasTrabajo($trabajo->getId(), $parcelasSeleccionadas);
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
        comprobarAcceso(rol: 10);

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

    //Zonas
    public function getTrabajosZonas()
    {
        try {
            require_once '../db/database.php';
            $db = Database::connect();
            //Consulta SQL para obtener os trabajos de cada zona y el porcentaje de cada trabajo realizado
            $query = $db->prepare("SELECT 
                    z.id AS zona_id, z.nombre AS zona_nombre, z.limites AS zona_limites,
                    t.id AS trabajo_id, t.nombre AS trabajo_nombre, t.porcentaje AS trabajo_porcentaje,
                    zp.id AS parcela_id, zp.num_parcela AS parcela_numero, zp.descripcion AS parcela_descripcion
                FROM zonas z
                LEFT JOIN zonas_parcelas zp ON zp.id_zona = z.id
                LEFT JOIN trabajos_parcelas tp ON tp.id_parcela = zp.id
                LEFT JOIN trabajos t ON t.id = tp.id_trabajo
                ORDER BY z.id, t.id, zp.num_parcela");

            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            //Agrupar info por zona
            $zonas = [];

            foreach ($result as $row) {
                $zonaId = $row['zona_id'];
                if (!isset($zonas[$zonaId])) {
                    $zonas[$zonaId] = [
                        'id' => $zonaId,
                        'nombre' => $row['zona_nombre'],
                        'limites' => $row['zona_limites'],
                        'parcelas' => [],
                        'porcentaje_total' => 0,
                        'parcelas_count' => 0
                    ];
                }
                if ($row['parcela_id']) {
                    $parcelaId = $row['parcela_id'];
                    if (!isset($zonas[$zonaId]['parcelas'][$parcelaId])) {
                        $zonas[$zonaId]['parcelas'][$parcelaId] = [
                            'id' => $parcelaId,
                            'num_parcela' => $row['parcela_numero'],
                            'descripcion' => $row['parcela_descripcion'],
                            'trabajos' => []
                        ];
                    }
                    $zonas[$zonaId]['parcelas'][$parcelaId]['trabajos'][] = [
                        'trabajo' => $row['trabajo_nombre'],
                        'porcentaje' => intval($row['trabajo_porcentaje'])
                    ];
                    // Sumamos el porcentaje y luego calculamos el promedio
                    $zonas[$zonaId]['porcentaje_total'] += intval($row['trabajo_porcentaje']);
                    $zonas[$zonaId]['parcelas_count']++;
                }
            }

            //Calculamos el porcentaje total de la zona como promedio
            foreach ($zonas as $zonaId => &$zona) {
                if ($zona['parcelas_count'] > 0) {
                    $zona['porcentaje_total'] = round($zona['porcentaje_total'] / $zona['parcelas_count']);
                } else {
                    //Si no hay parcelas el porcentaje es 0
                    $zona['porcentaje_total'] = 0;
                }
                //Eliminamos el contador
                unset($zona['parcelas_count']);
            }
            unset($zona);

            echo json_encode(array_values($zonas));


        } catch (PDOException $e) {
            echo json_encode(['error' => 'Error en la consulta: ' . $e->getMessage()]);
        }
    }


    //Grupos
    public function gestionGrupos()
    {
        comprobarAcceso(rol: 10);

        $rol = "jefe";
        $pagina = "gestion-grupos";
        $gruposInfo = $this->model->getAllGruposConNumeroIntegrantes();
        require_once '../view/header.php';
        require_once '../view/jefe/gestionGrupos.php';
        require_once '../view/footer.php';

    }

    public function editarGrupo()
    {
        comprobarAcceso(rol: 10);

        $rol = "jefe";
        $pagina = "editar-grupo";
        $grupoId = $_GET['id'] ?? null;
        $coordinadores = $this->model->getCoordinadores(); //obtenemos los coordinadores para mostrarlos en el select del formulario
        if ($grupoId) {
            $grupo = $this->model->getGrupoById($grupoId);
            $trabajadores = $this->model->geTrabajadores();
            $integrantesSeleccionados = $this->model->getIntegrantesByGrupoId($grupoId); //integrantes de un grupo 
            $coordinadorId = $grupo->getIdCoordinador();
        } else {
            $integrantesSeleccionados = [];
            $trabajadores = $this->model->geTrabajadores();
            $trabajo = null; //si no se ha pasado el id, no hay trabajo a editar
        }
        require_once '../view/header.php';
        require_once '../view/jefe/editarGrupo.php';
        require_once '../view/footer.php';
    }

    public function guardarGrupo()
    {
        comprobarAcceso(rol: 10);

        $id_grupo = $_POST['id'] ?? null; //Trabajo a editar
        $nombre = htmlspecialchars(trim(strip_tags($_POST['grupo'])), ENT_QUOTES, "ISO-8859-1");
        $integrantesSeleccionados = $_POST['integrantesSeleccionados'] ?? []; //Ids de los integrantes seleccionados
        $coordinador = $_POST['coordinador'] ?? null; //Id
        //Validar campos:

        $cadenaErrores = []; //array para almacenar los errores
        if (validarCampoVacio($nombre, "Grupo")) {
            $cadenaErrores[] = validarCampoVacio($nombre, "Grupo");
        } else {
            $nombreGrupo = htmlspecialchars(trim(strip_tags($nombre)), ENT_QUOTES, "ISO-8859-1");
        }

        if (validarCampoNull($coordinador, "Coordinador")) {
            $cadenaErrores[] = validarCampoNull($coordinador, "Coordinador");
        } else {
            $coordinadorSeleccionado = htmlspecialchars(trim(strip_tags($coordinador)), ENT_QUOTES, "ISO-8859-1");
        }

        if (validarArrayVacio($integrantesSeleccionados, "Integrantes")) {
            $cadenaErrores[] = validarArrayVacio($integrantesSeleccionados, "Integrantes");
        }

        //Si son validos creamos el grupo 
        $grupo = new Grupo(
            $id_grupo,
            $nombre,
            $coordinador
        );

        if (!empty($cadenaErrores)) {
            $rol = "jefe";
            $pagina = "editar-grupo";
            //Datos necesarios para visualizar el formulario en caso de errores
            $grupoId = $_POST['id'] ?? null;
            $coordinadores = $this->model->getCoordinadores();
            $trabajadores = $this->model->geTrabajadores();
            $integrantesIds = $grupoId ? $this->model->getIntegrantesByGrupoId($grupoId) : [];
            $coordinadorId = $grupoId ? $this->model->getGrupoById($grupoId)->getIdCoordinador() : null;
            require_once '../view/header.php';
            require_once '../view/jefe/editarGrupo.php';
            require_once '../view/footer.php';
            return; //Salir de la funcion en caso de errores
        }

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
        comprobarAcceso(rol: 10);

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
        comprobarAcceso(rol: 10);

        $rol = "jefe";
        $pagina = "visualizar-procesos";
        $zonas = $this->model->getAllZonas();
        require_once '../view/header.php';
        require_once '../view/jefe/visualizarProcesos.php';
        require_once '../view/footer.php';

    }



}
?>