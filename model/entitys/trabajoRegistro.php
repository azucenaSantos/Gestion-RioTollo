<?php
class TrabajoRegistro extends Trabajo
{
    private $porcentaje_final;

    public function __construct($id, $nombre, $zona, $parcelas, $porcentaje, $porcentaje_final, $finalizado, $hora_inicio, $hora_fin, $fecha, $anotaciones, $id_zona)
    {
        parent::__construct($id, $nombre, $zona, $parcelas, $porcentaje, $finalizado, $hora_inicio, $hora_fin, $fecha, $anotaciones, $id_zona);
        $this->porcentaje_final = $porcentaje_final;
    }

    public function getPorcentajeFinal()
    {
        return $this->porcentaje_final;
    }
    public function setPorcentajeFinal($porcentaje_final)
    {
        $this->porcentaje_final = $porcentaje_final;
    }

    public function __toString(){
        return "TrabajoRegistro: porcentaje_final = " . $this->porcentaje_final;
    }

}