<?php
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
if (!$conn) {
	$error = "No se pudo conectar con la base de datos";
} else {
	$stid = oci_parse($conn,'select BEBEDOR_ID,BEBEDOR_TIPO from BEBEDOR');
    oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
               echo "<option value=".$row['BEBEDOR_ID'].">".$row['BEBEDOR_TIPO']."</option>";
            }
	oci_close($conn);
}
?>