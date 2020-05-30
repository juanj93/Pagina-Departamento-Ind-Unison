<!DOCTYPE html>
<html>
		
	<?php 
include "header.php";
include "conexion.php";
header("Content-Type: text/html;charset=utf-8");
mysqli_query($conn, "SET NAMES 'utf8'");
	$id = $_GET['id'];
//consulta noticia con id
	$result= mysqli_query($conn, "SELECT *, DATE_FORMAT(fecha, '%d-%b-%Y') as fechanoticia FROM noticias WHERE id_noticias =".$_GET['id']);
while ($row = mysqli_fetch_array($result)) {
	$ruta = "agregarnoticias/imagenes/" . $row['imagen'];//tomamos la ruta de la imagen de la noticia
?>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h2 class="text-center"><?php echo $row['titulo']; ?></h2>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<img class="img-responsive" src="<?php echo $ruta; ?>">
		</div>
	</div>

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<p class="text-justify"><?php echo nl2br($row['contenido']);?></p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<small class="pull-right">Publicado el: <?php echo $row['fechanoticia'];?></small>
		</div>
	</div>
<?php 

}

 ?>


 
 <br>
 	<?php 
  include "footer.php"; ?>
</div>
</body>
</html>