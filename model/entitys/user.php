<?php
    class User{
        private $id;
        private $name;
        private $surname;
        private $password;
        private $rol;
        
        public function __construct($id, $name, $surname, $password, $rol){
            $this->id = $id;
            $this->name = $name;
            $this->surname = $surname;
            $this->password = $password;
            $this->rol = $rol;
        }

        public function getId(){
            return $this->id;
        }   
        public function getName(){
            return $this->name;
        }
        public function getSurname(){
            return $this->surname;
        }
        public function getPassword(){
            return $this->password;
        }
        public function getRol(){
            return $this->rol;
        }
        public function setId($id){
            $this->id = $id;
        }
        public function setName($name){
            $this->name = $name;
        }
        public function setSurname($surname){
            $this->surname = $surname;
        }
        public function setPassword($password){
            $this->password = $password;
        }
        public function setRol($rol){
            $this->rol = $rol;
        }
        /*public function __toString(){
            return "ID: $this->id, Nombre: $this->name, Apellido: $this->surname, Password: $this->password, Rol: $this->rol";
        }*/
    }
?>