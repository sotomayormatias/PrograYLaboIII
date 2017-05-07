<?php
require_once("clases/producto.php");
$tituloVentana = "PRODUCTOS";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>
            <?php echo $tituloVentana; ?> </title>

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
            <div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td width="50%">

                                <div id="divFrm" style="height:250px;overflow:auto;margin-top:20px">
                                    <div class="form-group">
                                        <input type="text" name="codigo" id="codBarra" placeholder="Ingrese código" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre" class="form-control" />
                                    </div>
                                    <div class="form-group" >
                                        <input type="file" name="archivo" id="archivo" onchange="subirFoto()" class="form-control" />
                                    </div>
                                    <div id="divBotonera">
                                        <div class="form-group">
                                            <input type="button" class="miBotonUTN btn btn-primary btn-block" onclick="agregarProducto()" value="Agregar" />
                                        </div>
                                    </div>
                                    <input type="hidden" id="hdnArchivoTemp" />

                                </div>
                            </td>
                            <td rowspan="2">
                                <div id="divGrilla" style="height:610px;overflow:auto;border-style:solid">

                                </div>

                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div id="divFoto" style="height:350px;overflow:auto;">

                                </div>

                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>


        </div>

    </body>

    </html>