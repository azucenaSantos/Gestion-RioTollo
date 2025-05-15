<?php
class User
{
    protected $id;
    protected $name;
    protected $surname;
    private $username;

    protected $password;
    protected $passwordChanged;
    protected $rol;

    public function __construct($id, $name, $surname, $username, $password, $passwordChanged, $rol)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->username = $username;
        $this->password = $password;
        $this->passwordChanged = $passwordChanged;
        $this->rol = $rol;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getPasswordChanged()
    {
        return $this->passwordChanged;
    }
    public function getRol()
    {
        return $this->rol;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setPasswordChanged($passwordChanged)
    {
        $this->passwordChanged = $passwordChanged;
    }
    public function setRol($rol)
    {
        $this->rol = $rol;
    }
    /*public function __toString(){
        return "ID: $this->id, Nombre: $this->name, Apellido: $this->surname, Password: $this->password, Rol: $this->rol";
    }*/
}
?>