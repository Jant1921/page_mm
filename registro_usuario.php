<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['boton_crear'])) {
    if ( (empty($_POST['in_nombre']) || empty($_POST['in_papellido']) || empty($_POST['in_sapellido']) ||
            empty($_POST['in_genero']) || empty($_POST['in_correo']) || empty($_POST['in_nacimiento']) ||
             empty($_POST['in_usuario']) || empty($_POST['in_contrasenha']) || empty($_POST['in_pais']) ||
             empty($_POST['in_ciudad']))) {
    $error = "Ningún campo puede quedar vacío";
    echo $error;
    }
    else{
        header("location: pagpersonabuscada.html");
    }
}
?>