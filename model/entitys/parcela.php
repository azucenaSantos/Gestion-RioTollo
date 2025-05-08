<?php
class Parcela
{
    private $id;
    private $num_parcela;
    private $descripcion;
    private $id_zona;

    public function __construct($id, $num_parcela, $descripcion, $id_zona)
    {
        $this->id = $id;
        $this->num_parcela = $num_parcela;
        $this->descripcion = $descripcion;
        $this->id_zona = $id_zona;
    }
    public function getId()
    {
        return $this->id;
    }   
    public function getNumParcela()
    {
        return $this->num_parcela;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getIdZona()
    {
        return $this->id_zona;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNumParcela($num_parcela)
    {
        $this->num_parcela = $num_parcela;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function setIdZona($id_zona)
    {
        $this->id_zona = $id_zona;
    }
     

}