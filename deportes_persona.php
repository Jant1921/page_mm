<?php
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
if (!$conn) {
	$error = "No se pudo conectar con la base de datos";
} else {
	$nombres="";
        $stid = oci_parse($conn,'select dxp_deporte from deportexpersona where dxp_persona=:id_persona');
        oci_bind_by_name($stid,':id_persona',$id_pers);
        oci_execute($stid);
        while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
        	$st = oci_parse($conn, 'select deporte_nombre from deporte where deporte_id =:dep_id');
        	oci_bind_by_name($st,':dep_id',$row['DXP_DEPORTE']);
        	oci_execute($st);
        	$row = oci_fetch_array($st, OCI_ASSOC);
        	$depor_nom=$row['DEPORTE_NOMBRE'];
        	echo "<option value=".$depor_nom.">".$depor_nom."</option>";
        }
  
	oci_close($conn);
}
?>