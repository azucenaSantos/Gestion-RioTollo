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
           $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model->getUserByUsername($username);

            if ($user && password_verify($password, $user->getPassword())) {
                echo "Usuario encontrado";
                session_start();
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['username'] = $user->getName();
                $_SESSION['rol'] = $user->getRol();

                //Redirgir a la página correspondiente según el rol
                /*switch ($user->getRol()) {
                    case '10':
                        header('Location: ../view/admin/dashboard.php');
                        break;
                    case '20':
                        header('Location: ../view/user/dashboard.php');
                        break;
                    case '30':
                        header('Location: ../view/user/dashboard.php');
                        break;
                    case '40':
                        header('Location: ../view/user/dashboard.php');
                        break;
                    default:
                        header('Location: ../view/sesion/sesion.php');
                        break;
                }
                exit();*/
                header('Location: ../view/jefe/prueba.php');
            } else {
                $error = "Usuario o contraseña incorrectos.";
                require_once '../view/sesion/sesion.php';
            }
        }
    }

}
?>