<?php 

  include "header.php";
  // reportes
  include "conexion.php";
  
  header("Content-Type: text/html;charset=utf-8");
   ini_set("display_errors", false);
?>
   <script type="text/javascript">
        window.onload =function(){
          select();
        }
        function  select(){
          $("#tipoSelect").val("<?php echo $tipoReporte; ?>");

        }
        function cancelar(){
          window.location.href="index.php";
        }
        function actualizar(){
          window.location.reload();
        }
  </script>
  <h3 class="text-center">Listado de reportes</h3>
  <script language="javascript" src="js/reportes.js" type="text/javascript"></script>
  <br>
  <form method="GET" action="" onSubmit="return validarForm(this);" >
<center>
<input type="text" placeholder="Buscar Reporte(s)" name="palabra" class="form-control input">
<br>
<input type="submit" value="Buscar" name="buscar" class="btn btn-primary btn-lg">
  <br><br>

<?php include('buscador.php'); ?>
</form>

  <form name="frmUser" method="post" action="pdf.php" >
       
  <table class="table table-hover table-bordered table-striped">
    <thead>
      <tr>
        <th>Maestro</th>
        <th>Problema</th>
        <th>Descripción</th>
        <th>Fecha de Inicio</th>
        <th>Fecha de Modificación</th>
        <th>Estatus</th>
        <th><button class="btn btn-danger" name="eliminar"  >Eliminar</button>
        <input class="btn btn-primary"  name="pdf" type="submit" value="PDF" onclick="this.form.action='pdf.php';this.form.target='_blank';this.form.submit();parent.window.location.reload();">
        </th>
      </tr>
    </thead>
    <tbody>
      
<?php
//onclick="window.open('timeclock/index.php', '_blank';location.reload();"
  //Muestra de reportes para usuarios administradores
if ($_SESSION['tipo']=='administrador') {
  
$registros=15;
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
  $result = "SELECT r.reporte_id, u.name as solicitante, r.tipo, r.ubicacion, r.fecha_mod,r.fecha_inicio, r.estatus, SUBSTRING(r.descrip, 1,20) as descripcion 
  FROM reportes_industrial r, usuarios_industrial u 
  WHERE r.user_id=u.user_id
  ORDER BY r.fecha_inicio desc limit ".$inicio." , ".$registros." ";
  $cad = mysqli_query($conn,$result) or die ( 'error al listar, $pegar' .mysqli_error($conn)); 
  //calculamos las paginas a mostrar

$contar = "SELECT * FROM reportes_industrial";
$contarok = mysqli_query($conn, $contar);
$total_registros = mysqli_num_rows($contarok);
//$total_paginas = ($total_registros / $registros);
$total_paginas = ceil($total_registros / $registros); 


  while ($row = mysqli_fetch_array($cad)) {
?>
 <tr> 
  <td align="center"><?php echo $row['solicitante']; ?></td>
<td align="center"><?php echo $row['tipo']; ?></td>
<td align="center"><a href="verReportes.php?id=<?php echo $row['reporte_id'];?>"><?php echo $row['descripcion']; ?></td>
<td align="center"><?php echo $row['fecha_inicio']; ?></td>
<td align="center"><?php echo $row['fecha_mod']; ?></td>
<td align="center"><?php echo $row['estatus']; ?></td>
  <td><input type="checkbox" name="reportes[]" value="<?php echo $row["reporte_id"]; ?>" ></td> 
  </tr>    
        
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

}//fin if admin

include "eliminar_reportes.php";
    ?>
  </tbody>
  </table>
</form>
</body>

  <?php 


  include "footer.php";
  ?>

