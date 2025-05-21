<?php
require_once '../model/rrhhDAO.php';
require_once '../model/entitys/trabajador.php';
require_once '../model/entitys/rol.php';
require_once '../model/entitys/jefe.php';
require_once 'functions/formFunctions.php';
require_once 'functions/roleSesionValidation.php';


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
    }

    //Trabajadores
    public function gestionTrabajadores()
    {
        comprobarAcceso(20);
        $rol = "rrhh";
        $pagina = "gestion-trabajadores";
        require_once '../view/header.php';
        $trabajadoresInfo = $this->model->geAlltTrabajadores();
        require_once '../view/rrhh/gestionTrabajadores.php';
        require_once '../view/footer.php';
    }

    public function editarTrabajador()
    {
        comprobarAcceso(20);
        $rol = "rrhh";
        $pagina = "editar-trabajador";
        $trabajadorId = $_GET['id'] ?? null;
        if ($trabajadorId) {//sabemos que vamos a editar un trabajador, obtenemos sus datos
            $trabajador = $this->model->getTrabajadorById($trabajadorId);
        } else {
            $trabajador = null;
        }
        $roles = $this->model->getAllRoles();
        require_once '../view/header.php';
        require_once '../view/rrhh/editarTrabajador.php';
        require_once '../view/footer.php';

    }

    public function guardarTrabajador()
    {
        comprobarAcceso(20);
        $rol = "rrhh";
        $pagina = "editar-trabajador";
        //Recoger los datos del formulario
        $id = $_POST['id'] ?? "null";
        $nombre = $_POST['nombre'] ?? null;
        $apellidos = $_POST['apellidos'] ?? null;
        $usuario = $_POST['usuario'] ?? null;
        $idRol = $_POST['rol'] ?? null;
        //Validar los campos
        $cadenaErrores = [];

        //Nombre
        if (validarCampoVacio($nombre, "Nombre")) {
            $cadenaErrores[] = validarCampoVacio($nombre, "Nombre");
            $nombre = "";
        } else if (validarCampoLetras($nombre, "Nombre")) {
            $cadenaErrores[] = validarCampoLetras($nombre, "Nombre");
            $nombre = "";
        }

        //Apellidos
        if (validarCampoVacio($apellidos, "Apellidos")) {
            $cadenaErrores[] = validarCampoVacio($apellidos, "Apellidos");
            $apellidos = "";
        } else if (validarCampoLetras($apellidos, "Apellidos")) {
            $cadenaErrores[] = validarCampoLetras($apellidos, "Apellidos");
            $apellidos = "";
        }

        //Usuario
        if (validarCampoVacio($usuario, "Usuario")) {
            $cadenaErrores[] = validarCampoVacio($usuario, "Usuario");
            $usuario = "";
        } else if (validarCampoLetrasNumeros($usuario, "Usuario")) {
            $cadenaErrores[] = validarCampoLetrasNumeros($usuario, "Usuario");
            $usuario = "";
        }

        //Rol
        if (validarCampoNull($idRol, "Rol")) {
            $cadenaErrores[] = validarCampoNull($idRol, "Rol");
            $idRol = "";
        } else {
            $rolSeleccionar = $idRol;
        }
        //Crear el objeto trabajador
        $trabajador = new Trabajador($id, $nombre, $apellidos, $usuario, null, null, $idRol);

        //Comprobar si hay errores y mostrar el formulario de nuevo con los errores y campos erroneos vacios
        if (!empty($cadenaErrores)) {
            require_once '../view/header.php';
            $roles = $this->model->getAllRoles();
            require_once '../view/rrhh/editarTrabajador.php';
            require_once '../view/footer.php';
            return;
        }

        //Guardar o actualizar el trabajador
        if ($id) {
            $this->model->updateTrabajador($trabajador);
        } else {
            //Si estoy creando, se asigna la contraseña por defecto
            //La contraseña es un patron de (2 primeras letras apellido+ nombre completo+ 123), en minusculas
            $contraseñaDefecto = strtolower(substr($apellidos, 0, 2))
                . strtolower($nombre) . "123";
            //Hasheamos la contraseña
            $hashed_password = password_hash($contraseñaDefecto, PASSWORD_BCRYPT);
            //Asignamos la contraseña hasheada
            $trabajador->setPassword($hashed_password);
            $trabajador->setPasswordChanged(0);
            ;
            $this->model->createTrabajador($trabajador);
        }
        require_once '../view/header.php';
        $trabajadoresInfo = $this->model->geAlltTrabajadores();
        require_once '../view/rrhh/gestionTrabajadores.php';
        require_once '../view/footer.php';
    }

    public function eliminarTrabajador()
    {
        comprobarAcceso(20);
        $rol = "rrhh";
        $pagina = "gestion-trabajadores";
        $trabajadorId = $_GET['id'] ?? null;
        $this->model->deleteTrabajador($trabajadorId);
        require_once '../view/header.php';
        $trabajadoresInfo = $this->model->geAlltTrabajadores();
        require_once '../view/rrhh/gestionTrabajadores.php';
        require_once '../view/footer.php';

    }


    //Jefes
    public function gestionJefes()
    {
        comprobarAcceso(20);
        $rol = "rrhh";
        $pagina = "gestion-jefes";
        require_once '../view/header.php';
        $jefesInfo = $this->model->getAllJefes();
        require_once '../view/rrhh/gestionJefes.php';
        require_once '../view/footer.php';
    }

    public function editarJefe()
    {
        comprobarAcceso(20);
        $rol = "rrhh";
        $pagina = "editar-jefes";
        $jefeId = $_GET['id'] ?? null;
        if ($jefeId) {//sabemos que vamos a editar un jefe, obtenemos sus datos
            $jefe = $this->model->getJefeById($jefeId);
        } else {
            $jefe = null;
        }
        $roles = $this->model->getAllRoles();
        require_once '../view/header.php';
        require_once '../view/rrhh/editarJefe.php';
        require_once '../view/footer.php';
    }

    public function guardarJefe()
    {
        comprobarAcceso(20);
        $rol = "rrhh";
        $pagina = "editar-jefes";
        //Recoger los datos del formulario
        $id = $_POST['id'] ?? "null";
        $nombre = $_POST['nombre'] ?? null;
        $apellidos = $_POST['apellidos'] ?? null;
        $usuario = $_POST['usuario'] ?? null;
        $idRol = $_POST['rol'] ?? null;
        //Validar los campos
        $cadenaErrores = [];

        //Nombre
        if (validarCampoVacio($nombre, "Nombre")) {
            $cadenaErrores[] = validarCampoVacio($nombre, "Nombre");
            $nombre = "";
        } else if (validarCampoLetras($nombre, "Nombre")) {
            $cadenaErrores[] = validarCampoLetras($nombre, "Nombre");
            $nombre = "";
        }

        //Apellidos
        if (validarCampoVacio($apellidos, "Apellidos")) {
            $cadenaErrores[] = validarCampoVacio($apellidos, "Apellidos");
            $apellidos = "";
        } else if (validarCampoLetras($apellidos, "Apellidos")) {
            $cadenaErrores[] = validarCampoLetras($apellidos, "Apellidos");
            $apellidos = "";
        }

        //Usuario
        if (validarCampoVacio($usuario, "Usuario")) {
            $cadenaErrores[] = validarCampoVacio($usuario, "Usuario");
            $usuario = "";
        } else if (validarCampoLetrasNumeros($usuario, "Usuario")) {
            $cadenaErrores[] = validarCampoLetrasNumeros($usuario, "Usuario");
            $usuario = "";
        }

        //Rol
        if (validarCampoNull($idRol, "Rol")) {
            $cadenaErrores[] = validarCampoNull($idRol, "Rol");
            $idRol = "";
        } else {
            $rolSeleccionar = $idRol;
        }

        //Crear el objeto trabajador
        $jefe = new Trabajador($id, $nombre, $apellidos, $usuario, null, null, $idRol);

        //Comprobar si hay errores y mostrar el formulario de nuevo con los errores y campos erroneos vacios
        if (!empty($cadenaErrores)) {
            require_once '../view/header.php';
            $roles = $this->model->getAllRoles();
            require_once '../view/rrhh/editarJefe.php';
            require_once '../view/footer.php';
            return;
        }

        //Guardar o actualizar el trabajador
        if ($id) {
            $this->model->updateTrabajador($jefe);
        } else {
            //Si estoy creando, se asigna la contraseña por defecto
            //La contraseña es un patron de (2 primeras letras apellido+ nombre completo+ 123), en minusculas
            $contraseñaDefecto = strtolower(substr($apellidos, 0, 2))
                . strtolower($nombre) . "123";
            //Hasheamos la contraseña
            $hashed_password = password_hash($contraseñaDefecto, PASSWORD_BCRYPT);
            //Asignamos la contraseña hasheada
            $jefe->setPassword($hashed_password);
            $jefe->setPasswordChanged(0);
            $this->model->createTrabajador($jefe);
        }
        require_once '../view/header.php';
        $jefesInfo = $this->model->getAllJefes();
        require_once '../view/rrhh/gestionJefes.php';
        require_once '../view/footer.php';

    }

    public function eliminarJefe()
    {
        comprobarAcceso(20);
        $rol = "rrhh";
        $pagina = "gestion-jefes";
        $jefeId = $_GET['id'] ?? null;
        $this->model->deleteJefe($jefeId);
        require_once '../view/header.php';
        $jefesInfo = $this->model->getAllJefes();
        require_once '../view/rrhh/gestionJefes.php';
        require_once '../view/footer.php';
    }

    //Contraseña
    public function asignarContrasena()
    {
        comprobarAcceso(20);

        if (isset($_GET['usuarioId'])) {
            $usuarioId = intval($_GET['usuarioId']);
            //El nombre puede estar compuesto de varias palabras, recogemos el primer nombre
            $nombreFranccion = strtolower(trim(explode(' ', $_GET['nombre'])[0]));
            $nombre = strtolower(trim(preg_replace(
                '/[^a-zA-Z]/',
                '',
                iconv('UTF-8', 'ASCII//TRANSLIT', $nombreFranccion)
            ))); //primera parte del nombre sin tildes ni caracteres especiales
            $apellido = strtolower(substr(trim(preg_replace(
                '/[^a-zA-Z]/',
                '',
                iconv('UTF-8', 'ASCII//TRANSLIT', $_GET['apellidos'])
            )), 0, 2)); //apellidos sin tildes  ni caracteres especiales
            //Contraseña por defecto y hasheada
            $passwordPatron = "{$apellido}{$nombre}123";
            $passwordHasheada = password_hash($passwordPatron, PASSWORD_BCRYPT);

            //Conexion a bd
            require_once '../db/database.php';
            $db = Database::connect();

            //Consulta de actualizacion de la contraseña
            $sql = "UPDATE usuarios SET contrasena = :contrasena, contrasena_cambiada = :contrasena_camnbiada WHERE id = :id";
            $stmt = $db->prepare($sql);
            $contrasena_cambiada = 0;
            $stmt->bindParam(':contrasena', $passwordHasheada);
            $stmt->bindParam(':contrasena_camnbiada', $contrasena_cambiada);
            $stmt->bindParam(':id', $usuarioId);
            $stmt->execute();

            //Respuesta en JSON
            if ($stmt->rowCount() > 0) {
                echo json_encode([
                    'success' => true,
                    'message' => "Contraseña actualizada correctamente."
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al actualizar la contraseña.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'ID de usuario no proporcionado.']);
        }
    }






}
?>