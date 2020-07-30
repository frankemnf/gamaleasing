<?php
	
	$AutoId=$_POST["AutoId"];
	$TipoId=$_POST["TipoId"];
	$Cant=$_POST["Cant"];

	$urlped = "http://www.autosusados.cl/Servicios/ServicioContar.ashx?AutoId=".$AutoId."&TipoId=".$TipoId."&Cant=".$Cant;
	
	//echo 'urlped = '.$urlped.'<br/>';
	$ch = curl_init();
	// set url
	curl_setopt($ch, CURLOPT_URL, $urlped);
	
	//return the transfer as a string
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	// $output contains the output string
	$output = (curl_exec($ch));
	
	echo $output;

?>