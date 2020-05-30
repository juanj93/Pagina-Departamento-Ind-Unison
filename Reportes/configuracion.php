<?php 
include "header.php";

//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['nombre'])|| $_SESSION['tipo']!='administrador') 
{
  header('Location:index.php'); 
  exit();
}

?>
 <script type="text/javascript">
        window.onload =function(){
          select();
        }
        function  select(){
          $("#tipoSelect").val("<?php echo $tipo; ?>");

        }
        function cancelar(){
          window.location.href="configuracion.php";
        }
  </script>


<!--configuracion personal-->
  <form class="form-horizontal"  method="POST">
    
    <legend>Configuración personal</legend>
    
<fieldset>


<!--Nombre y apellidos-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nombretxt">Nombre:</label>  
  <div class="col-md-5">
  <input id="nombretxt" name="nombretxt" placeholder="Escriba nombre(s) y apellidos" class="form-control input-md" required="" maxlength="100" type="text" 
  value='<?=$name?>'>
    
  </div>
</div>

<!--tipo-->
<div class="form-group">
  <label class="col-md-4 control-label" for="tipoSelect">Tipo:</label>
  <div class="col-md-4">
    <select id="tipoSelect" name="tipoSelect" class="form-control">
      <option value="usuario">usuario</option>
      <option value="administrador">administrador</option>
    </select>
  </div>
</div>

<!--Nombre uusario-->
<div class="form-group">
  <label class="col-md-4 control-label" for="userNametxt">Nombre de usuario:</label>  
  <div class="col-md-4">
  <input id="userNametxt" name="userNametxt" placeholder="Escriba nombre de usuario" class="form-control input-md" type="text"  maxlength="30" required 
    value="<?=$user?>">
    
  </div>
</div>

<!--Contraseña anterior-->
<div class="form-group">
  <label class="col-md-4 control-label" for="passtxt">Contraseña anterior:</label>  
  <div class="col-md-4">
  <input id="passViejatxt" name="passViejatxt" placeholder="Contraseña anterior" class="form-control input-md" maxlength="30" type="password" required>
    
  </div>
</div>

<!--Nueva contraseña-->
<div class="form-group">
  <label class="col-md-4 control-label" for="passtxt">Nueva contraseña:</label>  
  <div class="col-md-4">
  <input id="passNuevatxt" name="passNuevatxt" placeholder="Nueva contraseña" class="form-control input-md" maxlength="30" type="password" required>
    
  </div>
</div>

<!--email-->
<div class="form-group">
  <label class="col-md-4 control-label" for="emailtxt">E-mail:</label>  
  <div class="col-md-4">
  <input id="emailtxt" name="emailtxt" placeholder="Escriba e-mail" class="form-control input-md" type="email" required maxlength="100"
    value="<?=$mail?>">
    
  </div>
</div>

<!--botones-->
<div class="form-group">
	 
  <div class="col-md-4 col-md-offset-6">
    <button id="btn-next" name="cancelarbtn" class="btn btn-danger" onclick="cancelar()">Cancelar</button>
    <button id="actualizarAdmintn" name="actualizarAdminbtn" class="btn btn-success" >Actualizar</button>
  </div>
</div>
</fieldset>
</form>
<?php 
 
    if (isset($_POST['actualizarAdminbtn'])){
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
            $tipo=trim($_POST['tipoSelect']);
            $userN=trim($_POST['userNametxt']);
            $pass=trim($_POST['passNuevatxt']);
           
            $mailN=$_POST['emailtxt'];

            $sql="UPDATE usuarios_industrial  
            SET  tipo='".$tipo."', name='".$nombre."', userName='".$userN."', password='".$pass."', email='".$mailN."' 
            WHERE user_id='".$id."'";
           
            
            if ($conn->query($sql) === TRUE) {
             $_SESSION['nombre']=$nombre;
            
               echo'<script type="text/javascript">
                alert("Los datos se han actualizado.");
                </script>';


             if ($tipo=="usuario") { //si cambia de tipo se cerrará la sessión
                  echo "<script language=\"javascript\">
                  window.location.href=\"logout.php\";
                  </script>";
             }
           

            } 
        }
        else{
          
         echo'<script type="text/javascript">
                alert("La contraseña anterior no concide..");
                </script>';
        }        
      }
      
  } 
  
  ?>

<?php

include "footer.php";

 ?>