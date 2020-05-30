<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<title>Departamento de industrial</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
	<script type="text/javascript" src="js/jquery-easing-1.3.pack.js"></script>
	<script type="text/javascript" src="js/jquery-easing-compatibility.1.2.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato:300,400">
	<script type="text/javascript" src="js/menuresponsive.js"></script>

	<script type="text/javascript" src="js/coda-slider.1.1.1.pack.js"></script>
	<script type="text/javascript" src="js/slider.js"></script>

</head>

<body>
	<div class="container">
	<center><img class="img-responsive" src="img/bannerIndustrial.jpg"></center>
			
			<nav class="navbar">
			  <div class="container-fluid">			    
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">			        
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			    </div>
			    <div class="collapse navbar-collapse" id="menu">
			      <ul class="navbar-nav">
			      	<li><a href="index.php">Inicio</a></li>
			        <li ><a href="departamento.php">Departamento</a></li>
			        <li><a href="noticias.php">Noticias</a></li>
			        <li class="dropdown">
			          <a class="dropdown-toggle" data-toggle="dropdown" >Oferta Educativa <b class="caret"></b></a>
			          <ul class="dropdown-menu">
			           <li><a href="http://mii.isi.uson.mx/">Maestria en Ingenieria Sistemas y Tecnologia</a></li>
                        <li class="divider"></li>
                        <li><a href="http://www.gds.uson.mx/ms/">Maestria en Sustentabilidad</a></li>
                        <li class="divider"></li>
                        <li><a href="http://www.gds.uson.mx/eds/">Especialidad en Desarrollo Sutentables</a></li>
                        <li class="divider"></li>
                        <li><a href="industrial.php">Industrial y de Sistemas</a></li>
                        <li class="divider"></li>
                        <li><a href="sistemas.php">Sistemas de Informacion</a></li>
                        <li class="divider"></li>
                        <li><a href="mecatronica.php">Mecatronica</a></li>
			            </ul>
			        </li>
			        <li><a href="contacto.php">Contacto</a></li>
			      </ul>	     
			      </div>
			  </div>
			</nav>		
	


    <h1>Departamento de Industrial</h1>
	
	<div class="container">
	<div id="page-wrap">					
	<div class="slider-wrap">
		<div id="main-photo-slider" class="csw">
			<div class="panelContainer">

			<?php 
			include ('conexion.php');
			header("Content-Type: text/html;charset=utf-8");
			mysqli_query($conn, "SET NAMES 'utf8'");
                $result = mysqli_query($conn, "SELECT * FROM noticias ORDER BY fecha desc LIMIT 4");
                    while ($row = mysqli_fetch_array($result)) {
                     $ruta = "agregarnoticias/imagenes/" . $row['imagen'];
                      ?>								
				
				<div class="panel" title="<?php echo $row['id_noticias'];?>">
					<div class="wrapper">
						<img src="<?php echo $ruta; ?>"  class="floatLeft" style=""/>
						<h2><?php echo $row['titulo'];?></h2>
						<p><?php echo substr($row['contenido'],0,500) ;?>... </p> <a class="readmore" style="color:black;" href="noticia.php?id=<?php echo $row['id_noticias'];?>">Leer noticia completa </a>
					</div>
				</div>
				 <?php }?>
			</div>
		</div>

	<div class="movers-row">
		<?php
		$i =0;       
		$result = mysqli_query($conn, "SELECT * FROM noticias ORDER BY fecha desc LIMIT 4");
                    while ($row = mysqli_fetch_array($result)) {
                     $i =$i +1;
                      ?>			

			<div class="linea"><a href="#<?php echo $i;?>" class="cross-link" style="text-align:center;"><?php echo substr($row['titulo'],0,70); ?></a></div>
			
		<?php  } ?>		
	</div>

</div>
	
	</div>
<br><br>

<br>
	<div class="row industrial">
  <div class="col-md-4">
  <img class="logoaxis" src="img/logoaxis.png">
    <h5>SIMPOSIO INTERNACIONAL DE INGENIERÍA, SISTEMAS Y TECNOLOGÍA</h5>
 		<p class="text-justify">Axis, es un magno evento organizado por estudiantes, para estudiantes, con la finalidad de brindar un espacio, en el que los 	participantes puedan ilustrarse de las nuevas tendencias en el área de tecnología e industria. Así mismo, hacer que los alumnos despierten el 	   interés de sus respectivas carreras...</p>

    <a href="http://www.simposioaxis.com" tarjet="_blank">Ver más</a>
   
  </div>
  <div class="col-md-4">
   <img  class="cstilogo" src="img/logocsti.png">
  	
    <h5>CENTRO DE SERVICIO DE TECNOLOGIAS DE LA INFORMACIÓN</h5>
    <a href="#" tarjet="_blank">Ver más</a>
    
  </div>

  <div class="col-md-4">
  <img src="img/logoreporte.png" class="logoreporte">
    <h5>SISTEMA DE REPORTES</h5>
    <p class="text-justify"> Aqui podra reportar las incidencias de las aulas</p>
  </div>
	</div>
   </div>
   
 <?php include "footer.php"; ?>

</body>
</html>

