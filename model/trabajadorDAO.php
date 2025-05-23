<?php
class TrabajadorDAO
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

    public function getTrabajosTrabajador($idTrabajador)
    {
        try {
            $sql = "SELECT t.*, tg.id_grupo, g.nombre AS nombre_grupo
                    FROM trabajos t
                    INNER JOIN trabajos_grupos tg ON t.id = tg.id_trabajo
                    INNER JOIN grupos g ON tg.id_grupo = g.id
                    INNER JOIN grupos_trabajadores gt ON g.id = gt.id_grupo
                    WHERE gt.id_trabajador = :id_trabajador";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_trabajador', $idTrabajador);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $trabajos = [];
            foreach ($result as $row) {
                $trabajo = new Trabajo(
                    $row['id'],
                    $row['nombre'],
                    $row['zona'],
                    $row['parcelas'],
                    $row['porcentaje'],
                    $row['finalizado'],
                    $row['hora_inicio'],
                    $row['hora_fin'],
                    $row['fecha'],
                    $row['anotaciones'],
                    $row['id_zona']
                );
                $trabajo->setIdGrupo($row['id_grupo']);
                $trabajo->setGrupoNombre($row['nombre_grupo']);
                $trabajos[] = $trabajo;
            }

            return $trabajos;
        } catch (Exception $e) {
            echo "Error al obtener trabajos: " . $e->getMessage();
        }
    }

    public function getTrabajador($idTrabajador)
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE id = :idTrabajador";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idTrabajador', $idTrabajador);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $trabajador = new Trabajador(
                    $result['id'],
                    $result['nombre'],
                    $result['apellido'],
                    $result['nombre_usuario'],
                    $result['contrasena'],
                    $result['contrasena_cambiada'],
                    $result['id_rol']
                );
                return $trabajador;
            } else {
                return null;
            }
        } catch (Exception $e) {
            echo "Error al obtener el trabajador: " . $e->getMessage();
        }
    }








}