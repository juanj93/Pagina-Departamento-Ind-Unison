<?php    
//$conn = mysql_connect("localhost","root","");
//mysql_select_db("csti_db1",$conn);
include "conexion.php";
//
if(isset($_GET['buscar'])) {   ?>

<form name="frmUser" method="get" action="" >
 <script language="javascript" src="js/reportes.js" type="text/javascript"></script>      
  <table class="table table-hover table-bordered table-striped">
    <thead>
      <tr>
        <th>Maestro</th>
        <th>Problema</th>
        <th>Descripción</th>
        <th>Fecha de Inicio</th>
        <th>Fecha de Modificación</th>
         <th>Estatus</th>
          <th><input class="btn btn-danger" name="eliminar" type="submit" value="Eliminar">
        <input class="btn btn-primary"  name="pdf" type="submit" value="PDF" onclick="this.form.action='pdf2.php';this.form.target='_blank';this.form.submit();parent.window.location.reload();">
        </th>
         </tr>
    </thead>
    <tbody>
    	

<?php


include "eliminar_reportes.php";

$buscar = $_GET["palabra"];

$consulta_mysql=mysqli_query($conn,"SELECT r.reporte_id, u.name as solicitante, r.tipoServicio, r.tipo, r.ubicacion, r.fecha_mod, r.fecha_inicio, r.estatus, SUBSTRING(r.descrip, 1,20) 
  as descripcion  FROM reportes_industrial r, usuarios_industrial u 
  WHERE r.user_id=u.user_id AND u.name   like '%$buscar%' 
  OR r.user_id=u.user_id AND r.tipo like '%$buscar%'
  OR r.user_id=u.user_id AND r.tipoServicio like '%$buscar%' 
  OR r.user_id=u.user_id AND r.descrip like '%$buscar%' 
  ORDER BY r.fecha_mod ");
while($row = mysqli_fetch_array($consulta_mysql)) {

?> 
<tr>

<td align="center"><?php echo $row['solicitante']; ?></td>
<td align="center"><?php echo $row['tipoServicio']; ?></td>
<td align="center"><a href="verReportes.php?id=<?php echo $row['reporte_id'];?>"><?php echo $row['descripcion']; ?></td>
<td align="center"><?php echo $row['fecha_inicio']; ?></td>
<td align="center"><?php echo $row['fecha_mod']; ?></td>
<td align="center"><?php echo $row['estatus']; ?></td>
<td><input type="checkbox" name="reportes[]" value="<?php echo $row['reporte_id']; ?>" ></td>
<?php } 

?>
</tbody> 
</tr>
</table>
</form>
<?php   
} // fin if


//mysqli_close($conn);
?>