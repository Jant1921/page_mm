<?php
include('sesion.php');

$error=''; // Variable To Store Error Message... el mensaje de error
if (isset($_POST['btn_guarda_df'])) {   // si el boton es presionado que verifique si cada uno de esos campos son  diferente de vacios
    
        $conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB'); //crea la conexion 
    if (!$conn) {
        $error = "No se pudo conectar con la base de datos";  //si no se pudo dar la conexion, error!
    } else {
        
        $Persona_id=$_SESSION['signed_id'];
        
        $person_contextura=$_POST['in_contextura'];
        $scriptU='begin update_persona_contextura(person_id => :id_p,contex_id => :cont_id);end;';
        $stid = oci_parse($conn,$scriptU);
        oci_bind_by_name($stid,':id_p',$id_pers);
         oci_bind_by_name($stid,':cont_id',$person_contextura);
        oci_execute($stid);
        
        $person_cabello=$_POST['in_cabello'];
        $scriptU='begin ACTUALIZAR_COLOR_PELO(:id_color,:id_p);end;';
        $stid = oci_parse($conn,$scriptU);
        oci_bind_by_name($stid,':id_color',$person_cabello);
        oci_bind_by_name($stid,':id_p',$id_pers);
        oci_execute($stid);
        
        $person_piel=$_POST['in_piel'];
        $scriptU='begin Actualizar_Color_PIEL(:id_color,:id_p);end;';
        $stid = oci_parse($conn,$scriptU);
        oci_bind_by_name($stid,':id_color',$person_piel);
        oci_bind_by_name($stid,':id_p',$id_pers);
        oci_execute($stid);
        
        $person_ojos=$_POST['in_ojos'];
        $scriptU='begin Actualizar_Color_Ojos(:id_color,:id_p);end;';
        $stid = oci_parse($conn,$scriptU);
        oci_bind_by_name($stid,':id_color',$person_ojos);
        oci_bind_by_name($stid,':id_p',$id_pers);
        oci_execute($stid);
        
        
        $person_frecejer=$_POST['in_frecejer'];
        $scriptU='begin Actualizar_FREC_EJERCICIO(NFRECEJER => :fejer,IDPERSONA => :id_p);end;';
        $stid = oci_parse($conn,$scriptU);
         oci_bind_by_name($stid,':fejer',$person_frecejer);
         oci_bind_by_name($stid,':id_p',$id_pers);
        oci_execute($stid);
        
        $person_fumador=$_POST['in_fumador'];
        $scriptU='begin Actualizar_Fumar(NFumado => :fuma,IDPERSONA => :id_p);end;';
        $stid = oci_parse($conn,$scriptU);
         oci_bind_by_name($stid,':fuma',$person_fumador);
         oci_bind_by_name($stid,':id_p',$id_pers);
        oci_execute($stid);
        
        $person_bebedor=$_POST['in_bebedor'];
        $scriptU='begin Actualizar_Bebedor(NBebedor => :bebedor,IDPERSONA => :id_p);end;';
        $stid = oci_parse($conn,$scriptU);
         oci_bind_by_name($stid,':bebedor',$person_bebedor);
         oci_bind_by_name($stid,':id_p',$id_pers);
        oci_execute($stid);
        
        $person_altura=$_POST['in_altura'];
        $scriptU='begin update_persona_altura(person_id => :id_p,altura => :alto);end;';
        $stid = oci_parse($conn,$scriptU);
         oci_bind_by_name($stid,':alto',$person_altura);
         oci_bind_by_name($stid,':id_p',$id_pers);
        oci_execute($stid);
        
        $person_peso=$_POST['in_peso'];
        $scriptU='begin updatePesoPersona(idPersona => :id_p,nPeso => :peso);commit;end;';
        $stid = oci_parse($conn,$scriptU);
         oci_bind_by_name($stid,':peso',$person_peso);
         oci_bind_by_name($stid,':id_p',$id_pers);
        oci_execute($stid);

        header("location: pagintereseshobbies.html");
    
    }
    }
?>
