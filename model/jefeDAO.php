<?php
class JefeDAO
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
    public function getPdo()
    {
        return $this->pdo; // Método para acceder a la conexión PDO
    }
    public function getAllTrabajos()
    {
        $sql = "
            SELECT 
                t.*,
                g.nombre AS nombre_grupo
            FROM 
                trabajos t
            LEFT JOIN 
                trabajos_grupos tg ON t.id = tg.id_trabajo
            LEFT JOIN 
                grupos g ON tg.id_grupo = g.id
            ORDER BY 
            t.id ASC 
        ";

        $result = $this->pdo->query($sql);
        $trabajos = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Verificar si ya existe el trabajo en el array
            if (!isset($trabajos[$row['id']])) {
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
                $trabajo->setGrupoNombre($row['nombre_grupo']);
                $trabajos[$row['id']] = $trabajo;  // Usar el ID como clave
            } else {
                // Si el trabajo ya existe, concatenar el nombre del grupo (si es necesario)
                $trabajos[$row['id']]->setGrupoNombre(
                    $trabajos[$row['id']]->getGrupoNombre() . ", " . $row['nombre_grupo']
                );
            }
        }

        return array_values($trabajos); // Devolver un array indexado numéricamente
    }
    public function getTrabajoById($id)
    {
        $sql = "SELECT * FROM trabajos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //El formateo de las horas está en la entidad Trabajo.
        if ($row) {
            return new Trabajo(
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
        }

        return null; // Si no se encuentra el trabajo, devuelve null
    }

    public function getAllGrupos()
    {
        $sql = "SELECT * FROM grupos";
        $result = $this->pdo->query($sql);
        $grupos = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $grupo = new Grupo(
                $row['id'],
                $row['nombre'],
                $row['id_coordinador']
            );
            array_push($grupos, $grupo);
        }

        return $grupos;
    }

    public function getGrupoByTrabajoId($id_trabajo)
    {
        $sql = "SELECT g.nombre FROM trabajos_grupos tg JOIN grupos g ON tg.id_grupo = g.id WHERE tg.id_trabajo = :id_trabajo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_trabajo', $id_trabajo, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row['nombre'];
        }

        return null;
    }

    public function getAllZonas()
    {
        $sql = "SELECT * FROM zonas";
        $result = $this->pdo->query($sql);
        $zonas = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $zona = new Zona(
                $row['id'],
                $row['nombre'],
                $row['limites']
            );
            array_push($zonas, $zona);
        }

        return $zonas;
    }

    public function getNameOfZona($id_zona)
    {
        $sql = "SELECT nombre FROM zonas WHERE id = :id_zona";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_zona', $id_zona, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row['nombre'];
        }

        return null; // Si no se encuentra la zona, devuelve null
    }

    public function getNameOfGrupo($id_grupo)
    {
        $sql = "SELECT nombre FROM grupos WHERE id = :id_grupo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_grupo', $id_grupo, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row['nombre'];
        }

        return null; // Si no se encuentra el grupo, devuelve null
    }
    public function guardarTrabajo($trabajo)
    {
        $sql = "INSERT INTO trabajos (nombre, zona, parcelas, porcentaje, finalizado, hora_inicio, hora_fin, fecha, anotaciones, id_zona) 
                VALUES (:nombre, :zona, :parcelas, :porcentaje, :finalizado, :hora_inicio, :hora_fin, :fecha, :anotaciones, :id_zona)";
        $stmt = $this->pdo->prepare($sql);

        // Asignar valores a variables
        $nombre = $trabajo->getNombre();
        $zona = $trabajo->getZona();
        $parcelas = $trabajo->getParcelas();
        $porcentaje = $trabajo->getPorcentaje();
        $finalizado = $trabajo->getFinalizado();
        $hora_inicio = $trabajo->getHoraInicio();
        $hora_fin = $trabajo->getHoraFin();
        $fecha = $trabajo->getFecha();
        $anotaciones = $trabajo->getAnotaciones();
        $id_zona = $trabajo->getIdZona();

        // Pasar las variables a bindParam
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':zona', $zona, PDO::PARAM_STR);
        $stmt->bindParam(':parcelas', $parcelas, PDO::PARAM_INT);
        $stmt->bindParam(':porcentaje', $porcentaje, PDO::PARAM_INT);
        $stmt->bindParam(':finalizado', $finalizado, PDO::PARAM_BOOL);
        $stmt->bindParam(':hora_inicio', $hora_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':hora_fin', $hora_fin, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':anotaciones', $anotaciones, PDO::PARAM_STR);
        $stmt->bindParam(':id_zona', $id_zona, PDO::PARAM_INT);

        $stmt->execute();

        // Devuelve el ID del trabajo recién creado
        return $this->pdo->lastInsertId();
    }

    public function updateTrabajo($trabajo)
    {
        $sql = "UPDATE trabajos 
            SET nombre = :nombre, zona = :zona, parcelas = :parcelas, porcentaje = :porcentaje, 
                finalizado = :finalizado, hora_inicio = :hora_inicio, hora_fin = :hora_fin, 
                fecha = :fecha, anotaciones = :anotaciones 
            WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        // Asignar valores a variables
        $id = $trabajo->getId();
        $nombre = $trabajo->getNombre();
        $zona = $trabajo->getZona();
        $parcelas = $trabajo->getParcelas();
        $porcentaje = $trabajo->getPorcentaje();
        $finalizado = $trabajo->getFinalizado();
        $hora_inicio = $trabajo->getHoraInicio();
        $hora_fin = $trabajo->getHoraFin();
        $fecha = $trabajo->getFecha();
        $anotaciones = $trabajo->getAnotaciones();

        // Pasar las variables a bindParam
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':zona', $zona, PDO::PARAM_STR);
        $stmt->bindParam(':parcelas', $parcelas, PDO::PARAM_STR);
        $stmt->bindParam(':porcentaje', $porcentaje, PDO::PARAM_INT);
        $stmt->bindParam(':finalizado', $finalizado, PDO::PARAM_BOOL);
        $stmt->bindParam(':hora_inicio', $hora_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':hora_fin', $hora_fin, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':anotaciones', $anotaciones, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function asignarGrupoTrabajo($id_trabajo, $id_grupo)
    {
        $sql = "INSERT INTO trabajos_grupos (id_trabajo, id_grupo) VALUES (:id_trabajo, :id_grupo)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_trabajo', $id_trabajo, PDO::PARAM_INT);
        $stmt->bindParam(':id_grupo', $id_grupo, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function actualizarGrupoTrabajo($id_trabajo, $id_grupo)
    {
        $sql_delete = "DELETE FROM trabajos_grupos WHERE id_trabajo = :id_trabajo";
        $stmt_delete = $this->pdo->prepare($sql_delete);
        $stmt_delete->bindParam(':id_trabajo', $id_trabajo, PDO::PARAM_INT);
        $stmt_delete->execute();

        $sql_insert = "INSERT INTO trabajos_grupos (id_trabajo, id_grupo) VALUES (:id_trabajo, :id_grupo)";
        $stmt_insert = $this->pdo->prepare($sql_insert);
        $stmt_insert->bindParam(':id_trabajo', $id_trabajo, PDO::PARAM_INT);
        $stmt_insert->bindParam(':id_grupo', $id_grupo, PDO::PARAM_INT);
        return $stmt_insert->execute();
    }

    public function eliminarTrabajo($id_trabajo)
    {
        $sql = "DELETE FROM trabajos WHERE id = :id_trabajo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_trabajo', $id_trabajo, PDO::PARAM_INT);
        return $stmt->execute();
    }








}