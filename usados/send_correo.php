<?php
$objcorreo = new correos();


$myemail =  'contacto.usados@intouch.cl';
//$cc = '';
$bcc = 'diseno@destacados.cl';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$email = $_POST['email']; 
$asunto = "Formulario de Contacto";	

	
	$message ='';
	
	$message=$message.'<table width="400" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">';
  	$message=$message.'<tr>';
    $message=$message.'<td align="center">';
    $message=$message.'   </td>';
  	$message=$message.'</tr>';
	$message=$message.'<tr>';
 	$message=$message.'<td align="center">';
    $message=$message.'   <img src="complementos/image/logoEmail.png" width="200"></td>';
  	$message=$message.'</tr>';
  	$message=$message.'<tr>';
    $message=$message.'<td align="left" style="padding:15px 0 5px 0; font-size:13px; border-bottom:1px dotted #3c3c3d;">Raul Repetto | Contacto. Estos son los detalles:</td>';
  	$message=$message.'</tr>';
  	$message=$message.'<tr>';
    $message=$message.'<td align="left"  style="padding:3px 10px; color:#3c3c3b ; font-size:12px; font-weight:bold">Nombre:</td><td>'.$nombre.'</td>';
  	$message=$message.'</tr>';
	
	$message=$message.'<tr>';
    $message=$message.'<td align="left"  style="padding:3px 10px; color:#3c3c3b ; font-size:12px; font-weight:bold">Apellido:</td><td>'.$apellido.'</td>';
  	$message=$message.'</tr>';
	
	$message=$message.'<tr>';
    $message=$message.'<td align="left"  style="padding:3px 10px; color:#3c3c3b ; font-size:12px; font-weight:bold">Tel&eacute;fono:</td><td>'.$telefono.'</td>';
  	$message=$message.'</tr>';
    $message=$message.'<tr>';
    $message=$message.'<td align="left" style="padding:3px 10px; color:#3c3c3b ; font-size:12px; font-weight:bold">E-mail:</td><td>'.$email.'</td>';
  	$message=$message.'</tr>';

	$message=$message.'<tr>';
    $message=$message.'<td align="center" style="padding:10px 0 5px 0; color:#3c3c3b ; font-size:13px;">Sigue visitando nuestro sitio en <span style="color:#436aab; font-weight:bold;"><a href="#">www.sitioweb.cl/</a></span></td>';
  	$message=$message.'</tr>';
  
	$message=utf8_decode($message.'</table>');	
	
	
	$from_name=utf8_decode($nombre);
	$from_mail=$email;
	//$message="HOLA...";
	$para='contacto.usados@intouch.cl';
	//$bcc = '';
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
				//$cabeceras .= 'Bcc:'.$bcc. "\r\n";
	

	try {
		
		mail($para, $titulo, $message, $cabeceras);
		$autoid=0;
		//cambiar id cliente//
		$clienteid=486;
		$pie=0;
		$autopago= "";
		$mcontacto='Correo';
		$precio=0;
		$mensaje=$mensaje;
		$marcav="";
		$modelov="";
		$vehiculoa="";
		$Tabla=3;
		$rut="";
		$nombre=$nombre." ".$apellido;
		$cuotas=0;

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
			. "&rut=" . $txtrut. "&pie=" . $pie. "&cuotas=" . $num_cuotas. "&autopago=" . $autopago. "&mcontacto=" . $mcontacto. "&tipo=30";
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

