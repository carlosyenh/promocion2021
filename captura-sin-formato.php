<?php
session_start();
if (!$_SESSION['username']) {
    header("location:login.php");
}
if ($_SESSION['userType'] != 'administrador' && $_SESSION['userType'] != 'supervisor' && $_SESSION['userType'] != 'capturista') {
    header("location:login.php");
    //echo $_SESSION['userType'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
                    <?php } ?>
                    <li><a class="dropdown-item nav-item" href="logout.php" style="color: grey;">Cerrar sesíon</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        let seccionesMezquital = [];
        let seccionesNDD = [];
        let seccionesSuchil = [];
        let seccionesPoanas = [];
        let seccionesVicente = [];
    </script>

    <?php
    ///////////GET SUCHIL///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    require 'conexion.php';
    $contador = 0;
    $consultaSecciones = "SELECT seccion FROM metas WHERE municipio = 'mezquital'";
    $result = $conexion->query($consultaSecciones);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $seccion = $row['seccion'];
            //echo $seccion;
            $contador++;
    ?>
            <script>
                seccionesMezquital.push("<?php echo $seccion ?>");
            </script>

        <?php
        }
        //echo 'sali';
    } else {
        echo 'No resultados encontrados';
    }



    ///////////GET SUCHIL///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    $contador = 0;
    $consultaSecciones = "SELECT seccion FROM metas WHERE municipio = 'suchil'";
    $result = $conexion->query($consultaSecciones);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $seccion = $row['seccion'];
            //echo $seccion;
            $contador++;
        ?>
            <script>
                seccionesSuchil.push("<?php echo $seccion ?>");
            </script>

        <?php
        }
        //echo 'sali';
    } else {
        echo 'No resultados encontrados';
    }


    ///////////GET NOMBRE DE DIOS///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    $contador = 0;
    $consultaSecciones = "SELECT seccion FROM metas WHERE municipio = 'nombre de dios'";
    $result = $conexion->query($consultaSecciones);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $seccion = $row['seccion'];
            //echo $seccion;
            $contador++;
        ?>
            <script>
                seccionesNDD.push("<?php echo $seccion ?>");
            </script>

        <?php
        }
        //echo 'sali';
    } else {
        echo 'No resultados encontrados';
    }



    ///////////GET POANAS///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    $contador = 0;
    $consultaSecciones = "SELECT seccion FROM metas WHERE municipio = 'poanas'";
    $result = $conexion->query($consultaSecciones);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $seccion = $row['seccion'];
            //echo $seccion;
            $contador++;
        ?>
            <script>
                seccionesPoanas.push("<?php echo $seccion ?>");
            </script>

        <?php
        }
        //echo 'sali';
    } else {
        echo 'No resultados encontrados';
    }



    ///////////GET VICENTE///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    $contador = 0;
    $consultaSecciones = "SELECT seccion FROM metas WHERE municipio = 'vicente guerrero'";
    $result = $conexion->query($consultaSecciones);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $seccion = $row['seccion'];
            //echo $seccion;
            $contador++;
        ?>
            <script>
                seccionesVicente.push("<?php echo $seccion ?>");
            </script>

    <?php
        }
        //echo 'sali';
    } else {
        echo 'No resultados encontrados';
    }

    ?>




    <div class="container mt-3 mb-3">
        <div class="col-md-8 mx-auto ">
            <div id="amigop" name="amigoPrincipalDiv">
                <div class="card mb-3 border-dark">
                    <div class="card-header bg-success">
                        <h2 class="mx-auto center text-light">Captura SIN formato</h2>
                    </div>
                    <div class="card-body">
                        <div class="form">
                            <form action="captura-sin-formato-api.php" method="post" name="amigoPrincipalForm" id="amigoPrincipalForm">

                                <label for="id_del_promotor" class="form-label">ID del promotor:</label>
                                <input type="number" name="id_del_promotor" id="id_del_promotor" placeholder="ID del promotor" class="form-control" min="1" max="2000" required>
                                <br>

                                <label for="municipio" class="form-label">Municipio:</label>
                                <select name="municipio" id="municipio" name="municipio" class="form-control form-select" onchange="cambia_provincia()" required>
                                    <option hidden selected value="">Selecciona un municipio</option>
                                    <option value="1">Mezquital</option>
                                    <option value="2">Nombre de Dios</option>
                                    <option value="3">Poanas</option>
                                    <option value="4">Súchil</option>
                                    <option value="5">Vicente Guerrero</option>
                                </select>
                                <br>

                                <label for="localidad" class="form-label">Localidad:</label>
                                <input type="text" name="localidad" id="localidad" placeholder="Localidad" class="form-control">
                                <br>

                                <label for="seccion" class="form-label">Sección:</label>
                                <select name="seccion" id="seccion" name="municipio" class="form-control form-select" required>
                                    <option hidden selected value="">Selecciona una seccion</option>

                                </select>
                                <br>

                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control" required>
                                <br>

                                <label for="apat" class="form-label">Apellido Paterno:</label>
                                <input type="text" name="apat" id="apat" placeholder="Apellido paterno" class="form-control" required>
                                <br>

                                <label for="amat" class="form-label">Apellido materno:</label>
                                <input type="text" name="amat" id="amat" placeholder="Apellido materno" class="form-control">
                                <br>

                                <button type="submit" class="btn btn-success form-control" value="captura">CAPTURAR PROMOVIDO</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script>
        var mequital = seccionesMezquital;
        var ndd = seccionesNDD;
        var poanas = seccionesPoanas;
        var suchil = seccionesSuchil;
        var vicente = seccionesVicente;


        var todasSecciones = [
            [],
            mequital,
            ndd,
            poanas,
            suchil,
            vicente
        ];

        function cambia_provincia() {
            //tomo el valor del select del pais elegido 
            var municipio
            municipio = document.amigoPrincipalForm.municipio[document.amigoPrincipalForm.municipio.selectedIndex].value
            console.log(municipio)
            //miro a ver si el pais está definido 
            if (municipio != 0) {
                //si estaba definido, entonces coloco las opciones de la provincia correspondiente. 
                //selecciono el array de provincia adecuado 
                misSecciones = todasSecciones[municipio]
                //calculo el numero de provincias 
                numSecciones = misSecciones.length
                //marco el número de provincias en el select 
                document.amigoPrincipalForm.seccion.length = numSecciones + 1


                //para cada provincia del array, la introduzco en el select
                for (i = 0; i < numSecciones; i++) {
                    document.amigoPrincipalForm.seccion.options[i + 1].value = misSecciones[i]
                    document.amigoPrincipalForm.seccion.options[i + 1].text = misSecciones[i]
                }
            } else {
                //si no había provincia seleccionada, elimino las provincias del select 
                document.amigoPrincipalForm.seccion.length = 1
                //coloco un guión en la única opción que he dejado 
                document.amigoPrincipalForm.seccion.options[0].value = ""
                document.amigoPrincipalForm.seccion.options[0].text = "Seleiona una seccion"
            }
            //marco como seleccionada la opción primera de provincia 
            document.amigoPrincipalForm.seccion.options[0].selected = true
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>

</html>
