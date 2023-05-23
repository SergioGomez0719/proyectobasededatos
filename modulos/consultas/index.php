<?php
include("../../conexion.php");

function mostrarEmpleados() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT * FROM empleados LIMIT 10");
    $stm->execute();
    $empleados = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $empleados;
}

function mostrarCursos() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT * FROM cursoscursados LIMIT 10");
    $stm->execute();
    $cursoscursados = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursoscursados;
}
function mostrarCursosPanama() {
    include("../../conexion.php");
    global $conexion;
    $stm = $conexion->prepare("SELECT posicion.IDcursoC,  empleados.paisRegion, COUNT(DISTINCT posicion.IDempleado) AS totalEmpleados
    FROM posicion
    INNER JOIN empleados ON posicion.IDempleado = empleados.IDempleado
    WHERE empleados.paisRegion = 'Panama'
    GROUP BY posicion.IDcursoC
    ORDER BY totalEmpleados DESC
    LIMIT 5");
    $stm->execute();
    $cursosPanama = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursosPanama;
}

function mostrarCursosCosta() {
    include("../../conexion.php");
    global $conexion;
    $stm = $conexion->prepare("SELECT posicion.IDcursoC, empleados.paisRegion, COUNT(DISTINCT posicion.IDempleado) AS totalEmpleados
    FROM posicion
    INNER JOIN empleados ON posicion.IDempleado = empleados.IDempleado
    WHERE empleados.paisRegion = 'Costa Rica'
    GROUP BY posicion.IDcursoC
    ORDER BY totalEmpleados DESC
    LIMIT 5");
    $stm->execute();
    $cursosCosta = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursosCosta;
}

function mostrarCursosColombiaV() {
    include("../../conexion.php");
    global $conexion;
    $stm = $conexion->prepare("SELECT cursoscursados.IDcursoC, cursoscursados.tituloC, TipoCursoC, COUNT(DISTINCT cursoscursados.IDempleado) AS totalEmpleados
    FROM cursoscursados
    INNER JOIN empleados ON cursoscursados.IDempleado = empleados.IDempleado
    WHERE empleados.paisRegion = 'Colombia' AND TipoCursoC = 'VIRTUAL'
    GROUP BY cursoscursados.IDcursoC
    ORDER BY totalEmpleados DESC
    LIMIT 10");
    $stm->execute();
    $cursosColombiaV = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursosColombiaV;
}

function mostrarCursosColombiaP() {
    include("../../conexion.php");
    global $conexion;
    $stm = $conexion->prepare("SELECT cursoscursados.IDcursoC, cursoscursados.tituloC, TipoCursoC, COUNT(DISTINCT cursoscursados.IDempleado) AS totalEmpleados
    FROM cursoscursados
    INNER JOIN empleados ON cursoscursados.IDempleado = empleados.IDempleado
    WHERE empleados.paisRegion = 'Colombia' AND TipoCursoC = 'PRES'
    GROUP BY cursoscursados.IDcursoC
    ORDER BY totalEmpleados DESC
    LIMIT 10");
    $stm->execute();
    $cursosColombiaP = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursosColombiaP;
}

function mostrarMejoresNotas() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT empleados.PrimerNombre, empleados.PrimerApellido, cursoscursados.calificacion, cursoscursados.IDcursoC, cursoscursados.tituloC
    FROM empleados empleados
    INNER JOIN cursoscursados cursoscursados ON empleados.IDempleado = cursoscursados.IDempleado
    WHERE cursoscursados.calificacion IN (50, 100)
    GROUP BY empleados.PrimerNombre, empleados.PrimerApellido
    ORDER BY empleados.PrimerNombre, empleados.PrimerApellido
    LIMIT 10");
    $stm->execute();
    $empleados = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $empleados;
}




if (isset($_POST['mostrarEmpleados'])) {
    $empleados = mostrarEmpleados();
}
elseif(isset($_POST['mostrarCursos'])) {
    $cursoscursados = mostrarCursos();
}
elseif(isset($_POST['mostrarCursosPanama'])) {
    $cursosPanama = mostrarCursosPanama();
}
elseif(isset($_POST['mostrarCursosCosta'])) {
    $cursosCosta = mostrarCursosCosta();
}
elseif (isset($_POST['mostrarCursosColombiaV'])) {
    $cursosColombiaV = mostrarCursosColombiaV();
}

elseif (isset($_POST['mostrarCursosColombiaP'])) {
    $cursosColombiaP = mostrarCursosColombiaP();
}
elseif (isset($_POST['mostrarMejoresNotas'])) {
    $empleadosNota = mostrarMejoresNotas();
}
?>

<?php include("../../template/header.php"); ?>

<div>
     <h3 class="title">Consultas Join</h3>
    <br>

    <div class="button-container">
        <form method="post">
            <button class="button is-primary is-large" type="submit" name="mostrarEmpleados">datos de 10 empleados</button>
            <button class="button is-primary is-large" type="submit" name="mostrarCursos">10 cursos dictados</button>
            <br><br>
            <button class="button is-primary is-large" type="submit" name="mostrarCursosPanama">5 cursos con mas empleados panama</button>
            <button class="button is-primary is-large" type="submit" name="mostrarCursosCosta">5 cursos con mas empleados Costa Rica</button>
            <br><br>
            <button class="button is-primary is-large" type="submit" name="mostrarCursosColombiaV">10 cursos en Colombia Virtual</button>
            <button class="button is-primary is-large" type="submit" name="mostrarCursosColombiaP">10 cursos en Colombia presencial</button>
            <br><br>
            <button class="button is-primary is-large" type="submit" name="mostrarMejoresNotas">Mejores Notas</button>


        </form>
    </div>

<?php if (isset($empleados)) { ?>
    <br>
    <h4 class="title is-4">10 empleados de la compañía:</h4>
    <div class="table-container">
        <table class="table is-bordered is-hoverable">
            <thead>
                <tr>
                    <th>Activo</th>
                    <th>ID empleado</th>
                    <th>ID usuario</th>
                    <th>Genero</th>
                    <th>Primer Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Grupo Pers.</th>
                    <th>compañia</th>
                    <th>pais/Region</th>
                    <th>Ciudad</th>
                    <th>Ubic. Principal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empleados as $empleado) { ?>
                    <tr>
                        <td><?php echo $empleado['activo']; ?></td>
                        <td><?php echo $empleado['IDempleado']; ?></td>
                        <td><?php echo $empleado['IDusuario']; ?></td>
                        <td><?php echo $empleado['genero']; ?></td>
                        <td><?php echo $empleado['PrimerNombre']; ?></td>
                        <td><?php echo $empleado['PrimerApellido']; ?></td>
                        <td><?php echo $empleado['GrupoPersonal']; ?></td>
                        <td><?php echo $empleado['compañia']; ?></td>
                        <td><?php echo $empleado['paisRegion']; ?></td>
                        <td><?php echo $empleado['ciudad']; ?></td>
                        <td><?php echo $empleado['ubicacionPrim']; ?></td>
                        <td>
                            <button class="button is-small is-primary">Editar</button>
                            <button class="button is-small is-danger">Eliminar</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } elseif (isset($cursoscursados)) { ?>
    <br>
    <h4 class="title is-4">...:</h4>
    <div class="table-container">
        <table class="table is-bordered is-hoverable">
                    <tr>
                        <th scope="col">TipoCurso</th>
                        <th scope="col">IDcurso</th>
                        <th scope="col">titulo</th>
                        <th scope="col">calificacion</th>
                        <th scope="col">estado</th>
                        <th scope="col">fechaFin</th>
                        <th scope="col">usuarioActualizacion</th>
                        <th scope="col">horaActualizacion</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($cursoscursados as $cursoscursados) { ?>
                        <tr class="">
                            <td><?php echo $cursoscursados['TipoCursoC']; ?></td>
                            <td><?php echo $cursoscursados['IDcursoC'];?></td>
                            <td><?php echo $cursoscursados['tituloC'];?></td>
                            <td><?php echo $cursoscursados['calificacion'];?></td>
                            <td><?php echo $cursoscursados['estadoProgreso'];?></td>
                            <td><?php echo $cursoscursados['fechaFin'];?></td>
                            <td><?php echo $cursoscursados['usuarioActualizacion'];?></td>
                            <td><?php echo $cursoscursados['horaActualizacion'];?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } elseif (isset($cursosPanama)) { ?>
    <br>
    <h4 class="title is-4">...:</h4>
    <div class="table-container">
        <table class="table is-bordered is-hoverable">
                <tr>
                    <th scope="col">Cantidad de E</th>
                    <th scope="col">ID C</th>
                    <th scope="col">pais</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursosPanama as $cursoscursados) { ?>
                    <tr class="">
                        <td><?php echo $cursoscursados['totalEmpleados']; ?></td>
                        <td><?php echo $cursoscursados['IDcursoC']; ?></td>
                        <td><?php echo $cursoscursados['paisRegion']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } elseif (isset($cursosColombiaV)) { ?>
    <br>
    <h4 class="title is-4">...:</h4>
    <div class="table-container">
        <table class="table is-bordered is-hoverable">
                <tr>
                    <th scope="col">Cantidad de </th>
                    <th scope="col">ID C</th>
                    <th scope="col">Título C</th>
                    <th scope="col">Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursosColombiaV as $cursoscursados) { ?>
                    <tr class="">
                        <td><?php echo $cursoscursados['totalEmpleados']; ?></td>
                        <td><?php echo $cursoscursados['IDcursoC']; ?></td>
                        <td><?php echo $cursoscursados['tituloC']; ?></td>
                        <td><?php echo $cursoscursados['TipoCursoC']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php }elseif (isset($cursosColombiaP)) { ?>
    <br>
    <h4 class="title is-4">...:</h4>
    <div class="table-container">
        <table class="table is-bordered is-hoverable">
                <tr>
                    <th scope="col">Cantidad de E</th>
                    <th scope="col">ID C</th>
                    <th scope="col">Título C</th>
                    <th scope="col">Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursosColombiaP as $cursoscursados) { ?>
                    <tr class="">
                        <td><?php echo $cursoscursados['totalEmpleados']; ?></td>
                        <td><?php echo $cursoscursados['IDcursoC']; ?></td>
                        <td><?php echo $cursoscursados['tituloC']; ?></td>
                        <td><?php echo $cursoscursados['TipoCursoC']; ?></td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php }elseif (isset($cursosCosta)) { ?>
    <br>
    <h4 class="title is-4">...:</h4>
    <div class="table-container">
        <table class="table is-bordered is-hoverable">
                <tr>
                    <th scope="col">Cantidad de Empleados</th>
                    <th scope="col">ID C</th>
                    <th scope="col">pais</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursosCosta as $cursoscursados) { ?>
                    <tr class="">
                        <td><?php echo $cursoscursados['totalEmpleados']; ?></td>
                        <td><?php echo $cursoscursados['IDcursoC']; ?></td>
                        <td><?php echo $cursoscursados['paisRegion']; ?></td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php }elseif (isset($empleadosNota)) { ?>
    <br>
    <h4 class="title is-4">...:</h4>
    <div class="table-container">
        <table class="table is-bordered is-hoverable">
                <tr>
                    <th scope="col">Nombre empleado</th>
                    <th scope="col">ID C</th>
                    <th scope="col">Título C</th>
                    <th scope="col">nota E</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empleadosNota as $empleado) { ?>
                    <tr class="">
                        <td><?php echo $empleado['PrimerNombre']; ?></td>
                        <td><?php echo $empleado['IDcursoC']; ?></td>
                        <td><?php echo $empleado['tituloC']; ?></td>
                        <td><?php echo $empleado['calificacion']; ?></td>
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