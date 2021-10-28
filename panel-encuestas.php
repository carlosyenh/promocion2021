<?php
session_start();
if (!$_SESSION['username']) {
    header("location:login.php");
}
if ($_SESSION['userType'] != 'administrador' && $_SESSION['userType'] != 'superencuestador') {
    header("location:login.php");
}

$sesionMunicipio = $_SESSION['municipio'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/efdb1e25c5.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>


    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggleExternalContent">
                <ul class="nav navbar-nav">
                    <?php
                    if ($_SESSION['userType'] == 'encuestador' || $_SESSION['userType'] == 'superencuestador') {
                    ?>
                        <li><a class="dropdown-item nav-item" href="encuesta.php" style="color: grey;">Encuesta</a></li>
                    <?php
                    }

                    if ($_SESSION['userType'] == 'superencuestador' || $_SESSION['userType'] == 'administrador') {
                    ?>
                        <li><a class="dropdown-item nav-item" href="panel-encuestas.php" style="color: grey;">Avance encusta</a></li>
                    <?php
                    }


                    if ($_SESSION['userType'] == 'capturista' || $_SESSION['userType'] == 'administrador') {
                    ?>
                        <li><a class="dropdown-item nav-item" href="captura-sin-formato.php" style="color: grey;">Captura sin formato</a></li>
                        <li><a class="dropdown-item nav-item" href="captura-con-formato.php" style="color: grey;">Captura con formato</a></li>
                    <?php
                    }
                    if ($_SESSION['userType'] == 'administrador') {
                    ?>
                        <li><a class="dropdown-item nav-item" href="#" style="color: grey;">Reporte por celula</a></li>
                        <li><a class="dropdown-item nav-item" href="resumen-promocion.php" style="color: grey;">Resumen promocion</a></li>
                        <li><a class="dropdown-item nav-item" href="#" style="color: grey;">Grafica</a></li>
                    <?php } ?>
                    <li><a class="dropdown-item nav-item" href="logout.php" style="color: grey;">Cerrar sesíon</a></li>
                </ul>
            </div>
        </div>
    </nav>




    <div class="container mt-3">
        <div class="col-md-8 mx-auto">
            <div class="amigop">
                <div class="card mt-">
                    <div class="card-header">
                        <h2 class="text-center">
                            Resumen Encuestas
                        </h2>
                        <h2 class="text-center text-primary">
                            <b><?php echo $sesionMunicipio ?></b>
                        </h2>
                    </div>
                    <div class="card-body">
                        <?php
                        mysqli_report(MYSQLI_REPORT_STRICT);
                        require 'conexion.php';
                        $consultaMetas = "SELECT * FROM metas_encuesta WHERE municipio = '$sesionMunicipio'";
                        $consultaEncuestas = "";
                        $sql = "SELECT * FROM encuesta";
                        $result = $conexion->query($consultaMetas);
                        $count = 0;

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $seccion = $row["seccion"];
                                $municipio =  $row["municipio"];
                                $meta =  $row["meta"];
                                $completada =  $row["completada"];
                                $lugar = $row["lugar"];
                                $direccion = $row["direccion"];
                                //echo $seccion;
                                $consultaEncuestas = "SELECT COUNT(seccion) as total FROM encuesta WHERE seccion = '$seccion'";
                                $resultadoConsultaEnuestas = $conexion->query($consultaEncuestas);
                                $renglonConsultaEncuestas = $resultadoConsultaEnuestas->fetch_assoc();
                                $encuestasTotal = implode($renglonConsultaEncuestas);
                                $avance = ($encuestasTotal / $meta) * (100);
                                //    $sp =  $row["sp"];
                                //    $sp =  $row["sp"];

                        ?>
                                <div class="mx-auto">
                                    <h1 class="mx-auto text-center text-primary"><b>Sección: <?php echo $seccion; ?></b></h1>
                                    <span> <b>Dirección:</b> </span><span><?php echo $direccion; ?></span>
                                    <br>
                                    <span> <b>Lugar:</b> </span><span><?php echo $lugar; ?></span>
                                    <br>
                                    <span> <b>Realizadas:</b> </span><span><?php echo $encuestasTotal; ?></span>
                                    <span> <b>De:</b> </span><span><?php echo $meta; ?></span>
                                    <br>
                                    <h2 class="text-center"><b id="row-<?php echo $count; ?>">Avance<span id="avance-<?php echo $count; ?>"> <?php echo bcdiv($avance, '1', 2); ?></span><span>%</span></b></h2>
                                    <br>
                                    <hr>
                                </div>

                                <script>
                                    avance = document.getElementById("avance-<?php echo $count; ?>").innerHTML;
                                    console.log(avance);
                                    if (avance >= 0 && avance <= 59) {
                                        document.getElementById("row-<?php echo $count; ?>").style.color = "red";
                                    }
                                    if (avance >= 60 && avance <= 90) {
                                        document.getElementById("row-<?php echo $count; ?>").style.color = "#ffbf00";
                                    }
                                    if (avance >= 90 && avance <= 99) {
                                        document.getElementById("row-<?php echo $count; ?>").style.color = "green";
                                    }
                                    if (avance >= 100) {
                                        document.getElementById("row-<?php echo $count; ?>").style.color = "lime";
                                        document.getElementById("row-<?php echo $count; ?>").innerHTML = "Completa";
                                    }
                                </script>
                        <?php
                                $count++;
                            }
                        } else {
                            echo "0 results";
                        }
                        //mysqli_close($conexion);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <script type="text/javascript">
        var currentDate = new Date(Date.now());
        var localCurrentDate = currentDate.toLocaleDateString();
        console.log(localCurrentDate);

        function exportReportToExcel() {
            let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
            TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
                name: `Resumen_promocion_${localCurrentDate}.xlsx`, // fileName you could use any name
                sheet: {
                    name: 'Libro 1' // sheetName
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>