<?php 
include "header.php";


?>

<form class="form-horizontal" method="POST">
<fieldset>

<legend>Enviar Correo</legend>

<!-- Asunto-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtAsunto">Asunto:</label>  
  <div class="col-md-4">
  <input id="txtAsunto" name="txtAsunto" placeholder="" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Textarea Mensaje -->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtAreaMsg">Mensaje:</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="txtAreaMsg" name="txtAreaMsg" rows="7" required></textarea>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="btnCancelar"></label>
  <div class="col-md-4">
    <button id="btnCancelar" name="btnCancelar" class="btn btn-danger " onclick="window.location='index.php';" >Cancelar</button>
    <button id="btnEnviar" name="btnEnviar" class="btn btn-primary pull-right">Enviar</button>
  </div>
</div>

</fieldset>
</form>


<?php

if (isset($_POST['btnEnviar'])) {
    $asunto=$_POST['txtAsunto'];
    $Mensaje=$_POST['txtAreaMsg'];
    $to = "armdan22@gmail.com";
   
    $headers = "From: armdan22@gmail.com" . "\r\n" .
    "CC: armdan22@gmail.com";
    if (@mail($to,$asunto,$Mensaje,$headers)) {
         echo "Mensaje enviado";
   
    }else{
         echo "Mensaje no enviado";
         echo "";
     }
}

include "footer.php";

 ?>