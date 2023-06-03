<?php

include("ConexionBD.php");
$conectar = Conectar();

?>

<html lang="es">
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title> Registrar productos </title>
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
        <h1 id="titulo">Registro de Productos</h1>
    </div>

    <div class="ancho">
        <form id="formulario" action="Registro_Prod.php" method="POST">
            <br>
            <label for="Nombre">Nombre del Producto</label> <input type="text" name="nombre" id="Nombre">
            <br><br>
            <label>Cantidad</label> <input type="number" name="cantidad" id="Cant_F" min="1" step="1" required>
            <br><br>
            <label>Precio de Venta</label><input type="number" name="precio" id="PrecioV" min="0.10" step="0.10">
            <br><br>
            <label>Codigo del producto</label><input type="number" name="codigo" id="Codigo" min="10000000" step="1" required>
            <br><br>
            <label>Existencia minima</label><input type="number" name="existencia" id="ExistenciaM" min="1" step="1">
            <br><br>
            <input type="submit" value="Enviar" name="enviar">

        </form>

    </div>

</body>

</html>

<?php

if (isset($_POST['enviar'])) {

    if (strlen($_POST['codigo']) > 1 && strlen($_POST['cantidad'])>=1) {

        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];
        $codigo = $_POST['codigo'];
        $existencia = $_POST['existencia'];

        $checarEx = "SELECT * FROM PRODUCTO WHERE codigo_p='$codigo'";

        $resultado2 = mysqli_query($conectar, $checarEx);
        $numFilas = mysqli_num_rows($resultado2);
        $fila = mysqli_fetch_array($resultado2);


        $sumaCantidad = $fila[2] + $cantidad;
        $registro = "INSERT INTO PRODUCTO (codigo_p,nombre,cnt_f,precio_v,ex_min) VALUES ('$codigo','$nombre','$cantidad','$precio','$existencia')";
        $actualizarCant = "UPDATE PRODUCTO SET cnt_f='$sumaCantidad' WHERE codigo_p ='$codigo'";
        $resultado = ($numFilas == 0) ? mysqli_query($conectar, $registro) : false;  //Ejecutamos el insertar

        if (!$resultado) {
            if ($numFilas != 0) {
                $resultado = mysqli_query($conectar, $actualizarCant);
            }

            echo ($resultado) ? "<table><tr><td>Ya existe el producto '$fila[1]' por lo que se aumento su cantidad con los datos aportados</td></tr></table>" : "<table><tr><td>Error al registrar datos.</td></tr></table>";
        } else {
            echo "<table><tr>
            <td >El producto se registro exitosamente</td>
            </tr></table>";
        }
    } 
}

?>
