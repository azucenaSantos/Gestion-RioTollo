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
            $usuario = new User($row['id'], $row['nombre'], $row['apellido'], $row['contrasena'], $row['contrasena_cambiada'], $row['id_rol']);
            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }

    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM usuarios WHERE nombre = :nombre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nombre', $username, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User($row['id'], $row['nombre'], $row['apellido'], $row['contrasena'], $row['contrasena_cambiada'], $row['id_rol']);
        } else {
            return null;
        }
    }
    public function updatePassword($user_id, $hashed_password)
    {
        $sql = "UPDATE usuarios SET contrasena = :contrasena WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':contrasena', $hashed_password);
        $stmt->bindParam(':id', $user_id);
        return $stmt->execute();
    }

    public function setPasswordChanged($user_id)
    {
        $sql = "UPDATE usuarios SET contrasena_cambiada = 1 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $user_id);
        return $stmt->execute();
    }
}
?>