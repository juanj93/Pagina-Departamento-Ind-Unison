<?php 
  include "conexion.php";

function generarLinkTemporal($user_id, $userName){
   // Se genera una cadena para validar el cambio de contraseña
   $cadena = $user_id.$userName.rand(1,9999999).date('Y-m-d');
   $token = sha1($cadena);
 
  include "conexion.php";
   // Se inserta el registro en la tabla
   $sql = "INSERT INTO reseteopass   (user_id, userName, token, creado) VALUES($user_id,'$userName','$token',NOW());";
   $resultado = $conn->query($sql);
   if($resultado){
      // Se devuelve el link que se enviara al usuario
      $enlace = $_SERVER["SERVER_NAME"].'/pass/restablecer.php?idusuario='.sha1($user_id).'&token='.$token;
      return $enlace;
   }
   else
      return FALSE;
}
 
function enviarEmail( $email, $link ){
   $mensaje = '<html>
     <head>
        <title>Restablece tu contraseña</title>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
         <link rel="stylesheet" href="css/style.css">
         <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css">
         <script src="http://code.jquery.com/jquery-latest.js"></script>
         <script src="js/menu.js"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
         <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
     </head>
     <body>
       <p>Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>
       <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
       <p>
         <strong>Enlace para restablecer tu contraseña</strong><br>
         <a href="'.$link.'"> Restablecer contraseña </a>
       </p>
     </body>
    </html>';
 
   $cabeceras = 'MIME-Version: 1.0' . "\r\n";
   $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $cabeceras .= 'From: Sistema de reportes Ingeniería Industrial' . "\r\n";
    //Se envia el correo al usuario
   mail($email, "Recuperar contraseña", $mensaje, $cabeceras);
}

$email = $_POST['email'];
 
$respuesta = new stdClass();
 
if( $email != "" ){
  
   $sql = " SELECT * FROM usuarios_industrial WHERE email = '$email' ";
   $resultado = $conn->query($sql);
   if($resultado->num_rows > 0){
      $usuario = $resultado->fetch_assoc();
      $linkTemporal = generarLinkTemporal( $usuario['user_id'], $usuario['userName'] );
      if($linkTemporal){
        enviarEmail( $email, $linkTemporal );
        $respuesta->mensaje = '<div class="alert alert-info"> Un correo ha sido enviado a su cuenta de email con las instrucciones para restablecer la contraseña </div>';
      }
   }
   else
      $respuesta->mensaje = '<div class="alert alert-warning"> No existe una cuenta asociada a ese correo. </div>';
}
else
   $respuesta->mensaje= "Debes introducir el email de la cuenta";
 echo json_encode( $respuesta );
 ?>