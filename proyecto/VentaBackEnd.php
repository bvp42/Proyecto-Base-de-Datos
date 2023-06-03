<?php

include("ConexionBD.php");
$conectar = Conectar();

if (isset($_POST['empleado'])){
    $empleado = $_POST['empleado'];
    $codigo = $_POST['codigo'];
    $cantidad = $_POST['cantidad'];
    $contador =$_POST['contador']+1;

    $q_verificar ="SELECT * FROM PRODUCTO WHERE codigo_p='$codigo'";
    $verificar = mysqli_query($conectar,$q_verificar);
    $existe = mysqli_num_rows($verificar);
    $renglon =mysqli_fetch_array($verificar);
    $precio_total = $cantidad*$renglon[3];

    $envio ="<tr><td>$contador</td><td>$renglon[0]</td><td>$renglon[1]</td><td>$cantidad</td><td>$renglon[3]</td><td>$precio_total</td></tr>";
    if ($existe>0){
        echo $envio;
    }
}
?>
