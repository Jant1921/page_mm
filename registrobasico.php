<?php
include('sesion.php');
$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
$script='begin
  registro_basico(:usuario,:estado,:educacion,:ocupacion,:reli);
end;';
$stid = oci_parse($conn,$script);
oci_bind_by_name($stid,':usuario',$id_pers);
oci_bind_by_name($stid,':estado',$_POST['in_civil']);
oci_bind_by_name($stid,':educacion',$_POST['in_edu']);
oci_bind_by_name($stid,':ocupacion',$_POST['in_ocup']);
oci_bind_by_name($stid,':reli',$_POST['in_reli']);
oci_execute($stid);
header("location: pagregdatfisicos.html")
	
?>