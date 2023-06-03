<?php

include("ConexionBD.php");
$conectar = Conectar();

?>

<html lang="es">
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title> Registrar Empleados </title>
    <link href="estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <ul id="navbar">
        <li class="elementos"><a class="links" href="Registro_Prod.php">Registro Productos</a></li>
        <li class="elementos"><a class="links" href="Registro_Emp.php">Registro Empleados</a></li>
        <li class="elementos"><a class="links" href="Venta.html">Venta</a></li>
        <li class="elementos" style="float:right"><a class="links" href="Acerca.php">Acerca de</a></li>
    </ul>
    <div class="ancho">
        <h1 id="titulo">Registro de Empleados</h1>
    </div>

    <div class="ancho">
        <form id="formulario" action="Registro_Emp.php" method="POST">
            <br>
            <label for="Nombre">Nombre</label> <input type="text" name="nombre" id="Nombre" required>
            <br><br>
            <label>Apellido Paterno</label> <input type="text" name="apellidoP" id="ApellidoP" required>
            <br><br>
            <label>Apellido Materno</label> <input type="text" name="apellidoM" id="ApellidoM" required>
            <br><br>
            <label>Telefono</label><input type="tel" name="telefono" id="Telefono" pattern="[0-9]{10}" required>
            <br><br>
            <label>Municipio</label><select name="ciudad">
                <?php
                $consulta = "SELECT * FROM CIUDAD";
                $ejecutar = mysqli_query($conectar, $consulta);
                ?>
                <?php foreach ($ejecutar as $opciones) : ?>
                    <option value="<?php echo $opciones['ciudad'] ?>"><?php echo $opciones['ciudad'] ?></option>
                <?php endforeach ?>
            </select>
            <br><br>
            <label>Calle</label><input type="text" name="calle" id="Calle" required>
            <br><br>
            <label>Colonia</label><input type="text" name="colonia" id="Colonia" required>
            <br><br>
            <label>Num Ext</label><input type="number" min="1" step="1"" name=" numExt" id="NumEXT" required>
            <br><br>
            <label>Cargo<select name="cargo">
                    <?php
                    $consulta = "SELECT * FROM CARGO";
                    $ejecutar = mysqli_query($conectar, $consulta);
                    ?>
                    <?php foreach ($ejecutar as $opciones) : ?>
                        <option value="<?php echo $opciones['cargo'] ?>"><?php echo $opciones['cargo'] ?></option>
                    <?php endforeach ?>
                </select></label>
            <br><br>
            <input type="submit" value="Enviar" name="enviar">

        </form>
    </div>

</body>

</html>

<?php

if (isset($_POST['enviar'])) {

    if (strlen($_POST['nombre']) > 1 && strlen($_POST['apellidoP']) > 1 && strlen($_POST['apellidoM']) > 1 && strlen($_POST['calle']) > 1 && strlen($_POST['colonia']) > 1) {
        $nombre = $_POST['nombre'];
        $apellidoP = $_POST['apellidoP'];
        $apellidoM = $_POST['apellidoM'];
        $ciudad = $_POST['ciudad'];
        $calle = $_POST['calle'];
        $colonia = $_POST['colonia'];
        $estado = 2;
        $numEXT = $_POST['numExt'];
        $telefono = $_POST['telefono'];
        $cargo =$_POST['cargo'];

        $q_Cargo = "SELECT * FROM CARGO WHERE cargo ='$cargo'";
        $ejecutarCargo = mysqli_query($conectar, $q_Cargo);
        $arregloCargo = mysqli_fetch_array($ejecutarCargo);
        $cargo=$arregloCargo[0];
        
        
        if ($cargo == 1) {
           
            $checarEx = "SELECT * FROM EMPLEADO WHERE id_cargo=$cargo";
            $resultado2 = mysqli_query($conectar, $checarEx);
            $numFilas = mysqli_num_rows($resultado2);
            

            if ($numFilas > 0) {
                echo "<table><tr>
            <td >No puede haber dos encargados. Almanecenando al trabajador como empleado</td>
            </tr></table>";
                $cargo = 2;
            }
        }
       
        
        $q_llenarColonia = "INSERT INTO COLONIA (colonia) VALUES ('$colonia')";
        $llenarColonia = mysqli_query($conectar, $q_llenarColonia);
        
        $q_recuperarIdColonia = "SELECT * FROM COLONIA WHERE colonia='$colonia'";
        $recuperarIdColonia = mysqli_query($conectar, $q_recuperarIdColonia);
        $arregloColonia = mysqli_fetch_array($recuperarIdColonia);
        

        $q_llenarCalle = "INSERT INTO CALLE (calle) VALUES ('$calle')";
        $llenarCalle = mysqli_query($conectar, $q_llenarCalle);
        
        $q_recuperarIdCalle = "SELECT * FROM CALLE WHERE calle='$calle'";
        $recuperarIdCalle = mysqli_query($conectar, $q_recuperarIdCalle);
        $arregloCalle = mysqli_fetch_array($recuperarIdCalle);
        

        $q_obtenerCiudad = "SELECT * FROM CIUDAD WHERE ciudad='$ciudad'";
        $recuperarCiudad = mysqli_query($conectar, $q_obtenerCiudad);
        $arregloCiudad = mysqli_fetch_array($recuperarCiudad);

        //Checar si existe el empleado
        $q_checarEmpleado = "SELECT * FROM EMPLEADO WHERE nombre='$nombre' AND apellido_p='$apellidoP' AND apellido_m='$apellidoM'";
        $checarEmpleado = mysqli_query($conectar, $q_checarEmpleado);
        $arrayEmpleado = mysqli_fetch_array($checarEmpleado);
        $filasEmp = mysqli_num_rows($checarEmpleado);

        if ($filasEmp == 0) {
           
            $insertarEmp = "INSERT INTO EMPLEADO (nombre,apellido_p,apellido_m,id_ciudad,id_calle,id_colonia,id_estado,id_cargo,num_ext,telefono) VALUES ('$nombre','$apellidoP','$apellidoM',$arregloCiudad[0],$arregloCalle[0],$arregloColonia[0],$estado,$cargo,$numEXT,$telefono)";
            $agregarEmp = mysqli_query($conectar, $insertarEmp); 
            
            echo "<table><tr>
            <td>Se ha agregado correctamente al empleado</td>
            </tr></table>";
        } else {
            echo "<table><tr>
            <td>El empleado que acabas de agregar ya existe y su id es $arrayEmpleado[0]</td>
            </tr></table>";
        }
    } else {
        echo "<table><tr>
    <td>No se llenaron todos los campos</td>
    </tr></table>";
    }
}
?>