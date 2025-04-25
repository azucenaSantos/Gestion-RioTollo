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
            $usuario = new User($row['id'], $row['nombre'], $row['apellido'], $row['contrasena'], $row['id_rol']);
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
            return new User($row['id'], $row['nombre'], $row['apellido'], $row['contrasena'], $row['id_rol']);
        } else {
            return null;
        }
    }
}
?>