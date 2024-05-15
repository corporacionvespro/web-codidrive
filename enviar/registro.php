<?php
$nombres = $_POST["nombres"];
$empresa = $_POST["empresa"];
$correo = $_POST["correo"];
$whatsapp = $_POST["whatsapp"];


$message = '
<html>'.
	'<head><title>Email con HTML</title></head>'.
	'<body><h1>Email con HTML</h1>'.
	'Esto es un email que se envía en el formato HTML'.
	'<hr>'.
	'Enviado por mi programa en PHP'.
	'<img style="display:block;margin-left: auto; margin-right: auto;" src="https://as.com/meristation/imagenes/2019/06/10/betech/1560195710_365328_1560195771_noticia_normal.jpg" />'.
	
	'</body>'.
	'</html>'; 

$destinatario = "henrydelgadomar@gmail.com";
$subject = "NUEVO CLIENTE";
$msg = "NOMBRE: $nombres \n";
$msg .= "ASUNTO: nuevo cliente \n";
$msg .= "MENSAJE: Empresa: $empresa \n";
$msg .= "Correo: $correo \n";
$msg .= "Whatsapp: $whatsapp";


$headers .= 'MIME-Version: 1.0' . "\r\n".
'Content-type: text/html; charset=utf-8' . "\r\n".
'From: vespro'."\r\n".
			'Correo: '.$correo."\r\n".
	'Desinatario: '.$destinatario."\r\n".
	'X-Mailer: PHP/'.phpversion();

if (mail($destinatario, $subject, $message, $headers)) {
	echo '<p class="ContactoC-confirm">Sus datos han sido enviados, un asesor se comunicará con usted a la brevedad. </p>';
} else {
	echo '<p>El envío de datos ha fallado.</p>';
}

$cn = new PDO("mysql:host=localhost;dbname=landing;charset=utf8", "root", "");
$query = "INSERT INTO cliente (celular, nombre, empresa, correo) VALUES ('".$whatsapp."', '".$nombres."', '".$empresa."', '". $correo."');";
$result = $cn->prepare($query);
$exec = $result->execute();
if ($exec) {
	echo 'Cliente registrado correctamente';
}


       

       
?>