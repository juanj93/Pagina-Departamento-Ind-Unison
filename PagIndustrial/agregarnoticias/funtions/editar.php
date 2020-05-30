<?php 

//creamos la sesion
session_start();

if(!isset($_SESSION['usuario'])) 
{
  header('Location:index.php'); 
  exit();
  
}

include "../conexion.php";

//parte para actualizar
if(isset($_POST["submit"]) && $_POST["submit"]!="") {
$usersCount = count($_POST["titulo"]);
for($i=0;$i<$usersCount;$i++) {
mysqli_query($conn,"UPDATE noticias set titulo='" . $_POST["titulo"][$i] . "', contenido='" . $_POST["contenido"][$i] . "', imagen='" . $_POST["ruta"][$i]. "' WHERE id_noticias='" . $_POST["id_noticias"]. "'");
}
header("Location:vernoticias.php");
} 

?>
<html>

  <head>
  <title>Noticias Depatarmento Industrial</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato:300,400">
 <script type="text/javascript"  language="javascript"  src="assets/js/modificar.js"></script>
  <link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>

  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="nav navbar-nav"> 
        <li class=""><a href="agregarnoticias.php">Agregar Noticia</a></li>
        <li><a href="vernoticias.php">Ver noticias</a></li>
        <li><a href="cerrarsesion.php">Cerrar Sesión</a></li>
      </ul>
    </div>
  </div>
</nav>

<form name="formnoticias" method="post" action="" enctype="multipart/form-data">

<div class="container">

<h1>Modificacion de noticias</h1>

<table class="table table-hover table-bordered table-striped"  align="center">
<tr>
<td><h4>Datos de las noticias</h4></td>
</tr>

<?php
include "../conexion.php";
$rowCount = count($_POST["noticias"]);
header("Content-Type: text/html;charset=utf-8");
mysqli_query($conn, "SET NAMES 'utf8'");
for($i=0;$i<$rowCount;$i++) {
$result = mysqli_query($conn,"SELECT * FROM noticias WHERE id_noticias='" . $_POST["noticias"][$i] . "'");
$row[$i]= mysqli_fetch_array($result);
?>
<tr>
<td>
<table class="table table-striped">
<tr>
<td><label>Titulo</label></td>
<td><input type="text" name="titulo[]" required="" class="txtField" value="<?php echo $row[$i]['titulo']; ?>">
<input type="hidden" name="id_noticias[]" class="txtField" value="<?php echo $row[$i]['id_noticias']; ?>"></td>
<td></td>
</tr>
<tr>
<td><label>Imagen</label></td>
<td><img width="100px" src="<?php echo "imagenes/".$row[$i]['imagen']; ?>" id="upfile1" style="cursor:pointer" /></td>
<td><input type="file" name="imagen[]" id="imagen" class="input-file" ></td>

</tr>
<tr></tr>
<tr>
<td><label>Contenido</label></td>
<td><textarea type="text" name="contenido[]" rows="5" cols="90" class="txtField" required=""><?php echo $row[$i]['contenido']; ?></textarea></td>
</tr>
<tr>
<td></td></tr>
</table>
</td>
</tr>

<?php
}
?>
<td colspan="2"><input type="submit" name="submit" value="Actualizar" class="btn btn-primary"></td>

</table>
</div>
</form>
</div>
</body>
</html>