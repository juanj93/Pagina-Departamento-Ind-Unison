<?php


include "conexion.php";

if ($_GET['pdf']) {
    $ids = implode(',', $_GET['reportes']);
$result = mysqli_query($conn,"SELECT r.reporte_id, u.name as solicitante, r.tipo, r.ubicacion, r.fecha_mod,r.fecha_inicio, r.estatus, SUBSTRING(r.descrip, 1,80) as descripcion 
  FROM reportes_industrial r, usuarios_industrial u 
   WHERE r.user_id=u.user_id AND reporte_id in ($ids)");
   $i=0;
while($row = mysqli_fetch_array($result)) {
      if($i%2==0)
   
    $content = "
    
<style>
img  {
    float: left;
} 
h4
{
margin-top:5px;
margin-left:15px;

}

titulo{

    margin-top:20px;
}
</style>
<page>
    <img src=img/logoIndustrial.png width=200 height=100>
    <h2 class=titulo text align=center>Reporte de Incidencias en el Departamento</h2>
    <h5 text align=center>Folio: $row[reporte_id] </h5>
    <br>
    <br>
    <br>
    <br>
    <h4 margin-left: 15px>Tipo de trabajo: $row[tipo]</h4>
    <h4 margin-left: 15px>Solicitante: $row[solicitante]</h4>
    <h4 margin-left: 15px>Ubicación: $row[ubicacion]</h4>
    <h4 margin-left: 15px>Descripcion del trabajo:</h4>
    <p>$row[descripcion]</p>
    <h4>Fecha de inicio: $row[fecha_inicio]</h4>
    <h4>Fecha de Modificacion:  $row[fecha_mod]</h4>
    <h4>Estatus: $row[estatus]</h4>
    <br>
    <br>
    <br><br><br>
    <br><br><br>
    <br><br><br>
    <br><br><br>
    <br><br><br>
    <br><br><br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <p>Este documento fue hecho en el Sistema de Reportes, desarrollado por CSTI</p>
  </page>
"
;
}
}else{

    header("Location:reportes.php");

}
    require('html2pdf_v4.03/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','es',true,'UTF-8');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('exemple.pdf');
?>
 
