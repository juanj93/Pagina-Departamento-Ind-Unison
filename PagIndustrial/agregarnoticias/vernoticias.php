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
<head>
	<title>Ver noticias</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato:300,400">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
  <script type="text/javascript">
  function setUpdateAction() {
  document.formnoticias.action = "editar.php";
  document.formnoticias.submit();
  }

  </script>
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
        <li><a href="agregarnoticias.php">Agregar Noticia</a></li>
        <li><a href="vernoticias.php">Ver noticias</a></li>
        <li><a href="cerrarsesion.php">Cerrar Sesión</a></li>
      </ul>
    </div>
  </div>
</nav>
	<div class="container">
    <div class="form-group">
    </div>
		<form method="post" name="formnoticias">
    <table class="table table-hover table-bordered table-striped">
       <thead>
      <tr>
        <th>Titulo</th>
        <th>Imagen</th>
        <th>Contenido</th>
        <th>Fecha</th>
        <th>
      </th>
      </tr>
    </thead>
    <tbody>
          <?php

            include "../conexion.php";
            header("Content-Type: text/html;charset=utf-8");
            mysqli_query($conn, "SET NAMES 'utf8'");

            $registros=10;
             @$pagina = $_GET ['pagina'];

            if (!isset($pagina)){ 
                $pagina = 1;
                $inicio = 0;
            }else{
            $inicio = ($pagina-1) * $registros;
            } 
            $result ="SELECT id_noticias, imagen, titulo, DATE_FORMAT(fecha, '%d-%b-%Y') as fechanoticia, SUBSTRING(contenido, 1,200) as contenidoc FROM noticias ORDER BY fecha desc limit ".$inicio." , ".$registros."";
            $cad = mysqli_query($conn,$result) or die ( 'error al listar, $pegar' .mysqli_error($conn)); 
           
            //calculamos las paginas a mostrar
 
$contar = "SELECT * FROM noticias";
$contarok = mysqli_query($conn, $contar);
$total_registros = mysqli_num_rows($contarok);
//$total_paginas = ($total_registros / $registros);
$total_paginas = ceil($total_registros / $registros); 

      $i=0;
  
    while($row = mysqli_fetch_array($cad)) {
      $ruta = "imagenes/" . $row['imagen'];
      if($i%2==0)
        $classname="evenRow";
          else
        $classname="oddRow";
        ?>
        
        <tr class="<?php if(isset($classname)) echo $classname;?>"> 
          
         <td><?php echo $row['titulo']?></td> 
         <td><img  style="width:50px" src="<?php echo $ruta; ?>"></td> 
         <td><?php echo $row['contenidoc']?>...</td>
         <td><?php echo $row['fechanoticia']?></td>
         <td>
         <input type="submit" class="btn btn-primary" id="btneditar" name="update" value="Editar" onclick="javascript: form.action='editarnoticia.php?id=<?php echo $row['id_noticias']; ?>';">
         <input type="submit" class="btn btn-danger" id="btneliminar" name="eliminar" value="Eliminar" onclick="javascript: form.action='eliminar2.php?id=<?php echo $row['id_noticias']; ?>';" >
         </td> 
         </td> 
         </tr>
          <?php 
    
    $i++;  
        }
       

?> 
     
         
     </tbody>

    </table>
</form> 
<?php 

 echo "<center><p>";

if($total_registros>$registros){
if(($pagina - 1) > 0) {
echo "<span class='pactiva' ><a href='?pagina=".($pagina-1)."' style='color:blue'>&laquo; Anterior</a></span> ";
}
// Numero de paginas a mostrar
$num_paginas=10;
//limitando las paginas mostradas
$pagina_intervalo=ceil($num_paginas/2)-1;

// Calculamos desde que numero de pagina se mostrara
$pagina_desde=$pagina-$pagina_intervalo;
$pagina_hasta=$pagina+$pagina_intervalo;

// Verificar que pagina_desde sea negativo
if($pagina_desde<1){ // le sumamos la cantidad sobrante para mantener el numero de enlaces mostrados $pagina_hasta-=($pagina_desde-1); $pagina_desde=1; } // Verificar que pagina_hasta no sea mayor que paginas_totales if($pagina_hasta>$total_paginas){
$pagina_desde-=($pagina_hasta-$total_paginas);
$pagina_hasta=$total_paginas;
if($pagina_desde<1){
$pagina_desde=1;
}
}

for ($i=$pagina_desde; $i<=$pagina_hasta; $i++){
if ($pagina == $i){
echo "<span class='pnumero' style='color:black' >".$pagina."</span> ";
}else{
echo "<span class='active' ><a style='color:blue' href='?pagina=$i'>$i</a></span> ";
}
}

if(($pagina + 1)<=$total_paginas) {
echo " <span class='pactiva'><a style='color:blue' href='?pagina=".($pagina+1)."'>Siguiente &raquo;</a></span>";
}
}

echo "</p></center>";

 ?>
	</div>

</body>
</html>
