<?php
	
	$Cliente=$_POST["Cliente"];				
	$urlped = "http://www.autosusados.cl/Servicios/InvocaSucursalesCliente.ashx?Cliente=".$Cliente."&_=1495581439674";
	
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