<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$capturista = $_SESSION['username'];
if (!$_SESSION['username']) {
    header("location:login.php");
}
if ($_SESSION['userType'] != 'administrador' && $_SESSION['userType'] != 'supervisor' && $_SESSION['userType'] != 'capturista') {
    header("location:login.php");
    //echo $_SESSION['userType'];
}

try {
    if (isset($_POST['id_del_promotor'])) {
        $tipo = "sin formato";
        $folio = 0;
        $id_del_promotor = $_POST['id_del_promotor'];
        $numero_en_red = 0;

        $municipio = $_POST['municipio'];
        //echo $municipio;
        if($municipio == 1){
            $municipio = 'mezquital';
        }
        if($municipio == 2){
            $municipio = 'nombre de dios';
        }
        if($municipio == 3){
            $municipio = 'poanas';
        }
        if($municipio == 4){
            $municipio = 'suchil';
        }
        if($municipio == 5){
            $municipio = 'vicente guerrero';
        }
        $grupo = 0;
        if (isset($_POST['localidad']) && !empty($_POST['localidad'])) {
            $localidad = $_POST['localidad'];
        } else {
            $localidad = 'sin localidad';
        }
        $seccion = $_POST['seccion'];
        //echo $seccion;
    
        $manzana = 0;
        $colonia = 'sin colonia';
        $calle = 'sin calle';
        $numero = 's/n';
        $cp = 0;
        $nombre = $_POST['nombre'];
        $apat = $_POST['apat'];
        if (isset($_POST['amat']) && !empty($_POST['amat'])) {
            $amat = $_POST['amat'];
        } else {
            $amat = '';
        }
        $tel = 'no';
        $correo = 'no';
        $facebook = 'no';
        $instagram = 'no';
        $twitter = 'no';

        mysqli_report(MYSQLI_REPORT_STRICT);
        require 'conexion.php';

        ////////////BUSCAR OR REPETIDOS//////////////////
        //ejemlo de repetido en el municipio
        //$buscarRepetidos = "SELECT * FROM `amigos_principales` WHERE municipio = '$municipio' and nombre = '$nombre' and apat = '$apat' and amat = '$amat' ";
        //ejemplo de repetidos or seccion 
        $buscarRepetidos = "SELECT * FROM `amigos_principales` WHERE municipio = '$municipio' and nombre = '$nombre' and apat = '$apat' and amat = '$amat' and seccion = '$seccion' ";
        $result = mysqli_query($conexion, $buscarRepetidos);
        if ($result->num_rows > 0) {
            $repetido = 'si';
        }else{
            $repetido = 'no';
        }
        //echo $repetido;


        $consulta = "INSERT INTO amigos_principales (
            `tipo`, 
            `repetido`,
            `folio`, 
            `id_del_promotor`, 
            `numero_en_red`, 
            `municipio`, 
            `grupo`, 
            `localidad`, 
            `seccion`, 
            `manzana`, 
            `colonia`, 
            `calle`, 
            `numero`, 
            `cp`, 
            `nombre`, 
            `apat`, 
            `amat`, 
            `tel`, 
            `correo`, 
            `facebook`, 
            `instagram`, 
            `twitter`, 
            `capturista`) 
        VALUES (
            '$tipo', 
            '$repetido',
            '$folio',
            '$id_del_promotor', 
            '$numero_en_red',
            '$municipio', 
            '$grupo', 
            '$localidad', 
            '$seccion',
            '$manzana', 
            '$colonia', 
            '$calle', 
            '$numero', 
            '$cp', 
            '$nombre', 
            '$apat', 
            '$amat',
            '$tel', 
            '$correo', 
            '$facebook', 
            '$instagram', 
            '$twitter', 
            '$capturista');";
        $query = mysqli_query($conexion, $consulta);
        mysqli_close($conexion);
?>
        <center>
            <h1>Folio capturado Exitosamente</h1>
            <br>
            <form action="captura-con-formato.php" method="post">
                <button type="submit" class="btn btn-primary" value="captura">CAPTURAR CON FORMATO</button>
            </form>
            <br>
            <br>
            <form action="captura-sin-formato.php" method="post">
                <button type="submit" class="btn btn-primary" value="captura">CAPTURAR SIN FORMATO</button>
            </form>
        </center>

    <?php
        return;
    }
    //echo "No folior";
} catch (Exception $e) {
    ?>
    <center>
        <h1>Folio no capturado</h1>
        <h1>Error en el servidor</h1>
        <br>
        <form action="captura-sin-formato-api.php" method="post">
            <button type="submit" class="btn btn-primary" value="reintentar">REINTENTAR</button>
        </form>
        <br>
        <br>
    </center>
<?php
}
?>
