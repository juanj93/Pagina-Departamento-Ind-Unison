<?php 

	include "header.php";
?>
<!--configuracion personal-->
  <form class="form-horizontal" method="POST">
<fieldset>

<!---->
<legend>Configuración de cuenta</legend>

<!--Nombre y apellidos-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nombretxt">Nombre:</label>  
  <div class="col-md-5">
  <input id="nombretxt" name="nombretxt" placeholder="Escriba nombre(s) y apellidos" maxlength="100" class="form-control input-md" required="" type="text"
  value='<?=$name?>'>
    
  </div>
</div>

<!--tipo-->

<!--Nombre uusario-->
<div class="form-group">
  <label class="col-md-4 control-label" for="userNametxt">Nombre de usuario:</label>  
  <div class="col-md-4">
  <input id="userNametxt" name="userNametxt" placeholder="Escriba nombre de usuario" maxlength="30" class="form-control input-md" required="" type="text"
  value="<?=$user?>">
    
  </div>
</div>

<!--Contraseña anterior-->
<div class="form-group">
  <label class="col-md-4 control-label" for="passtxt">Contraseña anterior:</label>  
  <div class="col-md-4">
  <input id="passViejatxt" name="passViejatxt" placeholder="Contraseña anterior" maxlength="30" class="form-control input-md" required="" type="password">
    
  </div>
</div>

<!--Nueva contraseña-->
<div class="form-group">
  <label class="col-md-4 control-label" for="passtxt">Nueva contraseña:</label>  
  <div class="col-md-4">
  <input id="passNuevatxt" name="passNuevatxt" placeholder="Nueva contraseña" maxlength="30" class="form-control input-md" required="" type="password">
    
  </div>
</div>

<!--email-->
<div class="form-group">
  <label class="col-md-4 control-label" for="emailtxt">E-mail:</label>  
  <div class="col-md-4">
  <input id="emailtxt" name="emailtxt" placeholder="Escriba e-mail" maxlength="100" class="form-control input-md" required="" type="email"
  value="<?=$mail?>">
    
  </div>
</div>

<!--botones-->
<div class="form-group">
  <div class="col-md-4 col-md-offset-4">
    <button id="cancelarbtn" name="cancelarbtn" class="btn btn-danger" onclick="cancelar()">Cancelar</button>
    <button id="actualizarusuariotn" name="actualizarusariobtn" class="btn btn-success">Actualizar</button>
  </div>
</div>

</fieldset>
</form>
<!---->
<?php 
 
    if (isset($_POST['actualizarusariobtn'])){
    $sql='select * FROM usuarios_industrial';
    $r=mysqli_query($conn, $sql);

    $verificar_usuario=0;//variable para identificar si el usario ya existe, 0 no, 1 si.

    while ($result=mysqli_fetch_array($r)) {       
         if ($_POST['userNametxt']==$result['userName'] && $_POST['userNametxt']!=$user) {
            $verificar_usuario=1;

      echo'<script type="text/javascript">
                alert("El nombre de usuario no se ecuentra disponible.");
                </script>';
           
          }        
      }

    if ($verificar_usuario==0) {
        if ($_POST['passViejatxt']==$password ) {
            $nombre=trim($_POST['nombretxt']);
           
            $userN=trim($_POST['userNametxt']);
            $pass=trim($_POST['passNuevatxt']);
           
            $mailN=$_POST['emailtxt'];

            $sql="UPDATE usuarios_industrial 
            SET  name='".$nombre."', userName='".$userN."', password='".$pass."', email='".$mailN."' 
            WHERE user_id='".$id."'";
           
            
            if ($conn->query($sql) === TRUE) {
             $_SESSION['nombre']=$nombre;
             
             echo'<script type="text/javascript">
                alert("Los datos se han actualizado.");
                </script>';

            } 
        }
        else{
           echo'<script type="text/javascript">
                alert("La contraseña anterior no concide..");
                </script>';
         
        }        
      }
      
  } 


	include "footer.php";

 ?>