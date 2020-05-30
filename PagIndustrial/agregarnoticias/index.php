<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />
	<title>Sistema de noticias</title>
	
	<link href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	
</head>
<body>
	
	<section class="container login-form">
		<form method="post" action="" role="login">
			<section>
				<h4 class="text-center">Sistema de noticias</h4>
				
		
				<div class="form-group">
	   				<input type="text" name="user" placeholder="Nombre de usuario" required class="form-control input-lg" />
				</div>
				<div class="form-group">
	   				<input type="password" name="password" placeholder="Contraseña" required class="form-control input-lg" />
				</div>
				
				<!--<a href="#">¿Olvidaste tu contraseña?</a>-->
				<br>
				
				<button type="submit" name="submit" class="btn btn-lg btn-block btn-success">Iniciar Sesión</button>
			</section>
		</form>

		</section>
	</section>
	

</body>
</html>
<?php
//incluidos la clase de conxion

include "../conexion.php";

 $errorLogin=false;
header("Content-Type: text/html;charset=utf-8");
mysqli_set_charset($conn, 'utf8');
mysqli_query($conn, "SET NAMES 'utf8'");
if (mysqli_connect_errno())
  {
  echo "Error de conexion: " . mysqli_connect_error();
  } 

if (isset($_POST['submit'])) 
{
   $sql1= "select * from usuariosnoticias where username= '".$_POST['user']."' &&  password ='".$_POST['password']."'";
 
   $result=mysqli_query($conn, $sql1)
      or exit("Sql Error".mysqli_error($result));
       
    $row = mysqli_fetch_array($result);
   
  if ($row["username"] == $_POST['user'] && $row['password']== $_POST['password']) {
      //se crea session
      session_start();  
      $_SESSION['usuario']=$row['username'];
     
 	  header("Location:agregarnoticias.php");

  }
  else {

      echo'<script type="text/javascript">
                alert("Usuario o Contraseña Incorrecta");
                </script>';
  }
  mysqli_close($conn);
    }
?>