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
<?php include "header.php";
	include "../conexion.php";
	header("Content-Type: text/html;charset=utf-8");
	mysqli_query($conn, "SET NAMES 'utf8'");

	$id = $_GET['id'];
	//consulta noticia con id
	$result= mysqli_query($conn, "SELECT * FROM noticias WHERE id_noticias =".$_GET['id']);
	while ($row = mysqli_fetch_array($result)) {
	$ruta = "imagenes/" . $row['imagen'];//tomamos la ruta de la imagen de la noticia
	
 ?>
 <h3 class="text-center" style="color:blue">Actualizar noticia</h3>
	<div class="container">
		<!-- Formulario -->

		<form enctype="multipart/form-data"  method="post" name="agregarnoticia" class="form-horizontal">
			<!--Titulo-->

			<div class="form-group">
				<label class="col-md-3 control-label">Titulo:</label>
				<div class="col-md-5">
					<input type="text" class="form-control input-md" id="txttitulo" name="titulo" placeholder="Escriba título" maxlength="200" required="" value="<?php echo $row['titulo'] ?>">
				</div>
			<!--Imagen-->
			</div>
			<div class="form-group">
				<label for="imagen" class="col-md-3 control-label">Imagen:</label>
				<div class="col-md-5">
					<img class="img-responsive" width="100px" src="<?php echo $ruta; ?>">
					<input type="hidden" name="imagenanterior" value="<?php echo $ruta; ?>">
					<input type="file" name="imagen" id="imagen" class="input-file" >
				</div>
			</div>
			<!--Contenido-->
			<div class="form-group">
				<label class="col-md-3 control-label" for="contenido">Contenido:</label>
				<div class="col-md-6">
					<textarea name="contenido" id="contenido" class="form-control" rows="20"  required="" maxlength="8000" ><?php echo $row['contenido']; ?></textarea>
				</div>
			</div>
			<!--Boton de agregar-->
			<div class="form-group">
				<label class="col-md-3 control-label"></label>
				<div class="col-md-5">
					<button type="submit" name="actualizar" value="subir" class="btn btn-primary">Actualizar noticia</button>
				</div> 	
			</div>

		</form>

	</div>
	
	<?php } 
		include "../conexion.php";
	header("Content-Type: text/html;charset=utf-8");
	mysqli_query($conn, "SET NAMES 'utf8'");
		if (isset($_POST['actualizar'])) {
			$ruta = "imagenes/" . $_FILES['imagen']['name'];
		//comprobamos si este archivo existe para no volverlo a copiar.
		if (!file_exists($ruta) || $_FILES['imagen']['name']==$row['imagen']) {
			//aqui movemos el archivo desde la ruta temporal a nuestra ruta
			//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
			//almacenara true o false				
				if ($_FILES['imagen']['name']!="") {//SI EMODIFICA IMAGEN
					$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
					if ($resultado) {
						$nombre = $_FILES['imagen']['name'];
						unlink($_POST['imagenanterior']);
						@mysqli_query($conn, "UPDATE noticias set titulo='" . $_POST["titulo"]. "', contenido='" . $_POST["contenido"]. "', imagen='" . $nombre. "' WHERE id_noticias='" . $id. "'");
						
                		echo "<p class='text-center'>Se ha actualizado la noticia exitosamente.<p>";
                		 echo'<script type="text/javascript">
                			window.location.href="vernoticias.php";
               				 </script>';

					}else{
						echo "Ocurrió un error al subir la imagen.";
					}
                //echo "<p class='text-center'><a href='agregarnoticias.php'>Atrás.</a></p>";
				}else{//sI NO SE MODIFICA IMAGEN
					$r=@mysqli_query($conn, "UPDATE noticias set titulo='" . $_POST["titulo"]. "', contenido='" . $_POST["contenido"]. "' WHERE id_noticias='" . $id. "'");
									}
					 echo'<script type="text/javascript">
                			window.location.href="vernoticias.php";
               				 </script>';
				
		} else {
				
			 	echo  " <p class='text-center'>".$_FILES['imagen']['name'] . " este archivo existe. </p>";
               // echo "<p class='text-center'><a href='agregarnoticias.php'>Atrás.</a></p>";
		}
	}

	?>
</body>
</html>