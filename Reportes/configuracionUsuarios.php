<?php 

  include "header.php";
//ini_set("display_errors", false);
//validamos si se ha hecho o no el inicio de sesion correctamente

//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['nombre'])|| $_SESSION['tipo']!='administrador') 
{
  header('Location:index.php'); 
  exit();
}
?>

<script language="javascript" src="js/users.js" type="text/javascript"></script>

<!--configuracion de usuarios-->
 <h3 text align="center";>Lista de usuarios registrados</h3>
 <br>
 

<!--Tabla de Usuarios-->
<form name="frmUser" method="POST" >
       
  <table class="table table-hover table-bordered table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Usuario</th>
        <th>Tipo</th>
        <th>E-mail</th>
        <th><button class="btn btn-danger" id="eliminar" name="eliminar" >Eliminar</button>
        <input name="update" value="Editar" onClick="setUpdateAction();" type="button" class="btn btn-primary">
      </th>
      </tr>
    </thead>
    <tbody>
      <?php

$registros=20;
  @$pagina = $_GET ['pagina'];

if (!isset($pagina))
{
$pagina = 1;
$inicio = 0;
}
else
{
$inicio = ($pagina-1) * $registros;
} 
  $result = "SELECT * FROM usuarios_industrial
  WHERE NOT (name='$_SESSION[nombre]')
  ORDER BY name limit ".$inicio." , ".$registros." ";
  $cad = mysqli_query($conn,$result) or die ( 'error al listar, $pegar' .mysqli_error($conn)); 
  //calculamos las paginas a mostrar

$contar = "SELECT * FROM usuarios_industrial WHERE NOT (name='$_SESSION[nombre]')";
$contarok = mysqli_query($conn, $contar);
$total_registros = mysqli_num_rows($contarok);
//$total_paginas = ($total_registros / $registros);
$total_paginas = ceil($total_registros / $registros); 

   $i=0;
  
    while($row = mysqli_fetch_array($cad)) {
      if($i%2==0)
        $classname="evenRow";
          else
        $classname="oddRow";
        ?>
        
        <tr class="<?php if(isset($classname)) echo $classname;?>"> 
         <td><?php echo $row['name']?></td> 
         <td><?php echo $row['userName']?></td> 
         <td><?php echo $row['tipo']?></td>
         <td><?php echo $row['email']?></td>
         <td><input type="checkbox" name="users[]" value="<?php echo $row["user_id"]; ?>" ></td> 
         </td> 
         </tr>
         
      <?php     
    $i++;    

            }      
mysqli_close($conn);

		?>

    </tbody>
  </table>
</form>
<?php 
echo "<center><p>";

if($total_registros>$registros){
if(($pagina - 1) > 0) {
echo "<span class='pactiva' ><a href='?pagina=".($pagina-1)."' style='color:blue'>&laquo; Anterior</a></span> ";
}
// Numero de paginas a mostrar
$num_paginas=10;
//limitando las paginas mostradas
$pagina_intervalo=ceil($num_paginas/2)-1;

// Calculamos desde que numero de pagina se mostrara
$pagina_desde=$pagina-$pagina_intervalo;
$pagina_hasta=$pagina+$pagina_intervalo;

// Verificar que pagina_desde sea negativo
if($pagina_desde<1){ // le sumamos la cantidad sobrante para mantener el numero de enlaces mostrados $pagina_hasta-=($pagina_desde-1); $pagina_desde=1; } // Verificar que pagina_hasta no sea mayor que paginas_totales if($pagina_hasta>$total_paginas){
$pagina_desde-=($pagina_hasta-$total_paginas);
$pagina_hasta=$total_paginas;
if($pagina_desde<1){
$pagina_desde=1;
}
}

for ($i=$pagina_desde; $i<=$pagina_hasta; $i++){
if ($pagina == $i){
echo "<span class='pnumero' style='color:black' >".$pagina."</span> ";
}else{
echo "<span class='active' ><a style='color:blue' href='?pagina=$i'>$i</a></span> ";
}
}

if(($pagina + 1)<=$total_paginas) {
echo " <span class='pactiva'><a style='color:blue' href='?pagina=".($pagina+1)."'>Siguiente &raquo;</a></span>";
}
}
echo "</p></center>";


 ?>

</body>

<?php

include "conexion.php";
if (isset($_POST['eliminar']) && !empty($_POST['users'])) {
        $ids = implode(',', $_POST['users']);
    $query="DELETE FROM usuarios_industrial WHERE user_id in ($ids)";    
    //$resultado=$conn->query($query);
    mysqli_query($conn,"SET FOREIGN_KEY_CHECKS=0");
    mysqli_query($conn,$query) or die ("Error".mysqli_error($conn));
       echo'<script type="text/javascript">
                alert("Se ha eliminado el/los usuarios.");
                window.location="configuracionUsuarios.php";
                </script>';
  } 


	include "footer.php";

 ?>
