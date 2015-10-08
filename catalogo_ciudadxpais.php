<?php
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
if (!$conn) {
	$error = "No se pudo conectar con la base de datos";
} else {
	$stid = oci_parse($conn,'select ciudad_id,ciudad_nombre from ciudad where ciudad_pais=:spais');
        oci_bind_by_name($stid,':spais',$_POST['in_pais']);
        oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
               echo "<option value=".$row['CIUDAD_ID'].">".$row['CIUDAD_NOMBRE']."</option>";
            }
	oci_close($conn);
}
?>