<?php 
include_once("autentificadorJWT.php");

class MWParaAutenticar{
    public function VerificarUsuario($request, $response, $next){
        if($request->isGet()){
            $next($request, $response);
        }
    }
}
?>