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
}