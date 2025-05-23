<?php
class CoordiDAO
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

    public function getTrabajosCoordinador($id_coordinador)
    {
        try {
            $sql = "SELECT t.*, tg.id_grupo, g.nombre AS nombre_grupo
                    FROM trabajos t
                    INNER JOIN trabajos_grupos tg ON t.id = tg.id_trabajo
                    INNER JOIN grupos g ON tg.id_grupo = g.id
                    WHERE g.id_coordinador = :id_coordinador";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_coordinador', $id_coordinador);
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
    public function getIntegrantesGrupo($idGrupo)
    {
        try {
            $sql = "SELECT u.nombre, u.apellido
                FROM grupos g
                JOIN grupos_trabajadores gt ON g.id = gt.id_grupo
                JOIN usuarios u ON gt.id_trabajador = u.id
                WHERE g.id = :idGrupo"; // Cambiado de g.id_coordinador a g.id
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idGrupo', $idGrupo);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $integrantes = [];
            foreach ($result as $row) {
                $integrante = new Trabajador(
                    null,
                    $row['nombre'],
                    null,
                    null,
                    null,
                    null,
                    null
                );
                $integrantes[] = $integrante;
            }
            return $integrantes;
        } catch (Exception $e) {
            echo "Error al obtener integrantes del grupo: " . $e->getMessage();
        }
    }

    public function registrarReporte($trabajo)
    {
        try {
            $sql = "INSERT INTO trabajos_registro (id_trabajo, id_grupo, porcentaje_inicial,porcentaje_final, hora_inicio, hora_fin, fecha) 
                    VALUES (:id_trabajo, :id_grupo, :porcentaje_inicio,:porcentaje_final, :hora_inicio, :hora_fin, :fecha)";
            $stmt = $this->pdo->prepare($sql);
            $idTrabajo = $trabajo->getId();
            $idGrupo = $trabajo->getIdGrupo();
            $porcentajeInicio = $trabajo->getPorcentaje();
            $porcentajeFinal = $trabajo->getPorcentajeFinal();
            $horaInicio = $trabajo->getHoraInicio();
            $horaFin = $trabajo->getHoraFin();
            $fecha = $trabajo->getFecha();
            $stmt->bindParam(':id_trabajo', $idTrabajo);
            $stmt->bindParam(':id_grupo', $idGrupo);
            $stmt->bindParam(':porcentaje_inicio', $porcentajeInicio);
            $stmt->bindParam(':porcentaje_final', $porcentajeFinal);
            $stmt->bindParam(':hora_inicio', $horaInicio);
            $stmt->bindParam(':hora_fin', $horaFin);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error al registrar el reporte: " . $e->getMessage();
        }

    }

    public function getInfoTrabajo($idTrabajo)
    {
        try {
            $sql = "SELECT t.*, g.nombre AS nombre_grupo
                    FROM trabajos t
                    LEFT JOIN trabajos_grupos tg ON t.id = tg.id_trabajo
                    LEFT JOIN grupos g ON tg.id_grupo = g.id
                    WHERE t.id = :idTrabajo";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idTrabajo', $idTrabajo);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return new Trabajo(
                    $result['id'],
                    $result['nombre'],
                    $result['zona'],
                    $result['parcelas'],
                    $result['porcentaje'],
                    $result['finalizado'],
                    $result['hora_inicio'],
                    $result['hora_fin'],
                    $result['fecha'],
                    $result['anotaciones'],
                    $result['id_zona']
                );
            } else {
                return null;
            }
        } catch (Exception $e) {
            echo "Error al obtener información del trabajo: " . $e->getMessage();
        }
    }

    public function actualizarTrabajo($trabajoActualizado)
    {
        try {
            $sql = "UPDATE trabajos 
                SET nombre = :nombre, zona = :zona, parcelas = :parcelas, porcentaje = :porcentaje, finalizado = :finalizado, 
                hora_inicio = :hora_inicio, hora_fin = :hora_fin, fecha = :fecha, anotaciones = :anotaciones, id_zona = :id_zona
                WHERE id = :id AND id_zona = :id_zona";
            $stmt = $this->pdo->prepare($sql);

            $id = $trabajoActualizado->getId();
            $nombre = $trabajoActualizado->getNombre();
            $zona = $trabajoActualizado->getZona();
            $parcelas = $trabajoActualizado->getParcelas();
            $porcentaje = $trabajoActualizado->getPorcentajeFinal();
            $finalizado = $trabajoActualizado->getFinalizado();
            $horaInicio = $trabajoActualizado->getHoraInicio();
            $horaFin = $trabajoActualizado->getHoraFin();
            $fecha = $trabajoActualizado->getFecha();
            $anotaciones = $trabajoActualizado->getAnotaciones();
            $idZona = $trabajoActualizado->getIdZona();

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':zona', $zona);
            $stmt->bindParam(':parcelas', $parcelas);
            $stmt->bindParam(':porcentaje', $porcentaje);
            $stmt->bindParam(':finalizado', $finalizado);
            $stmt->bindParam(':hora_inicio', $horaInicio);
            $stmt->bindParam(':hora_fin', $horaFin);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':anotaciones', $anotaciones);
            $stmt->bindParam(':id_zona', $idZona);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error al actualizar el trabajo: " . $e->getMessage();
        }

    }

    //Consultas de datos para el parte PDF
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