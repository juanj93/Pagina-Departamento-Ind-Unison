<?php 

	$para = 'dany_cute_@hotmail.com';
	$asunto = 'Contacto sitio Ing Industrial';

    error_reporting(0);
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
            die('Error');
    }

	$nombre = filter_input(INPUT_POST, 'nombre');
	$correo = filter_input(INPUT_POST, 'correo');
	$mensaje = filter_input(INPUT_POST, 'mensaje');

    $headers = 	'From: '.$correo.'' . "\r\n" .
    			'Reply-To: '.$correo.'' . "\r\n" .
    			'X-Mailer: PHP/' . phpversion();
    
    $sentMail = @mail($para, $asunto, $nombre, $headers);
    
    $output;

    if($sentMail)
    {
        $output = json_encode(array('typeMsg'=>'error', 'textMsg' => 'Su mensaje no pudo ser enviado, intentelo de nuevo.'));
    }else{
        $output = json_encode(array('typeMsg'=>'ok', 'textMsg' => '¡Muchas gracias por ponerse en contacto con nosotros!'));
    }

    echo $output;
?>