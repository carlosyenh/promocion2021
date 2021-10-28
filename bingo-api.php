<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    if (!isset($_POST['municipio'])) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            <title>Error</title>
        </head>

        <body>
            <center>
                <h1 class="text-danger">Error</h1>
                <h3>Los datos no se guardaron porque algún dato no fue ingresado correctamente </h3>
                <h4>Por favor ingresa de nuevo los datos y asegúrate de llenar todos los campos</h4>
                <br>
                <form action="bingo.php" method="post">
                    <button type="submit" class="btn btn-primary" value="captura">Volver a ingresar votos</button>
                </form>
                <br>
                <br>
            </center>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        </body>

        </html>

    <?php
        die('');
    }
    if (!isset($_POST['seccion'])) {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            <title>Error</title>
        </head>

        <body>
            <center>
                <h1 class="text-danger">Error</h1>
                <h3>Los datos no se guardaron porque algún dato no fue ingresado correctamente </h3>
                <h4>Por favor ingresa de nuevo los datos y asegúrate de llenar todos los campos</h4>
                <br>
                <form action="bingo.php" method="post">
                    <button type="submit" class="btn btn-primary" value="captura">Volver a ingresar votos</button>
                </form>
                <br>
                <br>
            </center>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        </body>

        </html>

    <?php
        die('');
    }

    if (!isset($_POST['corte'])) {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            <title>Error</title>
        </head>

        <body>
            <center>
                <h1 class="text-danger">Error</h1>
                <h3>Los datos no se guardaron porque estas fuera del horario de envios </h3>
                <h4>Por favor ingresa de nuevo los datos y asegúrate de llenar todos los campos</h4>
                <br>
                <form action="bingo.php" method="post">
                    <button type="submit" class="btn btn-primary" value="captura">Volver a ingresar votos</button>
                </form>
                <br>
                <br>
            </center>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        </body>

        </html>

    <?php
        die('');
    }
    if (!isset($_POST['enviado_por'])) {
        ?>
            <!DOCTYPE html>
            <html lang="en">
    
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
                <title>Error</title>
            </head>
    
            <body>
                <center>
                    <h1 class="text-danger">Error</h1>
                    <h3>Los datos no se guardaron porque algún dato no fue ingresado correctamente </h3>
                    <h4>Por favor ingresa de nuevo los datos y asegúrate de llenar todos los campos</h4>
                    <br>
                    <form action="bingo.php" method="post">
                        <button type="submit" class="btn btn-primary" value="captura">Volver a ingresar votos</button>
                    </form>
                    <br>
                    <br>
                </center>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
            </body>
    
            </html>
    
        <?php
            die('');
        }
    if (!isset($_POST['hanvotado'])) {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            <title>Error</title>
        </head>

        <body>
            <center>
                <h1 class="text-danger">Error</h1>
                <h3>Los datos no se guardaron porque algún dato no fue ingresado correctamente </h3>
                <h4>Por favor ingresa de nuevo los datos y asegúrate de llenar todos los campos</h4>
                <br>
                <form action="bingo.php" method="post">
                    <button type="submit" class="btn btn-primary" value="captura">Volver a ingresar votos</button>
                </form>
                <br>
                <br>
            </center>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        </body>

        </html>

    <?php
        die('');
    }


    $municipio = $_POST['municipio'];
    $seccion = $_POST['seccion'];
    $enviado_por = $_POST['enviado_por'];
    $enviado_por = strtoupper($enviado_por);
    $num_corte = $_POST['corte'];
    $hanvotado = $_POST['hanvotado'];


    if ($hanvotado < 0) {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            <title>Error</title>
        </head>

        <body>
            <center>
                <h1 class="text-danger">Error</h1>
                <h3>Los datos no se guardaron porque algún dato no fue ingresado correctamente </h3>
                <h4>Por favor ingresa de nuevo los datos y asegúrate de llenar todos los campos</h4>
                <br>
                <form action="bingo.php" method="post">
                    <button type="submit" class="btn btn-primary" value="captura">Volver a ingresar votos</button>
                </form>
                <br>
                <br>
            </center>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        </body>

        </html>

    <?php
        die('');
    }

    mysqli_report(MYSQLI_REPORT_STRICT);
    require 'conexion.php';

    $checkForSended = "SELECT * FROM `bingo` WHERE seccion = '$seccion' AND num_corte = '$num_corte'";
    //$checkingQuery = mysqli_query($conexion, $checkForSended);
    if(1==2){
//    if($checkingQuery->num_rows > 0){
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            <title>Error</title>
        </head>

        <body>
            <center>
                <h1 class="text-danger">Error</h1>
                <h3>Los datos no se guardaron</h3>
                <h4 class="text-danger">YA HABIAS ENVIADO UN CORTE <?php echo $num_corte ?> PARA LA SECCION <?php echo $seccion ?></h4>
                <br>
                <form action="bingo.php" method="post">
                    <button type="submit" class="btn btn-primary" value="captura">Volver a Bingo</button>
                </form>
                <br>
                <br>
            </center>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        </body>

        </html>

    <?php
        die('');
    }

    $insertInBingoTable = "INSERT INTO bingo (municipio, seccion, num_corte, enviado_por, num_votantes) VALUES ('$municipio','$seccion','$num_corte', '$enviado_por', '$hanvotado' );";
    $insertQuery = mysqli_query($conexion, $insertInBingoTable);

    $consulta = "UPDATE metas set votos = votos+$hanvotado, ultimoEnvio = CURRENT_TIMESTAMP WHERE seccion = '$seccion'";
    $query = mysqli_query($conexion, $consulta);

    mysqli_close($conexion);
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <title>Datos registrados exitosamente</title>
    </head>

    <body>
        <center>
            <h1 class="text-danger">Muy bien</h1>
            <h3>Datos registrados exitosamente</h3>
            <h3 class="text-danger">Ahora haz clic en el botón de abajo para que estés listo para capturar tu próximo corte.</h3>
            <br>
            <form action="bingo.php" method="post">
                <button type="submit" class="btn btn-primary" value="captura">Clic aqui</button>
            </form>
            <br>
            <br>
        </center>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>

    </html>

<?php
    //echo "No folior";
} catch (Exception $e) {
?>
    <center>
        <h1>Folio no capturado</h1>
        <h1>Error en el servidor</h1>
        <br>
        <form action="captura-sin-formato-api.php" method="post">
            <button type="submit" class="btn btn-primary" value="reintentar">REINTENTAR</button>
        </form>
        <br>
        <br>
    </center>
<?php
}
?>
