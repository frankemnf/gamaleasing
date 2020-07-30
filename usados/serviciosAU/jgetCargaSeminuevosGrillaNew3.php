<?php

$marcaid=$_REQUEST["marcaid"];
$catid=$_REQUEST["catid"];
$clienteunico=$_REQUEST["clienteunico"];
$clienteid=$_REQUEST["clienteid"];
$modeloid=$_REQUEST["modeloid"];
$anodesde=$_REQUEST["anodesde"];
$anohasta=$_REQUEST["anohasta"];
$preciohasta=$_REQUEST["preciohasta"];
$transmision=$_REQUEST["transmision"];
$bencina=$_REQUEST["bencina"];
$pagina=$_REQUEST["pag"];
$por_pagina=$_REQUEST["por_pagina"];
$orden=$_REQUEST["orden"];
$etiqueta=$_REQUEST["etiqueta"];
$kilo=$_REQUEST["kilo"];


$urlped = "http://www.autosusados.cl/Servicios/jgetCargaSeminuevosGrillaNew3.ashx?marcaid=".$marcaid."&catid=".$catid."&clienteunico=".$clienteunico."&clienteid=".$clienteid."&modeloid=".$modeloid."&anohasta=".$anohasta."&preciohasta=".$preciohasta."&transmision=".$transmision."&bencina=".$bencina."&pag=".$pagina."&por_pagina=".$por_pagina."&orden=".$orden."&etiqueta=".$etiqueta;
//$urlped = "http://localhost:53108/D3N4/Servicios/jgetCargaSeminuevosGrillaNew3.ashx?marcaid=".$marcaid."&catid=".$catid."&clienteunico=".$clienteunico."&clienteid=".$clienteid."&modeloid=".$modeloid."&anohasta=".$anohasta."&preciohasta=".$preciohasta."&transmision=".$transmision."&bencina=".$bencina."&pag=".$pagina."&por_pagina=".$por_pagina."&orden=".$orden."&etiqueta=".$etiqueta;
	
	//echo 'urlped = '.$urlped.'<br/>';
	$ch = curl_init();
	// set url
	curl_setopt($ch, CURLOPT_URL, $urlped);
	
	//return the transfer as a string
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	// $output contains the output string
	$output = (curl_exec($ch));
	
	//echo 'output = '.$output.'<br/>';
	//$data= simplexml_load_string($output,null);
	//$geoloc = json_decode($output, true);
	
	echo $output;
?>