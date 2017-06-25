<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '/vendor/autoload.php';
require '/clases/AccesoDatos.php';
require '/clases/cdApi.php';
require '/clases/MWParaAutenticar.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*

¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/


$app = new \Slim\App(["settings" => $config]);



/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
  

$app->group('/cd', function () {
  $this->get('[/]', \cdApi::class . ':traerTodos');
  $this->get('/{id}', \cdApi::class . ':traerUno');
  $this->post('[/]', \cdApi::class . ':CargarUno');
  $this->delete('/{id}', \cdApi::class . ':BorrarUno');
  $this->put('[/]', \cdApi::class . ':ModificarUno');
  
})->add(\MWParaAutenticar::class . ':VerificarUsuario');

$app->get('/crearToken[/]', function (Request $request, Response $response) {  
    $datos = array(
            'nombre' => 'Matias',
            'apellido' => 'Sotomayor',
            'edad' => 28
    );
    $token = AutentificadorJWT::crearToken($datos);
    $newResponse = $response->withJson($token, 401);
    return $newResponse;
});

$app->run();