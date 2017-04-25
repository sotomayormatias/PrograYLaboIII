<?php
class cd
{
    public $titulo;
    public $interprete;
    public $anio;

    public function MostrarDatos()
    {
            return $this->titulo." - ".$this->interprete." - ".$this->anio;
    }
    
    public static function TraerUnCdAnioParamNombreArray($titulo, $anio)
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT titel AS titulo, interpret AS interprete, "
                                                        . "jahr AS anio FROM cds WHERE titel = :titulo "
                                                        . "AND jahr= :anio");
        
        $consulta->execute(array(":titulo" => $titulo, ":anio" => $anio));
        
        $cdBuscado = $consulta->fetchObject('cd');
        
        return $cdBuscado; 
    }
    
    public function InsertarElCdParametros()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO cds (titel, interpret, jahr)"
                                                    . "VALUES(:titulo, :cantante, :anio)");
        
        $consulta->bindValue(':titulo', $this->titulo, PDO::PARAM_INT);
        $consulta->bindValue(':anio', $this->anio, PDO::PARAM_INT);
        $consulta->bindValue(':cantante', $this->interprete, PDO::PARAM_STR);

        $consulta->execute();   

    }
    
    public static function ModificarCd($id, $titulo, $anio, $cantante)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE cds SET titel = :titulo, interpret = :cantante, 
                                                        jahr = :anio WHERE id = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':titulo', $titulo, PDO::PARAM_INT);
        $consulta->bindValue(':anio', $anio, PDO::PARAM_INT);
        $consulta->bindValue(':cantante', $cantante, PDO::PARAM_STR);

        return $consulta->execute();

    }

    public static function EliminarCd($id)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM cds WHERE id = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();

    }
    
}