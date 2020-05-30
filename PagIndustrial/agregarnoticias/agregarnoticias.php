<?php 
//creamos la sesion
session_start();
if(!isset($_SESSION['usuario'])) 
{
  header('Location:index.php'); 
  exit();
}
 ?>
<!DOCTYPE HTML>
<html>
<?php include "header.php"; ?>

	<div class="container">
		<!-- Formulario -->
		<form enctype="multipart/form-data" action="subir.php" method="post" name="agregarnoticia" class="form-horizontal">
			<!--Titulo-->
			<div class="form-group">
				<label class="col-md-3 control-label">Titulo:</label>
				<div class="col-md-5">
					<input type="text" class="form-control input-md" id="txttitulo" name="titulo" placeholder="Escriba título" maxlength="200" required="">
				</div>
			<!--Imagen-->
			</div>
			<div class="form-group">
				<label for="imagen" class="col-md-3 control-label">Imagen:</label>
				<div class="col-md-5">
					<input type="file" name="imagen" id="imagen" class="input-file"  required="">
				</div>
			</div>
			<!--Contenido-->
			<div class="form-group">
				<label class="col-md-3 control-label" for="contenido">Contenido:</label>
				<div class="col-md-6">
					<textarea name="contenido" id="contenido" class="form-control" rows="20"  required="" maxlength="8000" ></textarea>
				</div>
			</div>
			<!--Boton de agregar-->
			<div class="form-group">
				<label class="col-md-3 control-label"></label>
				<div class="col-md-5">
					<button type="submit" name="subir" value="subir" class="btn btn-primary">Añadir noticia</button>
				</div> 	
			</div>

		</form>

	</div>

</body>
</html>