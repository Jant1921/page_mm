<?php
include('sesion.php');

$error=''; // Variable To Store Error Message... el mensaje de error
if (isset($_POST['btn_guardar'])) {   // si el boton es presionado que verifique si cada uno de esos campos son  diferente de vacios
    if ( (empty($_POST['in_nombre']) || empty($_POST['in_primer_apellido']) || empty($_POST['in_segundo_apellido']) ||
            empty($_POST['in_genero']) || empty($_POST['in_nacimiento']) ||
             empty($_POST['in_pais']) ||
             empty($_POST['in_ciudad'])||empty($_POST['in_correo']))) {  // (in_nombre) nombre del campo en la interfaz
    $error = "Ning�n campo puede quedar vac�o";  //si hay alguno vacio, tira error
    echo $error;
    }
    else{
        $conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB'); //crea la conexion 
    if (!$conn) {
        $error = "No se pudo conectar con la base de datos";  //si no se pudo dar la conexion, error!
    } else {
        
//obtener primer apellido de la persona      
        $stid = oci_parse($conn, 'begin :resultado := get_primer_apellido(:person_id);end;');
        oci_bind_by_name($stid,':resultado',$person_primer_apellido,30);
        oci_bind_by_name($stid,':person_id',$id_pers);
        oci_execute($stid);

        //obtener segundo apellido de la persona
        $stid = oci_parse($conn, 'begin :resultado := get_segundo_apellido(:person_id);end;');
        oci_bind_by_name($stid,':resultado',$person_segundo_apellido,30);
        oci_bind_by_name($stid,':person_id',$id_pers);
        oci_execute($stid);

        //obtener fecha nacimiento
        $stid = oci_parse($conn, 'begin :resultado := get_fechaNacimiento(:person_id);end;');
        oci_bind_by_name($stid,':resultado',$person_fecha_nacimiento,30);
        oci_bind_by_name($stid,':person_id',$id_pers);
        oci_execute($stid);

            
        $scriptU='begin update_persona(:id_p,:nombre,:papellido,:sapellido,:genero,:ciudad,:fecha);end;';//se puede hacer pegado, ver login
        $stid = oci_parse($conn,$scriptU);  //para ejecutar el script
        
        $nom_us=$_POST['in_nombre'];     //busca el nombre q tenia ese nombre
        $pApellido_us=$_POST['in_primer_apellido'];     //todo lo que dice POST esta en interfaz
        $sApellido_us=$_POST['in_segundo_apellido'];
        $genero_us=$_POST['in_genero'];
        $ciudad_us=$_POST['in_ciudad'];
        oci_bind_by_name($stid,':id_p',$id_pers);
        oci_bind_by_name($stid,':nombre',$nom_us); //oci_bind_by_name, sustituir los parametros de script U, por valores reales.
        oci_bind_by_name($stid,':papellido',$pApellido_us);
        oci_bind_by_name($stid,':sapellido',$sApellido_us);
        oci_bind_by_name($stid,':genero',$genero_us);
        oci_bind_by_name($stid,':ciudad',$ciudad_us);
        oci_bind_by_name($stid,':fecha',$_POST['in_nacimiento']);
        
        oci_execute($stid); //es csomo F8 ejecutar
        print "Datos actualizados correctamente";
        
        $stid=oci_parse($conn,"begin update_correo(:id_p,:direccion);end;");
        oci_bind_by_name($stid,':id_p',$id_pers);
        oci_bind_by_name($stid,':direccion',$_POST['in_correo']); //oci_bind_by_name, sustituir los parametros de script U, por valores reales.
        oci_execute($stid);
        
        
		if(empty($_POST['in_contrasena_nueva']) || empty($_POST['in_contrasena_actual']) 
            || empty($_POST['in_confirmar_contrasena'])){
			
		}else{
                $scriptU='begin update_usuario(nombre => :nombre,pass => :pass);end;';//se puede hacer pegado, ver login
        		$stid = oci_parse($conn,$scriptU);  //para ejecutar el script
        		$nom_usu=$_POST['in_usuario'];     //busca el nombre q tenia ese nombre
        $pass_usu=$_POST['in_contrasena_actual'];   //todo lo que dice POST esta en interfaz
        oci_bind_by_name($stid,':nombre',$nom_usu); //oci_bind_by_name, sustituir los parametros de script U, por valores reales.
        oci_bind_by_name($stid,':pass',$pass_usu);
        oci_execute($stid); //es csomo F8 ejecutar
		}
        

        
        
        header("location: pageditarregistro.html");   //para donde quiero ir.
    
    }
    }
}
?>

