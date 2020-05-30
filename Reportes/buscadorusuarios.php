<?php    
//$conn = mysql_connect("localhost","root","");
//mysql_select_db("csti_db1",$conn);
include "conexion.php";

if($_GET['buscar']) {   ?>

<form name="frmUser" method="post" action="" >
 <script language="javascript" src="js/users.js" type="text/javascript"></script>    
  <table class="table table-hover table-bordered table-striped">
    <thead>
       <tr>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Nombre de Usuario</th>
        <th>Password</th>
        <th>E-mail</th>
        <th><input class="btn btn-danger" name="eliminar" type="submit" value="Eliminar">
        <input name="update" value="Editar" onClick="setUpdateAction();" type="button" class="btn btn-primary">
      </th>
      </tr>
    </thead>
    <tbody>
    	

<?php


include "eliminar.php";

$buscar = $_GET["palabra"];

$consulta_mysql=mysqli_query($conn,"SELECT* FROM usuarios_industrial WHERE NOT (name='$_SESSION[nombre]') AND name like '%$buscar%' 
  OR NOT (name='$_SESSION[nombre]') AND email like '%$buscar%' ORDER BY name ASC");
while($row = mysqli_fetch_array($consulta_mysql)) {

?> 
<tr>

<td align="center"><?php echo $row['name']; ?></td>
<td align="center"><?php echo $row['tipo']; ?></td>
<td align="center"><?php echo $row['userName']; ?></td>
<td align="center"><?php echo $row['password']; ?></td>
<td align="center"><?php echo $row['email']; ?></td>
<td><input type="checkbox" name="users[]" value="<?php echo $row["user_id"]; ?>" ></td>
<?php } 

?>
</tr>
</tbody> 
</table>
</form>
<?php   
} // fin if


//mysqli_close($conn);
?>