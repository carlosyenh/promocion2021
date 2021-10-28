<?php
if(isset($_POST['usuario'])){
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $municipio = $_POST['municipio'];
    $userType = $_POST['userType'];
    $secretToken = $_POST['token'];
    require 'conexion.php';


    if($userType == 'administrador'){
        if($secretToken == 'secretAdmin123#'){
            $consulta = "INSERT INTO usuarios(usuario, pass, municipio, userType) VALUES ('$usuario', '$pass', '$municipio', '$userType')";
            $query = mysqli_query($conexion, $consulta);
            mysqli_close($conexion); 
            ?>
                <center>
                    <h1>Usuario agregado con exito</h1>
                    <form action="login.php" method="post">
                        <button type="submit" class="btn btn-primary" value="login">INICIAR SESÍON</button>
                    </form>
                </center>
            <?php
            return;
        }
        die("Error al agregar usuario");
    }

    if($userType == 'supervisor'){
        if($secretToken == 'secretSuper123#'){
            $consulta = "INSERT INTO usuarios(usuario, pass, municipio, userType) VALUES ('$usuario', '$pass', '$municipio', '$userType')";
            $query = mysqli_query($conexion, $consulta);
            mysqli_close($conexion);
            ?>
                <center>
                    <h1>Usuario agregado con exito</h1>
                    <form action="login.php" method="post">
                        <button type="submit" class="btn btn-primary" value="login">INICIAR SESÍON</button>
                    </form>
                </center>
            <?php
            return;
        }
        die("Error al agregar usuario");
    }
    
    if($userType == 'capturista'){
        if($secretToken == 'capturaMoy1'){
            $consulta = "INSERT INTO usuarios(usuario, pass, municipio, userType) VALUES ('$usuario', '$pass', '$municipio', '$userType')";
            $query = mysqli_query($conexion, $consulta);
            mysqli_close($conexion);
            if(!$query){
                die("Error al agregar usuario");
            }
            ?>
                <center>
                    <h1>Usuario agregado con exito</h1>
                    <form action="login.php" method="post">
                        <button type="submit" class="btn btn-primary" value="login">INICIAR SESÍON</button>
                    </form>
                </center>
            <?php
            return;
        }
        die("Error al agregar usuario");

    }

    if($userType == 'encuestador'){
        if($secretToken == 'yen123'){
            $consulta = "INSERT INTO usuarios(usuario, pass, municipio, userType) VALUES ('$usuario', '$pass', '$municipio', '$userType')";
            $query = mysqli_query($conexion, $consulta);
            mysqli_close($conexion);
            if(!$query){
                die("Error al agregar usuario");
            }
            ?>
                <center>
                    <h1>Usuario agregado con exito</h1>
                    <form action="login.php" method="post">
                        <button type="submit" class="btn btn-primary" value="login">INICIAR SESÍON</button>
                    </form>
                </center>
            <?php
            return;
        }
        die("Error al agregar usuario");

    }

    if($userType == 'superencuestador'){
        if($secretToken == 'yen123'){
            $consulta = "INSERT INTO usuarios(usuario, pass, municipio, userType) VALUES ('$usuario', '$pass', '$municipio', '$userType')";
            $query = mysqli_query($conexion, $consulta);
            mysqli_close($conexion);
            if(!$query){
                die("Error al agregar usuario");
            }
            ?>
                <center>
                    <h1>Usuario agregado con exito</h1>
                    <form action="login.php" method="post">
                        <button type="submit" class="btn btn-primary" value="login">INICIAR SESÍON</button>
                    </form>
                </center>
            <?php
            return;
        }
        die("Error al agregar usuario");

    }

    die("Error al agregar usuario");






}
