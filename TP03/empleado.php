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

    public function guardarEnTxt(){
    $file = fopen("empleados.txt", "a");
    $success = fwrite($file, $this->ToString() . "\r\n");
    fclose($file);

    return $success;
    }

    private function leerDesdeArchivo(){
        $file = fopen("empleados.txt", "r");
        $empleados = array();
        while (!feof($file)) {
            $registro = trim(fgets($file));
            if($registro != ""){
                $array = explode(" - ", $registro);
                $empleado = new Empleado($array[0], $array[1], $array[2], $array[3], $array[4], $array[5]);
                array_push($empleados, $empleado);
            }
        }
    }
}
?>