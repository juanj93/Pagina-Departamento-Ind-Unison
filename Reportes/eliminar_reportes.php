<?php

  include('conexion.php');
    
    if (isset($_POST['eliminar'])) {
    $ids = implode(',', $_POST['reportes']);
    $query="DELETE FROM reportes_industrial WHERE reporte_id in ($ids)";    
    $resultado=$conn->query($query);
     echo "<script language=\"javascript\">
                  window.location.href=\"reportes.php\";
                  </script>";
  }
?>