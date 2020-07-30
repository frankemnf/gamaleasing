<?php
	$clienteid=$_REQUEST["ClienteId"];
	$estadoid=$_REQUEST["EstadoId"];
	$maxvehi=$_REQUEST["maximo"];
	
	$urlped = "http://www.autosusados.cl/Servicios//jgetAutosDestacadosNew.ashx?ClienteId=".$clienteid."&EstadoId=".$estadoid."&maximo=".$maxvehi;
	//$urlped = "http://localhost:53108/D3N4/Servicios/jgetAutosDestacadosNew.ashx?ClienteId=".$clienteid."&EstadoId=".$estadoid."&maximo=".$maxvehi;
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