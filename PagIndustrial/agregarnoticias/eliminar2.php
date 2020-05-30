<?php 

        // file: delete.php
    require("../conexion.php");
    $id = $_GET['id'];
    $result=mysqli_query($conn, "SELECT imagen FROM noticias WHERE id_noticias =".$_GET['id']);
    $row = mysqli_fetch_array($result);
    unlink("imagenes/".$row['imagen']);
    @mysqli_query($conn, "DELETE FROM noticias WHERE id_noticias =".$_GET['id']);
    header("location:vernoticias.php");
 ?>