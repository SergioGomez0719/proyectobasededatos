<?php

include("../../conexion.php");

function cursosIngles() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT cursosactivos.activo, cursosactivos.idioma, IDcurso, tituloCurso, tipoCur,  COUNT(*) AS cantidad_cursos
    FROM cursosactivos
    WHERE idioma = 'Ingles'");
    $stm->execute();
    $cursosactivos = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursosactivos;
}

function cursosEspañol() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT COUNT(*) AS cantidad_cursos
    FROM cursosactivos
    WHERE idioma = 'Espanol'");
    $stm->execute();
    $cursosactivos = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursosactivos;
}

function cursosHolndes() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT COUNT(*) AS cantidad_cursos
    FROM cursosactivos
    WHERE idioma = 'Holandes'");
    $stm->execute();
    $cursosactivos = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursosactivos;
}

function cursosFrances() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT COUNT(*) AS cantidad_cursos
    FROM cursosactivos
    WHERE idioma = 'Frances'");
    $stm->execute();
    $cursosactivos = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursosactivos;
}

function cursosApro() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT COUNT(*) AS cantidad_cursos
    FROM cursoscursados
    WHERE estadoProgreso = 'Aprobado (Virtual)' OR estadoProgreso = 'Aprobado (Pres)'");
    $stm->execute();
    $cursosactivos = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursosactivos;
}

function cursosNoApro() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT COUNT(*) AS cantidad_cursos
    FROM cursoscursados
    WHERE estadoProgreso = 'No Aprobado (Virtual)' OR estadoProgreso = 'No Aprobado (Pres)'" );
    $stm->execute();
    $cursosactivos = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursosactivos;
}

function promNotasColombia() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT AVG(cursoscursados.calificacion) AS promedio_notas
    FROM empleados 
    INNER JOIN cursoscursados  ON empleados.IDempleado = cursoscursados.IDempleado
    WHERE empleados.paisRegion = 'Colombia'" );
    $stm->execute();
    $prom = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $prom;
}


function promNotasCosta() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT AVG(cursoscursados.calificacion) AS promedio_notas
    FROM empleados 
    INNER JOIN cursoscursados  ON empleados.IDempleado = cursoscursados.IDempleado
    WHERE empleados.paisRegion = 'Costa Rica'" );
    $stm->execute();
    $prom = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $prom;
}

function promNotasHon() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT AVG(cursoscursados.calificacion) AS promedio_notas
    FROM empleados 
    INNER JOIN cursoscursados  ON empleados.IDempleado = cursoscursados.IDempleado
    WHERE empleados.paisRegion = 'Honduras'" );
    $stm->execute();
    $prom = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $prom;
}

function promNotasPan() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT AVG(cursoscursados.calificacion) AS promedio_notas
    FROM empleados 
    INNER JOIN cursoscursados  ON empleados.IDempleado = cursoscursados.IDempleado
    WHERE empleados.paisRegion = 'Panama'" );
    $stm->execute();
    $prom = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $prom;
}

if (isset($_POST['cursosIngles'])) {
    $cursosactivos = cursosIngles();

}
elseif(isset($_POST['cursosEspañol'])) {
    $cursosactivos = cursosEspañol();

}
elseif(isset($_POST['cursosHolndes'])) {
    $cursosactivos = cursosHolndes();
}
elseif(isset($_POST['cursosFrances'])) {
    $cursosactivos = cursosFrances();
}
elseif(isset($_POST['cursosApro'])) {
    $cursosactivos = cursosApro();
}
elseif(isset($_POST['cursosNoApro'])) {
    $cursosactivos = cursosNoApro();
}
elseif(isset($_POST['promNotasColombia'])) {
    $prom = promNotasColombia();
}
elseif(isset($_POST['promNotasCosta'])) {
    $prom = promNotasCosta();
}
elseif(isset($_POST['promNotasPan'])) {
    $prom = promNotasPan();
}
elseif(isset($_POST['promNotasHon'])) {
    $prom = promNotasHon();
}


?>

<?php include("../../template/header.php"); ?>

<div>
     <h3 class="title">Consultas de agregación</h3>
    <br>

<div>

    <div class="button-container">
        <form method="post">
        
            <button class="button is-primary is-large" type="submit" name="cursosIngles">Cursos en idiomas inglés</button>
            <button class="button is-primary is-large" type="submit" name="cursosEspañol">Cursos en idiomas español</button>
            <br><br>
            <button class="button is-primary is-large" type="submit" name="cursosHolndes">Cursos en idiomas holandés</button>
            <button class="button is-primary is-large" type="submit" name="cursosFrances">Cursos en idiomas francés</button>
            <br><br>
            <button class="button is-primary is-large" type="submit" name="cursosApro">Cursos aprobados por los empleados</button>
            <button class="button is-primary is-large" type="submit" name="cursosNoApro">Cursos no aprobados por los empleados</button>
            <br><br>
            <button class="button is-primary is-large" type="submit" name="promNotasColombia">Promedio de notas en Colombia</button>
            <button class="button is-primary is-large" type="submit" name="promNotasCosta">Promedio de notas en Costa Rica</button>
            <br><br>
            <button class="button is-primary is-large" type="submit" name="promNotasHon">Promedio de notas en Honduras</button>
            <button class="button is-primary is-large" type="submit" name="promNotasPan">Promedio de notas en Panamá</button>


        </form>
    </div>

    <?php if (isset($cursosactivos)) { ?>
    <br>
    <br>
    <div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <tbody>
                <?php foreach ($cursosactivos as $cursosactivos) { ?>
                    <tr>
                        <td><?php echo $cursosactivos['cantidad_cursos']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } elseif (isset($prom)) { ?>
    <br>
    <br>

    <div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <tbody>
                <?php foreach ($prom as $prom) { ?>
                    <tr>
                        <td><?php echo $prom['promedio_notas']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>
<style>
body{
background: grey;
}
 .title{
      width:100%;
      height:60px;
      background-color:#59F5DF;
  }
.button-container {
    /* Agrega los estilos personalizados que desees */
    background-color: #4CAF50; /* Color de fondo */
    color: white; /* Color de texto */
    border: none; /* Sin borde */
    padding: 10px 20px; /* Espaciado interno */
    text-align: center; /* Alineación de texto */
    text-decoration: none; /* Sin subrayado de enlace */
    display: inline-block; /* Mostrar como elemento en línea */
    font-size: 16px; /* Tamaño de fuente */
    margin: 4px 2px; /* Márgenes externos */
    cursor: pointer; /* Cambia el cursor al pasar el mouse */
    border-radius: 4px; /* Radio de borde */
  }
  </style>

<?php include("../../template/footer.php"); ?>
