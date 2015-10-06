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
                end;";
        $stid = oci_parse($conn,$scriptP);
        oci_bind_by_name($stid,':nombre',$_POST['in_nombre']);
        oci_bind_by_name($stid,':prim_apellido',$_POST['in_papellido']);
        oci_bind_by_name($stid,':seg_apellido',$_POST['in_sapellido']);
        oci_bind_by_name($stid,':fecha',$_POST['in_nacimiento']);
        oci_bind_by_name($stid,':usuario',$_POST['in_usuario']);
        $get_genero=oci_parse($conn,'begin :resul :=get_genero_id(:nom_gen); end;');
        oci_bind_by_name($get_genero,':resul',$genero_id,2);
        oci_bind_by_name($get_genero,':nom_gen',$_POST['in_genero']);
        oci_execute($get_genero);
        oci_bind_by_name($stid,':genero',$genero_id);
        $get_ciudad=oci_parse($conn,'begin :resul :=get_ciudad_id(:nom_city); end;');
        oci_bind_by_name($get_ciudad,':resul',$ciudad_id,4);
        oci_bind_by_name($get_ciudad,':nom_city',$_POST['in_ciudad']);
        oci_execute($get_ciudad);
        oci_bind_by_name($stid,':residencia',$ciudad_id);
        oci_execute($stid);
        
        $scriptI='begin :result := get_id_persona_user(nombre => :nombre); end;';
        $stid = oci_parse($conn,$scriptI);
        oci_bind_by_name($stid,':result',$Persona_id,2);
        oci_bind_by_name($stid,':nombre',$_POST['in_usuario']);
        oci_execute($stid);
        $_SESSION['signed_id']=$Persona_id;
        
        header("location: pagpersonabuscada.html");
    
    }
    }
}
?>