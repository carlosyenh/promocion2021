<?php 
require 'conexion.php';
if(isset($_POST['usuario'])){
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND pass = '$pass'";
    $resultado = mysqli_query($conexion, $consulta);
    $array = mysqli_fetch_array($resultado);
    if($array){
        $username = $array['usuario'];
        $userType = $array['userType'];
        $municipio = $array['municipio'];
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['userType'] = $userType;
        $_SESSION['municipio'] = $municipio;

        if($userType == 'administrador'){
            header("location: resumen-promocion.php");
        }

        if($userType == 'supervisor'){
            header("location: resumen-promocion.php");
        }

        if($userType == 'capturista'){
            header("location: captura-con-formato.php");
        }
        if($userType == 'encuestador'){
            header("location: encuesta.php");
        }
        if($userType == 'superencuestador'){
            header("location: panel-encuestas.php");
        }

        //header("location: captura.html");
    }else{
        echo "El usuario no exite o la contraseña es incorrecta";
    }
  
  
}


?>
