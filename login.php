<?php
session_start();
if(isset($_SESSION['userType'])){
    //echo session_status();
    if ($_SESSION['userType'] == 'administrador') {
        header("location:resumen-promocion.php");
        //echo $_SESSION['userType'];
    }
    if ($_SESSION['userType'] == 'supervisor') {
        header("location:resumen-promocion.php");
        //echo $_SESSION['userType'];
    }
    if ($_SESSION['userType'] == 'capturista') {
        header("location:captura-con-formato.php");
        //echo $_SESSION['userType'];
    }
    if ($_SESSION['userType'] == 'encuestador' ) {
        header("location:encuesta.php");
        //echo $_SESSION['userType'];
    }
    
    if ($_SESSION['userType'] == 'superencuestador' ) {
        header("location:panel-encuestas.php");
        //echo $_SESSION['userType'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>


    <div class="container mt-3">
        <div class="col-md-8 mx-auto ">
            <div id="amigop" name="amigoPrincipalDiv">
                <div class="card mt-10">
                    <div class="card-header">
                        <h2 class="mx-auto center">Inicio de sesíon</h2>
                    </div>
                    <div class="card-body">
                        <div class="form">
                            <form action="login-api.php" method="post" name="loginForm" id="loginForm">
                                <label for="usuario" class="form-label">Nombre de usuario:</label>
                                <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario" class="form-control" required>
                                <br>

                                <label for="pass" class="form-label">Contraseña:</label>
                                <input type="password" name="pass" id="pass" placeholder="********"
                                    class="form-control" required>
                                <br>
                                <br>

                                <button type="submit" class="btn btn-primary" value="captura">INICIAR SESÍON</button>
                            </form>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <script>
        function hideAmigoPrincipalDiv() {
            document.getElementById("amigoPrincipalForm").addEventListener("click", function (event) {
                event.preventDefault();
            });
            var amigoPrincipalDiv = document.getElementById("amigoPrincipalDiv");
            amigop.style.display = "none";
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
</body>

</html>