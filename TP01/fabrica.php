<?php
include "empleado.php";
class Fabrica{
    private $_empleados;
    private $_razonSocial;

    public function __construct($razonSocial){
        $this->_empleados = array();
        $this->_razonSocial = $razonSocial;
        $this->inicializarDesdeArchivo($razonSocial);
    }

    private function inicializarDesdeArchivo($razonSocial){
        if(file_exists($razonSocial . ".txt")){
            $file = fopen($razonSocial . ".txt", "r");
            while (!feof($file)) {
                $registro = trim(fgets($file));
                if($registro != ""){
                    $array = explode(" - ", $registro);
                    $empleado = new Empleado($array[0], $array[1], $array[2], $array[3], $array[4], $array[5]);
                    $this->agregarEmpleado($empleado);
                }
            }
        }
    }

    public function agregarEmpleado($empleado){
        array_push($this->_empleados, $empleado);
        // $this->eliminarEmpleadosRepetidos();
    }

    public function eliminarEmpleado($empleado){
        var_dump($empleado);
        foreach ($this->_empleados as $key => $value) {
            if($empleado->getDni() == $value->getDni()){
                unset($this->_empleados[$key]);
            }
        }
    }

    private function eliminarEmpleadosRepetidos(){
        array_unique($this->_empleados);
    }

    public function ToString(){
        $resultado = "";
        foreach ($this->_empleados as $empleado) {
            $resultado .= $empleado->ToString() . "<br>";
        }
        return $resultado;
    }

    public function calcularSueldos(){
        $importe = 0;
        foreach ($this->_empleados as $empleado) {
            $importe += $empleado->getSueldo();
        }
        return $importe;
    }

    public function guardarEnTxt(){
        $file = fopen($this->_razonSocial . ".txt", "w");
        foreach ($this->_empleados as $empleado) {
            fwrite($file, $empleado->ToString() . "\r\n");
        }
        fclose($file);
    }
}
?>