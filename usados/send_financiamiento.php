<?php

$objcorreo = new correos();

$myemail =  ' aalvarez@kaufmann.cl';
$cc = '';
$bcc = 'indicadores@destacados.cl';

$nombre = $_REQUEST['nombre'];
$rut = $_REQUEST['rut'];
$telefono = $_REQUEST['telefono'];
$email = $_REQUEST['email']; 
$marcav = $_REQUEST['marca'];
$modelov = $_REQUEST['modelo'];
$vehiculoa = $_REQUEST['anio']; 
$creditom = $_REQUEST['creditom'];
$cuotas = $_REQUEST['cuotas'];
$mensaje = $_REQUEST['comentarios'];
$asunto = "Formulario de Financiamiento";

//cambiar url
$urllogo = "https://www.kaufmannusados.cl/";
$urltitulo = "www.kaufmannusados.cl";
//cambiar url

$message ='';

$message=$message.'<table width="400" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">';
$message=$message.'<tr>';
$message=$message.'<td align="center">';
$message=$message.'   </td>';
$message=$message.'</tr>';
$message=$message.'<tr>';
$message=$message.'<td align="center">';
$message=$message.'   <img src="'.$urllogo.'complementos/image/logoEmail.png" width="200"></td>';
$message=$message.'</tr>';
$message=$message.'<tr>';
$message=$message.'<td align="left" style="padding:15px 0 5px 0; font-size:13px; border-bottom:1px dotted #3c3c3d;">Kaufmann Seminuevos | Financimiento. Estos son los detalles:</td>';
$message=$message.'</tr>';
$message=$message.'<tr>';
$message=$message.'<td align="left"  style="padding:3px 10px; color:#3c3c3b ; font-size:12px; font-weight:bold">Nombre:</td><td>'.$nombre.'</td>';
$message=$message.'</tr>';

$message=$message.'<tr>';
$message=$message.'<td align="left"  style="padding:3px 10px; color:#3c3c3b ; font-size:12px; font-weight:bold">RUT:</td><td>'.$rut.'</td>';
$message=$message.'</tr>';

$message=$message.'<tr>';
$message=$message.'<td align="left"  style="padding:3px 10px; color:#3c3c3b ; font-size:12px; font-weight:bold">Tel&eacute;fono:</td><td>'.$telefono.'</td>';
$message=$message.'</tr>';
$message=$message.'<tr>';
$message=$message.'<td align="left" style="padding:3px 10px; color:#3c3c3b ; font-size:12px; font-weight:bold">E-mail:</td><td>'.$email.'</td>';
$message=$message.'</tr>';

$message=$message.'<tr>';
$message=$message.'<td align="left" style="padding:3px 10px; color:#3c3c3b ; font-size:12px; font-weight:bold">Marca Veh&iacute;culo: </td><td>'.$marcav.'</td>';
$message=$message.'</tr>';

$message=$message.'<tr>';
$message=$message.'<td align="left" style="padding:3px 10px; color:#3c3c3b ; font-size:12px; font-weight:bold">Modelo Veh&iacute;culo: </td><td>'.$modelov.'</td>';
$message=$message.'</tr>';

$message=$message.'<tr>';
$message=$message.'<td align="left" style="padding:3px 10px; color:#3c3c3b ; font-size:12px; font-weight:bold">A&ntilde;o Veh&iacute;culo: </td><td>'.$vehiculoa.'</td>';
$message=$message.'</tr>';

$message=$message.'<tr>';
$message=$message.'<td align="left" style="padding:3px 10px; color:#3c3c3b ; font-size:12px; font-weight:bold">Credito: </td><td>'.$creditom.'</td>';
$message=$message.'</tr>';

$message=$message.'<tr>';
$message=$message.'<td align="left" style="padding:3px 10px; color:#3c3c3b ; font-size:12px; font-weight:bold">Cuotas:</td><td>'.$cuotas.'</td>';
$message=$message.'</tr>';

