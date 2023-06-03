<?php

include("ConexionBD.php");
$conectar = Conectar();


    $q_verificarTicket ="SELECT * FROM COMPRA";
    $verificarTicket = mysqli_query($conectar,$q_verificarTicket);
    $existeTicket = mysqli_num_rows($verificarTicket);

    echo $existeTicket;

?>
