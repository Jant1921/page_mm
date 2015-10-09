<?php
	if (isset($_POST['btn_crear'])) {
		if (empty($_POST['nombre_evento']) || empty($_POST['fecha_evento'])
				||empty($_POST['hora_evento'])||empty($_POST['pais_evento'])||
				empty($_POST['ciudad_evento'])||empty($_POST['descripcion_evento'])
				||empty($_POST['asunto_correo'])||empty($_POST['cuerpo_correo'])				
				) {
					$error = "Ningun campo puede estar vacío.";
					echo $error;
					
				}
		else{
			$nombre_evento = $_POST['nombre_evento'];
			$fecha_evento = $_POST['fecha_evento'];
			$hora_evento = $_POST['hora_evento'];
			$pais_evento = $_POST['hora_evento'];
			$ciudad_evento = $_POST['ciudad_evento'];
			$descripcion_evento = $_POST['descripcion_evento'];
			$asunto_evento = $_POST['asunto_correo'];
			$cuerpo_evento = $_POST['cuerpo_correo'];
			$conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
			if (!$conn) {
				$error = "No se pudo conectar con la base de datos";
			} else {
				$script_insert='begin
  					insertar_evento(nombre => :nombre,
                  lugar => :lugar,
                  hora => :hora,
                  fecha => :fecha,
                  descrip => :descrip);
					commit;
				end;';
			
				$stid = oci_parse($conn,$script_insert);
				oci_bind_by_name($stid,':nombre',$nombre_evento);
				oci_bind_by_name($stid,':lugar',$ciudad_evento);
				oci_bind_by_name($stid,':hora',$hora_evento);
				oci_bind_by_name($stid,':fecha',$fecha_evento);
				oci_bind_by_name($stid,':descrip',$descripcion_evento);
				oci_execute($stid);
				
				
				$message = wordwrap($cuerpo_evento, 70, "\r\n");
				
				// Send
				mail('jruizj6@gmail.com', $asunto_evento, $message);
				
				
				oci_close($conn);
				header("location: pagcrearevento.html");
			}
			
			
		}
		
	}
	

?>
	
	