<?php
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
if (!$conn) {
	$error = "No se pudo conectar con la base de datos";
} else {
	$stid = oci_parse($conn,'select FRECEJERCICIO_ID,FRECEJERCICIO_FRECUENCIA from FRECEJERCICIO');
    oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
               echo "<option value=".$row['FRECEJERCICIO_ID'].">".$row['FRECEJERCICIO_FRECUENCIA']."</option>";
            }
	oci_close($conn);
}
?>
