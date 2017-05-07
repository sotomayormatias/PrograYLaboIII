<?php
class Usuario{
    private $nombre;
    private $dni;
    private $pathFoto;

    public function getNombre(){
        return $this->nombre;
    }
    public function getDni(){
        return $this->dni;
    }
    public function getPathFoto(){
        return $this->pathFoto;
    }

    public function setNombre($valor){
        $this->nombre = $valor;
    }
    public function setDni($valor){
        $this->dni = $valor;
    }
    public function setPathFoto($valor){
        $this->pathFoto = $valor;
    }


    public function __construct($dni=NULL, $nombre=NULL, $pathFoto=NULL){
        if($nombre != NULL && $dni != NULL && $pathFoto != NULL){
            $this->nombre = $nombre;
            $this->dni = $dni;
            $this->pathFoto = $pathFoto;
        }
    }

    public function toString(){
        return $this->dni . " - " . $this->nombre . " - " . $this->pathFoto . "\r\n";
    }

    public function guardarEnTxt(){
        $result = FALSE;

        $file = fopen("archivos/usuarios.txt", "a");
        $cant = fwrite($file, $this->toString());

        if($cant > 0){
            $result = TRUE;
        }

        fclose($file);
        return $result;
    }

    public function getByDniFromTxt($dni){
        $file = fopen("archivos/usuarios.txt", "r");

        while(!feof($file)){
            $linea = fgets($file);
            $array = explode(" - ", $linea);

            if(trim($array[0]) == $dni){
                $usuario = new Usuario(trim($array[0]), trim($array[1]), trim($array[2]));
            }
        }
        fclose($file);

        return $usuario;
    }

    public function getAllFromTxt(){
        $file = fopen("archivos/usuarios.txt", "r");
        $resultado = array();

        while(!feof($file)){
            $linea = fgets($file);
            $array = explode(" - ", $linea);

            if(trim($array[0]) != ""){
                $resultado[] = new Usuario(trim($array[0]), trim($array[1]), trim($array[2]));
            }
        }
        fclose($file);

        return $resutlado;
    }
}
?>