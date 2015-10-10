<?php
include('sesion.php');
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
        $min = $_POST['edmin'];
        $max = $_POST['edmax'];
		$scriptU='begin
  :result := get_personas_rangoedad(min => :min,
                                    max => :max);
end;';//se puede hacer pegado, ver login
            $stid = oci_parse($conn,$scriptU);
            oci_bind_by_name($stid,':result',$cantidad,3);
            oci_bind_by_name($stid,':max',$max);
            oci_bind_by_name($stid,':min',$min);
            oci_execute($stid); //es csomo F8 ejecutar//para ejecutar el script
             $_SESSION['cant_rango'] = 'jasodjsadisaod';
             $_SESSION['cant_rango'] = $cantidad;
             echo $cantidad;
             echo 'sirve?';
             echo $max;
             echo $min;
             header("location: estadisticas.html");
	oci_close($conn);
      
?>

