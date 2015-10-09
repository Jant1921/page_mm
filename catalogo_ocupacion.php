<?php
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
if (!$conn) {
	$error = "No se pudo conectar con la base de datos";
} else {
	$stid = oci_parse($conn,'select PROFESION_ID,PROFESION_NOMBRE from PROFESION');
    oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
               echo "<option value=".$row['PROFESION_ID'].">".$row['PROFESION_NOMBRE']."</option>";
            }
	oci_close($conn);
}
?>


