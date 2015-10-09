<?php
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
if (!$conn) {
	$error = "No se pudo conectar con la base de datos";
} else {
	$stid = oci_parse($conn,'select colorpelo_id,colorpelo_nombre from colorpelo');
    oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
               echo "<option value=".$row['COLORPELO_ID'].">".$row['COLORPELO_NOMBRE']."</option>";
            }
	oci_close($conn);
}
?>