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

<?php
//conexion a la base de datos
 	include "../conexion.php";
 	include "header.php";
    
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    }
mysqli_set_charset($conn, 'utf8');
//comprobamos si ha ocurrido un error.
if ($_FILES["imagen"]["error"] > 0){
	echo "ha ocurrido un error";
} else {
	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
	//y que el tamano del archivo no exceda los 7000kb
	$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	$limite_kb = 10000;

	if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
		//esta es la ruta donde copiaremos la imagen
		$ruta = "imagenes/" . $_FILES['imagen']['name'];
		//comprobamos si este archivo existe para no volverlo a copiar.
		if (!file_exists($ruta)){
			//aqui movemos el archivo desde la ruta temporal a nuestra ruta
			//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
			//almacenara true o false
			$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
			if ($resultado){
				$nombre = $_FILES['imagen']['name'];
				$titulo= $_POST['titulo'];
				$contenido = $_POST['contenido'];
				//@mysqli_query($conn, "INSERT INTO imagenes (imagen) VALUES ('$nombre')") ;
				@mysqli_query($conn, "INSERT INTO noticias (imagen, titulo, contenido) VALUES ('$nombre', '$titulo', '$contenido')");

                echo "<p class='text-center'>Se ha agregado la noticia exitosamente.<p>";
                echo "<p class='text-center'><a href='agregarnoticias.php'>Atrás.</a></p>";
               
			} else {

				echo "Ocurrió un error al subir la imagen.";
				echo "<p class='text-center'><a href='agregarnoticias.php'>Atrás.</a></p>";

			}
		} else {

			 	echo  " <p class='text-center'>".$_FILES['imagen']['name'] . ",este archivo existe. </p>";
                echo "<p class='text-center'><a href='agregarnoticias.php'>Atrás.</a></p>";
		}
	} else {
			echo "<p class='text-center'>Archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes.</p>";
            echo "<p class='text-center'><a href='agregarnoticias.php'>Atrás.</a></p>"; 
		
	}
}

?>
</body>
</html>

