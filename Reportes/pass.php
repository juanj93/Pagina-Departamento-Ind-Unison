<form id="frmRestablecer" action="validaremail.php" method="post">
  <div class="panel panel-default">
    <div class="panel-heading"> Restaurar contraseña </div>
    <div class="panel-body">
      <div class="form-group">
        <label for="email"> Escribe el email asociado a tu cuenta para recuperar tu contraseña </label>
        <input type="email" id="email" class="form-control" name="email" required>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Recuperar contraseña" >
      </div>
    </div>
  </div>
</form>
 
<div id="mensaje"></div>
    <script>
  $(document).ready(function(){
    $("#frmRestablecer").submit(function(event){
      event.preventDefault();
      $.ajax({
        url:'validaremail.php',
        type:'post',
        dataType:'json',
        data:$("#frmRestablecer").serializeArray()
      }).done(function(respuesta){
        $("#mensaje").html(respuesta.mensaje);
        $("#email").val('');
      });
    });
  });
</script>