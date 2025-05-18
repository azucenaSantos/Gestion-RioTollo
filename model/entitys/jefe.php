<?php
require_once 'user.php';
class Jefe extends User
{
    protected $id;
    private $nombreApellidos;

    public function __construct($id, $name, $surname, $username, $password, $passwordChanged, $rol)
    {
        parent::__construct($id, $name, $surname, $username, $password, $passwordChanged, $rol);
        $this->nombreApellidos = "$name $surname";
    }

    public function getNombreApellidos()
    {
        return $this->nombreApellidos;
    }
    public function setNombreApellidos($nombreApellidos)
    {
        $this->nombreApellidos = $nombreApellidos;
    }

}
?>