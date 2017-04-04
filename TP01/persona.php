<?php 
abstract class Persona{
    private $_apellido;
    private $_dni;
    private $_nombre;
    private $_genero;

    public function __construct($nombre, $apellido, $dni, $genero){
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_dni = $dni;
        $this->_genero = $genero;
    }

    public function getApellido(){
        return $this->_apellido;
    }
    public function getNombre(){
        return $this->_nombre;
    }
    public function getDni(){
        return $this->_dni;
    }
    public function getGenero(){
        return $this->_genero;
    }

    public function ToString(){
        return $this->_nombre . " - ". $this->_apellido . " - ". $this->_dni . " - ". $this->_genero;
    }

    public abstract function hablar($idioma);
}
?>