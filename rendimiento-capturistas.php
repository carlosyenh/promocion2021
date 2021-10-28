<?php
session_start();
if (!$_SESSION['username']) {
    header("location:login.php");
}
if ($_SESSION['userType'] != 'administrador') {
    header("location:login.php");
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

<body style="background-color: #009900;">
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
                        <li><a class="dropdown-item nav-item" href="rendimiento-capturistas.php" style="color: grey;">Rendimiento de capturistas</a></li>
                        <li><a class="dropdown-item nav-item" href="panel-bingo.php" style="color: grey;">Panel Bingo</a></li>
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
                        <?php
                        mysqli_report(MYSQLI_REPORT_STRICT);
                        require 'conexion.php';
                        // CONSULTAR DEL DIA DE HOY
                        if (isset($_POST['dateToSearch'])) {
                            $dateToSearch = $_POST['dateToSearch'];
                        } else {
                            $dateToSearch = "Hoy";
                        }
                        ?>
                        <h2 class="text-center"> <span>Rendimiento</span></h2>
                        <h2 class="text-center"> <span style="color: red;"><?php echo strtoupper($dateToSearch); ?></span></h2>

                        <form action="" method="post">
                            <label for="dateToSearch">Buscar fecha:</label>
                            <input type="date" id="dateToSearch" name="dateToSearch" value="<?php echo $dateToSearch ?>" min="2021-05-01" max="2021-07-10" class="form-control">
                            <br>
                            <button type="submit" class="btn btn-success form-control">Buscar por fecha</button>
                        </form>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="height: 350px;">
                            <table class="table" name="table" id="table">
                                <thead class="table-dark" style="position: sticky;">
                                    <tr style="position: sticky;">
                                        <th scope="col" class="text-center">Nombre</th>
                                        <th scope="col" class="text-center">Capturados <?php echo $dateToSearch ?></th>
                                        <th scope="col" class="text-center">Total capturadas</th>
                                        <th scope="col" class="text-center">Folios capturados</th>

                                    </tr>
                                </thead>
                                <tbody style="overflow: auto; ">
                                    <?php

                                    $consutarNombresCapturistas = "SELECT usuario FROM usuarios WHERE userType = 'capturista'";
                                    $listaCapturistas = $conexion->query($consutarNombresCapturistas);

                                    if ($listaCapturistas->num_rows > 0) {
                                        while ($row = $listaCapturistas->fetch_assoc()) {
                                            $usuario = $row["usuario"];


                                            if (isset($_POST['dateToSearch'])) {
                                                $consultarDia = "SELECT COUNT(id) AS totalCapturadas FROM `amigos_principales` WHERE capturista = '$usuario' AND DATE(fecha_de_captura) = DATE('$dateToSearch')";
                                                $consultarDiaTotal = "SELECT COUNT(id) AS totalCapturadas FROM `amigos_principales` WHERE DATE(fecha_de_captura) = DATE('$dateToSearch')";
                                            } else {
                                                $consultarDia = "SELECT COUNT(id) AS totalCapturadas FROM `amigos_principales` WHERE capturista = '$usuario' AND DATE(fecha_de_captura) = CURRENT_DATE()";
                                                $consultarDiaTotal = "SELECT COUNT(id) AS totalCapturadas FROM `amigos_principales` WHERE DATE(fecha_de_captura) = CURRENT_DATE()";
                                            }




                                            /////////TOTAL CAPTURADOS POR CADA CAPTURISTA////////////////////////
                                            $consultaTotalCapturados = "SELECT COUNT(id) AS totalCapturadas FROM `amigos_principales` WHERE capturista = '$usuario'";
                                            $resultadoConsultaTotalCapturados = $conexion->query($consultaTotalCapturados);
                                            $renglonTotalCapturados = $resultadoConsultaTotalCapturados->fetch_assoc();
                                            $totalCapturados = implode($renglonTotalCapturados);

                                            ///TOTAL CAPTURADOS POR DIA POR CADA CAPTURISTA ////////////
                                            $resultadoConsultaTotalCapturadosPorDia = $conexion->query($consultarDia);
                                            $renglonTotalCapturadosPorDia = $resultadoConsultaTotalCapturadosPorDia->fetch_assoc();
                                            $totalCapturadosPorDia = implode($renglonTotalCapturadosPorDia);



                                            /////////TOTAL CAPTURADOS POR CADA CAPTURISTA POR FOLIO////////////////////////
                                            $consultaTotalFoliosCapturados = "SELECT COUNT(DISTINCT folio) FROM `amigos_principales` WHERE capturista = '$usuario'";
                                            $resultadoConsultaTotalFoliosCapturados = $conexion->query($consultaTotalFoliosCapturados);
                                            $renglonTotalFoliosCapturados = $resultadoConsultaTotalFoliosCapturados->fetch_assoc();
                                            $totalFoliosCapturados = implode($renglonTotalFoliosCapturados);
                                    ?>

                                            <tr>
                                                <td class="text-center "><?php echo $usuario ?></td>
                                                <td class="text-center "><?php echo $totalCapturadosPorDia ?></td>
                                                <td class="text-center "><?php echo $totalCapturados ?></td>
                                                <td class="text-center "><?php echo $totalFoliosCapturados ?></td>
                                            </tr>

                                    <?php
                                        }
                                    }


                                    /////////TOTAL CAPTURADOS////////////////////////
                                    $consultaTotalCapturadosTotal = "SELECT COUNT(id) AS totalCapturadas FROM `amigos_principales`";
                                    $resultadoConsultaTotalCapturadosTotal = $conexion->query($consultaTotalCapturadosTotal);
                                    $renglonTotalCapturadosTotal = $resultadoConsultaTotalCapturadosTotal->fetch_assoc();
                                    $totalCapturadosTotal = implode($renglonTotalCapturadosTotal);


                                    ///TOTAL CAPTURADOS POR DIA ////////////
                                    $resultadoConsultaTotalCapturadosPorDiaTotal = $conexion->query($consultarDiaTotal);
                                    $renglonTotalCapturadosPorDiaTotal = $resultadoConsultaTotalCapturadosPorDiaTotal->fetch_assoc();
                                    $totalCapturadosPorDiaTotal = implode($renglonTotalCapturadosPorDiaTotal);

                                    ///TOTL DE FOLIOS CAPTURADOS
                                    $consultaTotalFoliosCapturadosTotal = "SELECT COUNT(DISTINCT folio) FROM `amigos_principales`";
                                    $resultadoConsultaTotalFoliosCapturadosTotal = $conexion->query($consultaTotalFoliosCapturadosTotal);
                                    $renglonTotalFoliosCapturadosTotal = $resultadoConsultaTotalFoliosCapturadosTotal->fetch_assoc();
                                    $totalFoliosCapturadosTotal = implode($renglonTotalFoliosCapturadosTotal);


                                    ?>
                                    <tr>
                                        <td class="text-center "><b class="text-danger">TOTAL</b></td>
                                        <td class="text-center "><b class="text-danger"><?php echo $totalCapturadosPorDiaTotal ?></b></td>
                                        <td class="text-center "><b class="text-danger"><?php echo $totalCapturadosTotal ?></b></td>
                                        <td class="text-center "><b class="text-danger"><?php echo $totalFoliosCapturadosTotal ?></b></td>
                                    </tr>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="mb-3">
                <button id="exportBtn1" onclick="exportReportToExcel()" class="btn btn-primary mb-3">Descargar Excel&nbsp;&nbsp;<i class="fas fa-download"></i></button>
            </div>






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
                name: `Rendimiento_capturistas_${localCurrentDate}.xlsx`, // fileName you could use any name
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
