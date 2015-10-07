<?php
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
if (!$conn) {
	$error = "No se pudo conectar con la base de datos";
} else {
	$stid = oci_parse($conn,'contextura_id,contextura_descripcion from contextura');
    oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
               echo "<option value=".$row['CONTEXTURA_ID'].">".$row['CONTEXTURA_DESCRIPCION']."</option>";
            }
	oci_close($conn);
}
?>