<?php
require_once '../model/userDAO.php';
require_once '../model/entitys/user.php';

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserDAO();
    }

    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Almacenamos los datos del formulario en variables
            $username = $_POST['username'];
            $password = $_POST['password'];
            $remember = isset($_POST['remember']);

            $user = $this->model->getUserByUsername($username);

            //Comrpobamos si existe el usuario y luego si es correcta la contraseña
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['username'] = $user->getName();
                $_SESSION['rol'] = $user->getRol();

                //Comprobar si la contraseña es correcta
                if (password_verify($password, $user->getPassword())) {
                    //Comprobar si es la primera vez que inicia sesión
                    if ($user->getPasswordChanged() == 0) {
                        //Si es la primera vez que inicia sesión, redirigir a la página de cambio de contraseña
                        require_once '../view/sesion/cambiar_password.php';
                        exit();
                    } else {
                        //Guardamos datos de usuario en la sesion
                        session_start();
                        $_SESSION['user_id'] = $user->getId();
                        $_SESSION['username'] = $user->getName();
                        $_SESSION['rol'] = $user->getRol();

                        //Comrpobamos si el checkbox de recordar datos está marcado
                        if ($remember) {
                            setcookie('username', $username, time() + (86400 * 30), "/"); // 30 días
                            setcookie('password', $password, time() + (86400 * 30), "/"); // 30 días
                            setcookie('remember', '1', time() + (86400 * 30), "/"); // Guarda el estado del checkbox
                        } else {
                            //Si no está marcado el checkbox eliminamos las cookies
                            setcookie('username', '', time() - 3600, "/");
                            setcookie('password', '', time() - 3600, "/");
                            setcookie('remember', '', time() - 3600, "/");
                        }

                        //Redirgir a la página correspondiente según el rol
                        switch ($user->getRol()) {
                            case '1': //admin
                                //header('Location: ../view/admin/dashboard.php');
                                break;
                            case '10': //jefe
                                header('Location: ../view/jefe/jefe.php');
                                break;
                            case '20': //rrhh
                                //header('Location: ../view/user/dashboard.php');
                                break;
                            case '30': //coordinador
                                //header('Location: ../view/user/dashboard.php');
                                break;
                            case '40': //traabajador
                                //header('Location: ../view/user/dashboard.php');
                                break;
                            default:
                                //header('Location: ../view/sesion/sesion.php');
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
        session_start();
        /*if (!isset($_SESSION['user_id'])) {
            // Redirigir al inicio de sesión si no hay sesión activa
            header('Location: ../view/sesion/sesion.php');
            exit();
        }*/

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            // Validar que las contraseñas coincidan
            if ($new_password !== $confirm_password) {
                $errorPassword = "Las contraseñas no coinciden.";
                require_once '../view/sesion/cambiar_password.php';
                exit();
            }

            // Hashear la nueva contraseña
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $user_id = $_SESSION['user_id'];

            // Actualizar la contraseña en la base de datos
            if ($this->model->updatePassword($user_id, $hashed_password)) {
                // Redirigir al usuario según su rol
                switch ($_SESSION['rol']) {
                    case '1': // admin
                        //header('Location: ../view/admin/dashboard.php');
                        break;
                    case '10': // jefe
                        header('Location: ../view/jefe/jefe.php');
                        break;
                    case '20': // rrhh
                        //header('Location: ../view/user/dashboard.php');
                        break;
                    case '30': // coordinador
                        //header('Location: ../view/user/dashboard.php');
                        break;
                    case '40': // trabajador
                        //header('Location: ../view/user/dashboard.php');
                        break;
                    default:
                        //header('Location: ../view/sesion/sesion.php');
                        break;
                }
                exit();
            } else {
                $errorPassword = "Error al cambiar la contraseña.";
                require_once '../view/sesion/cambiar_password.php';
                exit();
            }
        } else {
            $errorPassword = "Error al cambiar la contraseña.";
            require_once '../view/sesion/cambiar_password.php';
        }
    }


}


?>