<?php
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
if (!$conn) {
	$error = "No se pudo conectar con la base de datos";
} else {
	$stid = oci_parse($conn,'select ESTADOCIVIL_ID,ESTADOCIVIL_NOMBRE from ESTADOCIVIL');
    oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
               echo "<option value=".$row['ESTADOCIVIL_ID'].">".$row['ESTADOCIVIL_NOMBRE']."</option>";
            }
	oci_close($conn);
}
?>


