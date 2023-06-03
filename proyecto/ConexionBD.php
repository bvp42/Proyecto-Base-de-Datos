<?php

function Conectar(){
    $user="root";
    $pass="";
    $server="localhost";
    $db="PROYECTO";
    $conexion=new mysqli($server,$user,$pass,$db);

    if ($conexion->connect_error){
        die ("Problemas en la conexión: ".$conexion->connect_error);
    }
    return $conexion;       
}

function CerrarConexion(){
    $cerrar=mysqli_close($conexion);
    return $cerrar;
}
?>
