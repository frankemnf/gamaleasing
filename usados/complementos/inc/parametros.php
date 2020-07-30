<?php
//Modificar este campo con el correspondiente al sitio del cliente
$Title = 'Nombre De Automotora';
$icon = "../image/favicon.ico";
$eIdAuto = isset($_GET["eIdAuto"])? $_GET["eIdAuto"]: '';

//copiar este parametro
$vpagina = isset($_REQUEST["vpagina"])? $_REQUEST["vpagina"]: '';

/*id facebook que se debe ir cambiando dependiendo del cliente*/

$idfacebook = '920938461322524';

/*iframe mapa*/

// create curl resource
$ch = curl_init();

//Copiar desde aqui-->
if($eIdAuto != ""){

	$urlped = "http://www.autosusados.cl/Servicios/jgetFichaUsado2New.ashx?autoid=".$eIdAuto;
	
	// set url
	curl_setopt($ch, CURLOPT_URL, $urlped);
	
	//return the transfer as a string
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	$output = (curl_exec($ch));
	
	$geoloc = json_decode($output, true);
	
	
	$pCliente = $geoloc[0]["ClienteID"];
	
	$activafinanciamiento=isset($geoloc[0]["ActivadorF"])?$geoloc[0]["ActivadorF"]:0;
	$pPieminimo=$geoloc[0]["pieminimo"];
	$pCuota=$geoloc[0]["Cuota"];
	$pNumcuota=$geoloc[0]["Numcuota"];
	$pCae=$geoloc[0]["Cae"];
	$pVfmg=isset($geoloc[0]["Vfmg"])?$geoloc[0]["Vfmg"]:"";
	$pctc = isset($geoloc[0]["CTC"])?$geoloc[0]["CTC"]:"";
	
	
	$pMarca = $geoloc[0]["Marca"];
	$pModelo = $geoloc[0]["Modelo"];
	$pMoneda = $geoloc[0]["Moneda"];
	$pPrecio = $geoloc[0]["Precio"];
	$pLegal_precio = $geoloc[0]["Legal_precio"];
	$pVersion = $geoloc[0]["Version"];
	$pAnoFab = $geoloc[0]["AnoFab"];
	$pColor = $geoloc[0]["Color"];
	$pKilometros = $geoloc[0]["Kilometros"];
	$pCombustible = $geoloc[0]["Combustible"];
	$pCilindrada = $geoloc[0]["Cilindrada"];
	$pvideo=$geoloc[0]["vVideo"];
	$p360=$geoloc[0]["Vch360"];
	
	if($pKilometros == ''){
		
		$pKilometros = '-';
		
	}
	$pCodigo = $geoloc[0]["Codigo"];
	$pEstado = $geoloc[0]["Estado"];
	$pEtiqueta = $geoloc[0]["Etiqueta"];
	$pEtiquetaN = $geoloc[0]["EtiquetaN"];
	$pBarra = str_replace("'", "\"", $geoloc[0]["pHtml"]);
	
	$pBannerFin = str_replace("'", "\"", $geoloc[0]["pHtmlF"]);
	
	$pTituloC = $geoloc[0]["Titulo"];
	$pColorC = $geoloc[0]["ColorC"];
	
	$pAlt = $pMarca." ".$pModelo." ".$pVersion;
	
	$spDescripcion = str_replace(array('\r\n\r\n', PHP_EOL), ' ',trim($geoloc[0]["Descripcion"]));
	
	$ppDescripcion =  nl2br(htmlspecialchars($spDescripcion));
	
	$array = explode("<br />", $ppDescripcion);
	
	$imuestra = "";
	
	for ($i = 0; $i < count($array); $i++) {
		
		if(strlen(trim($array[$i])) > 0){
			$imuestra.= trim($array[$i])." ";
		}
	}
	
	$pDescripcion =  $imuestra;  
	
	$pContactoID = $geoloc[0]["ContactoID"];	
	
	$pFono1 = $geoloc[0]["Cliente"]["Fono1"];
	$pFono2 = $geoloc[0]["Cliente"]["Fono2"];

//Inicio Nuevo parametros whatsapp y foto url
	$pWhatsapp = $geoloc[0]["WHATSAPP"];	
	$fontcolor = $geoloc[0]["fontcolor"];
//Inicio Nuevo parametros whatsapp y foto url	

	$pNombre = $geoloc[0]["Cliente"]["Nom"];
	$pCalle = $geoloc[0]["Cliente"]["Calle"];
	$pComuna = $geoloc[0]["Cliente"]["Comuna"];
	$pCiudad = $geoloc[0]["Cliente"]["Ciudad"];
	$pUrl = $geoloc[0]["Cliente"]["URL"];
	$pEmail = $geoloc[0]["Contacto"]["Email"];
	$pcCaracAuto = $geoloc[0]["CaracAuto"];

//INICIO SE AGREGARON ESTOS DOS PARAMETROS PARA EL NUEVO MAPA
	$plogo = str_replace("/fachadas","",$geoloc[0]["Cliente"]["Logo"]);
	$lat = $geoloc[0]["Cliente"]["Latitud"];
	$long = $geoloc[0]["Cliente"]["Longitud"];
//FIN SE AGREGARON ESTOS DOS PARAMETROS PARA EL NUEVO MAPA

	$pTransmicion = "";
	if(count($pcCaracAuto) > 0 ){
	
		$pcCaracID = $geoloc[0]["CaracAuto"][0]["CaracID"];
		
	}else{
		$pcCaracID = "";
			
	}
	
	$mhtmlCaractini = '';
	
	foreach($pcCaracAuto as $posicion=>$jugador)
	{
		$pcCaracID = $geoloc[0]["CaracAuto"][$posicion]["CaracID"];
		$pcCaracNombre = ($geoloc[0]["CaracAuto"][$posicion]["CaracNombre"]);
		$pcCantidad = $geoloc[0]["CaracAuto"][$posicion]["Cantidad"];
		$pcDescripcion = $geoloc[0]["CaracAuto"][$posicion]["Descripcion"];
		
		if($pcCaracID == 3){
			
			$mhtmlCaractini = $mhtmlCaractini.'<li> <i class="fa fa-check"></i>' .$pcCantidad." ".$pcCaracNombre.'</li>'; 
			
		}else if($pcCaracID == 16){
			
			$mhtmlCaractini = $mhtmlCaractini.'<li> <i class="fa fa-check"></i>'.$pcCantidad." ".$pcCaracNombre.'</li>'; 
			
		}else if($pcCaracID == 1){
			
			if($pcCantidad == 0){
			
				$mhtmlCaractini = $mhtmlCaractini.'<li><i class="fa fa-check"></i>'.$pcCaracNombre.' Automática </li>'; 
				$pTransmicion = $pcCaracNombre.' Automática ';
				
			}
			if($pcCantidad == 1){
			
				$mhtmlCaractini = $mhtmlCaractini.'<li><i class="fa fa-check"></i>'.$pcCaracNombre.' Mecánica </li>'; 
				$pTransmicion = $pcCaracNombre.' Mecánica ';
				
			}
			if($pcCantidad == 2){
			
				$mhtmlCaractini = $mhtmlCaractini.'<li><i class="fa fa-check"></i>'.$pcCaracNombre.' Mixta </li>'; 
				$pTransmicion = $pcCaracNombre.' Mixta ';
				
			}
		}else if($pcCaracID == 11){
			
			if($pcCantidad == 0){
			
				$mhtmlCaractini = $mhtmlCaractini.'<li><i class="fa fa-check"></i>'.$pcCaracNombre.' Asistida </li>'; 
				
			}
			if($pcCantidad == 1){
			
				$mhtmlCaractini = $mhtmlCaractini.'<li><i class="fa fa-check"></i>'.$pcCaracNombre.' Mecánica </li>'; 
			}
		}else if($pcCaracID == 25){
			
			if($pcCantidad == 1){
			
				$mhtmlCaractini = $mhtmlCaractini.'<li><i class="fa fa-check"></i>'.$pcCaracNombre.' Gasolina </li>'; 
				
			}
			if($pcCantidad == 2){
			
				$mhtmlCaractini = $mhtmlCaractini.'<li><i class="fa fa-check"></i>'.$pcCaracNombre.' Diesel </li>'; 
			}
			if($pcCantidad == 3){
			
				$mhtmlCaractini = $mhtmlCaractini.'<li><i class="fa fa-check"></i>'.$pcCaracNombre.' Gasolina GNC </li>'; 
				
			}
			if($pcCantidad == 4){
			
				$mhtmlCaractini = $mhtmlCaractini.'<li><i class="fa fa-check"></i>'.$pcCaracNombre.' Eléctrico </li>'; 
			}
		}else{
		
			$mhtmlCaractini = $mhtmlCaractini.'<li><i class="fa fa-check"></i>'.$pcCaracNombre.'</li>'; 
			
		}
	}	
	
	$nombre_combustible="";

//Inicio Nuevo combustible		
	switch($pCombustible){
		case 1:
			$nombre_combustible="Gasolina";
		break;
		
		case 2:
			$nombre_combustible="Diesel";
		break;
		
		case 3:
			$nombre_combustible="Gasolina GNC";
		break;
		
		case 4:
			$nombre_combustible="Eléctrico";
		break;

		case 5:
			$nombre_combustible="Híbrido";
		break;
		
	}
//Fin Nuevo combustible			
	
	$pcarrFotos = $geoloc[0]["CatFoto"];
	
	$mhtmlfoto ='';
	$mhtmlfotoC ='';
	$contador=0;

	for($i=0;$i<count($pcarrFotos);$i++) {
		
		for($j=0;$j<count($pcarrFotos[$i]["arrFotos"]);$j++) {

//Inicio Nuevo url fotografias				
			$rfotosUrl = $pcarrFotos[$i]["arrFotos"][$j]["FotUrl"];
			
			$rfotos = $pcarrFotos[$i]["arrFotos"][$j]["FotoNombre"];

			if($rfotosUrl != ''){

				if($rfotos != 'default.jpg'){
				
					$fotoUrlS = $rfotosUrl;

					
					if($j==0){
						$mpimage = $fotoUrlS;
					}
				
				}else{
					
					$fotoUrlS = 'complementos/image/default.jpg';
					$fotoUrlL = 'complementos/image/default.jpg';
					
				}

			}else{
			
				if($rfotos != 'default.jpg'){
				
					$rfotoS = str_replace('-1.jpg', '-3.jpg', $rfotos);
			
					$fotoUrlS = 'http://www.autosusados.cl/fotos/'.$pCliente.'/'.$rfotoS;

					
					if($j==0){
						$mpimage = $fotoUrlS;
					}
				
				}else{
					
					$fotoUrlS = 'complementos/image/default.jpg';
					$fotoUrlL = 'complementos/image/default.jpg';
					
				}
			}
			
		}

	}
//Fin Nuevo url fotografias	
	
	if($pVersion != ''){
	
	$pAuto = $pMarca.' '.$pModelo.' '.$pVersion.' '.$pAnoFab;
	$pcAuto = str_replace(" ","-",$pMarca).'-'.str_replace(" ","-",$pModelo).'-'.str_replace(" ","-",$pVersion).'-'.$pAnoFab;
	
	}else{
	
	$pAuto = $pMarca.' '.$pModelo.' '.$pAnoFab;
	$pcAuto = str_replace(" ","-",$pMarca).'-'.str_replace(" ","-",$pModelo).'-'.$pAnoFab;
	
	}
			
	$ptitulo = $pMarca.'-'.$pModelo.'-'.$pMoneda.''.$pPrecio;
	
	$vpPrecio = !empty($pPrecio)&&$pPrecio!=0?$pMoneda.''.$pPrecio:"-";
	
	$vpFonos1 = $pFono1;
	
	$vpcFonos1 = "tel:".$pFono1;
	
	$vpFonos2 = $pFono2;
	
	$vpcFonos2 = "tel:".$pFono2;

//Inicio Nuevo Whatsapp	
	$vpWhatsapp = $pWhatsapp;
//Fin Nuevo Whatsapp	

	$pDireccion = $pCalle.' '.$pComuna.' '.$pCiudad;
	
	$pNomUrl= $pMarca.' '.$pModelo;
	
	/*metas*/
//Hasta Aqui--->

//Modificar en esta seccion todo lo correspondiente al sitio del cliente
	
	$mpdescription = "Bienvenido al sitio web de Nombre De Automotora";
	
	$mpkeywords = "Nombre De Automotora, Seminuevos de selección, Vehículos usados, vehículos nuevos";
	
	$mpabstract = "Automóviles con fotografías de exterior, interior y motor - Publicidad de Automóviles en internet";
	
	$mpreply= "contacto@nombredeautomotora.cl";
	
	$mpauthor = "https://plus.google.com/+destacadoscl";
	
	$mppublisher = "https://plus.google.com/+destacadoscl";
	
	$mpname= "nombredeautomotora";

//Copiar estas dos lineas	
	$mpdescriptioni = $pAuto." Lo Vende: ".$pNombre.". Ubicado en : ".$pDireccion.". Fonos : ".$vpFonos1." - ".$vpcFonos2;
	
//hasta aquí
	
	$mpabstract = "Automóviles con fotografías de exterior, interior y motor - Publicidad de Automóviles en internet";
	
	$mpsite = "@nombredeautomotoracl";
	
	$facebook = "https://www.facebook.com/nombredeautomotora.cl";
	
	$youtube = "https://www.youtube.com/user/nombredeautomotora/videos";
	/*metas*/
	
	
	$mUrl = $pUrl."/ficha.php?eIdAuto=".$eIdAuto;
}
// close curl resource to free up system resources
curl_close($ch);
		
?>
<input type="hidden" id="vPrecio" name="vPrecio" value="<?php echo ($pPrecio=="-")?0:$pPrecio;?>"/>
<input type="hidden" id="vClienteid" name="vClienteid" value="<?php echo $pCliente?>"/>