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

    public function getGrupoById($id_Grupo)
    {
        $sql = "SELECT * FROM grupos WHERE id = :idGrupo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idGrupo', $id_Grupo, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Grupo(
                $row['id'],
                $row['nombre'],
                $row['id_coordinador']
            );
        }
        return null;
    }

    public function getAllGruposConNumeroIntegrantes()
    {
        $sql = "SELECT g.id, g.nombre, g.id_coordinador, u.nombre AS nombre_coordinador, COUNT(gt.id_trabajador) as numero_integrantes
            FROM grupos g
            LEFT JOIN grupos_trabajadores gt ON g.id = gt.id_grupo
            LEFT JOIN usuarios u ON g.id_coordinador = u.id
            GROUP BY g.id";
        $result = $this->pdo->query($sql);
        $grupos = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $grupo = new Grupo(
            $row['id'],
            $row['nombre'],
            $row['id_coordinador']
            );
            $grupo->setIntegrantes($row['numero_integrantes']);
            $grupo->setNombreCoordinador($row['nombre_coordinador']); // Asumiendo que el método setNombreCoordinador existe en la clase Grupo
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

    public function getIntegrantesByGrupoId($id_Grupo)
    {
        $sql = "SELECT u.id FROM grupos_trabajadores gt JOIN usuarios u ON gt.id_trabajador = u.id WHERE gt.id_grupo = :idGrupo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idGrupo', $id_Grupo, PDO::PARAM_INT);
        $stmt->execute();
        $idsIntegrantes = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $idsIntegrantes[] = $row['id'];
        }
        return $idsIntegrantes;

    }

    public function getIdsIntegrantesByGrupoId($id_Grupo)
    {
        $sql = "SELECT id_trabajador FROM grupos_trabajadores WHERE id_grupo = :idGrupo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idGrupo', $id_Grupo, PDO::PARAM_INT);
        $stmt->execute();
        $idsIntegrantes = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $idsIntegrantes[] = $row['id_trabajador'];
        }

        return $idsIntegrantes;
    }

    public function getCoordinadores()
    {
        $sql = "SELECT * FROM usuarios WHERE id_rol = 30"; // Asumiendo que el rol de coordinador es 30
        $result = $this->pdo->query($sql);
        $coordinadores = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $coordinador = new Trabajador(
                $row['id'],
                $row['nombre'],
                $row['apellido'],
                $row['nombre_usuario'],
                $row['contrasena'],
                $row['contrasena_cambiada'],
                $row['id_rol']
            );
            array_push($coordinadores, $coordinador);
        }

        return $coordinadores;
    }

    public function geTrabajadores()
    {
        $sql = "SELECT * FROM usuarios WHERE id_rol = 40";
        $result = $this->pdo->query($sql);
        $trabajadores = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
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

    public function updateGrupo($grupo){
        $sql = "UPDATE grupos SET nombre = :nombre, id_coordinador = :id_coordinador WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        // Asignar valores a variables
        $id = $grupo->getId();
        $nombre = $grupo->getNombre();
        $id_coordinador = $grupo->getIdCoordinador();

        // Pasar las variables a bindParam
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':id_coordinador', $id_coordinador, PDO::PARAM_INT);

        return $stmt->execute();        
    }

    public function actualizarIntegrantesGrupo($id_grupo, $integrantesseleccionados){
        $sql_delete = "DELETE FROM grupos_trabajadores WHERE id_grupo = :id_grupo";
        $stmt_delete = $this->pdo->prepare($sql_delete);
        $stmt_delete->bindParam(':id_grupo', $id_grupo, PDO::PARAM_INT);
        $stmt_delete->execute();

        // Insertar nuevas asociaciones
        $sql_insert = "INSERT INTO grupos_trabajadores (id_grupo, id_trabajador) VALUES (:id_grupo, :id_trabajador)";
        $stmt_insert = $this->pdo->prepare($sql_insert);

        foreach ($integrantesseleccionados as $id_trabajador) {
            $stmt_insert->bindParam(':id_grupo', $id_grupo, PDO::PARAM_INT);
            $stmt_insert->bindParam(':id_trabajador', $id_trabajador, PDO::PARAM_INT);
            $stmt_insert->execute();
        }

        return true;
        
    }

    public function guardarGrupo($grupo){
        $sql = "INSERT INTO grupos (nombre, id_coordinador) VALUES (:nombre, :id_coordinador)";
        $stmt = $this->pdo->prepare($sql);

        // Asignar valores a variables
        $nombre = $grupo->getNombre();
        $id_coordinador = $grupo->getIdCoordinador();

        // Pasar las variables a bindParam
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':id_coordinador', $id_coordinador, PDO::PARAM_INT);

        $stmt->execute();

        // Devuelve el ID del trabajo recién creado
        return $this->pdo->lastInsertId();

    }

    public function eliminarGrupo($id_grupo)
    {
        $sql = "DELETE FROM grupos WHERE id = :id_grupo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_grupo', $id_grupo, PDO::PARAM_INT);
        return $stmt->execute();
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
                fecha = :fecha, anotaciones = :anotaciones, id_zona = :id_zona
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
        $id_zona = $trabajo->getIdZona();

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
        $stmt->bindParam(':id_zona', $id_zona, PDO::PARAM_INT);

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

    public function actualizarParcelasTrabajo($id_trabajo, $parcelas)//Recibe un array de parcelas, se recorre y se asigna al id del trabajo tantas veces como parcelas haya
    {
        // Eliminar todas las parcelas asociadas previamente
        $sql_delete = "DELETE FROM trabajos_parcelas WHERE id_trabajo = :id_trabajo";
        $stmt_delete = $this->pdo->prepare($sql_delete);
        $stmt_delete->bindParam(':id_trabajo', $id_trabajo, PDO::PARAM_INT);
        $stmt_delete->execute();

        // Insertar nuevas asociaciones
        $sql_insert = "INSERT INTO trabajos_parcelas (id_trabajo, id_parcela) VALUES (:id_trabajo, :id_parcela)";
        $stmt_insert = $this->pdo->prepare($sql_insert);

        foreach ($parcelas as $id_parcela) {
            $stmt_insert->bindParam(':id_trabajo', $id_trabajo, PDO::PARAM_INT);
            $stmt_insert->bindParam(':id_parcela', $id_parcela, PDO::PARAM_INT);
            $stmt_insert->execute();
        }

        return true;
    }

    public function getNumerosParcela($idParcela)
    {
        $sql = "SELECT num_parcela FROM zonas_parcelas WHERE id = :idParcela";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idParcela', $idParcela, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row['num_parcela'];
        }

        return null; // Si no se encuentra la parcela, devuelve null
    }

    public function getParcelasByZona($id_zona)
    {
        $sql = "SELECT * FROM zonas_parcelas WHERE id_zona = :id_zona";
        $stmt = $this->pdo->prepare($sql);
        $parcelas = [];
        $stmt->bindParam(':id_zona', $id_zona, PDO::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Verificar si ya existe el trabajo en el array
            if (!isset($parcelas[$row['id']])) {
                $parcela = new Parcela(
                    $row['id'],
                    $row['num_parcela'],
                    $row['descripcion'],
                    $row['id_zona'],

                );
                $parcelas[] = $parcela;
            }
        }
        return array_values($parcelas);
    }

    public function getParcelasByTrabajo($id_trabajo)
    {
        $sql = "SELECT id_parcela FROM trabajos_parcelas WHERE id_trabajo = :id_trabajo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_trabajo', $id_trabajo, PDO::PARAM_INT);
        $stmt->execute();
        $idsParcelas = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Verificar si ya existe el trabajo en el array
            if (!isset($parcelas[$row['id_parcela']])) {
                $idsParcelas[] = $row['id_parcela'];
            }
        }
        return array_values($idsParcelas);

    }


}