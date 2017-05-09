<?php
require_once("clases/usuario.php");

if(isset($_POST['correo'])){
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    if(Usuario::ExisteUsuario($correo)){
        header("Location: listado.php"); /* Redirect browser */
        exit();
    } else {
        ?>
        <div>Usuario y/o Password inexistente</div>
        <a href="loginUsuario.html">Volver</a>
        <?php
    }
}
?>