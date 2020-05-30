<?php 

	include "header.php";
  if ($_SESSION['tipo']!='administrador') {
    header('Location:index.php'); 
  exit();
  }

?>

<!--Formulario para crear usuarios-->
<form class="form-horizontal" class="crearUsuario" action="" method="post">
<fieldset>

<legend>Crear nuevo usuario</legend>

<div class="form-group">
  <label class="col-md-4 control-label" for="nombretxt"><link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>Nombre:</label>  
  <div class="col-md-5">
  <input id="nombretxt" name="nombretxt" placeholder="Escriba nombre(s) y apellidos" class="form-control input-md" required="" type="text" maxlength="100">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="tipoSelect">Tipo:</label>
  <div class="col-md-4">
    <select id="tipoSelect" name="tipoSelect" class="form-control">
      <option value="usuario">usuario</option>
      <option value="administrador">administrador</option>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="userNametxt">Nombre de usuario:</label>  
  <div class="col-md-4">
  <input id="userNametxt" name="userNametxt" placeholder="Escriba nombre de usuario" class="form-control input-md" required="" type="text" maxlength="30">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="passtxt">Contraseña:</label>  
  <div class="col-md-4">
  <input id="passtxt" name="passtxt" placeholder="Escriba contraseña" class="form-control input-md" required="" type="password" maxlength="30">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="passtxt">Confirme contraseña:</label>  
  <div class="col-md-4">
  <input id="passtxt" name="pass2txt" placeholder="Confirme contraseña" class="form-control input-md" required="" type="password" maxlength="30">
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="emailtxt">E-mail:</label>  
  <div class="col-md-4">
  <input id="emailtxt" name="emailtxt" placeholder="Escriba e-mail" class="form-control input-md" required="" type="email" maxlength="100">
    
  </div>
</div>

<div class="form-group">
 
  <div class="col-md-6 col-md-offset-6">
    <button id="cancelarbtn" name="cancelarbtn" class="btn btn-danger" onclick="window.location='index.php';">Cancelar</button>
    <button id="crearUsuariobtn" name="crearUsuariobtn" class="btn btn-success">Crear usuario</button>
  </div>
</div>

</fieldset>
</form>
  <!--Crea el usario-->
    <?php if (isset($_POST['crearUsuariobtn'])){
    $sql='select * FROM usuarios';

    $r=mysqli_query($conn, $sql);

    $verificar_usuario=0;//variable para identificar si el usario ya existe, 0 no, 1 si.

    while ($result=mysqli_fetch_array($r)) {
          if ($result["userName"] == $_POST['userNametxt'] || $result["email"]== $_POST['emailtxt']) {
            $verificar_usuario=1;
            echo'<script type="text/javascript">
                alert("Este nombre de usuario y/o email ya está registrado.");
                </script>';
           
        }
          
      }

    if ($verificar_usuario==0) {
        if ($_POST['passtxt']==$_POST['pass2txt']) {
            $nombre=$_POST['nombretxt'];
            $tipo=$_POST['tipoSelect'];
            $userN=$_POST['userNametxt'];
            $pass1=$_POST['passtxt'];
            $pass2=$_POST['passtxt'];
            $mail=$_POST['emailtxt'];

            $sql="INSERT INTO usuarios_industrial (tipo, name, userName, password, email) 
            values ('$tipo', '$nombre', '$userN', '$pass1','$mail')";
            mysqli_query($conn, $sql);
            echo'<script type="text/javascript">
                alert("Usuario registrado existosamente.");
                </script>';
            
            mysqli_close($con);
        }
        else{
          echo'<script type="text/javascript">
                alert("Las contraseñas no conciden.");
                </script>';
         
        }


      }
  } 
  ?>

 <?php
	include "footer.php";

 ?>