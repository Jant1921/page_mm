<?php
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
if (!$conn) {
	$error = "No se pudo conectar con la base de datos";
} else {
        $min = $_POST['x'];
        $max = $_POST['y'];
	$scriptU='begin get_personas_rangoedad(:emin,emax);end;';//se puede hacer pegado, ver login
            $stid = oci_parse($conn,$scriptU);
            oci_bind_by_name($stid,':emax',$max);
            oci_bind_by_name($stid,':emin',$min);
             oci_execute($stid); //es csomo F8 ejecutar//para ejecutar el script
             echo "$stid";
            }
	oci_close($conn);
      
?>

