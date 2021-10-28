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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
    <title>Grafica de avance</title>
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
                        <li><a class="dropdown-item nav-item" href="rendimiento-capturistas.php" style="color: grey;">Rendimiento de capturistas</a></li>
                        <li><a class="dropdown-item nav-item" href="panel-bingo.php" style="color: grey;">Panel Bingo</a></li>
                    <?php } ?>
                    <li><a class="dropdown-item nav-item" href="logout.php" style="color: grey;">Cerrar sesíon</a></li>
                </ul>
            </div>
        </div>
    </nav>



    <?php
    mysqli_report(MYSQLI_REPORT_STRICT);
    require 'conexion.php';

    //mezquital
    ////CONTAR TOTAL DE PROMOVIDOS
    $consultaPromocionMezquital = "SELECT COUNT(municipio) as total FROM amigos_principales WHERE municipio = 'mezquital'";
    $resultadoConsultaPromocionMezquital = $conexion->query($consultaPromocionMezquital);
    $renglonConsultaPromocionMezquital = $resultadoConsultaPromocionMezquital->fetch_assoc();
    $promovidosMezquital = implode($renglonConsultaPromocionMezquital);

    ////CONTAR REPETIDOS POR SECCION
    $contarRepetidosMezquital = "SELECT COUNT(seccion) as total FROM amigos_principales WHERE municipio = 'mezquital' and repetido = 'si'";
    $totalRepetidosMezquital = $conexion->query($contarRepetidosMezquital);
    $renglonRepetidosMezquital = $totalRepetidosMezquital->fetch_assoc();
    $repetidosMezquital = implode($renglonRepetidosMezquital);

    //PROMOVIOS REALES
    $promovidosRealesMezquital = $promovidosMezquital - $repetidosMezquital;





    //nombre de dios
    ////CONTAR TOTAL DE PROMOVIDOS
    $consultaPromocionNDD = "SELECT COUNT(municipio) as total FROM amigos_principales WHERE municipio = 'nombre de dios'";
    $resultadoConsultaPromocionNDD = $conexion->query($consultaPromocionNDD);
    $renglonConsultaPromocionNDD = $resultadoConsultaPromocionNDD->fetch_assoc();
    $promovidosNDD = implode($renglonConsultaPromocionNDD);

    ////CONTAR REPETIDOS POR SECCION
    $contarRepetidosNDD = "SELECT COUNT(seccion) as total FROM amigos_principales WHERE  municipio = 'nombre de dios' and repetido = 'si'";
    $totalRepetidosNDD = $conexion->query($contarRepetidosNDD);
    $renglonRepetidosNDD = $totalRepetidosNDD->fetch_assoc();
    $repetidosNDD = implode($renglonRepetidosNDD);

    //PROMOVIOS REALES
    $promovidosRealesNDD = $promovidosNDD - $repetidosNDD;



    


    //poanas
    $consultaPromocionPoanas = "SELECT COUNT(municipio) as total FROM amigos_principales WHERE municipio = 'poanas'";
    $resultadoConsultaPromocionPoanas = $conexion->query($consultaPromocionPoanas);
    $renglonConsultaPromocionPoanas = $resultadoConsultaPromocionPoanas->fetch_assoc();
    $promovidosPoanas = implode($renglonConsultaPromocionPoanas);

    ////CONTAR REPETIDOS POR SECCION
    $contarRepetidosPoanas = "SELECT COUNT(seccion) as total FROM amigos_principales WHERE municipio = 'poanas' and repetido = 'si'";
    $totalRepetidosPoanas = $conexion->query($contarRepetidosPoanas);
    $renglonRepetidosPoanas = $totalRepetidosPoanas->fetch_assoc();
    $repetidosPoanas = implode($renglonRepetidosPoanas);

    //PROMOVIOS REALES
    $promovidosRealesPoanas = $promovidosPoanas - $repetidosPoanas;






    //vicente guerrero
    ////CONTAR TOTAL DE PROMOVIDOS
    $consultaPromocionVicente = "SELECT COUNT(municipio) as total FROM amigos_principales WHERE municipio = 'vicente guerrero'";
    $resultadoConsultaPromocionVicente = $conexion->query($consultaPromocionVicente);
    $renglonConsultaPromocionVicente = $resultadoConsultaPromocionVicente->fetch_assoc();
    $promovidosVicente = implode($renglonConsultaPromocionVicente);

    ////CONTAR REPETIDOS POR SECCION
    $contarRepetidosVicente = "SELECT COUNT(seccion) as total FROM amigos_principales WHERE municipio = 'vicente guerrero' and repetido = 'si'";
    $totalRepetidosVicente = $conexion->query($contarRepetidosVicente);
    $renglonRepetidosVicente = $totalRepetidosVicente->fetch_assoc();
    $repetidosVicente = implode($renglonRepetidosVicente);

    //PROMOVIOS REALES
    $promovidosRealesVicente = $promovidosVicente - $repetidosVicente;






    //suchil
    ////CONTAR TOTAL DE PROMOVIDOS
    $consultaPromocionSuchil = "SELECT COUNT(municipio) as total FROM amigos_principales WHERE municipio = 'suchil'";
    $resultadoConsultaPromocionSuchil = $conexion->query($consultaPromocionSuchil);
    $renglonConsultaPromocionSuchil = $resultadoConsultaPromocionSuchil->fetch_assoc();
    $promovidosSuchil = implode($renglonConsultaPromocionSuchil);

    ////CONTAR REPETIDOS POR SECCION
    $contarRepetidosSuchil = "SELECT COUNT(seccion) as total FROM amigos_principales WHERE  municipio = 'suchil' and repetido = 'si'";
    $totalRepetidosSuchil = $conexion->query($contarRepetidosSuchil);
    $renglonRepetidosSuchil = $totalRepetidosSuchil->fetch_assoc();
    $repetidosSuchil = implode($renglonRepetidosSuchil);

    //PROMOVIOS REALES
    $promovidosRealesSuchil = $promovidosSuchil - $repetidosSuchil;


    ?>
    <canvas id="myChart"  width="400" height="400"></canvas>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Mezquital\n<?php echo $promovidosRealesMezquital ?>', 'Nombre de Dios\n<?php echo $promovidosRealesNDD ?>', 'Poanas\n<?php echo $promovidosRealesPoanas ?>', 'Vicente Guerrero\n<?php echo $promovidosRealesVicente ?>', 'Sushil\n<?php echo $promovidosRealesSuchil ?>'],
                datasets: [{
                    label: '# DE PROMOVIDOS POR MUNICIPIO',
                    data: [<?php echo $promovidosRealesMezquital; ?>, <?php echo $promovidosRealesNDD; ?>, <?php echo $promovidosRealesPoanas; ?>, <?php echo $promovidosRealesVicente; ?>, <?php echo $promovidosRealesSuchil; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'

                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>
