<?php 
include "header.php";

include "conexion.php";
if($_SESSION['tipo']!='usuario') 
{
  header('Location:index.php'); 
  exit();
}

$idReporte = $_GET['id'];
$url_actual = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//consulta noticia con id
  $result= mysqli_query($conn, "SELECT *, DATE_FORMAT(fecha_mod, '%d-%b-%Y') as fecha FROM reportes_industrial WHERE reporte_id =".$_GET['id']);

while ($row = mysqli_fetch_array($result)) {
  if ($row['user_id']!=$id) {//Verifica que el reporte sea del usuario logeado
      echo'<script type="text/javascript">
                window.location.href="index.php";
                </script>';
      
  }
  $estatus=$row['estatus'];
  $tipoReporte=$row['tipoServicio'];
  $tipodeServicio=$row['tipo'];
?>
   <script type="text/javascript">
      //paso variable tiposervicio a var js
      var selectServicios="<?php echo $tipodeServicio; ?>";
      var urlActReporte="<?php echo $url_actual; ?>";
      var idReporteActual="<?php echo $idReporte; ?>";

        window.onload =function(){
          select();
        }

        function  select(){
          $("#tipoSelect").val("<?php echo $tipoReporte; ?>");//Selecciona valor en el tipo select segun la BD
          $('#tipoSelectInfraestructura').val("<?php echo $tipodeServicio; ?>");
          var sInfraestructura=document.getElementById('tipoSelectInfraestructura');//Verifica si hay seleccionado algo del select
          $('#tipoSelectLimpieza').val("<?php echo $tipodeServicio; ?>");
          var sLimpieza=document.getElementById('tipoSelectLimpieza');
          $('#tipoSelectComputo').val("<?php echo $tipodeServicio; ?>");
          var scomputo=document.getElementById('tipoSelectComputo');

          //Activan el select segun si se habia seleccionado algo o no
          if (sInfraestructura.selectedIndex!=-1) {
            $("#infraestructura").show();
            $("#limpieza").hide();
            $("#computo").hide();
          };
          if (sLimpieza.selectedIndex!=-1) {
            $("#infraestructura").hide();
            $("#limpieza").show();
            $("#computo").hide();
          };
          if (scomputo.selectedIndex!=-1) {

            $("#infraestructura").hide();
            $("#limpieza").hide();
            $("#computo").show();
          };
        }


        function  mostrar(id){//funcion para cambiar el select secundario dependiendo del tipo de servicio
          if (id.value=="Infraestructura") {
            $("#infraestructura").show();
            $("#limpieza").hide();
            $("#computo").hide();
          };
          if (id.value=="Limpieza") {
            $("#infraestructura").hide();
            $("#limpieza").show();
            $("#computo").hide();
          };
          if (id.value=="Equipo de cómputo") {
            $("#infraestructura").hide();
            $("#limpieza").hide();
            $("#computo").show();
          };
        }

  </script>
  <form class="form-horizontal" method="POST">
<fieldset>


  <legend>Nuevo reporte</legend>


<!-- Tipo servicio -->
<div class="form-group">
  <label class="col-md-4 control-label" for="tipoSelect">Tipo de servicio:</label>
  <div class="col-md-5">
    <select id="tipoSelect" name="tipoSelect" class="form-control" onChange="mostrar(this);">
      <option value="Infraestructura">Infraestructura</option>
      <option value="Limpieza">Limpieza</option>
      <option value="Equipo de cómputo">Equipo de cómputo</option>
    </select>
  </div>
</div>
<!--Tipo de servicio Infraestructura-->
<div class="form-group" id="infraestructura" style="display: none;">
  <label class="col-md-4 control-label" for="tipoSelect"></label>
  <div class="col-md-3">
    <select id="tipoSelectInfraestructura" name="tipoSelectInfraestructura" class="form-control">
      <option value="Iluminación">Iluminación</option>
      <option value="Electricidad">Electricidad</option>
      <option value="Fallas aire acondicionado">Fallas aire Acondicionado</option>
      <option value="Falta de mensabancos/sillas">Falta de mensabancos/sillas</option>
      <option value="Falta de mesas y/o escritorio">Falta de mesas y/o escritorio</option>
      <option value="Ventanas">Ventanas</option>
      <option value="Problemas con el contacto eléctrico">Problemas con el contacto eléctrico</option>
      <option value="Problemas con las llaves de aulas">Problema con las llaves de aulas</option>
    </select>
  </div>
</div>

<!--Tipo de servicio Limpieza-->
<div class="form-group" id="limpieza" style="display: none;">
  <label class="col-md-4 control-label" for="tipoSelect"></label>
  <div class="col-md-3">
    <select id="tipoSelectLimpieza" name="tipoSelectLimpieza" class="form-control">
      <option value="Aseo de aula(s)">Aseo de aula(s)</option>
      <option value="Aseo de cubículos">Aseo de cubículos</option>
      <option value="Aseo de pasillos">Aseo de pasillos</option>
      <option value="Aseo de laboratorios">Aseo de laboratorios</option>
      <option value="Aseo de baños">Aseo de baños</option>
    </select>
  </div>
</div>

<!--Tipo de servicio Computo-->
<div class="form-group" id="computo" style="display: none;">
  <label class="col-md-4 control-label" for="tipoSelect"></label>
  <div class="col-md-5">
    <select id="tipoSelectComputo" name="tipoSelectComputo" class="form-control">
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

<!-- Ubicacion-->
<div class="form-group">
  <label class="col-md-4 control-label" for="ubicaciontxt">Ubicacion:</label>  
  <div class="col-md-3">
  <input id="ubicaciontxt" name="ubicaciontxt" placeholder="Ubicacion de la solicitud de servicio" class="form-control input-md" required="" type="text" 
    value="<?php echo $row['ubicacion']; ?>">
    
  </div>
</div>

<!-- Descripcion -->
<div class="form-group">
  <label class="col-md-4 control-label" for="descripArea">Descripción:</label>
  <div class="col-md-5">                     
    <textarea class="form-control" id="descripArea" name="descripArea" rows="5"><?php echo $row['descrip']; ?></textarea>
  </div>
</div>

<!-- Estatus Select -->
<div class="form-group">
  <label class="col-md-4 control-label" for="estatusSelect" >Estatus:</label>
  <div class="col-md-2">
    <select id="estatusSelect" name="estatusSelect" class="form-control" disabled>
      <option value="Iniciado">Iniciado</option>
      <option value="En proceso">En proceso</option>
      <option value="Finalizado">Finalizado</option>
    </select>
  </div>
</div>

<!-- Botones -->
<div class="form-group">
  <label class="col-md-4 control-label" for="cancelarbtn"></label>
  <div class="col-md-8">
    <input id="cancelarbtn" name="cancelarbtn" type="button" class="btn btn-danger" onclick="window.location='index.php';" value="Cancelar">
    <button id="actualizarbtn" name="actualizarbtn" class="btn btn-success" >Actualizar</button>
  </div>
</div>

</fieldset>
</form>
<?php 
  if (isset($_POST['actualizarbtn'])) {
    
               $tipoServicio=$_POST['tipoSelect'];
               //Tomo el tipo de servicio especifico segun el servicio seleccionado
               if ($_POST['tipoSelect']=='Infraestructura') {
                 $tipo=$_POST['tipoSelectInfraestructura'];
               }
               if ($_POST['tipoSelect']=='Limpieza') {
                 $tipo=$_POST['tipoSelectLimpieza'];
               }
               if ($_POST['tipoSelect']=='Equipo de cómputo') {
                 $tipo=$_POST['tipoSelectComputo'];
               }

               $ubicacion_reporte=$_POST['ubicaciontxt'];
               $descrp_reporte=$_POST['descripArea'];
               

            $sql="UPDATE reportes_industrial  
            SET  tipoServicio='".$tipoServicio."', tipo='".$tipo."', ubicacion='".$ubicacion_reporte."', descrip='".$descrp_reporte."',fecha_mod= CURRENT_TIMESTAMP
            WHERE reporte_id='".$idReporte."'";

            mysqli_query($conn, $sql);
     
            
            echo'<script type="text/javascript">
                alert("Se ha actualizado el reporte.");
                window.location=urlActReporte;
                </script>';
                
            
            mysqli_close($conn);
  }

}
include "footer.php";

 ?>