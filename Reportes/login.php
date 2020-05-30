<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />
	<title>Reportes Departamento de Industrial</title>
	
	<link href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/styles.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
	<section class="container login-form">
		<form method="post"  role="login" >
			<section>
				<img src="img/logocsti.png" alt="Logo Csti" class="img-responsive" />
		    <h3 class="text-center">Sistema de reportes</h3>
				<div class="form-group">
	   				<input type="text" name="user" placeholder="Usuario" required class="form-control input-lg" />
				</div>
				<div class="form-group">
	   				<input type="password" name="password" placeholder="Contraseña" required class="form-control input-lg" />
				</div>
				<a class="btnResetearPass" data-toggle="modal" data-target="#resetearPass" data-keyboard="true">¿Olvidaste tu contraseña?</a>
				<!--<a href="#" data-toggle="modal" data-target="#resetearPass" data-keyboard="true" >¿Olvidaste tu contraseña?</a>-->
				
				<button type="submit" name="go" class="btn btn-lg btn-block btn-success" >Iniciar Sesión</button>
			</section>
		</form>

		</section>
	</section>
	

</body>
<footer>
<p class="pull-right" style="color:white">Desarrollado por CSTI 2015   </p>
</footer>
</html>
<?php
//incluidos la clase de conxion

include "conexion.php";

 $errorLogin=false;
header("Content-Type: text/html;charset=utf-8");
mysqli_set_charset($conn, 'utf8');
mysqli_query($conn, "SET NAMES 'utf8'");
if (mysqli_connect_errno())
  {
  echo "Error de conexion: " . mysqli_connect_error();
  } 

if (isset($_POST['go'])) 
{
   $sql1= "select * from usuarios_industrial where userName= '".$_POST['user']."' &&  password ='".$_POST['password']."'";
 
   $result=mysqli_query($conn, $sql1)
      or exit("Sql Error".mysqli_error($result));
       
    $row = mysqli_fetch_array($result);
    
  if ($row["tipo"] == 'usuario') {
      //se crea session
      session_start();  
      $_SESSION['id']=$row['id'];
      $_SESSION['nombre']=$row["name"];
      $_SESSION['tipo']=$row["tipo"]; 
      header("Location:index.php");

  }
  elseif ($row["tipo"] == 'administrador') {
      session_start();
      $_SESSION['nombre']=$row["name"];
       $_SESSION['id']=$row['id'];
      $_SESSION['tipo']=$row["tipo"]; 
      header("Location:index.php");
      

      }
  else {

      echo'<script type="text/javascript">
                alert("Usuario o Contraseña Incorrecta");
                </script>';
  }
  mysqli_close($conn);
    }
?>
<!-- Modal -->
  <div class="modal fade" id="resetearPass" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        	<h3 class="text-center" style="color:#819FF7"><link href='https://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet' type='text/css'>Reseteo de contraseña</h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding:10px 50px;">
          <form id="frmRestablecer" role="form-horizontal" action="validaremail.php" method="POST">

          	<!--email-->
            <div class="form-group">
              <label for="txtAsunto">Escribe el e-mail asociado a tu cuenta para recuperar tu contraseña:</label>
              <input type="email" class="form-control col-md-4" id="email" name="email" required>
            </div>
              <br>
              <br>

            <div class="form-group">
       		 <input type="submit" class="btn btn-primary " value="Recuperar contraseña" >
      		</div>
          
          </form>
          <div id="mensaje"></div>
        </div>
      </div>
      
    </div>

    <script>
  $(document).ready(function(){
    $("#frmRestablecer").submit(function(event){
      event.preventDefault();
      $.ajax({
        url:'validaremail.php',
        type:'post',
        dataType:'json',
        data:$("#frmRestablecer").serializeArray()
      }).done(function(respuesta){
        $("#mensaje").html(respuesta.mensaje);
        $("#email").val('');
      });
    });
  });
</script>

  </div> 
