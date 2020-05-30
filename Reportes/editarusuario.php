<?php

include('header.php');



if(isset($_POST["submit"]) && $_POST["submit"]!="") {
$usersCount = count($_POST["name"]);
for($i=0;$i<$usersCount;$i++) {
mysqli_query($conn,"UPDATE usuarios_industrial set name='" . $_POST["name"][$i] . "', userName='" . $_POST["userName"][$i] . "', tipo='" . $_POST["tipo"][$i] . "', password='" . $_POST["password"][$i] .  "' WHERE user_id='" . $_POST["user_id"][$i] . "'");
}
header("Location:configuracion.php");
}  
?>
<form name="frmUser" method="post" >


<h1>Modificacion de datos</h1>

<table class="table table-hover table-bordered table-striped"  align="center">
<tr>
<td><h4>Datos del usuario(s)</h4></td>
</tr>

<?php

$rowCount = count($_POST["users"]);

for($i=0;$i<$rowCount;$i++) {
$result = mysqli_query($conn,"SELECT * FROM usuarios_industrial WHERE user_id='" . $_POST["users"][$i] . "'");
$row[$i]= mysqli_fetch_array($result);
?>
<tr>
<td>
<table class="table table-striped">
<tr>
<td><label>Nombre</label></td>
<td>
  <div class="form-group"> 
  <div class="col-md-3">
  <input type="text" name="name[]" class="form-control" value="<?php echo $row[$i]['name']; ?>">
</div>
</div>
</td>
</tr>

<tr>
<td><label>Password</label></td>
<td>
  <div class="form-group"> 
  <div class="col-md-3">
  <input type="password" name="password[]"class="form-control input-md" value="<?php echo $row[$i]['password']; ?>">
  </div>
</div>
</td>
</tr>

<tr>
<td><label>Tipo</label></td>
<td>
  <div class="form-group">
  <div class="col-md-5"> 
<select  name="tipo[]" class="form-control" >
      <option selected><?php echo $row[$i]['tipo']; ?></option></option>
      <option value="usuario">usuario</option>
      <option value="administrador">administrador</option>
    </select>
 </div>
</div>
</td>
</tr>


<tr>
<td><label>Nombre de Usuario</label></td>
<td>
  <div class="form-group"> 
  <div class="col-md-3">
  <input name="userName[]" class="form-control input-md" type="ptext" value="<?php echo $row[$i]['userName']; ?>">
   </div>
</div>
</td>
</tr>


<tr>
<td><label>Email</label></td>
<td>
<div class="form-group"> 
  <div class="col-md-3"> 
   <input type="text" name="email[]" class="form-control" value="<?php echo $row[$i]['email']; ?>" ></td><input type="hidden" name="user_id[]" class="txtField" value="<?php echo $row[$i]['user_id']; ?>">
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
<input type="submit" name="submit" value="Cancelar" onClick="configuracion.php" class="btn btn-danger">
</td>
</tr>
</table>
</div>
</form>


<?php 

include "footer.php";
 ?>