<?php

	$marcaid=$_POST["marcaid"];
	$categoriaid=$_POST["catid"];
	$clienteid=$_POST["clienteid"];

	//$urlped = "http://localhost:53106/D3N4/Servicios/jgetModelosCliente.ashx?marcaid=".$marcaid."&catid=".$categoriaid."&clienteid=".$clienteid;
	$urlped = "http://www.autosusados.cl/Servicios/jgetModelosCliente.ashx?marcaid=".$marcaid."&catid=".$categoriaid."&clienteid=".$clienteid;
	
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