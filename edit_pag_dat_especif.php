<?php
include('sesion.php');

$error=''; // Variable To Store Error Message... el mensaje de error
if (isset($_POST['btn_guarda_ede'])) {   // si el boton es presionado 
    
        $conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB'); //crea la conexion 
    if (!$conn) {
        $error = "No se pudo conectar con la base de datos";  //si no se pudo dar la conexion, error!
    } else {
        
        $Persona_id=$_SESSION['signed_id'];
        
        $person_rangos=$_POST['rangosal_reg'];
        $scriptU='begin Actualizar_RangoSalario(NRangoSalario => :rango_id,IDPERSONA => :id_p);end;';
        $stid = oci_parse($conn,$scriptU);
        oci_bind_by_name($stid,':id_p',$id_pers);
         oci_bind_by_name($stid,':rango_id',$person_rangos);
        oci_execute($stid);
        
        $person_fhijos=$_POST['in_fhijos'];
        $scriptU='begin update_persona_hijos_futuro(person_id => :id_p,hijos_futuro => :id_fhijos);end;';
        $stid = oci_parse($conn,$scriptU);
        oci_bind_by_name($stid,':id_fhijos',$person_fhijos);
        oci_bind_by_name($stid,':id_p',$id_pers);
        oci_execute($stid);
        
        $person_chijos=$_POST['in_chijos'];
        $scriptU='begin update_persona_cantidad_hijos(person_id => :id_p,hijos => :cant_hijos);end;';
        $stid = oci_parse($conn,$scriptU);
        oci_bind_by_name($stid,':cant_hijos',$person_chijos);
        oci_bind_by_name($stid,':id_p',$id_pers);
        oci_execute($stid);

        
        $person_infor=$_POST['in_about'];
        $scriptU='begin update_persona_slogan(person_id => :id_p,slogan => :infor);end;';
        $stid = oci_parse($conn,$scriptU);
         oci_bind_by_name($stid,':infor',$person_infor);
         oci_bind_by_name($stid,':id_p',$id_pers);
        oci_execute($stid);
        
        $person_fmascotas=$_POST['in_fmascotas'];
        $scriptU='begin update_persona_mascota_futuro(person_id => :id_p,mascota_futuro => :mascfuturo);end;';
        $stid = oci_parse($conn,$scriptU);
         oci_bind_by_name($stid,':mascfuturo',$person_fmascotas);
         oci_bind_by_name($stid,':id_p',$id_pers);
        oci_execute($stid);
        
        $person_poseemascotas=$_POST['in_pmascotas'];
        $scriptU='begin update_persona_tiene_mascota(person_id => :id_p,tiene_mascota => :poseemasc);end;';
        $stid = oci_parse($conn,$scriptU);
         oci_bind_by_name($stid,':poseemasc',$person_poseemascotas);
         oci_bind_by_name($stid,':id_p',$id_pers);
        oci_execute($stid);
        
        $person_gmasc=$_POST['in_gmascotas'];
        $scriptU='begin updatePesoPersona(idPersona => :id_p,gustaMascota => :gmasc);end;';
        $stid = oci_parse($conn,$scriptU);
         oci_bind_by_name($stid,':gmasc',$person_gmasc);
         oci_bind_by_name($stid,':id_p',$id_pers);
        oci_execute($stid);

        header("location: perfil.html");
    
    }
    
}
?>
