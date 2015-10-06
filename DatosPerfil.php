<?php
session_start();
$id_pers=$_SESSION['signed_id'];
echo $id_pers;
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
    if (!$conn) {
        $error = "No se pudo conectar con la base de datos";
    } else {
$stid = oci_parse($conn, 'begin :resultado := get_person_nombre(:id_persona);end;');
oci_bind_by_name($stid,':resultado',$person_nombre,30);
oci_bind_by_name($stid,':id_persona',$id_pers);
oci_execute($stid);
$_SESSION['signed_nombre']=$person_nombre; // Initializing Session
$stid = oci_parse($conn, 'begin :resultado := get_persona_edad(:per_id);end;');
oci_bind_by_name($stid,':resultado',$person_edad,10);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);
$stid = oci_parse($conn, 'begin :resultado := get_SIGNO_ZODIACO(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_szodiaco,30);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);

$stid = oci_parse($conn, 'begin :resultado := get_Religion(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_religion,30);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);

$stid = oci_parse($conn, 'begin :resultado := get_Est_Civil_persona(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_ecivil,30);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);

$stid = oci_parse($conn, 'begin :resultado := get_Nivel_Educacion(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_educacion,30);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);

$stid = oci_parse($conn, 'begin :resultado := get_Genero_persona(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_genero,30);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);

$stid = oci_parse($conn, 'begin :resultado := get_correo(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_correo,40);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);

$stid = oci_parse($conn, 'begin :resultado := get_person_altura(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_altura,10);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);

$stid = oci_parse($conn, 'begin :resultado := selectPeso(:idPersona);end;');
oci_bind_by_name($stid,':resultado',$person_peso,10);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);

$stid = oci_parse($conn, 'begin :resultado := get_person_contextura(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_contextura,40);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);

$stid = oci_parse($conn, 'begin :resultado := get_person_cantidad_hijos(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_chijos,10);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);

$stid = oci_parse($conn, 'begin :resultado := get_person_altura(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_gmascotas,10);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);

$stid = oci_parse($conn, 'begin :resultado := get_tiene_mascota(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_pmascotas,10);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);

$stid = oci_parse($conn, 'begin :resultado := get_mascota_futuro(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_mmascotas,10);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);

$stid = oci_parse($conn, 'begin :resultado := get_Frec_Ejer_persona(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_frecejer,10);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);
// Initializing Session
    }
            
?>