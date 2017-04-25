
    <div class="well well-sm text-info">
        class AccesoDatos
        {<br>
        private static $ObjetoAccesoDatos;<br>
        private $objetoPDO;<br>
        <br>
        private function __construct()
        {<br>
        <br>
        try { <br>
        $this->objetoPDO = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));<br>
        $this->objetoPDO->exec("SET CHARACTER SET utf8");<br>
        } 
        catch (PDOException $e) { <br>
        print "Error!: " . $e->getMessage(); <br>
        die();<br>
        }<br>
        }
        <br><br>
        public static function dameUnObjetoAcceso()
        { <br>
        if (!isset(self::$ObjetoAccesoDatos)) {    <br>      
        self::$ObjetoAccesoDatos = new AccesoDatos(); <br>
        } <br>
        return self::$ObjetoAccesoDatos;<br>        
        }

        <br><br>
        public function RetornarConsulta($sql)
        { <br>
        return $this->objetoPDO->prepare($sql); <br>
        }
        <br><br>
        // Evita que el objeto se pueda clonar<br>
        public function __clone()
        { <br>
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR); <br>
        }<br>
        }
</div>
<?php
include_once ("clases/AccesoDatos.php");
include_once ("clases/cd.php");

$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

$consulta = $objetoAccesoDato->RetornarConsulta("select titel AS titulo, interpret AS interprete, jahr AS anio "
                                                . "FROM cds");
$consulta->execute();

$consulta->setFetchMode(PDO::FETCH_INTO, new cd);

foreach ($consulta as $cd) {

    print_r($cd->MostrarDatos());
    print("<br>");
}
?>
<h4>C&oacute;digo</h4>
<div class="well well-sm text-info">
$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();<br>
<br>
$consulta = $objetoAccesoDato->RetornarConsulta("select titel AS titulo, interpret AS interprete, jahr AS anio FROM cds");<br>
<br>$consulta->execute();<br>

<br>$consulta->setFetchMode(PDO::FETCH_INTO, new cd);<br>

foreach ($consulta as $cd) {<br>

    print_r($cd->MostrarDatos());<br>
    <br>
}   
</div>

