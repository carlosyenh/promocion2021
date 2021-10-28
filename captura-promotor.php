<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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




    <div class="container mt-100">
        <div class="col-md-8 mx-auto ">
            <div id="amigop" name="amigoPrincipalDiv">
                <div class="card mt-10">
                    <div class="card-header">
                        <h2 class="mx-auto center">Captura de promotor</h2>
                    </div>
                    <div class="card-body">
                        <div class="form">
                            <form action="capturaformato.php" method="post" name="amigoPrincipalForm" id="amigoPrincipalForm">

                                <label for="municipio" class="form-label">Municipio:</label>
                                <select name="municipio" id="municipio" class="form-control form-select" required>
                                    <option disabled selected>Selecciona un municipio</option>
                                    <option value="volvo">municipio1</option>
                                    <option value="saab">municipio2</option>
                                    <option value="mercedes">municipio3</option>
                                    <option value="audi">municipio4</option>
                                </select>
                                <br>

                                <label for="localidad" class="form-label">Localidad:</label>
                                <select name="localidad" id="localidad" class="form-control form-select" required>
                                    <option selected>Selecciona una sección</option>
                                    <option value="volvo">municipio1</option>
                                    <option value="saab">municipio2</option>
                                    <option value="mercedes">municipio3</option>
                                    <option value="audi">municipio4</option>
                                </select>
                                <br>

                                <label for="colonia" class="form-label">Colonia o barrio:</label>
                                <input type="text" name="colonia" id="colonia" placeholder="Colonia o Barrio" class="form-control" required>
                                <br>

                                <label for="calle" class="form-label">Calle:</label>
                                <input type="text" name="calle" id="calle" placeholder="Calle" class="form-control" required>
                                <br>

                                <label for="numero" class="form-label">Número:</label>
                                <input type="text" name="numero" id="numero" placeholder="Número" class="form-control" required>
                                <br>

                                <label for="cp" class="form-label">C.P. :</label>
                                <input type="text" name="cp" id="cp" placeholder="Codigo postal" class="form-control" required>
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

                                <label for="clave_e" class="form-label">Clave Electoral</label>
                                <input type="text" name="clave_e" id="clave_e" placeholder="Clave electoral" class="form-control" required>
                                <br>

                                <label for="tel" class="form-label">Teléfono</label>
                                <input type="text" name="tel" id="tel" placeholder="Teléfono" class="form-control">
                                <br>

                                <label for="correo" class="form-label">Correo:</label>
                                <input type="text" name="correo" id="correo" placeholder="Correo" class="form-control">
                                <br>

                                <label for="facebook" class="form-label">Facebook:</label>
                                <input type="text" name="facebook" id="facebook" placeholder="Facebook" class="form-control">
                                <br>

                                <label for="instagram" class="form-label">Instagram:</label>
                                <input type="text" name="instagram" id="instagram" placeholder="Instagram" class="form-control ">
                                <br>

                                <label for="twitter" class="form-label">Twitter:</label>
                                <input type="text" name="twitter" id="twitter" placeholder="Instagram" class="form-control ">
                                <br>
                                <br>

                                <button type="submit" class="btn btn-primary" value="Capturar promotor">Agregar Amigo 1</button>
                            </form>


                        </div>
                    </div>

                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>