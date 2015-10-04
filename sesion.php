<?php
session_start();
$id_pers=$_SESSION['signed_id'];
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
    if (!$conn) {
        $error = "No se pudo conectar con la base de datos";
    } else {
$stid = oci_parse($conn, 'begin :resultado := get_person_nombre(:id_persona);end;');
oci_bind_by_name($stid,':resultado',$person_nombre,30);
oci_bind_by_name($stid,':id_persona',$id_pers);
oci_execute($stid);
$_SESSION['signed_nombre']=$person_nombre; // Initializing Session
    }
            
?>