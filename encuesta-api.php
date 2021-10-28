<?php
session_start();

try {
    if (isset($_POST['municipio'])) {
        $municipio = $_POST['municipio'];
        $seccion = $_POST['seccion'];
        $ine = $_POST['ine-vigente'];
        $sexo = $_POST['sexo'];
        $edad = $_POST['edad'];

        $p1 = $_POST['p1'];

        $p2a = $_POST['p2-A'];
        $p2b = $_POST['p2-B'];
        $p2c = $_POST['p2-C'];
        $p2d = $_POST['p2-D'];
        $p2e = $_POST['p2-E'];
        $p2f = $_POST['p2-F'];
        $p2g = $_POST['p2-G'];
        $p2h = $_POST['p2-H'];
        //$p2e = $_POST['p2-E'];
        $p3 = $_POST['p3'];
        $p4 = $_POST['p4'];
        $p5 = $_POST['p5'];
        $p6 = $_POST['p6'];
        $p62 = $_POST['p62'];

        $p7 = $_POST['p7'];


        $p8a = isset($_POST['p8a']) ? 'si' : 'no';
        $p8b = isset($_POST['p8b']) ? 'si' : 'no';
        $p8c = isset($_POST['p8c']) ? 'si' : 'no';
        $p8d = isset($_POST['p8d']) ? 'si' : 'no';
        $p8e = isset($_POST['p8e']) ? 'si' : 'no';
        $p8f = isset($_POST['p8f']) ? 'si' : 'no';
        $p8g = isset($_POST['p8g']) ? 'si' : 'no';
        $p8h = isset($_POST['p8h']) ? 'si' : 'no';


        $p9 = isset($_POST['p9a']) ? 'si' : 'no';
        $p10 = $_POST['p10'];

        //echo $p9a;




        $encuestador = $_SESSION['username'];
        //echo $folio;
        mysqli_report(MYSQLI_REPORT_STRICT);

        //$conexion =  mysqli_connect("localhost", "root", "", "dbpromocion21");
        require 'conexion.php';
        $consulta = "INSERT INTO encuesta(seccion, municipio, ine, sexo, edad, p1, p2a, p2b, p2c, p2d, p2e, p2f, p2g, p2h, p3, p4, p5, p6, p62, p7, p8a, p8b, p8c, p8d, p8e, p8f, p8g, p8h, p9, p10, encuestador) 
            VALUES ('$seccion','$municipio', '$ine', '$sexo', '$edad', '$p1', '$p2a', '$p2b', '$p2c', '$p2d', '$p2e', '$p2f', '$p2g', '$p2h', '$p3', '$p4','$p5','$p6','$p62','$p7', '$p8a', '$p8b', '$p8c', '$p8d', '$p8e' , '$p8f', '$p8g', '$p8h', '$p9', '$p10' ,'$encuestador')";
        $query = mysqli_query($conexion, $consulta);
        mysqli_close($conexion);
?>
        <center>
            <h1>Encuesta guardada exitosamente</h1>
            <br>
            <form action="encuesta.php" method="post">
                <button type="submit" class="btn btn-primary" value="encuesta">INICIAR SIGUIENTE ENCUESTA</button>
            </form>
            <br>
            <br>
        </center>

    <?php
        return;
    }
    //echo "No folior";
} catch (Exception $e) {
    ?>
    <center>
        <h1>No se pudo guardar la encuesta</h1>
        <h1>Error en el servidor</h1>
        <br>
        <form action="encuesta.php" method="post">
            <button type="submit" class="btn btn-primary" value="reintentar">REINTENTAR</button>
        </form>
        <br>
        <br>
    </center>
<?php
}
?>