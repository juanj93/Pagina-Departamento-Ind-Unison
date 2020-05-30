<!DOCTYPE html>
<html>
<?php 
	include "header.php";
	$title = 'Contacto';
 ?>		

	<h3 class="text-center">¡Envíanos un mensaje!</h3>
<!--Formulario de contacto-->

<form class="form-horizontal" id="contacto-form">
<fieldset>


<div class="form-group">
  <label class="col-md-4 control-label" for="nombretxt">Nombre:</label>  
  <div class="col-md-4">
  <input id="nombre" name="nombre" maxlength="60" class="form-control input-md" required="" type="text">
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="correotxt">Correo:</label>  
  <div class="col-md-4">
  <input id="correo" name="correo" maxlength="60" class="form-control input-md" required="" type="email">
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="comentariotxt">Comentario:</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="mensaje" maxlength="500" rows="10" name="comentario"></textarea>
  </div>
</div>


<div class="form-group">
  <div class="col-md-5 pull-right">
    <button id="submit" name="submit" class="btn btn-primary">Enviar</button>
  </div>
</div>

</fieldset>
</form>
<div class="alert text-center" id="mensaje"></div>

<script>

	$('#submit').click(function(event) {

		event.preventDefault();

		var dataString = {
			'nombre': $('#nombre').val(),
			'correo': $('#correo').val(),
			'mensaje': $('#mensaje').val()
		}

		$.ajax({
			url: 'contact.php',
			type: 'post',
			data: dataString,
			success: function (respuesta) {
				console.log(respuesta);
				var respJson = $.parseJSON(respuesta);
				$('#mensaje').addClass( (respJson.typeMsg == 'error') ? 'alert-danger' : (respJson.typeMsg == 'ok') ? 'alert-success' : '' );

				$('#mensaje').append(respJson.textMsg);
				if (respJson.typeMsg == 'ok') {
					$('#contacto-form btn').remove();
					$('h1').empty().append('¡Mensaje Enviado!')
					$('#contacto-form').slideUp();
				};
			}
		});
		
	});
</script>
<br>
	<?php 
  include "footer.php"; ?>

</div>
</body>
</html>