<?php

include('sesion.php');
include('pagpersonabuscada.html');

$error=''; // Variable To Store Error Message... el mensaje de error
if (isset($_POST['btn_guardarCambios_pagEditarRegistro'])) {   // si el boton es presionado que verifique si cada uno de esos campos son  diferente de vacios
    if ( (empty($_POST['in_nombre']) || empty($_POST['in_primer_apellido']) || empty($_POST['in_segundo_apellido']) ||
            empty($_POST['in_genero']) || empty($_POST['in_nacimiento']) ||
            empty($_POST['in_contrasena_nueva']) || empty($_POST['in_contrasena_actual']) 
            || empty($_POST['in_confirmar_contrasena']) || empty($_POST['in_pais']) ||
             empty($_POST['in_ciudad']))) {  // (in_nombre) nombre del campo en la interfaz
    $error = "Ningún campo puede quedar vacío";  //si hay alguno vacio, tira error
    echo $error;
    }
    else{
        $conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB'); //crea la conexion 
    if (!$conn) {
        $error = "No se pudo conectar con la base de datos";  //si no se pudo dar la conexion, error!
    } else {
              
        $scriptU='begin update_persona(id => :id,nombre => :nombre,papellido => :papellido, sapellido => :sapellido, '
                . 'genero => :genero,ciudad =>:ciudad);end;';//se puede hacer pegado, ver login
        $stid = oci_parse($conn,$scriptU);  //para ejecutar el script
        
        $nom_us=$_POST['in_nombre'];     //busca el nombre q tenia ese nombre
        $pApellido_us=$_POST['in_primer_apellido'];     //todo lo que dice POST esta en interfaz
        $sApellido_us=$_POST['in_segundo_apellido'];
        $genero_us=$_POST['in_genero'];
        $ciudad_us=$_POST['in_ciudad'];
        
        oci_bind_by_name($stid,':nombre',$nom_us); //oci_bind_by_name, sustituir los parametros de script U, por valores reales.
        oci_bind_by_name($stid,':papellido',$pApellido_us);
        oci_bind_by_name($stid,':sapellido',$sApellido_us);
        oci_bind_by_name($stid,':genero',$genero_us);
        oci_bind_by_name($stid,':ciudad',$ciudad_us);
        
        oci_execute($stid); //es csomo F8 ejecutar
        $msj = 'Datos actualizados correctamente';
        echo $msj;
        

        
        

        
        $scriptU='begin update_usuario(nombre => :nombre,pass => :pass);end;';//se puede hacer pegado, ver login
        $stid = oci_parse($conn,$scriptU);  //para ejecutar el script
        
        $nom_usu=$_POST['in_usuario'];     //busca el nombre q tenia ese nombre
        $pass_usu=$_POST['in_contrasena_actual'];   //todo lo que dice POST esta en interfaz
        oci_bind_by_name($stid,':nombre',$nom_usu); //oci_bind_by_name, sustituir los parametros de script U, por valores reales.
        oci_bind_by_name($stid,':pass',$pass_usu);
        oci_execute($stid); //es csomo F8 ejecutar
        
        

        
        
        header("location: pageditarregistro.html");   //para donde quiero ir.
    
    }
    }
}
?>

