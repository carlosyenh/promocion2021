<?php
session_start();
$sesionMunicipio = $_SESSION['municipio'];
if (!$_SESSION['username']) {
    header("location:login.php");
}
if ($_SESSION['userType'] != 'administrador' && $_SESSION['userType'] != 'supervisor' && $_SESSION['userType'] != 'capturista' && $_SESSION['userType'] != 'encuestador' && $_SESSION['userType'] != 'superencuestador') {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Encuesta</title>
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




    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col col-md-8 mx-auto col-mt-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h2 class="text-center p-3">ENCUESTA DE INTENCIÓN DEL VOTO CAMPAÑA DIPUTADO LOCAL D15</h2>
                    </div>
                    <div class="card-body">
                        <form action="encuesta-api.php" method="POST" class="form ps-1 pe-1 pt-3 pb-3">
                            <label for="municipio" class="form-label">Municipio:</label>
                            <select name="municipio" id="municipio" class="form-control form-select" required>
                                <option hidden selected value="">Selecciona un municipio</option>
                                <?php
                                require 'conexion.php';
                                $consultaMunicipio = "SELECT municipio FROM metas_encuesta WHERE municipio = '$sesionMunicipio'";
                                $result = $conexion->query($consultaMunicipio);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $municipio = $row['municipio'];
                                        echo $municipio;
                                ?>
                                <?php
                                    }
                                    echo 'sali';
                                } else {
                                    echo 'hol';
                                }

                                ?>
                                <option value="<?php echo $municipio ?>"><?php echo $municipio ?></option>

                            </select>
                            <br>


                            <label for="seccion" class="form-label">Sección:</label>
                            <select name="seccion" id="seccion" class="form-control form-select" required>
                                <option hidden selected value="">Selecciona una sección</option>

                                <?php
                                require 'conexion.php';
                                $consultaSecciones = "SELECT seccion FROM metas_encuesta WHERE municipio = '$sesionMunicipio'";
                                $result = $conexion->query($consultaSecciones);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $seccion = $row['seccion'];
                                        echo $seccion;
                                ?>
                                        <option value="<?php echo $seccion ?>"><?php echo $seccion ?></option>
                                <?php
                                    }
                                    echo 'sali';
                                } else {
                                    echo 'hol';
                                }
                                ?>
                            </select>
                            <br>


                            <span>Credencial de Elector vigente:</span>
                            <div class="form-check">
                                <input type="radio" id="ine-vigente-si" name="ine-vigente" value="si" class="form-check-input" required>
                                <label for="ine-vigente-si" class="form-check-label">Sí</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="ine-vigente-no" name="ine-vigente" value="no" class="form-check-input">
                                <label for="ine-vigente-no" class="form-check-label">No</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="ine-vigente-no-sabe" name="ine-vigente" value="no sabe" class="form-check-input">
                                <label for="ine-vigente-no" class="form-check-label">No sabe</label>
                            </div>
                            <br>


                            <span>Sexo</span>
                            <div class="form-check">
                                <input type="radio" id="sexo-hombre" name="sexo" value="hombre" class="form-check-input" required>
                                <label for="sexo-hombre" class="form-check-label">Hombre</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="sexo-mujer" name="sexo" value="mujer" class="form-check-input">
                                <label for="sexo-mujer" class="form-check-label">Mujer</label>
                            </div>
                            <br>


                            <span>Rango de edad</span>
                            <div class="form-check">
                                <input type="radio" id="edad-A" name="edad" value="A" class="form-check-input" required>
                                <label for="edad-A" class="form-check-label">A) 18 años a 25 años</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="edad-B" name="edad" value="B" class="form-check-input">
                                <label for="edad-B" class="form-check-label">B) 26 años a 33 años</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="edad-C" name="edad" value="C" class="form-check-input">
                                <label for="edad-C" class="form-check-label">C) 34 años a 49 años</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="edad-D" name="edad" value="D" class="form-check-input">
                                <label for="edad-D" class="form-check-label">D) 50 años a 59 años</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="edad-E" name="edad" value="E" class="form-check-input">
                                <label for="edad-E" class="form-check-label">E) 60 a más años</label>
                            </div>
                            <br>







                            <span>1.- ¿Piensas votar estás elecciones?</span>
                            <div class="form-check">
                                <input type="radio" id="p1-A" name="p1" value="A" class="form-check-input" required>
                                <label for="p1-A" class="form-check-label">A) Sí</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="p1-B" name="p1" value="B" class="form-check-input">
                                <label for="p1-B" class="form-check-label">B) Tal Vez</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="p1-C" name="p1" value="C" class="form-check-input">
                                <label for="p1-C" class="form-check-label">C) No lo sé</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="p1-D" name="p1" value="D" class="form-check-input">
                                <label for="p1-D" class="form-check-label">D) No</label>
                            </div>
                            <br>




                            <span>
                                2.- De los siguientes candidatos a Diputado Local por el Distrito 1 ¿A quién reconoce más?
                            </span>
                            <br>
                            <span>Encuestador al enseñar las fotografías, una vez que haya identificado a uno se quita la foto y muestran las otras fotos restantes y se repite la pregunta (de estos a quien reconoce más) y así sucesivamente.</span>
                            <br>
                            <span>Según la respuesta: Se le enumeran del 1 al 4 poniendo el nuero 1 al primero que reconoció y así sucesivamente.</span>
                            <div class="input-group">
                                <input type="number" id="p2-A" name="p2-A" min="0" max="4" class="form-control" style="width: 35px; max-width: 35px;" required>
                                &nbsp;&nbsp;&nbsp;
                                <span class="input-group-text"> A) Alejandro Mojica Narváez</span>
                            </div>
                            <div class="input-group">
                                <input type="number" id="p2-B" name="p2-B" min="0" max="4" class="form-control" style="width: 35px; max-width: 35px;" required>
                                &nbsp;&nbsp;&nbsp;
                                <span class="input-group-text"> B) José Juan Cruz Martínez</span>
                            </div>
                            <div class="input-group">
                                <input type="number" id="p2-C" name="p2-C" min="0" max="4" class="form-control" style="width: 35px; max-width: 35px;" required>
                                &nbsp;&nbsp;&nbsp;
                                <span class="input-group-text"> C) Andrea Terán López Nava</span>
                            </div>
                            <div class="input-group">
                                <input type="number" id="p2-D" name="p2-D" min="0" max="4" class="form-control" style="width: 35px; max-width: 35px;" required>
                                &nbsp;&nbsp;&nbsp;
                                <span class="input-group-text"> D) Sonia Maribel Avilés Valdez </span>
                            </div>
                            <div class="input-group">
                                <input type="number" id="p2-E" name="p2-E" min="0" max="4" class="form-control" style="width: 35px; max-width: 35px;" required>
                                &nbsp;&nbsp;&nbsp;
                                <span class="input-group-text"> E) Alma Delia Pérez Gloria</span>
                            </div>
                            <div class="input-group">
                                <input type="number" id="p2-F" name="p2-F" min="0" max="4" class="form-control" style="width: 35px; max-width: 35px;" required>
                                &nbsp;&nbsp;&nbsp;
                                <span class="input-group-text"> F) Juan Francisco Soto Ledezma</span>
                            </div>
                            <div class="input-group">
                                <input type="number" id="p2-G" name="p2-G" min="0" max="4" class="form-control" style="width: 35px; max-width: 35px;" required>
                                &nbsp;&nbsp;&nbsp;
                                <span class="input-group-text"> G) Felipe De Jesús Hernández Orona</span>
                            </div>
                            <div class="input-group">
                                <input type="number" id="p2-H" name="p2-H" min="0" max="4" class="form-control" style="width: 35px; max-width: 35px;" required>
                                &nbsp;&nbsp;&nbsp;
                                <span class="input-group-text"> H) Sonia Jazmín Flores Arce </span>
                            </div>
                            <br>


                            <span>3.- ¿Si hoy fueran las elecciones para Diputado Local por el Distrito 1, ¿Por cuál candidato votaría?</span>
                            <div class="form-check" required>
                                <input type="radio" id="p3-A" name="p3" value="A" class="form-check-input" required>
                                <label for="p3-A" class="form-check-label">A) Alejandro Mojica Narváez</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p3-B" name="p3" value="B" class="form-check-input">
                                <label for="p3-B" class="form-check-label">B) José Juan Cruz Martínez</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p3-C" name="p3" value="C" class="form-check-input">
                                <label for="p3-C" class="form-check-label">C) Andrea Terán López Nava </label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p3-D" name="p3" value="D" class="form-check-input">
                                <label for="p3-D" class="form-check-label">D) Sonia Maribel Avilés Valdez </label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p3-E" name="p3" value="E" class="form-check-input">
                                <label for="p3-E" class="form-check-label">E) Alma Delia Pérez Gloria</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p3-F" name="p3" value="F" class="form-check-input" required>
                                <label for="p3-F" class="form-check-label">F) Juan Francisco Soto Ledezma </label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p3-G" name="p3" value="G" class="form-check-input">
                                <label for="p3-G" class="form-check-label">G) Felipe De Jesús Hernández Orona</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p3-H" name="p3" value="H" class="form-check-input">
                                <label for="p3-H" class="form-check-label">H) Sonia Jazmín Flores Arce</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p3-I" name="p3" value="I" class="form-check-input">
                                <label for="p3-I" class="form-check-label">I) Aun no estoy convencido por ninguno</label>
                            </div>
                            <br>


                            <span>4.- Como una segunda opción ¿Por cuál otro candidato votaría?</span>
                            <div class="form-check" required>
                                <input type="radio" id="p4-A" name="p4" value="A" class="form-check-input" required>
                                <label for="p4-A" class="form-check-label">A) Alejandro Mojica Narváez</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p4-B" name="p4" value="B" class="form-check-input">
                                <label for="p3-B" class="form-check-label">B) José Juan Cruz Martínez</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p4-C" name="p4" value="C" class="form-check-input">
                                <label for="p4-C" class="form-check-label">C) Andrea Terán López Nava </label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p4-D" name="p4" value="D" class="form-check-input">
                                <label for="p4-D" class="form-check-label">D) Sonia Maribel Avilés Valdez </label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p4-E" name="p4" value="E" class="form-check-input">
                                <label for="p4-E" class="form-check-label">E) Alma Delia Pérez Gloria</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p4-F" name="p4" value="F" class="form-check-input" required>
                                <label for="p4-F" class="form-check-label">F) Juan Francisco Soto Ledezma </label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p4-G" name="p4" value="G" class="form-check-input">
                                <label for="p4-G" class="form-check-label">G) Felipe De Jesús Hernández Orona</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p4-H" name="p4" value="H" class="form-check-input">
                                <label for="p4-H" class="form-check-label">H) Sonia Jazmín Flores Arce</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p4-I" name="p4" value="I" class="form-check-input">
                                <label for="p4-I" class="form-check-label">I) No tendría una segunda opción</label>
                            </div>
                            <br>


                            <span>5.- ¿Si hoy fueran las elecciones para Diputado Local por el Distrito 15, ¿Por cuál candidato NUNCA votaría?</span>
                            <div class="form-check" required>
                                <input type="radio" id="p5-A" name="p5" value="A" class="form-check-input" required>
                                <label for="p5-A" class="form-check-label">A) Alejandro Mojica Narváez</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p5-B" name="p5" value="B" class="form-check-input">
                                <label for="p5-B" class="form-check-label">B) José Juan Cruz Martínez</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p5-C" name="p5" value="C" class="form-check-input">
                                <label for="p5-C" class="form-check-label">C) Andrea Terán López Nava </label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p5-D" name="p5" value="D" class="form-check-input">
                                <label for="p5-D" class="form-check-label">D) Sonia Maribel Avilés Valdez </label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p5-E" name="p5" value="E" class="form-check-input">
                                <label for="p5-E" class="form-check-label">E) Alma Delia Pérez Gloria</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p5-F" name="p5" value="F" class="form-check-input" required>
                                <label for="p5-F" class="form-check-label">F) Juan Francisco Soto Ledezma </label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p5-G" name="p5" value="G" class="form-check-input">
                                <label for="p5-G" class="form-check-label">G) Felipe De Jesús Hernández Orona</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p5-H" name="p5" value="H" class="form-check-input">
                                <label for="p5-H" class="form-check-label">H) Sonia Jazmín Flores Arce</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p5-I" name="p5" value="I" class="form-check-input">
                                <label for="p5-I" class="form-check-label">I) Ninguno / No los conoce (ESPONTANEO NO LEER)</label>
                            </div>
                            <br>



                            <span>
                                6.- Si tuviera una emergencia ¿A cuál candidato NO le encargaría a sus hijos?
                            </span>
                            <div class="form-check" required>
                                <input type="radio" id="p6-A" name="p6" value="A" class="form-check-input" required>
                                <label for="p6-A" class="form-check-label">A) Alejandro Mojica Narváez</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p6-B" name="p6" value="B" class="form-check-input">
                                <label for="p6-B" class="form-check-label">B) José Juan Cruz Martínez</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p6-C" name="p6" value="C" class="form-check-input">
                                <label for="p6-C" class="form-check-label">C) Andrea Terán López Nava </label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p6-D" name="p6" value="D" class="form-check-input">
                                <label for="p6-D" class="form-check-label">D) Sonia Maribel Avilés Valdez </label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p6-E" name="p6" value="E" class="form-check-input">
                                <label for="p6-E" class="form-check-label">E) Alma Delia Pérez Gloria</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p6-F" name="p6" value="F" class="form-check-input" required>
                                <label for="p6-F" class="form-check-label">F) Juan Francisco Soto Ledezma </label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p6-G" name="p6" value="G" class="form-check-input">
                                <label for="p6-G" class="form-check-label">G) Felipe De Jesús Hernández Orona</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p6-H" name="p6" value="H" class="form-check-input">
                                <label for="p6-H" class="form-check-label">H) Sonia Jazmín Flores Arce</label>
                            </div>
                            <div class="form-check" required>
                                <input type="radio" id="p6-I" name="p6" value="I" class="form-check-input">
                                <label for="p6-I" class="form-check-label">I) Ninguno (ESPONTANEO NO LEER)</label>
                            </div>
                            <div>
                                <label for="p62" class="form-check-label">¿Por que?</label>
                                <input type="text" id="p62" name="p62" class="form-control" required>
                            </div>
                            <br>



                            <span>7.- ¿Recomendaría a un amigo o familiar votar por el candidato de tu elección?</span>
                            <div class="form-check">
                                <input type="radio" id="p7-A" name="p7" value="A" class="form-check-input" required>
                                <label for="p7-A" class="form-check-label">A) Sí</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="p7-B" name="p7" value="B" class="form-check-input">
                                <label for="p7-B" class="form-check-label">B) Tal Vez</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="p7-C" name="p7" value="C" class="form-check-input">
                                <label for="p7-C" class="form-check-label">C) No lo sé</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="p7-D" name="p7" value="D" class="form-check-input">
                                <label for="p7-D" class="form-check-label">D) Definitivamente no</label>
                            </div>
                            <br>

                            <?php
                            // echo $sesionMunicipio;

                            if ($sesionMunicipio == 'mezquital' || $sesionMunicipio == 'suchil' || $sesionMunicipio == 'vicente guerrero') {
                            ?>
                                <span>8.- En este proceso electoral también elegimos Diputados Federales ¿A quiénes de ellos reconoce?</span>
                                <br>
                                <div class="form-check">
                                    <input type="checkbox" id="p8-A" name="p8a" value="A" class="form-check-input">
                                    <label for="p8-A" class="form-check-label">A) Javier Castrellón Garza ( Va x México)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="p8-B" name="p8b" value="B" class="form-check-input">
                                    <label for="p8-B" class="form-check-label">B) Martha Olivia Guerrero (Morena-PT – Partido Verde Ecologista)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="p8-C" name="p8c" value="C" class="form-check-input">
                                    <label for="p8-C" class="form-check-label">C) Mario Alberto Reza Castañeda (Movimiento ciudadano)/label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="p8-D" name="p8d" value="D" class="form-check-input">
                                    <label for="p8-D" class="form-check-label">D) Vladimir Juventino Martínez (Fuerza x México)</label>
                                </div>
                                <br>

                                <span>9.- De los siguientes candidatos a diputado federal. ¿Por cuál o cuáles de ellos votaría? </span>
                                <br>
                                <div class="form-check">
                                    <input type="checkbox" id="p9-A" name="p9a" value="si" class="form-check-input">
                                    <label for="p9-A" class="form-check-label">A) Javier Castrellón Garza (Va x México)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="p9-B" name="p9b" value="si" class="form-check-input">
                                    <label for="p9-B" class="form-check-label">B) Martha Olivia Guerrero (Morena-PT – Partido Verde Ecologista)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="p9-C" name="p9c" value="si" class="form-check-input">
                                    <label for="p9-C" class="form-check-label">C) Mario Alberto Reza Castañeda (Movimiento ciudadano)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="p9-D" name="p9d" value="si" class="form-check-input">
                                    <label for="p9-D" class="form-check-label">D) Vladimir Juventino Martínez (Fuerza x México)</label>
                                </div>
                                <br>
                            <?php
                            }
                            else if ($sesionMunicipio == 'durango') {
                            ?>
                                <span>8.- En este proceso electoral también elegimos Diputados Federales ¿A quiénes de ellos reconoce?</span>
                                <br>
                                <div class="form-check">
                                    <input type="checkbox" id="p8-A" name="p8a" value="si" class="form-check-input">
                                    <label for="p8-A" class="form-check-label">A) MARTIN VIVANCO LIRA (Movimiento Ciudadano)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="p8-B" name="p8b" value="si" class="form-check-input">
                                    <label for="p8-B" class="form-check-label">B) ANTONIO DE LA TORRE CARLOS (Partido Encuentro Social)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="p8-C" name="p8c" value="si" class="form-check-input">
                                    <label for="p8-C" class="form-check-label">C)HUMBERTO RAUL ROSALES BADILLO (REdes Sociales Progresistas)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="p8-D" name="p8d" value="si" class="form-check-input">
                                    <label for="p8-D" class="form-check-label">D) ALICIA GARCIA VALENZUELA (Fuerza México)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="p8-D" name="p8d" value="si" class="form-check-input">
                                    <label for="p8-D" class="form-check-label">E) GINA GERARDINA CAMPUZANO GONZALEZ (PRI/PAN/PRD)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="p8-D" name="p8d" value="si" class="form-check-input">
                                    <label for="p8-D" class="form-check-label">F) RIGOBERTO QUIÑONEZ SAMANIEGO (MORENA/PT/PARTIDO VERDE)</label>
                                </div>

                                <br>

                                <span>9.- De los siguientes candidatos a diputado federal. ¿Por cuál de ellos votaría? </span>
                                <br>
                                <div class="form-check" required>
                                    <input type="radio" id="p9-A" name="p9" value="A" class="form-check-input" required>
                                    <label for="p9-A" class="form-check-label">A) MARTIN VIVANCO LIRA (Movimiento Ciudadano)</label>
                                </div>
                                <div class="form-check" required>
                                    <input type="radio" id="p9-B" name="p9" value="B" class="form-check-input">
                                    <label for="p9-B" class="form-check-label">B) ANTONIO DE LA TORRE CARLOS (Partido Encuentro Social)</label>
                                </div>
                                <div class="form-check" required>
                                    <input type="radio" id="p9-C" name="p9" value="C" class="form-check-input">
                                    <label for="p9-C" class="form-check-label">C)HUMBERTO RAUL ROSALES BADILLO (Redes Sociales Progresistas)</label>
                                </div>
                                <div class="form-check" required>
                                    <input type="radio" id="p9-D" name="p9" value="D" class="form-check-input">
                                    <label for="p9-D" class="form-check-label">D) ALICIA GARCIA VALENZUELA (Fuerza México) </label>
                                </div>
                                <div class="form-check" required>
                                    <input type="radio" id="p9-E" name="p9" value="E" class="form-check-input">
                                    <label for="p9-E" class="form-check-label">E) GINA GERARDINA CAMPUZANO GONZALEZ (PRI/PAN/PRD)</label>
                                </div>
                                <div class="form-check" required>
                                    <input type="radio" id="p9-F" name="p9" value="F" class="form-check-input" required>
                                    <label for="p9-F" class="form-check-label">F) RIGOBERTO QUIÑONEZ SAMANIEGO (MORENA/PT/PARTIDO VERDE)</label>
                                </div>
                                <br>
                            <?php
                            }
                            ?>










                            <span>10.- ¿Qué tan probable es que marque el mismo partido o coalición en ambas boletas el 6 de junio?</span>
                            <div class="form-check">
                                <input type="radio" id="p10-A" name="p10" value="A" class="form-check-input" required>
                                <label for="p10-A" class="form-check-label">A) Muy probable</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="p10-B" name="p10" value="B" class="form-check-input">
                                <label for="p10-B" class="form-check-label">B) Probable</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="p10-C" name="p10" value="C" class="form-check-input">
                                <label for="p10-C" class="form-check-label">C) Poco probable </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="p10-D" name="p10" value="D" class="form-check-input">
                                <label for="p10-D" class="form-check-label">D) No sé / no contestó (ESPONTANEO, NO LEER)</label>
                            </div>
                            <br>






                            <input type="submit" class="form-control btn btn-success" value="GARDAR DATOS">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>