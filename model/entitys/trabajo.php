<?php
class Trabajo
{
    private $id;
    private $nombre;
    private $zona;
    private $parcelas;
    private $porcentaje;
    private $finalizado;
    private $hora_inicio;
    private $hora_fin;
    private $fecha;
    private $anotaciones;
    private $id_zona;

    private $nombre_grupo; // Nombre del grupo asociado al trabajo
    private $id_grupo;     // ID del grupo (FALTA EN TU CLASE ORIGINAL)

    public function __construct($id, $nombre, $zona, $parcelas, $porcentaje, $finalizado, $hora_inicio, $hora_fin, $fecha, $anotaciones, $id_zona)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->zona = $zona;
        $this->parcelas = $parcelas;
        $this->porcentaje = $porcentaje;
        $this->finalizado = $finalizado;
        $this->hora_inicio = $hora_inicio;
        $this->hora_fin = $hora_fin;
        $this->fecha = $fecha;
        $this->anotaciones = $anotaciones;
        $this->id_zona = $id_zona;
        // $this->nombre_grupo = ""; // Inicializar el nombre del grupo
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getZona()
    {
        return $this->zona;
    }
    public function getParcelas()
    {
        return $this->parcelas;
    }
    public function getPorcentaje()
    {
        return $this->porcentaje;
    }
    public function getFinalizado()
    {
        return $this->finalizado;
    }
    public function getHoraInicio()
    {
        return date('H:i', strtotime($this->hora_inicio));
    }
    public function getHoraFin()
    {
        return date('H:i', strtotime($this->hora_fin));
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function getAnotaciones()
    {
        return $this->anotaciones;
    }
    public function getIdZona()
    {
        return $this->id_zona;
    }
    public function getGrupoNombre()
    {
        return $this->nombre_grupo;
    }
    public function getIdGrupo()
    {
        return $this->id_grupo;
    } // NUEVO

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setZona($zona)
    {
        $this->zona = $zona;
    }
    public function setParcelas($parcelas)
    {
        $this->parcelas = $parcelas;
    }
    public function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;
    }
    public function setFinalizado($finalizado)
    {
        $this->finalizado = $finalizado;
    }
    public function setHoraInicio($hora_inicio)
    {
        $this->hora_inicio = $hora_inicio;
    }
    public function setHoraFin($hora_fin)
    {
        $this->hora_fin = $hora_fin;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    public function setAnotaciones($anotaciones)
    {
        $this->anotaciones = $anotaciones;
    }
    public function setIdZona($id_zona)
    {
        $this->id_zona = $id_zona;
    }
    public function setGrupoNombre($nombre_grupo)
    {
        $this->nombre_grupo = $nombre_grupo;
    }
    public function setIdGrupo($id_grupo)
    {
        $this->id_grupo = $id_grupo;
    } // NUEVO

    public function __toString()
    {
        return "Trabajo: " . $this->nombre . ", Zona: " . $this->zona . ", Parcelas: " . $this->parcelas . ", Porcentaje: " . $this->porcentaje . ", Finalizado: " . $this->finalizado . ", Hora Inicio: " . $this->hora_inicio . ", Hora Fin: " . $this->hora_fin . ", Fecha: " . $this->fecha;
    }
}
