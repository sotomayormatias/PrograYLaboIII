<?php 
include "persona.php";

class Empleado extends Persona{
    private $_legajo;
    private $_sueldo;

    public function __construct($nombre, $apellido, $dni, $genero, $legajo, $sueldo){
        parent::__construct($nombre, $apellido, $dni, $genero);
        $this->_legajo = $legajo;
        $this->_sueldo = $sueldo;
    }

    public function getLegajo(){
        return $this->_legajo;
    }
    public function getSueldo(){
        return $this->_sueldo;
    }

    public function ToString(){
        return parent::ToString() . " - " . $this->_legajo . " - " . $this->_sueldo;
    }

    public function hablar($idioma){
        return "hola, soy: " . $this->ToString();
    }
}
?>