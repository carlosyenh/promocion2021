<?php
session_start();
if (!$_SESSION['username']) {
    header("location:login.html");
}
if ($_SESSION['userType'] != 'administrador') {
    header("location:login.html");
}
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

                    if ($_SESSION['userType'] == 'superencuestador') {
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
                        <li><a class="dropdown-item nav-item" href="avanc-celulas.php" style="color: grey;">Reporte por celula</a></li>
                        <li><a class="dropdown-item nav-item" href="resumen-promocion.php" style="color: grey;">Resumen promocion</a></li>
                        <li><a class="dropdown-item nav-item" href="graficas.php" style="color: grey;">Grafica</a></li>
                    <?php } ?>
                    <li><a class="dropdown-item nav-item" href="logout.php" style="color: grey;">Cerrar sesíon</a></li>
                </ul>
            </div>
        </div>
    </nav>







    <div class="container mt-3">
        <div class="col-md-8 mx-auto">

            <div id="amigop" name="amigoPrincipalDiv">
                <div class="card mt-10">
                    <div class="card-header">
                        <h2 class="text-center"> <span>Avance</span></h2>
                        <h2 class="text-center"> <span style="color: red;">Por celulas</span></h2>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="height: 350px;">
                            <table class="table" name="table" id="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Sección</th>
                                        <th scope="col">SP</th>
                                        <th scope="col">Meta Celula</th>
                                        <th scope="col">Meta Celula prioritaria</th>
                                        <th scope="col">Celulas Completas</th>
                                        <th scope="col">%Avance celulas</th>
                                        <th scope="col">%Avance Real</th>
                                    </tr>
                                </thead>
                                <tbody style="overflow: auto; ">
                                    <?php
                                    mysqli_report(MYSQLI_REPORT_STRICT);
                                    require 'conexion.php';
                                    $consultaMetas = "SELECT * FROM metas";
                                    $consultaPromocion = "";
                                    $sql = "SELECT * FROM metas";
                                    $result = $conexion->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $seccion = $row["seccion"];
                                            $sp =  $row["sp"];
                                            $meta =  $row["meta"];
                                            //echo $seccion;
                                            $consultaPromocion = "SELECT COUNT(seccion) as total FROM amigos_principales WHERE seccion = $seccion";
                                            $resultadoConsultaPromocion = $conexion->query($consultaPromocion);
                                            $renglonConsultaPromocion = $resultadoConsultaPromocion->fetch_assoc();
                                            $promovidos = implode($renglonConsultaPromocion);
                                            $avance = ($promovidos / $meta) * (100);
                                            //    $sp =  $row["sp"];
                                            //    $sp =  $row["sp"];

                                    ?>
                                            <tr id="row">
                                                <td><?php echo $seccion ?></td>
                                                <td><?php echo $sp ?></td>
                                                <td><?php echo $meta ?></td>
                                                <td><?php echo $promovidos ?></td>
                                                <td>
                                                    <span id="avance"><?php echo $avance - 2 + 101 ?></span>%
                                                    <script>
                                                        avance = document.getElementById("avance").innerHTML;
                                                        console.log(avance);
                                                        if (avance >= 0 && avance <= 59) {
                                                            document.getElementById("row").style.backgroundColor = "red";
                                                        }
                                                        if (avance >= 60 && avance <= 80) {
                                                            document.getElementById("row").style.backgroundColor = "yellow";
                                                        }
                                                        if (avance >= 81 && avance <= 90) {
                                                            document.getElementById("row").style.backgroundColor = "green";
                                                        }
                                                        if (avance >= 91) {
                                                            document.getElementById("row").style.backgroundColor = "lime";
                                                        }
                                                    </script>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    //mysqli_close($conexion);
                                    ?>

                                    <tr>
                                        <td>0266</td>
                                        <td>2</td>
                                        <td>15</td>
                                        <td>660</td>
                                        <td>10</td>
                                        <td>75%</td>
                                        <td>60%</td>
                                    </tr>
                                    <tr>
                                        <td>0266</td>
                                        <td>2</td>
                                        <td>15</td>
                                        <td>660</td>
                                        <td>10</td>
                                        <td>75%</td>
                                        <td>60%</td>
                                    </tr>
                                    <tr>
                                        <td>0266</td>
                                        <td>2</td>
                                        <td>15</td>
                                        <td>660</td>
                                        <td>10</td>
                                        <td>75%</td>
                                        <td>60%</td>
                                    </tr>
                                    <tr>
                                        <td>0266</td>
                                        <td>2</td>
                                        <td>15</td>
                                        <td>660</td>
                                        <td>10</td>
                                        <td>75%</td>
                                        <td>60%</td>
                                    </tr>
                                    <tr>
                                        <td>0266</td>
                                        <td>2</td>
                                        <td>15</td>
                                        <td>660</td>
                                        <td>10</td>
                                        <td>75%</td>
                                        <td>60%</td>
                                    </tr>
                                    <tr>
                                        <td>0266</td>
                                        <td>2</td>
                                        <td>15</td>
                                        <td>660</td>
                                        <td>10</td>
                                        <td>75%</td>
                                        <td>60%</td>
                                    </tr>
                                    <tr>
                                        <td>0266</td>
                                        <td>2</td>
                                        <td>15</td>
                                        <td>660</td>
                                        <td>10</td>
                                        <td>75%</td>
                                        <td>60%</td>
                                    </tr>
                                    <tr>
                                        <td>0266</td>
                                        <td>2</td>
                                        <td>15</td>
                                        <td>660</td>
                                        <td>10</td>
                                        <td>75%</td>
                                        <td>60%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <button id="exportBtn1" onclick="exportReportToExcel()" class="btn btn-success">Descargar Excel&nbsp;&nbsp;<i class="fas fa-download"></i></button>






        </div>
    </div>

    <style type="text/css">
        thead tr th {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #ffffff;
        }
    </style>


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