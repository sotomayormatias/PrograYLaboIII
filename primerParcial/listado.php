<?php
require_once("clases/usuario.php");
$tituloVentana = "Usuarios";

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo $tituloVentana; ?> </title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="scripts/funciones.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container" style="background-color:#ddeeff;">
            <div class="page-header">
                <h1 class="text-center">PRODUCTOS</h1>
            </div>
            <div id="divGrilla" style="height:610px;overflow:auto;border-style:solid">

            </div>
        </div>
    </body>
</html>