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
$stid = oci_parse($conn, 'begin :resultado := get_persona_edad(:per_id);end;');
oci_bind_by_name($stid,':resultado',$person_edad,10);
oci_bind_by_name($stid,':per_id',$id_pers);
oci_execute($stid);

//Obtener el signo zodiacal
//id_szodiaco almacena el id del signo zodiacal almacenado en persona
//person_szodiaco almacena el nombre del signo consultado por el id
$stid = oci_parse($conn, 'begin :resultado := get_SIGNO_ZODIACO(:person_id);end;');
oci_bind_by_name($stid,':resultado',$id_szodiaco,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);
$stid = oci_parse($conn, 'begin :resultado := get_Sig_Zodiaco_cat(:SIGNO_ID);end;');
oci_bind_by_name($stid,':resultado',$person_szodiaco,30);
oci_bind_by_name($stid,':SIGNO_ID',$id_szodiaco);
oci_execute($stid);

//Obtener la religion de la persona
$stid = oci_parse($conn, 'begin :resultado := get_Religion(:person_id);end;');
oci_bind_by_name($stid,':resultado',$id_religion,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);
$stid = oci_parse($conn, 'begin :resultado := get_religion_cat(:religion_id);end;');
oci_bind_by_name($stid,':resultado',$person_religion,30);
oci_bind_by_name($stid,':religion_id',$id_religion);
oci_execute($stid);

//obtener el estado civil
$stid = oci_parse($conn, 'begin :resultado := get_Est_Civil_persona(:person_id);end;');
oci_bind_by_name($stid,':resultado',$id_ecivil,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);
$stid = oci_parse($conn, 'begin :resultado := get_ecivil_cat(:ecivil_id);end;');
oci_bind_by_name($stid,':resultado',$person_ecivil,30);
oci_bind_by_name($stid,':ecivil_id',$id_ecivil);
oci_execute($stid);


//obtener el nivel de educacion
$stid = oci_parse($conn, 'begin :resultado := get_Nivel_Educacion(:person_id);end;');
oci_bind_by_name($stid,':resultado',$id_educacion,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);
$stid = oci_parse($conn, 'begin :resultado := get_educacion_cat(:educacion_id);end;');
oci_bind_by_name($stid,':resultado',$person_educacion,30);
oci_bind_by_name($stid,':educacion_id',$id_educacion);
oci_execute($stid);

//obtener el genero
$stid = oci_parse($conn, 'begin :resultado := get_Genero_persona(:person_id);end;');
oci_bind_by_name($stid,':resultado',$id_genero,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);
$stid = oci_parse($conn, 'begin :resultado := get_genero_cat(:genero_id);end;');
oci_bind_by_name($stid,':resultado',$person_genero,30);
oci_bind_by_name($stid,':genero_id',$id_genero);
oci_execute($stid);

//obtener correo
$stid = oci_parse($conn, 'begin :resultado := get_correo(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_correo,40);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);

//obtener altura
$stid = oci_parse($conn, 'begin :resultado := get_person_altura(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_altura,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);

//obtener peso
$stid = oci_parse($conn, 'begin :resultado := selectPeso(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_peso,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);

//obtener contextura
$stid = oci_parse($conn, 'begin :resultado := get_person_contextura(:person_id);end;');
oci_bind_by_name($stid,':resultado',$id_contextura,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);
$stid = oci_parse($conn, 'begin :resultado := get_contextura(:contextura_id);end;');
oci_bind_by_name($stid,':resultado',$person_contextura,40);
oci_bind_by_name($stid,':contextura_id',$id_contextura);
oci_execute($stid);

//obtener cantidad de hijos
$stid = oci_parse($conn, 'begin :resultado := get_person_cantidad_hijos(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_chijos,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);

// falta que si le gustan las mascotas
$stid = oci_parse($conn, 'begin :resultado := get_mascota_futuro(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_gmascotas,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);

// obtener si tiene mascotas
$stid = oci_parse($conn, 'begin :resultado := get_tiene_mascota(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_pmascotas,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);

//obtener si desea mascotas en un futuro
$stid = oci_parse($conn, 'begin :resultado := get_mascota_futuro(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_mmascotas,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);

//obtener la frecuencia de ejercicio
$stid = oci_parse($conn, 'begin :resultado := get_Frec_Ejer_persona(:person_id);end;');
oci_bind_by_name($stid,':resultado',$id_frecejer,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);
$stid = oci_parse($conn, 'begin :resultado := get_frecejer_cat(:fejer_id);end;');
oci_bind_by_name($stid,':resultado',$person_frecejer,30);
oci_bind_by_name($stid,':fejer_id',$id_frecejer);
oci_execute($stid);

// obtener la ciudad
$stid = oci_parse($conn, 'begin :resultado := selectCiudad(:idPersona);end;');
oci_bind_by_name($stid,':resultado',$person_ciudad,30);
oci_bind_by_name($stid,':idPersona',$id_pers);
oci_execute($stid);
// saber si fuma
$stid = oci_parse($conn, 'begin :resultado := get_fumador(:person_id);end;');
oci_bind_by_name($stid,':resultado',$person_fumador,30);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);
// saber si es bebedor 
$stid = oci_parse($conn, 'begin :resultado := get_bebedor_persona(:person_id);end;');
oci_bind_by_name($stid,':resultado',$id_bebedor,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);
$stid = oci_parse($conn, 'begin :resultado := get_bebedor_cat(:bebedor_id);end;');
oci_bind_by_name($stid,':resultado',$person_bebedor,30);
oci_bind_by_name($stid,':bebedor_id',$id_bebedor);
oci_execute($stid);

//obtener la profesion
$stid = oci_parse($conn, 'begin :resultado := get_Profesion(:person_id);end;');
oci_bind_by_name($stid,':resultado',$id_profesion,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);
$stid = oci_parse($conn, 'begin :resultado := get_profesion_cat(:ocupacion_id);end;');
oci_bind_by_name($stid,':resultado',$person_ocupacion,30);
oci_bind_by_name($stid,':ocupacion_id',$id_profesion);
oci_execute($stid);

$stid = oci_parse($conn, 'begin :resultado := get_edadmin_buscada(:person_id);end;');
oci_bind_by_name($stid,':resultado',$edad_min,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);

$stid = oci_parse($conn, 'begin :resultado := get_edadmax_buscada(:person_id);end;');
oci_bind_by_name($stid,':resultado',$edad_max,10);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);


//obtener el genero de la pareja q se busca
$stid = oci_parse($conn, 'begin :resultado := get_tipo_pareja(:person_id);end;');
oci_bind_by_name($stid,':resultado',$pareja_genero,30);
oci_bind_by_name($stid,':person_id',$id_pers);
oci_execute($stid);

// Initializing Session

    }
            
?>