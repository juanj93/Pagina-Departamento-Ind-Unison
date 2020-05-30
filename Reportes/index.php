<?php 

	include "header.php";

	// reportes
	include "conexion.php";
	header("Content-Type: text/html;charset=utf-8");
	mysqli_query($conn, "SET NAMES 'utf8'");
?>
	<h3 class="text-center">Historial de reportes</h3>
	<br>
<!--Formulario para recoger info de los reportes-->
	<form method="POST" class="form-inline" role="form">
		<!--Div para cambiar de estatus, solo opción administrador-->
		<?php if ($_SESSION['tipo']=='administrador'): ?>
		<div class="row">


		<div class="form-group col-md-offset-2">
			<button class="btnEstatusStyle" name="btnProceso">En proceso</button>
			<button class="btnEstatusStyle" name="btnFinalizado">Finalizado</button>
		</div>
<?php endif ?>
	
	<hr class="separador">	
	
<?php
	//Muestra de reportes para usuarios administradores
if ($_SESSION['tipo']=='administrador') {
	
$registros=7;
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
	$result = "SELECT r.reporte_id, u.name as solicitante, r.user_id,  r.tipoServicio, r.tipo, r.ubicacion, r.fecha_mod, r.estatus, SUBSTRING(r.descrip, 1,200) as descripcion 
	FROM reportes_industrial r, usuarios_industrial u 
	WHERE r.user_id=u.user_id AND r.estatus!='Finalizado'
	ORDER BY r.fecha_mod desc limit ".$inicio." , ".$registros." ";
	$cad = mysqli_query($conn,$result) or die ( 'error al listar, $pegar' .mysqli_error($conn)); 
	//calculamos las paginas a mostrar

$contar = "SELECT * FROM reportes_industrial WHERE estatus!='Finalizado'";
$contarok = mysqli_query($conn, $contar);
$total_registros = mysqli_num_rows($contarok);
//$total_paginas = ($total_registros / $registros);
$total_paginas = ceil($total_registros / $registros); 


	while ($row = mysqli_fetch_array($cad)) {
?>
	<div class="row reportes_inicio">
		<div class="col-md-10 col-md-offset-1">
			<div class="col-md-1">
			<input type="checkbox" name="reports[]" value="<?php echo $row['reporte_id']; ?>" >
			<input type="hidden" name="idsUsersReportes[]" value="<?php echo $row['user_id']; ?>">
			</div>
			<div class="col-md-8">
				<b><p class="text-justify"><a href="verReportes.php?id=<?php echo $row['reporte_id'];?>"><?php echo $row['tipoServicio'].': '.$row['tipo'].' || Ubicación: '.$row['ubicacion'];?></a></p></b>
				<p class="text-justify"><?php echo 'Solicitado por: '.$row['solicitante'].' || Estatus: '.$row['estatus'].' || '.$row['fecha_mod'];?></p>
				<p class="text-justify"><?php echo 'Descripción: '.$row['descripcion']; ?>...</p>	
			</div>
			<div class="col-md-2">
				<br>

		<!--<button type="button" class="btn btnECorreo" data-toggle="modal" data-target="#enviarCorreoModal" data-keyboard="true"><span class="glyphicon glyphicon-pencil"></span> Enviar Correo</button>
			-->
			<a href="correoAdmin.php?id=<?php echo $row['user_id'] ?>" type="button" class="btn btnECorreo"><span class="glyphicon glyphicon-pencil"></span> Enviar Correo</a>
			
			</div>
		</div>
	</div>
	<hr class="separador">	
	


<?php
//llamamos las funciones de actualizar estado

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

}//fin if admin
?> 


<?php

	//Listado de reportes para usuarios normales
	if ($_SESSION['tipo']=='usuario') {

		$registros=5;
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
	include "datosUsuario.php";
	$result = "SELECT r.reporte_id, u.name as solicitante, r.tipo, r.ubicacion, r.fecha_mod, r.estatus, SUBSTRING(r.descrip, 1,200) as descripcion 
	FROM reportes_industrial r, usuarios_industrial u 
	WHERE r.user_id=u.user_id AND r.user_id=$id
	ORDER BY r.fecha_inicio desc limit ".$inicio." , ".$registros." ";
	$cad = mysqli_query($conn,$result) or die ( 'error al listar, $pegar' .mysqli_error($conn)); 
	//calculamos las paginas a mostrar

$contar = "SELECT r.* FROM reportes_industrial r, usuarios_industrial u WHERE r.user_id=$id and r.user_id=u.user_id";
$contarok = mysqli_query($conn, $contar);
$total_registros = mysqli_num_rows($contarok);
//$total_paginas = ($total_registros / $registros);
$total_paginas = ceil($total_registros / $registros); 


	while ($row = mysqli_fetch_array($cad)) {
?>
	<div class="row reportes_inicio">
		<div class="col-md-6 col-md-offset-1">
			<b><p class="text-justify"><a href="reporte.php?id=<?php echo $row['reporte_id'];?>"><?php echo $row['tipo'].' || Ubicación: '.$row['ubicacion'].' || '.$row['fecha_mod'];?></a></p></b>
			<p class="text-justify"><?php echo 'Solicitado por: '.$row['solicitante'].' || Estatus: '.$row['estatus']; ?></p>
			<p class="text-justify"><?php echo 'Descripción: '.$row['descripcion']; ?>...</p>	
		</div>
	</div>
	<hr class="separador">	
	
        
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
		
	}

?>
</form>
<?php
include "functions/estatus_change.php";	
	include "footer.php";

 ?>
<!-- Modal -->
  <div class="modal fade" id="enviarCorreoModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        	<h3><span class="glyphicon glyphicon-envelope"></span> Enviar correo</h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding:10px 50px;">
          <form role="form-horizontal">

          	<!--Asunto-->
            <div class="form-group">
              <label for="txtAsunto">Asunto:</label>
              <input type="text" class="form-control col-md-6" id="txtAsunto" name="txtAsunto">
            </div>
            <!--Mensaje-->
            <div class="form-group">
              <label for="txtAreaMensaje"> Mensaje:</label>
              <textarea id="txtAreaMensaje" name="txtAreaMensaje" class="form-control" rows="5"></textarea>
            </div>
              
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
	 <button type="submit" class="btn btn-primary btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Enviar</button>
        </div>
      </div>
      
    </div>
  </div> 