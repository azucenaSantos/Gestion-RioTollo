<?php
class Grupo
{
    private $id;
    private $nombre;
    private $id_coordinador;
    private $integrantes;
    private $nombre_coordinador;

    public function __construct($id, $nombre, $id_coordinador)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->id_coordinador = $id_coordinador;
        $this->nombre_coordinador = null; 
    }
    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getIdCoordinador()
    {
        return $this->id_coordinador;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setIdCoordinador($id_coordinador)
    {
        $this->id_coordinador = $id_coordinador;
    }
    public function getIntegrantes()
    {
        return $this->integrantes;
    }
    public function setIntegrantes($integrantes)
    {
        $this->integrantes = $integrantes;
    }
    public function setNombreCoordinador($nombre_coordinador)
    {
        $this->nombre_coordinador = $nombre_coordinador;
    }
    public function getNombreCoordinador()
    {
        return $this->nombre_coordinador;
    }
}
?>