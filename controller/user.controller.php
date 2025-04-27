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
                        $user->setPasswordChanged(1);
                        $this->model->updatePasswordChanged($user->getId(), $user->getPasswordChanged());
                        //Si es la primera vez que inicia sesión, redirigir a la página de cambio de contraseña
                        require_once '../view/sesion/cambiar_password.php';
                        exit();
                    } else {
                        //Guardamos datos de usuario en la sesion
                        //session_start();
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
        //Inicia sesion si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            $user_changing = $_POST['user']; //Usuario que está cambiando la contarseña


            //Recogemos el id del usuario (sesion o buscamos si no hay en sesion)
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $user_rol = $_SESSION['rol'];
                $user = $this->model->getUserByUsername($user_changing);
            } else {
                $user = $this->model->getUserByUsername($user_changing);
                if ($user) {
                    $user_id = $user->getId();
                    $user_rol = $user->getRol();
                } else {
                    $error = "Usuario no encontrado.";
                    require_once '../view/sesion/cambiar_password.php';
                    exit();
                }
            }

            //Comprobamos si el usuario ya ha cambiado anteriormente la contraseña
            if ($user->getPasswordChanged() == 0) {
                $error = "Debe actualizar la contraseña inicial.<br>Contacte con la empresa si tiene dudas.";
                require_once '../view/sesion/cambiar_password.php';
                exit();
            }

            // Validar que las contraseñas coincidan
            if ($new_password !== $confirm_password) {
                $error = "Las contraseñas no coinciden.";
                require_once '../view/sesion/cambiar_password.php';
                exit();
            }

            // Hashear la nueva contraseña si cumple con los requisitos
            $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{10,}$/';
            if (strlen($new_password) < 10 || !preg_match($pattern, $new_password)) {
                $error = "La contraseña debe tener al menos 10 caracteres (numeros y letras).";
                require_once '../view/sesion/cambiar_password.php';
                exit();
            }
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

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
                $error = "Error al cambiar la contraseña.";
                require_once '../view/sesion/cambiar_password.php';
                exit();
            }
        } else {
            $error = "Error al cambiar la contraseña.";
            require_once '../view/sesion/cambiar_password.php';
        }
    }



}


?>