<?php
class Zona
{
    private $id;
    private $nombre;
    private $limites;

    public function __construct($id, $nombre, $limites)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->limites = $limites;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getLimites()
    {
        return $this->limites;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setLimites($limites)
    {
        $this->limites = $limites;
    }
}
?>