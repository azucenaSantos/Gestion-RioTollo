<?php
class UserDAO
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = Database::connect();
        } catch (Exception $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }


    /*public function getAllUsers()
    {
        $sql = "SELECT * FROM usuario";
        $result = $this->pdo->query($sql);
        $usuarios = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $usuario = new User($row['id'], $row['nombre'], $row['apellido'], $row['password'], $row['rol']);
            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }*/

    public function getUserByRol($rol)
    {
        $sql = "SELECT * FROM usuario WHERE rol = :rol";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':rol', $rol, PDO::PARAM_STR);
        $stmt->execute();
        $usuarios = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuario = new User($row['id'], $row['nombre'], $row['apellido'],$row['nombre_usuario'], $row['contrasena'], $row['contrasena_cambiada'], $row['id_rol']);
            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }

    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = :nombre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nombre', $username, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User($row['id'], $row['nombre'], $row['apellido'],$row['nombre_usuario'], $row['contrasena'], $row['contrasena_cambiada'], $row['id_rol']);
        } else {
            return null;
        }
    }

    public function getUserById($user_id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User($row['id'], $row['nombre'], $row['apellido'],$row['nombre_usuario'], $row['contrasena'], $row['contrasena_cambiada'], $row['id_rol']);
        } else {
            return null;
        }
    }
    public function updatePassword($user_id, $hashed_password, $contra_cambiada = 1) //Por defecto 1, en modo rrhh será 0
    {
        $sql = "UPDATE usuarios SET contrasena = :contrasena, contrasena_cambiada = :contrasena_cambiada WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':contrasena', $hashed_password);
        $stmt->bindParam(':contrasena_cambiada', $contra_cambiada);
        $stmt->bindParam(':id', $user_id);
        $result = $stmt->execute();
        // echo "<pre>" . print_r($stmt, return: 1) . "</pre>";
        return $result;
    }

    /*public function setPasswordChanged($user_id)
    {
        $sql = "UPDATE usuarios SET contrasena_cambiada = 1 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $user_id);
        return $stmt->execute();
    }*/

    /*public function updatePasswordChanged($user_id, $password_changed)
    {
        $sql = "UPDATE usuarios SET contrasena_cambiada = :contrasena_cambiada WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':contrasena_cambiada', $password_changed);
        $stmt->bindParam(':id', $user_id);
        return $stmt->execute();
    }*/

    //Funcion para obtener el nombre del rol de un usuario
    public function getRolFromUser($user_rol)
    {
        $sql = "SELECT nombre FROM ms_roles WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $user_rol, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row['nombre']; // Devuelve el nombre del rol
        } else {
            return null;
        }
    }
}
?>