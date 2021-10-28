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
    <title>Panel bingo</title>
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
                        // $consultaMetas = "SELECT * FROM metas";
                        $consultaPromocion = "";
                        if (isset($_POST['municipio'])) {
                            $municipio = $_POST['municipio'];
                            $sql = "SELECT * FROM metas WHERE municipio = '$municipio'";
                            if ($municipio == 'todos') {
                                $municipio = "COMPLETO";
                                $sql = "SELECT * FROM metas";
                            }
                        } else {
                            $municipio = "COMPLETO";
                            $sql = "SELECT * FROM metas";
                        }
                        ?>
                        <h2 class="text-center"> <span>Panel BINGO</span></h2>
                        <h2 class="text-center"> <span style="color: red;"><?php echo strtoupper($municipio); ?></span></h2>

                        <form action="" method="post">
                            <label for="municipio" class="form-label">Municipio:</label>
                            <select name="municipio" id="municipio" class="form-control form-select" required>
                                <option hidden selected value="">Selecciona un municipio</option>
                                <option value="mezquital">Mezquital</option>
                                <option value="nombre de dios">Nombre de Dios</option>
                                <option value="poanas">Poanas</option>
                                <option value="vicente guerrero">Vicente Guerrero</option>
                                <option value="suchil">Súchil</option>
                                <option value="todos">Todos los municipios</option>
                            </select>
                            <br>
                            <button type="submit" class="btn btn-success form-control">VER AVANCE</button>

                        </form>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="height: 350px;">
                            <table class="table" name="table" id="table">
                                <thead class="table-dark" style="position: sticky;">
                                    <tr style="position: sticky;">
                                        <th scope="col" class="text-center">Municipio</th>

                                        <th scope="col" class="text-center">Sección</th>
                                        <th scope="col" class="text-center">SP</th>
                                        <th scope="col" class="text-center">Meta</th>
                                        <th scope="col" class="text-center">#Promovidos</th>
                                        <th scope="col" class="text-center">Han votado</th>
                                        <th scope="col" class="text-center">%Avance</th>
                                        <th scope="col" class="text-center">Ultimo Envio</th>
                                    </tr>
                                </thead>
                                <tbody style="overflow: auto; ">
                                    <?php

                                    $result = $conexion->query($sql);
                                    $count = 0;

                                    setlocale(LC_ALL, "en_US.UTF-8");

                                    if ($result->num_rows > 0) {

                                        while ($row = $result->fetch_assoc()) {
                                            $municipio =  $row["municipio"];
                                            $seccion = $row["seccion"];
                                            $sp =  $row["sp"];
                                            $meta =  $row["meta"];
                                            $votos = $row["votos"];
                                            $ultimoEnvioFecha = $row["ultimoEnvio"];
                                            if ($ultimoEnvioFecha == NULL) {
                                                //   echo 'fecha null';
                                                //   echo $ultimoEnvio;
                                                $ultimoEnvio = 0;
                                            } else {
                                                $ultimoEnvio = date('h:i:s A', strtotime($ultimoEnvioFecha));
                                            }
                                            //echo $seccion;
                                            ///CONTAR TOTAL PROMOVIDOS
                                            $consultaPromocion = "SELECT COUNT(seccion) as total FROM amigos_principales WHERE seccion = '$seccion'";
                                            $resultadoConsultaPromocion = $conexion->query($consultaPromocion);
                                            $renglonConsultaPromocion = $resultadoConsultaPromocion->fetch_assoc();
                                            $promovidos = implode($renglonConsultaPromocion);

                                            ////CONTAR REPETIDOS POR SECCION
                                            $contarRepetidos = "SELECT COUNT(seccion) as total FROM amigos_principales WHERE seccion = '$seccion' and repetido = 'si'";
                                            $totalRepetidos = $conexion->query($contarRepetidos);
                                            $renglonRepetidos = $totalRepetidos->fetch_assoc();
                                            $repetidos = implode($renglonRepetidos);

                                            //PROMOVIOS REALES
                                            $promovidosReales = $promovidos - $repetidos;



                                            if ($meta == 0) {
                                                //$meta = 1;
                                                $avance = 100;
                                            } else {
                                                $avance = ($votos / $meta) * (100);
                                            }
                                            //    $sp =  $row["sp"];
                                            //    $sp =  $row["sp"];

                                    ?>
                                            <tr id="row-<?php echo $count ?>">
                                                <td class="text-center"><?php echo $municipio ?></td>
                                                <td class="text-center"><?php echo $seccion ?></td>
                                                <td class="text-center"><?php echo $sp ?></td>
                                                <td class="text-center"> <span id="meta-<?php echo $count ?>"><?php echo $meta ?></span> </td>
                                                <td class="text-center "><?php echo $promovidosReales ?></td>
                                                <td class="text-center "><?php echo $votos ?></td>


                                                <td class="text-center">
                                                    <span id="avance-<?php echo $count ?>"><?php echo round($avance, 2)  ?></span>%
                                                </td>
                                                <td class="text-center "><?php echo $ultimoEnvio ?></td>
                                            </tr>
                                            <script>
                                                avance = document.getElementById("avance-<?php echo $count; ?>").innerHTML;
                                                meta = document.getElementById("meta-<?php echo $count; ?>").innerHTML;

                                                console.log(avance);
                                                if (meta == 0 && avance == 100) {
                                                    document.getElementById("row-<?php echo $count ?>").style.backgroundColor = "deepskyblue";
                                                } else {
                                                    if (avance > 0 && avance <= 59) {
                                                        document.getElementById("row-<?php echo $count ?>").style.backgroundColor = "red";
                                                    }
                                                    if (avance >= 60 && avance <= 80) {
                                                        document.getElementById("row-<?php echo $count ?>").style.backgroundColor = "yellow";
                                                    }
                                                    if (avance >= 81 && avance <= 90) {
                                                        document.getElementById("row-<?php echo $count ?>").style.backgroundColor = "green";
                                                    }
                                                    if (avance >= 91) {
                                                        document.getElementById("row-<?php echo $count ?>").style.backgroundColor = "lime";
                                                    }
                                                }
                                            </script>
                                    <?php
                                            $count++;
                                        }












                                        if (isset($_POST['municipio'])) {
                                            $municipio = $_POST['municipio'];
                                            $consultaVotosTotal = "SELECT SUM(votos) as total FROM metas WHERE municipio = '$municipio'";
                                            $consultaPromocionTotal = "SELECT COUNT(municipio) as total FROM amigos_principales WHERE municipio = '$municipio'";
                                            $contarRepetidosTotal = "SELECT COUNT(seccion) as total FROM amigos_principales WHERE municipio = '$municipio' and repetido = 'si'";
                                            $consultaMetasTotal = "SELECT SUM(meta) as total FROM metas WHERE municipio = '$municipio'";

                                            if ($municipio == 'todos') {
                                                $municipio = "COMPLETO";
                                                $consultaVotosTotal = "SELECT SUM(votos) as total FROM metas";
                                                $consultaPromocionTotal = "SELECT COUNT(municipio) as total FROM amigos_principales";
                                                $contarRepetidosTotal = "SELECT COUNT(seccion) as total FROM amigos_principales WHERE repetido = 'si'";
                                                $consultaMetasTotal = "SELECT SUM(meta) as total FROM metas";
                                            }
                                        } else {
                                            $municipio = "COMPLETO";
                                            $consultaVotosTotal = "SELECT SUM(votos) as total FROM metas";
                                            $consultaPromocionTotal = "SELECT COUNT(municipio) as total FROM amigos_principales";
                                            $contarRepetidosTotal = "SELECT COUNT(seccion) as total FROM amigos_principales WHERE repetido = 'si'";
                                            $consultaMetasTotal = "SELECT SUM(meta) as total FROM metas";
                                        }


                                        ////CONTAR TOTAL DE PROMOVIDOS
                                        //  $consultaPromocionTotal = "SELECT COUNT(municipio) as total FROM amigos_principales WHERE municipio = '$municipio'";
                                        $resultadoConsultaPromocionTotal = $conexion->query($consultaPromocionTotal);
                                        $renglonConsultaPromocionTotal = $resultadoConsultaPromocionTotal->fetch_assoc();
                                        $promovidosTotal = implode($renglonConsultaPromocionTotal);



                                        ////CONTAR REPETIDOS POR SECCION
                                        $totalRepetidosTotal = $conexion->query($contarRepetidosTotal);
                                        $renglonRepetidosTotal = $totalRepetidosTotal->fetch_assoc();
                                        $repetidosTotal = implode($renglonRepetidosTotal);


                                        //PROMOVIOS REALES
                                        $promovidosRealesTotal = $promovidosTotal - $repetidosTotal;


                                        ////CONTAR METAS
                                        $resultadoConsultaMetasTotal = $conexion->query($consultaMetasTotal);
                                        $renglonConsultaMetasTotal = $resultadoConsultaMetasTotal->fetch_assoc();
                                        $metasTotal = implode($renglonConsultaMetasTotal);


                                        ////CONTAR TOTAL DE VOTOS
                                        $totalVotosTotal = $conexion->query($consultaVotosTotal);
                                        $renglonVotosTotal = $totalVotosTotal->fetch_assoc();
                                        $votosTotal = implode($renglonVotosTotal);



                                        ///AVANCE TOTAL
                                        $avanceVotosTotal = ($votosTotal / $metasTotal) * (100);


                                        ?>
                                <tfoot class="table-primary" style="position: sticky;">
                                    <tr style="position: sticky;">
                                        <th scope="col" class="text-center">TOTAL</th>
                                        <th scope="col" class="text-center">-</th>
                                        <th scope="col" class="text-center">-</th>
                                        <th scope="col" class="text-center"><?php echo $metasTotal ?></th>
                                        <th scope="col" class="text-center"><?php echo $promovidosRealesTotal ?></th>



                                        <th scope="col" class="text-center"><?php echo $votosTotal ?></th>
                                        <td class="text-center">
                                            <span><?php echo round($avanceVotosTotal, 2)  ?></span>%
                                        </td>
                                        <th scope="col" class="text-center">-</th>
                                    </tr>
                                </tfoot>
                            <?php



















                                    } else {
                                        echo "0 results";
                                    }
                                    //mysqli_close($conexion);
                                    ?>


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
                name: `BINGO_${localCurrentDate}.xlsx`, // fileName you could use any name
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