$message=$message.'<tr>';
$message=$message.'<td align="center" height="30px" style="padding:0 0 10px 0;">&nbsp;</td>';
$message=$message.'</tr>';
$message=$message.'<tr>';
$message=$message.'<td align="left" style="padding:3px 10px; color:#3c3c3b ; font-size:12px; font-weight:bold">Mensaje:</td>';
$message=$message.'</tr>';
$message=$message.'<tr>';
$message=$message.'<td align="center" height="30px" style="padding:0 0 10px 0;">'.$mensaje.'</td>';
$message=$message.'</tr>';
$message=$message.'<tr>';
$message=$message.'<td align="center" style="padding:10px 0 5px 0; color:#3c3c3b ; font-size:13px;">Siguie visitando nuestro sitio en <span style="color:#436aab; font-weight:bold;"><a href="'.$urllogo.'">'.$urltitulo.'</a></span></td>';
$message=$message.'</tr>';

$message=utf8_decode($message.'</table>');

//echo "message= ".$message;

$from_name=utf8_decode($nombre);
$from_mail=$email;
//$message="HOLA...";
$para=' aalvarez@kaufmann.cl';
$bcc = ' ';
//$para=$email;

/*if($txtEmailcc){
		$para .= ', '.$txtEmailcc;
}*/

//$replyto=$txtEmailcc;
$txtEmailcc=$email;

//$bcc="correocopia@autosusados.cl, ".$txtEmailbcc;
$titulo=utf8_decode($asunto);

//echo $bcc;

$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales

//$cabeceras .= 'To: '.$EmailAutomotora. "\r\n";
$cabeceras .= 'From:'.$from_name.'<'.$from_mail.'>' . "\r\n";
$cabeceras .= 'Cc:'.$txtEmailcc. "\r\n";
$cabeceras .= 'Bcc:'.$bcc. "\r\n";

try {
	
	mail($para, $titulo, $message, $cabeceras);
	$autoid=0;
	$clienteid=486;
	$pie=0;
	$autopago= $marcav.' '.$modelov.' '.$vehiculoa;
	$mcontacto='Correo';
	$precio=$creditom;
	$Tabla=2;
	$mensaje=$mensaje." Credito: ".$creditom;


	$objcorreo->guarda_correo($autoid, $nombre, $email, $telefono, $mensaje, $clienteid, $precio, $marcav, $modelov, $vehiculoa, $Tabla, $rut,
	$pie,$cuotas,$autopago,$mcontacto);
	
	echo json_encode("1");
	
	
} catch (Exception $e) {
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

class correos
{
	function guarda_correo($autoid, $txtNombre, $txtEmail, $txtFono, $txtMensaje, $clienteid, $precio, $marca, $modelo, $ano, $Tabla, $txtrut,
	$pie,$num_cuotas,$autopago,$mcontacto)
	{

		$parametros = "autoid=" . $autoid . "&txtNombre=" . $txtNombre . "&txtEmail=" . $txtEmail . "&txtFono=" . $txtFono . "&txtMensaje=" . $txtMensaje
		. "&clienteid=" . $clienteid . "&precio=" . $precio . "&marca=" . $marca . "&modelo=" . $modelo . "&ano=" . $ano . "&Tabla=" . $Tabla
		. "&rut=" . $txtrut. "&pie=" . $pie. "&cuotas=" . $num_cuotas. "&autopago=" . $autopago. "&mcontacto=" . $mcontacto. "&tipo=40";
		//echo "parametros = ".$parametros;
		$url = "http://www.autosusados.cl/Servicios/GuardarOtrosCorreos.ashx";
		//$url = "http://localhost:53106/D3N4/Servicios/GuardarOtrosCorreos.ashx";
		$sesion = curl_init($url);
		// definir tipo de petición a realizar: POST
		curl_setopt($sesion, CURLOPT_POST, true);
		// Le pasamos los parámetros definidos anteriormente
		curl_setopt($sesion, CURLOPT_POSTFIELDS, $parametros);
		// sólo queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false);
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// ejecutamos la petición
		$response = utf8_decode(curl_exec($sesion));
		// cerramos conexión
		curl_close($sesion);


		echo $response;
	}
}	

?>

