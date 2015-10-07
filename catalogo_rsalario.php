<?php
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
if (!$conn) {
	$error = "No se pudo conectar con la base de datos";
} else {
	$stid = oci_parse($conn,'select rangosalario_id,rangosalario_rango from rangosalario');
    oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
               echo "<option value=".$row['RANGOSALARIO_ID'].">".$row['RANGOSALARIO_RANGO']."</option>";
            }
	oci_close($conn);
}
?>