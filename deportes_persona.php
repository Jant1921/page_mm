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
        $st = oci_parse($conn, 'begin :resultado := selectNombreDeporte(:per_id);end;');
        oci_bind_by_name($st,':per_id',$id_pers);
        oci_execute($st);
        
    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
               echo "<option value=".$row['RANGOSALARIO_ID'].">".$row['RANGOSALARIO_RANGO']."</option>";
            }
	oci_close($conn);
}
?>