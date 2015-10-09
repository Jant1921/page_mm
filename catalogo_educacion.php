<?php
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
if (!$conn) {
	$error = "No se pudo conectar con la base de datos";
} else {
	$stid = oci_parse($conn,'select EDUCACION_ID,EDUCACION_NIVEL from EDUCACION');
    oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
               echo "<option value=".$row['EDUCACION_ID'].">".$row['EDUCACION_NIVEL']."</option>";
            }
	oci_close($conn);
}
?>


