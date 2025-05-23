<?php
require_once '../model/userDAO.php';
require_once '../model/entitys/user.php';
require_once 'functions/roleSesionValidation.php';

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserDAO();
    }

    public function index()
    {
        require_once '../view/sesion/sesion.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $remember = isset($_POST['remember']);
            //Recoger el usuario por el username(nombre de usuario)
            $user = $this->model->getUserByUsername($username);

            //Comrpobamos si existe el usuario
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['name'] = $user->getName();
                $_SESSION['rol'] = $user->getRol();
                //Guardamos el nombre del rol para mostrarlo en el header
                $rolName = $this->model->getRolFromUser($user->getRol());
                $_SESSION['rol_name'] = $rolName;

                //Comprobar la contraseña
                if (password_verify($password, $user->getPassword())) {
                    //Primer inicio de sesion
                    if ($user->getPasswordChanged() == 0) {
                        $_SESSION['username'] = $user->getUsername(); //guardar para cambiar contraseña
                        header('Location: ../view/sesion/cambiar_password.php');
                        exit();
                    } else {
                        //Checkbox de recordar datos
                        if ($remember) {
                            setcookie('username', $username, time() + (86400 * 30), "/"); // 30 días
                            setcookie('password', $password, time() + (86400 * 30), "/");
                            setcookie('remember', '1', time() + (86400 * 30), "/"); //Estado del checkbox
                        } else {
                            //Si no está marcado el checkbox eliminamos las cookies
                            setcookie('username', '', time() - 3600, "/");
                            setcookie('password', '', time() - 3600, "/");
                            setcookie('remember', '', time() - 3600, "/");
                        }
                        //Redirigir al usuario según el rol
                        switch ($user->getRol()) {
                            case '1': //admin
                                //header('Location: ../view/admin/dashboard.php');
                                break;
                            case '10': //jefe
                                header('Location: ../view/jefe/jefe.php');
                                break;
                            case '20': //rrhh
                                header('Location: ../view/rrhh/rrhh.php');
                                break;
                            case '30': //coordinador
                                header('Location: ../view/coordinador/coordinador.php');
                                break;
                            case '40': //trabajador
                                header('Location: ../view/trabajador/trabajador.php');
                                break;
                            default:
                                header('Location: ../view/sesion/sesion.php');
                                break;
                        }
                        exit();
                    }
                } else {
                    $errorPassword = "Contraseña incorrecta.";
                    require_once '../view/sesion/sesion.php';
                    exit();
                }
            } else {

                $errorUser = "Usuario no encontrado.";
                require_once '../view/sesion/sesion.php';
                exit();

            }
        }
    }

    //Funcion para cambiar la contraseña
    public function changePassword()
    {


        //Inicia sesion si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            $user_changin = $_SESSION['username']; //nombre_usuario para modificar contraseña   
            $user_id = $_SESSION['user_id'];
            $user_rol = $_SESSION['rol'];

            //Validar que las contraseñas coincidan
            if ($new_password !== $confirm_password) {
                $error = "Las contraseñas no coinciden.";
                require_once '../view/sesion/cambiar_password.php';
                exit();
            }

            //Hashear la nueva contraseña si cumple con los requisitos
            $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{10,}$/';
            if (strlen($new_password) < 10 || !preg_match($pattern, $new_password)) {
                $error = "La contraseña debe tener al menos 10 caracteres (numeros y letras).";
                require_once '../view/sesion/cambiar_password.php';
                exit();
            }
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            //Actualizar la contraseña en la base de datos
            if ($this->model->updatePassword($user_id, $hashed_password)) {
                // Redirigir al usuario según su rol
                switch ($user_rol) {
                    case '1': // admin
                        //header('Location: ../view/admin/dashboard.php');
                        break;
                    case '10': // jefe
                        header('Location: ../view/jefe/jefe.php');
                        break;
                    case '20': // rrhh
                        header('Location: ../view/rrhh/rrhh.php');
                        break;
                    case '30': // coordinador
                        header('Location: ../view/coordinador/coordinador.php');
                        break;
                    case '40': // trabajador
                        header('Location: ../view/trabajador/trabajador.php');
                        break;
                    default:
                        header('Location: ../view/sesion/sesion.php');
                        break;
                }
                exit();
            } else {
                $error = "Error al cambiar la contraseña.";
                require_once '../view/sesion/cambiar_password.php';
                exit();
            }
        } else {
            $error = "Error al cambiar la contraseña.";
            require_once '../view/sesion/cambiar_password.php';
        }
    }

    //Funcion para cerrar sesion
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        setcookie('username', '', time() - 3600, "/");
        setcookie('password', '', time() - 3600, "/");
        setcookie('remember', '', time() - 3600, "/");
        //Redirigimos a la pagina de inicio de sesion (la principal)
        header('Location: ../public/index.php');
        exit();
    }
}


?>