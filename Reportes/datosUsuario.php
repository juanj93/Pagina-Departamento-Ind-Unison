<?php 

include "conexion.php";

  
$validUser = mysqli_real_escape_string($conn, $_SESSION['nombre']);
$sql= "select * from usuarios_industrial where name= '".$validUser."'";
$result=mysqli_query($conn, $sql);

    while ($row=mysqli_fetch_array($result)) {
            $id=$row['user_id'];
            $tipo=$row['tipo'];
            $name=$row['name'];
            $user=$row['userName'];
            $password=$row['password'];
            $mail=$row['email'];

    }     
   
 ?>