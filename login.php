<?php

//Basado en codigo visto en: http://www.formget.com/login-form-in-php/ 

session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['boton_login'])) {
    if (empty($_POST['campo_nombre']) || empty($_POST['campo_pass'])) {
    $error = "Campo de Nombre de usuario o Contraseña vacío";
    echo $error;
    }
    else
    {
    $usuario = $_POST['campo_nombre'];
    $clave   = $_POST['campo_pass'];
    
    $conn = oci_connect('mmAdmin','mmAdmin', '//localhost/MATCHMEDB');
    if (!$conn) {
        $error = "No se pudo conectar con la base de datos";
    } else {
        $stid = oci_parse($conn,'select usuario_user from usuario where usuario_user '
                . '= :nom_user and usuario_senha = :user_pass');
        oci_bind_by_name($stid,':nom_user',$usuario);
        oci_bind_by_name($stid,':user_pass',$clave);
        
        oci_execute($stid);
        while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
                $user_name = $row['USUARIO_USER'];
        }
        if (empty($user_name)) {
            $error="Por favor verifique su Usuario o Contraseña";
            echo $error;
        }else{
            $stid = oci_parse($conn,'select persona_nombre from persona where persona_user '
                . '= :nom_user');
            oci_bind_by_name($stid,':nom_user',$user_name);
            oci_execute($stid);
            while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
                $person_nombre = $row['PERSONA_NOMBRE'];
            }
            
            $_SESSION['signed_nombre']=$person_nombre; // Initializing Session
            header("location: pag_inicio.html"); // Redirecting To Other Page
            
        }
        

        
        oci_close($conn);
        }
    }
}
?>
