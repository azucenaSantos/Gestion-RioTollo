<?php
class Grupo{
    private $id;    
    private $nombre;
    private $id_coordinador;

    public function __construct($id, $nombre, $id_coordinador){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->id_coordinador = $id_coordinador;
    }
    public function getId(){
        return $this->id;
    }   
    public function getNombre(){
        return $this->nombre;
    }
    public function getIdCoordinador(){
        return $this->id_coordinador;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setIdCoordinador($id_coordinador){
        $this->id_coordinador = $id_coordinador;
    }
}
?>