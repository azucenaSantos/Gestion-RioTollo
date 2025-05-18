<?php
class RrhhDAO
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

    //Trabajadores
    public function geAlltTrabajadores() //Todos los coordinadores y trabajadores
    {
        $sql = "SELECT * FROM usuarios WHERE id_rol = 30 OR id_rol = 40";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $trabajadores = [];
        foreach ($result as $row) {
            $trabajador = new Trabajador(
                $row['id'],
                $row['nombre'],
                $row['apellido'],
                $row['nombre_usuario'],
                $row['contrasena'],
                $row['contrasena_cambiada'],
                $row['id_rol']
            );
            $trabajadores[] = $trabajador;
        }

        return $trabajadores;
    }

    public function getTrabajadorById($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Trabajador(
                $row['id'],
                $row['nombre'],
                $row['apellido'],
                $row['nombre_usuario'],
                $row['contrasena'],
                $row['contrasena_cambiada'],
                $row['id_rol']
            );
        }
        return null;
    }

    public function getAllRoles()
    {
        $sql = "SELECT * FROM ms_roles WHERE id != 1"; //Excluimos el rol de admin
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $roles = [];
        foreach ($result as $row) {
            $rol = new Rol(
                $row['id'],
                $row['nombre']
            );
            $roles[] = $rol;
        }

        return $roles;
    }

    public function deleteTrabajador($id)
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    //Jefes
    public function getAllJefes()
    {
        $sql = "SELECT * FROM usuarios WHERE id_rol = 20 OR id_rol = 10";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $jefes = [];
        foreach ($result as $row) {
            $jefe = new Jefe(
                $row['id'],
                $row['nombre'],
                $row['apellido'],
                $row['nombre_usuario'],
                $row['contrasena'],
                $row['contrasena_cambiada'],
                $row['id_rol']
            );
            $jefes[] = $jefe;
        }

        return $jefes;
    }

    public function getJefeById($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Jefe(
                $row['id'],
                $row['nombre'],
                $row['apellido'],
                $row['nombre_usuario'],
                $row['contrasena'],
                $row['contrasena_cambiada'],
                $row['id_rol']
            );
        }
        return null;
    }

    public function deleteJefe($id)
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    //Guardado de jefe y/o trabajador
    public function updateTrabajador($trabajador)
    {
        $sql = "UPDATE usuarios SET nombre = :nombre, apellido = :apellido, nombre_usuario = :nombre_usuario, id_rol = :id_rol WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $id = $trabajador->getId();
        $nombre = $trabajador->getName();
        $apellido = $trabajador->getSurname();
        $nombre_usuario = $trabajador->getUsername();
        $id_rol = $trabajador->getRol();

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':id_rol', $id_rol);

        return $stmt->execute();

    }

    public function createTrabajador($trabajador)
    {
        $sql = "INSERT INTO usuarios (nombre, apellido, nombre_usuario,contrasena, contrasena_cambiada, id_rol) 
        VALUES (:nombre, :apellido, :nombre_usuario,:contrasena,:contrasena_cambiada, :id_rol)";
        $stmt = $this->pdo->prepare($sql);

        $nombre = $trabajador->getName();
        $apellido = $trabajador->getSurname();
        $nombre_usuario = $trabajador->getUsername();
        $contrasena = $trabajador->getPassword();
        $contrasena_cambiada = $trabajador->getPasswordChanged();
        $id_rol = $trabajador->getRol();


        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':contrasena_cambiada', $contrasena_cambiada);
        $stmt->bindParam(':id_rol', $id_rol);
        return $stmt->execute();
    }

}