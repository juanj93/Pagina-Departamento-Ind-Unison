<?php 

	include "header.php";
  if ($_SESSION['tipo']!='usuario') {
    header('Location:index.php'); 
  exit();
  }
	//Creación del nuevo reporte
?>
<!--script para que apararezca un nuevo select dependiendo del tipo de servicio seleccionado-->
<script type="text/javascript">
  function  mostrar(id){
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
  <div class="col-md-3">
    <select id="tipoSelect" name="tipoSelect" class="form-control" onChange="mostrar(this);">
      <option value="" disabled selected>Selecciona un tipo de servicio</option>
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
  <input id="ubicaciontxt" name="ubicaciontxt" placeholder="Ubicacion de la solicitud de servicio" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Descripcion -->
<div class="form-group">
  <label class="col-md-4 control-label" for="descripArea" >Descripción:</label>
  <div class="col-md-5">                     
    <textarea class="form-control" id="descripArea" name="descripArea" rows="5" ></textarea>
  </div>
</div>

<!-- Botones -->
<div class="form-group">
  <label class="col-md-4 control-label" for="cancelarbtn"></label>
  <div class="col-md-8">
    <button id="cancelarbtn" name="cancelarbtn" class="btn btn-danger">Cancelar</button>
    <button id="crearReporteAdminbtn" name="crearReporteAdminbtn" class="btn btn-success">Crear reporte</button>
  </div>
</div>

</fieldset>
</form>
<!--Crea el  reporte-->
    <?php if (isset($_POST['crearReporteAdminbtn'])){
             

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
               $solicitante=$id;
               $descrp_reporte=$_POST['descripArea'];


            $sql="INSERT INTO `reportes_industrial` (`reporte_id`, `user_id`, `tipoServicio`, `tipo`, `ubicacion`, `descrip`, `fecha_inicio`, `fecha_mod`, `estatus`) 
            VALUES (NULL, '$solicitante', '$tipoServicio', '$tipo', '$ubicacion_reporte', '$descrp_reporte', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'Iniciado');";
            mysqli_query($conn, $sql);
            echo'<script type="text/javascript">
                alert("Reporte creado exitosamente.");
                </script>';
               
            
            mysqli_close($conn);
      
  } 
  ?>

<?php
	include "footer.php";

 ?>