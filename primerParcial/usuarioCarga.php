<?php
require_once("clases/usuario.php");

if(isset($_POST['nombre'])){
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $edad = $_POST['edad'];
    $clave = $_POST['clave'];
    $usuario = new Usuario($nombre, $correo, $edad, $clave);

    if(Usuario::GuardarEnTXT($usuario)){
        ?>
        <div>El usuario fue dado de alta correctamente</div>
        <a href="formularioUsuario.html">Volver</a>
        <?php
    } else {
        ?>
        <div>Hubo un error, no se pudo cargar el usuario</div>
        <a href="formularioUsuario.html">Volver</a>
        <?php
    }
}
?>