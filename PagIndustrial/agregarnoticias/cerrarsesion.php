<?php 

session_start();

//vaciamos datos de session
$_SESSION= array();
//destruir session
session_destroy();

//redirrecionar al inicio
header("location:index.php");
 ?>