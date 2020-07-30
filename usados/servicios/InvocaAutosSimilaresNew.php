<?php

	$clienteid=$_POST["Cliente"];
	$precio=$_POST["Precio"];
	
	$urlped = "http://www.autosusados.cl/Servicios/InvocaAutosSimilaresNew.ashx?Cliente=".$clienteid."&Precio=".$precio;
	
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