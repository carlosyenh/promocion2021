<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>BINGO</title>
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
                        <h2 class="mx-auto center text-light">B - I - N - G - O</h2>
                    </div>
                    <div class="card-body">
                        <div class="form">
                            <form action="bingo-api.php" method="post" name="bingoForm" id="bingoForm">



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

                                <label for="seccion" class="form-label">Sección:</label>
                                <select name="seccion" id="seccion" name="municipio" class="form-control form-select" required>
                                    <option hidden selected value="">Selecciona una seccion</option>
                                </select>
                                <br>
                                <span>Numero de corte</span>
                                <br>

                                <?php
                                date_default_timezone_set('America/Mexico_City');
                                $today = strtotime(date("d-m-Y H:i:00", time()));
                                $startDay   = strtotime("06-06-2021 11:00:00");
                                $dateCorte2 = strtotime("06-06-2021 13:00:00");
                                $dateCorte3 = strtotime("06-06-2021 14:00:00");
                                $dateCorte4 = strtotime("06-06-2021 17:00:00");

                                // date_default_timezone_set('America/Mexico_City');
                               // echo date('Y-m-d H:i:s', $today);


                                if ($today >= $startDay && $today < $dateCorte2) {
                                    echo  "Corte 1";
                                ?>
                                    <div class="form-check">
                                        <input type="radio" id="corte1" name="corte" value="1" class="form-check-input" checked>
                                        <label for="corte1" class="form-check-label">11:00</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="corte2" name="corte" value="2" class="form-check-input" disabled>
                                        <label for="corte2" class="form-check-label">13:00</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="corte3" name="corte" value="3" class="form-check-input" disabled>
                                        <label for="corte3" class="form-check-label">14:00</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="corte4" name="corte" value="4" class="form-check-input" disabled>
                                        <label for="corte4" class="form-check-label">17:00</label>
                                    </div>
                                    <br>
                                <?php
                                }

                                else if ($today >= $dateCorte2 && $today < $dateCorte3) {
                                    echo  "Corte 2";
                                    ?>
                                    <div class="form-check">
                                        <input type="radio" id="corte1" name="corte" value="1" class="form-check-input" disabled>
                                        <label for="corte1" class="form-check-label">11:00</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="corte2" name="corte" value="2" class="form-check-input" checked>
                                        <label for="corte2" class="form-check-label">13:00</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="corte3" name="corte" value="3" class="form-check-input" disabled>
                                        <label for="corte3" class="form-check-label">14:00</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="corte4" name="corte" value="4" class="form-check-input" disabled>
                                        <label for="corte4" class="form-check-label">17:00</label>
                                    </div>
                                    <br>
                                <?php
                                }

                                else if ($today >= $dateCorte3 && $today < $dateCorte4) {
                                    echo  "Corte 3";
                                    ?>
                                    <div class="form-check">
                                        <input type="radio" id="corte1" name="corte" value="1" class="form-check-input" disabled>
                                        <label for="corte1" class="form-check-label">11:00</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="corte2" name="corte" value="2" class="form-check-input" disabled>
                                        <label for="corte2" class="form-check-label">13:00</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="corte3" name="corte" value="3" class="form-check-input" checked>
                                        <label for="corte3" class="form-check-label">14:00</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="corte4" name="corte" value="4" class="form-check-input" disabled>
                                        <label for="corte4" class="form-check-label">17:00</label>
                                    </div>
                                    <br>
                                <?php
                                }

                               else  if ($today >= $dateCorte4) {
                                    echo  "Corte 4";
                                    ?>
                                    <div class="form-check">
                                        <input type="radio" id="corte1" name="corte" value="1" class="form-check-input" disabled>
                                        <label for="corte1" class="form-check-label">11:00</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="corte2" name="corte" value="2" class="form-check-input" disabled>
                                        <label for="corte2" class="form-check-label">13:00</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="corte3" name="corte" value="3" class="form-check-input" disabled>
                                        <label for="corte3" class="form-check-label">14:00</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="corte4" name="corte" value="4" class="form-check-input" checked>
                                        <label for="corte4" class="form-check-label">17:00</label>
                                    </div>
                                    <br>
                                <?php
                                }




                                ?>

                                <label for="hanvotado" class="form-label">Han votado:</label>
                                <input type="number" name="hanvotado" id="hanvotado" placeholder="¿Cuantas personas han votado?" class="form-control" min="0" required>
                                <br>
                                <label for="enviado_por" class="form-label">Nombre de quién envia:</label>
                                <input type="text" name="enviado_por" id="clave" placeholder="Escribe tu nombre y apellido" class="form-control" required>
                                <br>
                                <button type="submit" class="btn btn-success form-control" value="captura">ENVIAR DATOS</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    /*
        const corte1 = document.getElementById("corte1");
        const corte2 = document.getElementById("corte2");
        const corte3 = document.getElementById("corte3");
        const corte4 = document.getElementById("corte4");

        const dayToday = new Date().getTime();
        const startDate = new Date('jun 03, 2021 00:31:00').getTime();
        //const dateCorte1 =new Date('jun 03, 2021 00:53:00').getTime();
        const dateCorte2 = new Date('jun 03, 2021 00:33:00').getTime();
        const dateCorte3 = new Date('jun 03, 2021 00:34:00').getTime();
        const dateCorte4 = new Date('jun 03, 2021 00:36:00').getTime();
        
        //1
        //13
        //14
        //17
        
        console.log('fecha hoy', dayToday);
        ///console.log( 'fecha  2 ',  date2);



        if (dayToday > startDate) {
            console.log('starting');
            corte1.checked = true;
            corte1.disabled = false;

            corte2.checked = false;
            corte2.disabled = true;

            corte3.checked = false;
            corte3.disabled = true;

            corte4.checked = false;
            corte4.disabled = true;
        }

        if (dayToday > dateCorte2) {
            console.log('corte 2');
            corte1.checked = false;
            corte1.disabled = true;

            corte2.checked = true;
            corte2.disabled = false;

            corte3.checked = false;
            corte3.disabled = true;

            corte4.checked = false;
            corte4.disabled = true;
        }

        if (dayToday > dateCorte3) {
            console.log('corte 3');
            corte1.checked = false;
            corte1.disabled = true;

            corte2.checked = false;
            corte2.disabled = true;

            corte3.checked = true;
            corte3.disabled = false;

            corte4.checked = false;
            corte4.disabled = true;
        }

        if (dayToday > dateCorte4) {
            console.log('corte 4');
            corte1.checked = false;
            corte1.disabled = true;

            corte2.checked = false;
            corte2.disabled = true;

            corte3.checked = false;
            corte3.disabled = true;

            corte4.checked = true;
            corte4.disabled = false;
        }

        */



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
            municipio = document.bingoForm.municipio[document.bingoForm.municipio.selectedIndex].value
            console.log(municipio)
            //miro a ver si el pais está definido 
            if (municipio != 0) {
                //si estaba definido, entonces coloco las opciones de la provincia correspondiente. 
                //selecciono el array de provincia adecuado 
                misSecciones = todasSecciones[municipio]
                //calculo el numero de provincias 
                numSecciones = misSecciones.length
                //marco el número de provincias en el select 
                document.bingoForm.seccion.length = numSecciones + 1


                //para cada provincia del array, la introduzco en el select
                for (i = 0; i < numSecciones; i++) {
                    document.bingoForm.seccion.options[i + 1].value = misSecciones[i]
                    document.bingoForm.seccion.options[i + 1].text = misSecciones[i]
                }
            } else {
                //si no había provincia seleccionada, elimino las provincias del select 
                document.bingoForm.seccion.length = 1
                //coloco un guión en la única opción que he dejado 
                document.bingoForm.seccion.options[0].value = ""
                document.bingoForm.seccion.options[0].text = "Seleiona una seccion"
            }
            //marco como seleccionada la opción primera de provincia 
            document.bingoForm.seccion.options[0].selected = true
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>
