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
        $conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
    if (!$conn) {
        $error = "No se pudo conectar con la base de datos";
        echo $error;
    } else {
        
        $scriptU='begin crear_usuario(nombre => :nombre,pass => :pass);end;';
        $stid = oci_parse($conn,$scriptU);
        $nom_us=$_POST['in_usuario'];
        $pass_us=$_POST['in_contrasenha'];
        oci_bind_by_name($stid,':nombre',$nom_us);
        oci_bind_by_name($stid,':pass',$pass_us);
        oci_execute($stid);
        
        
        
        $scriptP="begin  insertar_persona(nombre => :nombre,
                                         prim_apellido => :prim_apellido,
                                         seg_apellido => :seg_apellido,
                                         fecha => :fecha,
                                            usuario => :usuario,
                                            genero => :genero,
                                        residencia => :residencia);
        					commit;
                end;";
        $stid = oci_parse($conn,$scriptP);
        oci_bind_by_name($stid,':nombre',$_POST['in_nombre']);
        oci_bind_by_name($stid,':prim_apellido',$_POST['in_papellido']);
        oci_bind_by_name($stid,':seg_apellido',$_POST['in_sapellido']);
        $date = date('d-m-Y', strtotime($_POST['in_nacimiento']));
        oci_bind_by_name($stid,':fecha',$date);
        oci_bind_by_name($stid,':usuario',$_POST['in_usuario']);
        oci_bind_by_name($stid,':genero',$_POST['in_genero']);
        oci_bind_by_name($stid,':residencia',$_POST['in_ciudad']);
        oci_execute($stid); 
        
        $scriptI='begin :result := get_id_persona_user(nombre => :nombre); end;';
        $stid = oci_parse($conn,$scriptI);
        oci_bind_by_name($stid,':result',$Persona_id,2);
        oci_bind_by_name($stid,':nombre',$_POST['in_usuario']);
        oci_execute($stid);
        $_SESSION['signed_id']=$Persona_id;
        //se carga el nombre completo de la persona
        $stid = oci_parse($conn, 'begin :resultado := get_person_nombre(:id_persona);end;');
        oci_bind_by_name($stid,':resultado',$person_nombre,30);
        oci_bind_by_name($stid,':id_persona',$persona_id);
        oci_execute($stid);
        
        $stid = oci_parse($conn, 'begin :resultado := select_prim_apellido(:id_persona);end;');
        oci_bind_by_name($stid,':resultado',$person_pApellido,30);
        oci_bind_by_name($stid,':id_persona',$persona_id);
        oci_execute($stid);
        
        $person_nombre.=" ".$person_pApellido;
        
        $stid = oci_parse($conn, 'begin :resultado := select_seg_apellido(:id_persona);end;');
        oci_bind_by_name($stid,':resultado',$person_sApellido,30);
        oci_bind_by_name($stid,':id_persona',$persona_id);
        oci_execute($stid);
        
        $script_correo='begin insert_correo(:direccion,:usuario); end;';
        $stid = oci_parse($conn,$script_correo);
        oci_bind_by_name($stid,':direccion',$_POST['in_correo']);
        oci_bind_by_name($stid,':usuario',$persona_id);
        oci_execute($stid);
        
        $person_nombre.=" ".$person_sApellido;
        
        $_SESSION['signed_nombre']=$person_nombre;
        $_SESSION['signed_pApellido']=$person_pApellido;
        $_SESSION['signed_sApellido']=$person_sApellido;
        $_SESSION['signed_correo']=$_POST['in_correo'];
        
        
        
        //header("location: pagpersonabuscada.html");
    
    }
    }
}
?>
