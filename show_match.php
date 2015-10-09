<?php

function show_nombre($id){
	$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
	$stid = oci_parse($conn, "begin :result:=nombre_completo(:codigo);end;");
    oci_bind_by_name($stid,":result",$resul,62);
    oci_bind_by_name($stid,":codigo",$id);
    oci_execute($stid);
    oci_close($conn);
	return $resul;
}

function show_datos($id){
	$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
	$stid = oci_parse($conn, "begin :result:=datos_persona(:codigo);end;");
	oci_bind_by_name($stid,":result",$resul,100);
	oci_bind_by_name($stid,":codigo",$id);
	oci_execute($stid);
	oci_close($conn);
	return $resul;
}

$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
if (isset($_POST['btn_anterior'])){
	$person_suger=$_SESSION['personas'];
	$cantidad=$_SESSION['cantidad_personas'];
	$posicion=$_SESSION['offset'];
	$posicion=$posicion-6;
	$_SESSION['offset']=$posicion;
}elseif (isset($_POST['btn_sig'])) {
	$person_suger=$_SESSION['personas'];
	$cantidad=$_SESSION['cantidad_personas'];
	$posicion=$_SESSION['offset'];
	$posicion=$posicion+6;
	$_SESSION['offset']=$posicion;
}else{
	$stid = oci_parse($conn, "begin busqueda(:usuario);end;");
    oci_bind_by_name($stid,":usuario",$id_pers);
	oci_execute($stid);
	
	$person_suger=array();
	$curs = oci_new_cursor($conn);
	$stid = oci_parse($conn, "begin get_personas_sugeridas(:usuario,:cursor); end;");
	oci_bind_by_name($stid, ":cursor", $curs, -1, OCI_B_CURSOR);
	oci_bind_by_name($stid,":usuario",$id_pers);
	oci_execute($stid);
	oci_execute($curs);
	while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		$person_suger[] = $row['SUGERENCIA_PERSONA_SUGERIDA'];
	}
	
	
	$cantidad=count($person_suger);
	$posicion=0; //se le suma 6 cada vez que se pasa de página, cuando está en 0 significa que es la pagina 1
	
	$_SESSION['personas']=$person_suger;
	$_SESSION['cantidad_personas']=$cantidad;
	$_SESSION['offset']=$posicion;
	}
	oci_close($conn);
?>