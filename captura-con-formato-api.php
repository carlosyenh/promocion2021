<?php
session_start();
$capturista = $_SESSION['username'];

try {
    if (isset($_POST['folio'])) {
        $tipo = "con formato";
        $folio = $_POST['folio'];
        $id_del_promotor = 0;
        $numero_en_red = $_POST['numero_en_red'];

        $municipio = $_POST['municipio'];
        if ($municipio == 1) {
            $municipio = 'mezquital';
        }
        if ($municipio == 2) {
            $municipio = 'nombre de dios';
        }
        if ($municipio == 3) {
            $municipio = 'poanas';
        }
        if ($municipio == 4) {
            $municipio = 'suchil';
        }
        if ($municipio == 5) {
            $municipio = 'vicente guerrero';
        }
        $grupo = $_POST['grupo'];
        /////LOCALIDAD///////////////////////////////////////////////
        if (isset($_POST['localidad']) && !empty($_POST['localidad'])) {
            $localidad = $_POST['localidad'];
        } else {
            $localidad = 'sin localidad';
        }
        $seccion = $_POST['seccion'];
        /////MANZANA///////////////////////////////////////////////
        if (isset($_POST['manzana']) && !empty($_POST['manzana'])) {
            $manzana = $_POST['manzana'];
        } else {
            $manzana = 0;
        }
        /////COLONIA///////////////////////////////////////////////
        if (isset($_POST['colonia']) && !empty($_POST['colonia'])) {
            $colonia = $_POST['colonia'];
        } else {
            $colonia = 'sin colonia';
        }
        /////CALLE///////////////////////////////////////////////
        if (isset($_POST['calle']) && !empty($_POST['calle'])) {
            $calle = $_POST['calle'];
        } else {
            $calle = 'sin calle';
        }
        /////NUMERO///////////////////////////////////////////////
        if (isset($_POST['numero']) && !empty($_POST['numero'])) {
            $numero = $_POST['numero'];
        } else {
            $numero = 's/n';
        }
        /////MANZANA///////////////////////////////////////////////
        if (isset($_POST['cp']) && !empty($_POST['cp'])) {
            $cp = $_POST['cp'];
        } else {
            $cp = 0;
        }
        $nombre = $_POST['nombre'];
        $apat = $_POST['apat'];
        /////AMAT///////////////////////////////////////////////
        if (isset($_POST['amat']) && !empty($_POST['amat'])) {
            $amat = $_POST['amat'];
        } else {
            $amat = '';
        }
        /////TELEFONO///////////////////////////////////////////////
        if (isset($_POST['tel']) && !empty($_POST['tel'])) {
            $tel = $_POST['tel'];
        } else {
            $tel = 'no';
        }
        /////CORREO///////////////////////////////////////////////
        if (isset($_POST['correo']) && !empty($_POST['correo'])) {
            $correo = $_POST['correo'];
        } else {
            $correo = 'no';
        }
        /////FACEBOOK///////////////////////////////////////////////
        if (isset($_POST['facebook']) && !empty($_POST['facebook'])) {
            $facebook = $_POST['facebook'];
        } else {
            $facebook = 'no';
        }
        /////INSTAGRAM///////////////////////////////////////////////
        if (isset($_POST['instagram']) && !empty($_POST['instagram'])) {
            $instagram = $_POST['instagram'];
        } else {
            $instagram = 'no';
        }
        /////TWITTER///////////////////////////////////////////////
        if (isset($_POST['twitter']) && !empty($_POST['twitter'])) {
            $twitter = $_POST['twitter'];
        } else {
            $twitter = 'no';
        }

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



        /*
        $folio = $_POST['folio'];
        $tipo = "con formato";
        $id_del_promotor = 0;
        $numero_en_red = $_POST['numero_en_red'];
        $municipio = $_POST['municipio'];
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
        $grupo = $_POST['grupo'];
        $localidad = $_POST['localidad'];
        $seccion = $_POST['seccion'];
        $manzana = isset($_POST['manzana']) != null ? $_POST['manzana'] : 0;
        $colonia = $_POST['colonia'];
        $calle = $_POST['calle'];
        $numero = $_POST['numero'];
        $cp = $_POST['cp'];
        $nombre = $_POST['nombre'];
        $apat = $_POST['apat'];
        $amat = $_POST['amat'];
        $tel = $_POST['tel'];
        $correo = $_POST['correo'];
        $facebook = $_POST['facebook'];
        $instagram = $_POST['instagram'];
        $twitter = $_POST['twitter'];
        if(!empty($_POST['manzana'])){
            echo 'hola';
        }

        echo $manzana;
        mysqli_report(MYSQLI_REPORT_STRICT);

        require 'conexion.php';
        $consulta = "INSERT INTO amigos_principales(folio, tipo, numero_en_red, municipio, grupo, localidad, seccion, manzana, colonia, calle, numero, cp, nombre, apat, amat, tel, correo, facebook, instagram, twitter, capturista) 
            VALUES ('$folio', '$tipo', '$numero_en_red', '$municipio', '$grupo', '$localidad', '$seccion', '$manzana', '$colonia', '$calle', '$numero', '$cp', '$nombre', '$apat', '$amat', '$tel', '$correo', '$facebook','$instagram','$twitter', '$capturista')";
        $query = mysqli_query($conexion, $consulta);
        mysqli_close($conexion);

        */
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
        <form action="captura-con-formato.php" method="post">
            <button type="submit" class="btn btn-primary" value="reintentar">REINTENTAR</button>
        </form>
        <br>
        <br>
    </center>
<?php
}
?>
