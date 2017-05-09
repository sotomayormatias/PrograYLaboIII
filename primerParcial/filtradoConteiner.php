<?php
require_once("clases/conteiner.php");
$tituloVentana = "CONTEINER";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo $tituloVentana; ?> </title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="scripts/funcionesConteiner.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>

    <body>

        <div class="container" style="background-color:#ddeeff;">
            <div class="page-header">
                <h1 class="text-center">Conteiner</h1>
            </div>
            <div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td width="50%">

                                <div id="divFrm" style="height:250px;overflow:auto;margin-top:20px">
                                    <div class="form-group">
                                        <input type="text" name="pais" id="pais" placeholder="Ingrese pais" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <input type="button" class="miBotonUTN btn btn-primary btn-block" onclick="filtrarConteiner()" value="Filtrar" />
                                    </div>

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