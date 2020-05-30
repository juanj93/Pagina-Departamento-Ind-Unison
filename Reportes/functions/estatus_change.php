<?php

  include('conexion.php');
    
    //Variables basicas para los correos, estan serán las mismas no cambiarán
    $subject="Su reporte ha cambiado de estatus.";
    $mensajeProceso="Su reporte de insidencias del Departamento de Ingeniería Industrial 
                      ahora esta en proceso.";
    $mensajeFinalizado="Su reporte de insidencias del Departamento de Ingeniería Industrial 
                      ahora esta en Finalizado.";                 
    $headers="De: Sistemas de reportes, Departamento de Ingeniería Industrial";                  

    if (isset($_POST['btnProceso'])&& !empty($_POST['reports'])) {

   		 $ids = implode(',', $_POST['reports']);// ids de reportes
      
        $queryIdUsers=mysqli_query($conn,"SELECT user_id FROM reportes_industrial WHERE reporte_id in ($ids)");//query para ids users
        while ($row=mysqli_fetch_array($queryIdUsers)) {  //Guardamos el resultado en un array
                $idUs=$row['user_id'];
                $idUsers[]=$idUs;                         //Array de resultados
               // echo $row['user_id'];
          }

        $idUsersReportes=implode(',',$idUsers);           //descomponemos el array con ,
       // echo $idUsersReportes;

        $queryEmails=mysqli_query($conn,"SELECT email FROM usuarios_industrial WHERE user_id in ($idUsersReportes)"); //query para emails  
        while ($row=mysqli_fetch_array($queryEmails)) {  //Guardamos el resultado en un array
                $mailUs=$row['email'];
                $mailUsers[]=$mailUs;                         //Array de resultados
               // echo $row['user_id'];     

                //envio de correos
                mail($row['email'], $subject,$mensajeProceso,$headers);
        }
        //$mailUserReportes=implode(',',$mailUsers); //Array con los correos a enviar
       // echo $mailUserReportes;

        //Actualizacion de reporte 
  	   $query="UPDATE reportes_industrial SET estatus='En proceso',fecha_mod= CURRENT_TIMESTAMP WHERE reporte_id in ($ids)";    
   		 $resultado=$conn->query($query);  
   		 echo "<script language=\"javascript\">
                alert('Se ha(n) actualizado el/los reporte(s).');
                window.location.href=\"index.php\";
                 </script>";
  	}


    //btn finalizado

  	if (isset($_POST['btnFinalizado']) && !empty($_POST['reports'])) {
   		 $ids = implode(',', $_POST['reports']);
       $queryIdUsers=mysqli_query($conn,"SELECT user_id FROM reportes_industrial WHERE reporte_id in ($ids)");//query para ids users
        while ($row=mysqli_fetch_array($queryIdUsers)) {  //Guardamos el resultado en un array
                $idUs=$row['user_id'];
                $idUsers[]=$idUs;                         //Array de resultados
               // echo $row['user_id'];
          }

        $idUsersReportes=implode(',',$idUsers);           //descomponemos el array con ,
       // echo $idUsersReportes;

        $queryEmails=mysqli_query($conn,"SELECT email FROM usuarios_industrial WHERE user_id in ($idUsersReportes)"); //query para emails  
        while ($row=mysqli_fetch_array($queryEmails)) {  //Guardamos el resultado en un array
                $mailUs=$row['email'];
                $mailUsers[]=$mailUs;                         //Array de resultados
               // echo $row['user_id'];     

                //envio de correos
                mail($row['email'], $subject,$mensajeFinalizado,$headers);
        }
  	     $query="UPDATE reportes_industrial SET estatus='Finalizado',fecha_mod= CURRENT_TIMESTAMP WHERE reporte_id in ($ids)";    
   		 $resultado=$conn->query($query);  
   		  echo "<script language=\"javascript\">
                  alert('Se ha(n) actualizado el/los reporte(s).');
                  window.location.href=\"index.php\";
                  </script>";
  	}

 
?>