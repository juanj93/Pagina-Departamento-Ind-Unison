<?php

include('header.php');


if(isset($_POST["submit"]) && $_POST["submit"]!="") {
$usersCount = count($_POST["tipo"]);
for($i=0;$i<$usersCount;$i++) {

mysql_query("UPDATE reportes_industrial set tipo='" . $_POST["tipo"][$i] . "', ubicacion='" . $_POST["ubicacion"][$i] . "', descrip='" . $_POST["descrip"][$i] . "', estatus='" . $_POST["estatus"][$i] .  "', fecha_mod='" . $_POST["fecha_mod"][$i] .  "'  WHERE reporte_id='" . $_POST["reporte_id"][$i] . "'");

}
header("Location:reportes.php");
}  
?>
<form name="frmUser" method="post" action="">


<h1 text align="center";>Modificacion de Reportes</h1>

<table class="table table-hover table-bordered table-striped"  align="center">
<tr>
<td><h3>Datos del reporte(s)</h3></td>
</tr>

<?php


$rowCount = count($_POST["reportes"]);
for($i=0;$i<$rowCount;$i++) {
$result = mysqli_query($conn,"SELECT * FROM reportes_industrial WHERE reporte_id='" . $_POST["reportes"][$i] . "'");
$row[$i]= mysqli_fetch_array($result);
?>
<tr>
<td>
<table class="table table-striped">
<tr>
<td><label>Tipo de Servicio:</label></td>
<td>

<div class="form-group">
  <div class="col-md-5">
    <select  name="tipo[]" class="form-control">
      <option selected><?php echo $row[$i]['tipo']; ?></option></option>
      <option value="Iluminación">Iluminación</option>
      <option value="Electricidad">Electricidad</option>
      <option value="Fallas aire acondicionado">Fallas aire Acondicionado</option>
      <option value="Falta de mensabancos/sillas">Falta de mensabancos/sillas</option>
      <option value="Falta de mesas y/o escritorio">Falta de mesas y/o escritorio</option>
      <option value="Ventanas">Ventanas</option>
      <option value="Problemas con el contacto eléctrico">Problemas con el contacto eléctrico</option>
      <option value="Problemas con las llaves de aulas">Problema con las llaves de aulas</option>
      <option value="Aseo de aula(s)">Aseo de aula(s)</option>
      <option value="Aseo de cubículos">Aseo de cubículos</option>
      <option value="Aseo de pasillos">Aseo de pasillos</option>
      <option value="Aseo de laboratorios">Aseo de laboratorios</option>
      <option value="Aseo de baños">Aseo de baños</option>
      <option value="Configuración de Red">Configuración de Red</option>
      <option value="Instalación de Red">Instalación de Red</option>
      <option value="Falta de internet">Falta de internet</option>
      <option value="Formateo a equipo de compúto">Formateo a equipo de compúto</option>
      <option value="Instalación de software">Instalación de software</option>
      <option value="Instalación de equipo de compúto (impresoras, computadoras)">Instalación de equipo de compúto (impresoras, computadoras)</option>
      <option value="Mantenimiento de equipo de compúto preventivo">Mantenimiento de equipo de compúto preventivo</option>
      <option value="Mantenimiento de equipo de compúto correctivo">Mantenimiento de equipo de compúto correctivo</option>
      <option value="Mantenimiento de equipo de impresoras preventivo">Mantenimiento de equipo de impresoras preventivo</option>
      <option value="Mantenimiento de equipo de impresoras correctivo">Mantenimiento de equipo de impresoras correctivo</option>
      <option value="Mantenimiento de equipo de cañon correctivo">Mantenimiento de equipo de cañon correctivo</option>
      <option value="Reparación de cables (VGA, Corriente)">Reparación de cables (VGA, Corriente)</option>
    </select>
  </div>
</div>
</td>
</tr>

<tr>
<td><label>Ubicacion:</label> </td>
<td>
<div class="form-group"> 
  <div class="col-md-3">
  <input name="ubicacion[]" class="form-control input-md" type="text" value="<?php echo $row[$i]['ubicacion']; ?>">
 </div>
</div>	
</td>
</tr>

<tr>
<td><label>Descipción:</label></td>
<td>
<div class="form-group">
 <div class="col-md-5">                     
 <textarea class="form-control" rows="8" cols="6" name="descrip[]"><?php echo $row[$i]['descrip']; ?></textarea>
 </div>
</div>
</td>
</tr>


<tr>
<td><label>Fecha de Inicio</label></td>
<td>
<div class="form-group"> 
  <div class="col-md-3">
  <input name="fecha_inicio[]" class="form-control input-md" type="datetime" disabled=true value="<?php echo $row[$i]['fecha_inicio']; ?>">
 </div>
</div>	
</td>
</tr>


<tr>
<td><label>Fecha de Modificacion</label></td>
<td>
	<div class="form-group"> 
  <div class="col-md-3">
    <input type="datetime" class="form-control input-md" readonly="readonly" name="fecha_mod[]"  value="<?php $time = time(); echo date("Y-m-d ", $time); echo  date("H:i:s", $time) ?>"/>
   </div>
</div>	
</td>
</tr>

<tr> 
<td><label>Estatus</label></td>
<td>
<div class="form-group">
  <div class="col-md-5">
    <select  name="estatus[]" class="form-control">
      <option selected><?php echo $row[$i]['estatus']; ?></option>
      <option value="Iniciado">Iniciado</option>
      <option value="En proceso">En proceso</option>
      <option value="Finalizado">Finalizado</option>
    </select>
    <input type="hidden" name="reporte_id[]" class="txtField" value="<?php echo $row[$i]['reporte_id']; ?>">
  </div>
</div>
</td>
</tr>
</table>
</td>
</tr>

<?php
}
?>
<tr>
<td colspan="2">
<input type="submit" name="submit" value="Actualizar" class="btn btn-primary">
<input type="submit" name="submit" value="Cancelar"  class="btn btn-danger">
</td>
<tr>
</table>
</div>
</form>
<script language="javascript">
function cierra(){
window.close();

}
</script> 

</div>

</body>
</html>