<?php 
 include "header.php";

if($_SESSION['tipo']!='administrador') 
{
  header('Location:index.php'); 
  exit();
}


$emailAEnviar = $_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM usuarios_industrial WHERE user_id=".$_GET['id']);

while ($row=mysqli_fetch_array($result)) {
		$emailUsuarioReporte=$row['email'];
		$nombreUsuarioReporte=$row['name'];
	}
?>

<form class="form-horizontal" method="POST">
<fieldset>


<legend>Enviar correo a <?php echo $nombreUsuarioReporte; ?></legend>

<!-- asunto-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtAsunto">Asunto:</label>  
  <div class="col-md-4">
  <input id="txtAsunto" name="txtAsunto" class="form-control input-md" type="text" required>
  </div>
</div>

<!-- mensaje-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtMensaje">Mensaje:</label>  
  <div class="col-md-4">
  	<textarea id="txtMensaje" name="txtMensaje"  class="form-control input-md" rows="5" required></textarea>
  </div>
</div>

<!-- Botones -->
<div class="form-group">
  <label class="col-md-4 control-label" for="button1id"></label>
  <div class="col-md-8">
    <button id="btnCancelar" name="btnCancelar" class="btn btn-danger" onclick="window.location='index.php';">Cancelar</button>
    <button id="btnEnviar" name="btnEnviar" class="btn btn-success">Enviar</button>
  </div>
</div>

</fieldset>
</form>
<?php

if (isset($_POST['btnEnviar'])) {
	$asunto=$_POST['txtAsunto'];
	$mensaje=$_POST['txtMensaje'];
	$headers="Sistema de Reportes del Departamento de Ingeniería Industrial";

	if (@mail($emailUsuarioReporte,$asunto,$mensaje,$headers)) {
		  echo'<script type="text/javascript">
                alert("Su correo ha sido enviado.");
                window.location="index.php";
                </script>';  

                
	}else{
		  echo'<script type="text/javascript">
                alert("Ocurrió un error al enviar el correo, intente de nuevo.");
                window.location="index.php";
                </script>';
           
	}
}
 include "footer.php";

 ?>