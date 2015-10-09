<?php

include('sesion.php');
include('pagpersonabuscada.html');

$error=''; // Variable To Store Error Message... el mensaje de error
if (isset($_POST['btn_guardar'])) {   // si el boton es presionado que verifique si cada uno de esos campos son  diferente de vacios
    if ( (empty($_POST['in_nombre']) || empty($_POST['in_genero']) || empty($_POST['in_emin']) ||
         empty($_POST['in_emax']))) {  // (in_nombre) nombre del campo en la interfaz
         $error = "Ningún campo puede quedar vacío";  //si hay alguno vacio, tira error
         echo $error;
    }
    else{
        $conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB'); //crea la conexion 
        if (!$conn) {
            $error = "No se pudo conectar con la base de datos";  //si no se pudo dar la conexion, error!
        } else {      
            
            $scriptU='begin insert_genero_rangos(id => :id,genero => :genero,eMin => :eMin,eMax => :geMax);end;';//se puede hacer pegado, ver login
            $stid = oci_parse($conn,$scriptU);  //para ejecutar el script
            
            $person_genero=$_POST['in_genero'];     //busca el nombre q tenia ese nombre
            $person_emin=$_POST['in_emin'];     //busca el nombre q tenia ese nombre
            $person_genero=$_POST['in_emax'];     //busca el nombre q tenia ese nombre
            oci_bind_by_name($stid,':id_p',$id_pers);  //id de la persona
            oci_bind_by_name($stid,':id',$person_id);
            oci_bind_by_name($stid,':genero',$person_genero);
            oci_bind_by_name($stid,':eMin',$person_emin);
            oci_bind_by_name($stid,':eMax',$person_emax);
            oci_execute($stid); //es csomo F8 ejecutar
                 
        header("location: pageditarregistro.html");   //para donde quiero ir.
    
    }
    }
}
?>

