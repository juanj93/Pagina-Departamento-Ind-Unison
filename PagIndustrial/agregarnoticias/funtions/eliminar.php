 <?php 
    
    $i++;  
        }
        mysqli_close($conn);
     ?>
         <?php
    include "../conexion.php";

//    if (isset($_POST['submit']) && isset($_REQUEST['noticias'])) {
      
    $ids = implode(',', $_POST['noticias']);
    $query="DELETE FROM noticias WHERE id_noticias in ($ids)";
   
    $resultado=$conn->query($query);
     echo "<script language=\"javascript\">
                  window.location.href=\"vernoticias.php\";
                  </script>";
  //}
?>