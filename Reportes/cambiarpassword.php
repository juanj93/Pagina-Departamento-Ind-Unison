<?php
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$user_id = $_POST['user_id'];
$token = $_POST['token'];
 
if( $password1 != "" && $password2 != "" && $user_id != "" && $token != "" ){
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Restablecer contraseña </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
 
  <body>
    <div class="container" role="main">
      <div class="col-md-2"></div>
      <div class="col-md-8">
<?php
   include "conexion.php";
   $sql = " SELECT * FROM reseteopass WHERE token = '$token' ";
   $resultado = $conn->query($sql);
   if( $resultado->num_rows > 0 ){
      $usuario = $resultado->fetch_assoc();
      if( sha1( $usuario['user_id'] === $user_id ) ){
         if( $password1 === $password2 ){
            $sql = "UPDATE usuarios_industrial SET password = '".sha1($password1)."' WHERE id = ".$usuario['user_id'];
            $resultado = $conn->query($sql);
            if($resultado){
               $sql = "DELETE FROM reseteopass WHERE token = '$token';";
               $resultado = $conn->query( $sql );
?>
               <p class="alert alert-info"> La contraseña se actualizó con exito. </p>
<?php
            }
            else{
?>
              <p class="alert alert-danger"> Ocurrió un error al actualizar la contraseña, intentalo más tarde </p>
<?php
            }
         }
         else{
?>
           <p class="alert alert-danger"> Las contraseñas no coinciden </p>
<?php
         }
      }
      else{
?>
        <p class="alert alert-danger"> El token no es válido </p>
<?php
      }
   }
   else{
?>
      <p class="alert alert-danger"> El token no es válido </p>
<?php
   }
?>
</div>
<div class="col-md-2"></div>
</div> <!-- /container -->
<script src="js/jquery-1.11.1.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
}
else{
   header('Location:login.php');
}
?>