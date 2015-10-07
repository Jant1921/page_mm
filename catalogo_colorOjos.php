<?php
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
if (!$conn) {
	$error = "No se pudo conectar con la base de datos";
} else {
	$stid = oci_parse($conn,'colorojos_id,colorojos_nombre from colorojos');
    oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
               echo "<option value=".$row['COLOROJOS_ID'].">".$row['COLOROJOS_NOMBRE']."</option>";
            }
	oci_close($conn);
}
?>