<?php

    if (isset($_POST['eliminar'])) {
    $ids = implode(',', $_POST['users']);
    $query="DELETE FROM usuarios_industrial WHERE user_id in ($ids)";    
    $resultado=$conn->query($query);
     echo "<script language=\"javascript\">
                  window.location.href=\"configuracionUsuarios.php\";
                  </script>";
  }
?>