<!DOCTYPE html>
<html>

<?php 
	include "header.php";
 ?>
<!--Contenido de la pagina-->
    <h1>Noticias</h1>

<?php 
include "conexion.php";
header("Content-Type: text/html;charset=utf-8");
mysqli_query($conn, "SET NAMES 'utf8'");
	$registros=4;
	@$pagina = $_GET ['pagina'];

if (!isset($pagina))
{
$pagina = 1;
$inicio = 0;
}
else
{
$inicio = ($pagina-1) * $registros;
} 
	$result = "SELECT id_noticias, imagen, titulo, SUBSTRING(contenido, 1,500) as contenidoc FROM noticias ORDER BY fecha desc limit ".$inicio." , ".$registros." ";
	$cad = mysqli_query($conn,$result) or die ( 'error al listar, $pegar' .mysqli_error($conn)); 
	//calculamos las paginas a mostrar

$contar = "SELECT * FROM noticias";
$contarok = mysqli_query($conn, $contar);
$total_registros = mysqli_num_rows($contarok);
//$total_paginas = ($total_registros / $registros);
$total_paginas = ceil($total_registros / $registros); 


	while ($row = mysqli_fetch_array($cad)) {
		$ruta = "agregarnoticias/imagenes/" . $row['imagen'];
?>
	<div class="row noticias">
		<div class="col-md-12">
			<h3 class="text-center"><a href="noticia.php?id=<?php echo $row['id_noticias'];?>"><?php echo $row['titulo'];?></a></h3>
		</div>
		<div class="col-md-10 col-md-offset-1">
			<div class="col-md-4 alpha">
				<img class="img-responsive" src="<?php echo $ruta; ?>">
			</div>
			<div class="col-md-8">
				<div class="box">
					<p class="text-justify"><?php echo $row['contenidoc']; ?>...</p>
				</div>
				<a class="pull-right" href="noticia.php?id=<?php echo $row['id_noticias'];?>">Ver noticia completa</a>
			</div>
		</div>
	</div>	
        
<?php		
	}
	
	//creando los enlaces de paginacion de resultados

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
 
<br>
	<?php 
  include "footer.php"; ?>
</div>
</body>
</html>