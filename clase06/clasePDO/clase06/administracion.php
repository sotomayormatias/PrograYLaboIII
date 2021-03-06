<?php

//require_once ("clases/producto.php");
//require_once ("clases/archivo.php");

$queMuestro = isset($_POST['queMuestro']) ? $_POST['queMuestro'] : NULL;

switch ($queMuestro) {

    case "0":
        $obj = new stdClass();
        $obj->Exito = TRUE;
        $obj->Mensaje = "";
        $obj->Html = "";
        try {

            $objetoPDO = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', 'root', 'vamolarenga', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $objetoPDO->exec('SET CHARACTER SET utf8');

            $obj->Html = "<h4>C&oacute;digo</h4>";
            $obj->Html .= "<div class='well well-sm text-info'>
                            objetoPDO = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));<br>
                            objetoPDO->exec('SET CHARACTER SET utf8');</div>";
            
        } catch (PDOException $e) {

            $obj->Exito = FALSE;
            $obj->Mensaje = "Error!!!\n" . $e->getMessage();
        }

        echo json_encode($obj);

        break;

    case "1":
        $obj = new stdClass();
        $obj->Exito = TRUE;
        $obj->Mensaje = "";
        $obj->Html = "";

        try {
            $db = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', 'root', 'vamolarenga', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $sql = $db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');

            $catidadFilas = $sql->rowCount();

            $obj->Html = "<h3>FetchAll</h3><br/>";
            $obj->Html .= "<br/>cantidad de filas: " . $catidadFilas . "<br/><br/>";

            $resultado = $sql->fetchall();

            foreach ($resultado as $fila) {
                $obj->Html .= "titulo: " . $fila[0];
                $obj->Html .= "- A&ntilde;o: " . $fila[2];
                $obj->Html .= "- Cantante: " . $fila['interprete'] . '<br/>';
            }
            
            $obj->Html .= "<br/><br/><h4>C&oacute;digo</h4><div class='well well-sm text-info'>";
            
            $obj->Html .= "sql = db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');<br/>";
            $obj->Html .= "catidadFilas = sql->rowCount();<br/>";
            $obj->Html .= "resultado = sql->fetchall();<br/>";
            $obj->Html .= "foreach (resultado as fila) {<br/>
                            obj->Html .= 'titulo:' . fila[0];<br/>
                            obj->Html .=  'A&ntilde;o:' . fila[2];<br/>
                            obj->Html .=  'Cantante:' . fila['interprete'];<br/>
                            }</div>";
            
                
        } catch (PDOException $e) {

            $obj->Exito = FALSE;
            $obj->Mensaje = "Error!!!\n" . $e->getMessage();
        }

        echo json_encode($obj);

        break;

    case "2":
        $obj = new stdClass();
        $obj->Exito = TRUE;
        $obj->Mensaje = "";
        $obj->Html = "";

        try {
            $db = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', 'root', 'vamolarenga', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $sql = $db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');

            $catidadFilas = $sql->rowCount();

            $obj->Html = "<h3>Fetch(PDO::FETCH_ASSOC)</h3></br/>";
            $obj->Html .= "<br/>cantidad de filas: " . $catidadFilas . "<br/><br/>";

            while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {//FETCH_ASSOC -> RETORNA UNA ARRAY ASOCIATIVO
                $obj->Html .= "titulo: " . $fila['titulo'];
                $obj->Html .= "- A&ntilde;o: " . $fila['anio'];
                $obj->Html .= "- Cantante: " . $fila['interprete'] . '<br/>';
            }
        
            $obj->Html .= "<br/><br/><h4>C&oacute;digo</h4><div class='well well-sm text-info'>";
            
            $obj->Html .= "sql = db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');<br/><br/>";
            $obj->Html .= "while(fila = sql->fetch(PDO::FETCH_ASSOC)){<br/>
                            obj->Html .= 'titulo:' . fila['titulo'];<br/>
                            obj->Html .=  'A&ntilde;o:' . fila['anio'];<br/>
                            obj->Html .=  'Cantante:' . fila['interprete'];<br/>
                            }</div>";

        } catch (PDOException $e) {

            $obj->Exito = FALSE;
            $obj->Mensaje = "Error!!!\n" . $e->getMessage();
        }

        echo json_encode($obj);

        break;

    case "3":
        $obj = new stdClass();
        $obj->Exito = TRUE;
        $obj->Mensaje = "";
        $obj->Html = "";

        try {
            $db = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', 'root', 'vamolarenga', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $sql = $db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');

            $obj->Html = "<h3>Fetch(PDO::FETCH_NUM)</h3></br/>";

            while ($fila = $sql->fetch(PDO::FETCH_NUM)) {//FETCH_NUM -> RETORNA UNA ARRAY INDEXADO
                $obj->Html .= "titulo: " . $fila[0];
                $obj->Html .= "- A&ntilde;o: " . $fila[2];
                $obj->Html .= "- Cantante: " . $fila[1] . '<br/>';
            }
        
            $obj->Html .= "<br/><br/><h4>C&oacute;digo</h4><div class='well well-sm text-info'>";
            
            $obj->Html .= "sql = db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');<br/><br/>";
            $obj->Html .= "while(fila = sql->fetch(PDO::FETCH_NUM)){<br/>
                            obj->Html .= 'titulo:' . fila[0];<br/>
                            obj->Html .=  'A&ntilde;o:' . fila[2];<br/>
                            obj->Html .=  'Cantante:' . fila[1];<br/>
                            }</div>";

        } catch (PDOException $e) {

            $obj->Exito = FALSE;
            $obj->Mensaje = "Error!!!\n" . $e->getMessage();
        }
        
        echo json_encode($obj);
        
        break;

    case "4":
        $obj = new stdClass();
        $obj->Exito = TRUE;
        $obj->Mensaje = "";
        $obj->Html = "";

        try {
            $db = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', 'root', 'vamolarenga', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $sql = $db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');

            $obj->Html = "<h3>Fetch(PDO::FETCH_BOTH)</h3></br/>";

            while ($fila = $sql->fetch(PDO::FETCH_BOTH)) {//FETCH_BOTH -> RETORNA UNA ARRAY ASOCIATIVO E INDEXADO
                $obj->Html .= "titulo: " . $fila['titulo'];
                $obj->Html .= "- A&ntilde;o: " . $fila[2];
                $obj->Html .= "- Cantante: " . $fila['interprete'] . '<br/>';
            }
        
            $obj->Html .= "<br/><br/><h4>C&oacute;digo</h4><div class='well well-sm text-info'>";
            
            $obj->Html .= "sql = db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');<br/><br/>";
            $obj->Html .= "while(fila = sql->fetch(PDO::FETCH_BOTH)){<br/>
                            obj->Html .= 'titulo:' . fila['titulo'];<br/>
                            obj->Html .=  'A&ntilde;o:' . fila[2];<br/>
                            obj->Html .=  'Cantante:' . fila['interprete'];<br/>
                            }</div>";

        } catch (PDOException $e) {

            $obj->Exito = FALSE;
            $obj->Mensaje = "Error!!!\n" . $e->getMessage();
        }
        
        echo json_encode($obj);

        break;
      
    case "5":
        $obj = new stdClass();
        $obj->Exito = TRUE;
        $obj->Mensaje = "";
        $obj->Html = "";

        try {
            $db = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', 'root', 'vamolarenga', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $sql = $db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');

            $obj->Html = "<h3>Fetch(PDO::FETCH_LAZY)</h3></br/>";

            while ($fila = $sql->fetch(PDO::FETCH_LAZY)) {//FETCH_LAZY -> RETORNA UN OBJETO
                $obj->Html .= "titulo: " . $fila->titulo;
                $obj->Html .= "- A&ntilde;o: " . $fila->anio;
                $obj->Html .= "- Cantante: " . $fila->interprete . '<br/>';
            }
        
            $obj->Html .= "<br/><br/><h4>C&oacute;digo</h4><div class='well well-sm text-info'>";
            
            $obj->Html .= "sql = db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');<br/><br/>";
            $obj->Html .= "while(fila = sql->fetch(PDO::FETCH_LAZY)){<br/>
                            obj->Html .= 'titulo:' . fila->titulo;<br/>
                            obj->Html .=  'A&ntilde;o:' . fila->anio;<br/>
                            obj->Html .=  'Cantante:' . fila->interprete;<br/>
                            }</div>";

        } catch (PDOException $e) {

            $obj->Exito = FALSE;
            $obj->Mensaje = "Error!!!\n" . $e->getMessage();
        }
        
        echo json_encode($obj);

        break;
    
    case "6":
        $obj = new stdClass();
        $obj->Exito = TRUE;
        $obj->Mensaje = "";
        $obj->Html = "";

        require_once "clases/cd.php";
      
        try {
            $db = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', 'root', 'vamolarenga', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $sql = $db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');

            $obj->Html = "<h3>FetchObject</h3></br/>";

            while ($fila = $sql->fetchObject("cd")) {//FETCHOBJECT -> RETORNA UN OBJETO DE UNA CALSE DADA
                $obj->Html .= "<br/>". $fila->MostrarDatos(). '<br/>';
            }
        
            $obj->Html .= "<br/><br/><h4>C&oacute;digo</h4><div class='well well-sm text-info'>";
            
            $obj->Html .= "sql = db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');<br/><br/>";
            $obj->Html .= "while(fila = sql->fetchObject){<br/>
                            obj->Html .= fila->MostrarDatos();<br/> 
                            }</div>";

        } catch (PDOException $e) {

            $obj->Exito = FALSE;
            $obj->Mensaje = "Error!!!\n" . $e->getMessage();
        }
        
      echo json_encode($obj);

      break;

    case "7":
        $obj = new stdClass();
        $obj->Exito = TRUE;
        $obj->Mensaje = "";
        $obj->Html = "";

        require_once "clases/cd.php";
      
        try {
            $db = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', 'root', 'vamolarenga', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $sql = $db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');

            $obj->Html = "<h3>SetFetchMode(PDO::FETCH_INTO, new cd)</h3></br/>";

            $sql->setFetchMode(PDO::FETCH_INTO, new cd);

            foreach($sql as $cd){
                $obj->Html .= "<br/>". $cd->MostrarDatos(). '<br/>';
            }
        
            $obj->Html .= "<br/><br/><h4>C&oacute;digo</h4><div class='well well-sm text-info'>";
            
            $obj->Html .= "sql = db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');<br/><br/>";
            $obj->Html .= "sql->setFetchMode(PDO::FETCH_INTO, new cd);<br/>
                            foreach(sql as cd){<br/>
                            obj->Html .= cd->MostrarDatos();<br/> 
                            }</div>";

        } catch (PDOException $e) {

            $obj->Exito = FALSE;
            $obj->Mensaje = "Error!!!\n" . $e->getMessage();
        }
        
      echo json_encode($obj);

      break;
      
    case "8":
        
        include './pdo_files/ejemplo8PDO.php';
        
        break;
      
    case "9":
        
        $valor = 3;
        
        include './pdo_files/ejemplo9PDO.php';
        
        break;
    case "10":
        
        $valor = 1;
        
        include './pdo_files/ejemplo10PDO.php';
        
        break;    
    case "11":
        
        include './pdo_files/ejemplo11PDO.php';
        
        break;
      
    case "12":
        
        include './pdo_files/ejemplo12PDO.php';
        
        break;
    
    case "13":
        
        include './pdo_files/ejemplo13PDO.php';
        
        break;
    
    case "14":
        
        include './pdo_files/ejemplo14PDO.php';
        
        break;

    default:
        echo ":(";
}