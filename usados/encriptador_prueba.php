<?php
set_time_limit(700);
session_start();


var_dump($_POST);

die;
if(isset($_SESSION['cliente'])&&!empty($_SESSION['cliente'])){
	
	$recaptcha=$_POST["g-recaptcha-response"];
	if($recaptcha){
	
	$secret="6LdukE4UAAAAAPgRXJYVz6Wq3RRoiJod8qqsp5x3";
	$objcorreo=new correos();
	
	
	
	$parametros="";
	
	$key='187964652315485';
	
	$tipo_mail=$_POST["tipo_mail"];
	
	
	
	switch($tipo_mail){
		
		case 1:
		
			$autoid=$_POST["IdAuto"];
			
			$txtNombre=$_POST["txtNombre"];
			$txtEmail=$_POST["txtEmail"];
			$txtFono=$_POST["txtFono"];
			$txtMensaje=$_POST["txtMensaje"];
			$clienteid=$_POST["ClienteID"];
			
			//
			$precio=$_POST["Precio"];
			$marca=$_POST["Marca"];
			$modelo=$_POST["Modelo"];
			$ano=$_POST["Ano"];
			$URLactual=$_POST["URLactual"];
			$Fono1Automotora=$_POST["fono1automotora"];
			$Fono2Automotora=$_POST["fono2automotora"];
			
			$pie=$_POST["pie"];
			$num_cuotas=$_POST["num_cuotas"];
			$autopago=$_POST["autopago"];
			//
			
			$Tabla= $_POST["Tabla"];
			
			
			$objcorreo->guarda_correo($autoid,$txtNombre,$txtEmail,$txtFono,$txtMensaje,$clienteid,$precio,$marca,$modelo,$ano,$Tabla);
			
			$parametros="token=".$key."&IdAuto=".$autoid."&txtNombre=".$txtNombre."&txtEmail=".$txtEmail."&txtFono=".$txtFono."&txtMensaje=".$txtMensaje."&clienteid=".$clienteid."&tipo_mail=".$tipo_mail."&Tabla=".$Tabla."&URLactual=".$URLactual."&Ano=".$ano."&Fono1Automotora=".$Fono1Automotora."&Fono2Automotora=".$Fono2Automotora."&pie=".$pie."&num_cuotas=".$num_cuotas."&autopago=".$autopago;
		
		break;
		case 2:
		
			$nombred=$_POST["nombred"];
			$maild=$_POST["maild"];
			$nombrep=$_POST["nombrep"];
			$mailp=$_POST["mailp"];
			$mensaje=$_POST["mensaje"];
			
			$FonoAutomotora="";
			
			$IdAuto=$_POST["IdAuto"];
			$Tabla= $_POST["Tabla"];
			
			$ClienteID=$_POST["clienteid"];
			$URLactual=$_POST["URLactual"];
			
			
			$parametros="token=".$key."&nombred=".$nombred."&maild=".$maild."&nombrep=".$nombrep."&mailp=".$mailp."&mensaje=".$mensaje."&FonoAutomotora=".$FonoAutomotora."&IdAuto=".$IdAuto."&Tabla=".$Tabla."&clienteid=".$ClienteID."&tipo_mail=".$tipo_mail."&URLactual=".$URLactual;
		
		break;
	
	}

	
	$url="http://stock.destacados.cl/mail_cotizaclientes/envio_correo3.php";
	$sesion = curl_init($url);
	// definir tipo de petición a realizar: POST
	curl_setopt ($sesion, CURLOPT_POST, true); 
	// Le pasamos los parámetros definidos anteriormente
	curl_setopt ($sesion, CURLOPT_POSTFIELDS, $parametros); 
	// sólo queremos que nos devuelva la respuesta
	curl_setopt($sesion, CURLOPT_HEADER, false); 
	curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
	// ejecutamos la petición
	$response=utf8_decode(curl_exec($sesion)); 
	// cerramos conexión
	curl_close($sesion); 
	
	
	echo $response;
	}else{
		echo json_encode("debe completar el captcha.");
	}
	
}else{
	
	echo json_encode("Usted no tiene permiso para acceder a este servicio. 44");
	
}


class correos{
	function guarda_correo($autoid,$txtNombre,$txtEmail,$txtFono,$txtMensaje,$clienteid,$precio,$marca,$modelo,$ano,$Tabla){
	
		$parametros="autoid=".$autoid."&txtNombre=".$txtNombre."&txtEmail=".$txtEmail."&txtFono=".$txtFono."&txtMensaje=".$txtMensaje."&clienteid=".$clienteid."&precio=".$precio."&marca=".$marca."&modelo=".$modelo."&ano=".$ano."&Tabla=".$Tabla;
		$url="http://www.autosusados.cl/Servicios/InvocaCotizacion.ashx";
		$sesion = curl_init($url);
		// definir tipo de petición a realizar: POST
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los parámetros definidos anteriormente
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $parametros); 
		// sólo queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// ejecutamos la petición
		$response=utf8_decode(curl_exec($sesion)); 
		// cerramos conexión
		curl_close($sesion); 
		
		
		echo $response;
	
	
	}	
}

?>