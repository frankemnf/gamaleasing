<?php

session_start();
$_SESSION['cliente']="123";
$pagina=isset($_GET["pag"])?"pag=".$_GET["pag"]:1;
$mi_marca=isset($_GET["mar"])?"&mar=".$_GET["mar"]:"";
$mi_categoria=isset($_GET["cat"])?"&cat=".$_GET["cat"]:"";
$mi_modelo=isset($_GET["mod"])?"&mod=".$_GET["mod"]:"";
$mi_anodesde=isset($_GET["anod"])?"&anod=".$_GET["anod"]:"";
$mi_anohasta=isset($_GET["anoh"])?"&anoh=".$_GET["anoh"]:"";
$mi_precio=isset($_GET["prec"])?"&prec=".$_GET["prec"]:"";
$mi_combustible=isset($_GET["comb"])?"&comb=".$_GET["comb"]:"";
$mi_transmision=isset($_GET["trans"])?"&trans=".$_GET["trans"]:"";
$mi_sucursal=isset($_GET["suc"])?"&suc=".$_GET["suc"]:"";
$mifiltro=isset($_GET["ord"])?"&ord=".$_GET["ord"]:"";
$mipromo=isset($_GET["prom"])?"&prom=".$_GET["prom"]:"";
$mikm=isset($_GET["Kilometro"])?"&Kilometro=".$_GET["Kilometro"]:"";

//Inicio Nuevo parametro para whatsapp
$link = urlencode("https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
//Inicio Nuevo parametro para whatsapp

$mi_url=$pagina.$mi_sucursal.$mi_categoria.$mi_marca.$mi_modelo.$mi_anohasta.$mi_precio.$mi_combustible.$mi_transmision.$mifiltro.$mipromo.$mikm.$mi_anodesde;
$autoid=isset($_GET["eIdAuto"])?$_GET["eIdAuto"]:"";

// nombre de archivo de seminuevos
$nombre_pagina="seminuevos.php";

if($_POST){
    
    $objcorreo=new correos();
    
    $validaNombre="";
    $validaEmail="";
    $validaFono="";
    $validaMensaje="";
    $validacaptcha="";
    $validapie="";
    $validacuotas="";
    $validaautopago="";
    $valida=true;

    //valida si campo nombre si esta vacio
    if(!isset($_POST["nombre"])||empty($_POST["nombre"])){
        $valida=false;
        $validaNombre="Debe ingresar Nombre";
    }

    //valida si campo email si esta vacio
    if(!isset($_POST["email"])||empty($_POST["email"])){
        $valida=false;
        $validaEmail="Debe ingresar Email";
    }else{
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $validaEmail="Esta dirección de correo no es válida.";
        }
    }

    //valida si campo fono si esta vacio
    if(!isset($_POST["telefono"])||empty($_POST["telefono"])){
        $valida=false;
        $validaFono="Debe ingresar Fono";
    }

    //valida si campo mensaje si esta vacio
    if(!isset($_POST["mensaje"])||empty($_POST["mensaje"])){
        $valida=false;
        $validaMensaje="Debe ingresar Mensaje";
    }
        
    if(isset($_POST["checkbox1"])&&!empty($_POST["checkbox1"])){
        if(!isset($_POST["pie"])||empty($_POST["pie"])){
            $valida=false;
            $validapie="Debe Ingresar Pie";
        }
        
        if(!isset($_POST["num_cuotas"])){
            $valida=false;
            $validacuotas="Debe seleccionar al menos una cuota.";
        }
    }		

    if(isset($_POST["checkbox7"])&&!empty($_POST["checkbox7"])){
        if(!isset($_POST["autopago"])||empty($_POST["autopago"])){
            $valida=false;
            $validaautopago="Debe ingresar informacion de vehículo";
        }
    }		
            
    if($valida==true){
        //echo "VERDADERO";
        $autoid=$_POST["IdAuto"];
        $txtNombre=$_POST["nombre"];
        $txtEmail=$_POST["email"];
        $txtFono=$_POST["telefono"];
        $txtMensaje=$_POST["mensaje"];
        $clienteid=$_POST["clienteid"];
        $precio=$_POST["precio"];
        $marca=$_POST["Marca"];
        $modelo=$_POST["Modelo"];
        $ano=$_POST["Ano"];
        $URLactual=$_POST["URLactual"];
        $Fono1Automotora=$_POST["fono1automotora"];
        $Fono2Automotora=$_POST["fono2automotora"];
        $tipo_mail=$_POST["tipo_mail"];
            
        $pie=$_POST["pie"];
        $num_cuotas=$_POST["num_cuotas"];
        $autopago=$_POST["autopago"];
        $Tabla= $_POST["Tabla"];
        $key='187964652315485';				
        $txtrut='';	
        $mcontacto='';
        
        $miscuotas="";
        if(isset($_POST["num_cuotas"])){
            for($i=0;$i<count($_POST["num_cuotas"]);$i++){
                if($i==count($_POST["num_cuotas"])-1){
                    $miscuotas=$miscuotas.$_POST["num_cuotas"][$i];
                }else{
                    $miscuotas=$miscuotas.$_POST["num_cuotas"][$i].",";
                }	
            }
        }					
        
        $objcorreo->guarda_correo($autoid,$txtNombre,$txtEmail,$txtFono,$txtMensaje,$clienteid,$precio,$marca,$modelo,$ano,$Tabla,$txtrut,
        $pie,$miscuotas,$autopago,$mcontacto);
    
        $parametros="token=".$key."&IdAuto=".$autoid."&txtNombre=".$txtNombre."&txtEmail=".$txtEmail."&txtFono=".$txtFono."&txtMensaje=".$txtMensaje
        ."&clienteid=".$clienteid."&tipo_mail=".$tipo_mail."&Tabla=".$Tabla."&URLactual=".$URLactual."&Ano=".$ano."&Fono1Automotora=".$Fono1Automotora
        ."&Fono2Automotora=".$Fono2Automotora."&pie=".$pie."&num_cuotas=".$miscuotas."&autopago=".$autopago;
        
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

    
        //echo $response;
        echo '<script language="javascript">window.location="gracias-cotizacion.php?eIdAuto='.$autoid."&".$mi_url.'"</script>';
        //header('Location:gracias-cotizacion.php?'."eIdAuto=".$autoid."&".$mi_url);
    }
}

// Set a config array of information related to your Magento 2 installation
$config = [
    'bootstrap_path' => '../app/bootstrap.php',
    'store' => 'default',
    'theme' => "Smartwave/porto_child"
];

require_once($config['bootstrap_path']);

// $params = $_SERVER;
// $params[Bootstrap::INIT_PARAM_FILESYSTEM_DIR_PATHS] = [
//     DirectoryList::PUB => [DirectoryList::URL_PATH => ''],
//     DirectoryList::MEDIA => [DirectoryList::URL_PATH => 'media'],
//     DirectoryList::STATIC_VIEW => [DirectoryList::URL_PATH => 'static'],
//     DirectoryList::UPLOAD => [DirectoryList::URL_PATH => 'media/upload'],
// ];

$params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = $config['store'] ?? 'default'; // Website code as same in admin panel

$params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'store';

$bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $params);

/** @var \Cadence\External\Framework\App\External $app */

$app = $bootstrap->createApplication('\Cadence\External\Framework\App\External');

$integration = $app->launch([
    'theme' => $config['theme']
]);

$specialAssets = $integration->getPageComponents();
echo $specialAssets['requireJs'];

echo $specialAssets['headContent'];
echo $specialAssets['headAdditional'];

echo $integration->getBlockHtml('head.additional');

?>

<style type="text/css">
.custom-block .links{
	height: auto !important;
}
</style>

<!DOCTYPE html>
<html lang="en">

<head>
	<title> GAMA | Seminuevos </title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/favicon.png" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js"></script>
<!--Inicio Incluir para galeria de fotos-->	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"/>
<!--Fin Incluir para galeria de fotos-->

    <?php include("complementos/head-ficha.php"); ?>

	<?php
	/*
	require("../wp-config.php");

	require("../wp-blog-header.php");

	$wp->init(); $wp->parse_request(); $wp->query_posts();

	$wp->register_globals(); $wp->send_headers();

	get_header();
	*/
	?>
        
    <script>
        $(document).ready(function(e){
            $("#form-cotizador").submit(function(e){
                $("#carga").css("display", "block");
                funcionContador('<?php echo $autoid; ?>', 7, 1);
            });
        });
    </script>

<!--Inicio Nuevo para galeria de fotos-->
	<!--js carrusel inicio-->
	<script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script src="js/jssor.slider-28.0.0.min.js" type="text/javascript"></script>
	<!--style carrusel fin-->
	<!--java carrusel inicio-->
	<script type="text/javascript">
		jssor_1_slider_init = function() {

			var jssor_1_SlideshowTransitions = [{
					$Duration: 800,
					x: 0.3,
					$During: {
						$Left: [0.3, 0.7]
					},
					$Easing: {
						$Left: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					x: -0.3,
					$SlideOut: true,
					$Easing: {
						$Left: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					x: -0.3,
					$During: {
						$Left: [0.3, 0.7]
					},
					$Easing: {
						$Left: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					x: 0.3,
					$SlideOut: true,
					$Easing: {
						$Left: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					y: 0.3,
					$During: {
						$Top: [0.3, 0.7]
					},
					$Easing: {
						$Top: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					y: -0.3,
					$SlideOut: true,
					$Easing: {
						$Top: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					y: -0.3,
					$During: {
						$Top: [0.3, 0.7]
					},
					$Easing: {
						$Top: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					y: 0.3,
					$SlideOut: true,
					$Easing: {
						$Top: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					x: 0.3,
					$Cols: 2,
					$During: {
						$Left: [0.3, 0.7]
					},
					$ChessMode: {
						$Column: 3
					},
					$Easing: {
						$Left: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					x: 0.3,
					$Cols: 2,
					$SlideOut: true,
					$ChessMode: {
						$Column: 3
					},
					$Easing: {
						$Left: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					y: 0.3,
					$Rows: 2,
					$During: {
						$Top: [0.3, 0.7]
					},
					$ChessMode: {
						$Row: 12
					},
					$Easing: {
						$Top: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					y: 0.3,
					$Rows: 2,
					$SlideOut: true,
					$ChessMode: {
						$Row: 12
					},
					$Easing: {
						$Top: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					y: 0.3,
					$Cols: 2,
					$During: {
						$Top: [0.3, 0.7]
					},
					$ChessMode: {
						$Column: 12
					},
					$Easing: {
						$Top: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					y: -0.3,
					$Cols: 2,
					$SlideOut: true,
					$ChessMode: {
						$Column: 12
					},
					$Easing: {
						$Top: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					x: 0.3,
					$Rows: 2,
					$During: {
						$Left: [0.3, 0.7]
					},
					$ChessMode: {
						$Row: 3
					},
					$Easing: {
						$Left: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					x: -0.3,
					$Rows: 2,
					$SlideOut: true,
					$ChessMode: {
						$Row: 3
					},
					$Easing: {
						$Left: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					x: 0.3,
					y: 0.3,
					$Cols: 2,
					$Rows: 2,
					$During: {
						$Left: [0.3, 0.7],
						$Top: [0.3, 0.7]
					},
					$ChessMode: {
						$Column: 3,
						$Row: 12
					},
					$Easing: {
						$Left: $Jease$.$InCubic,
						$Top: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					x: 0.3,
					y: 0.3,
					$Cols: 2,
					$Rows: 2,
					$During: {
						$Left: [0.3, 0.7],
						$Top: [0.3, 0.7]
					},
					$SlideOut: true,
					$ChessMode: {
						$Column: 3,
						$Row: 12
					},
					$Easing: {
						$Left: $Jease$.$InCubic,
						$Top: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					$Delay: 20,
					$Clip: 3,
					$Assembly: 260,
					$Easing: {
						$Clip: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					$Delay: 20,
					$Clip: 3,
					$SlideOut: true,
					$Assembly: 260,
					$Easing: {
						$Clip: $Jease$.$OutCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					$Delay: 20,
					$Clip: 12,
					$Assembly: 260,
					$Easing: {
						$Clip: $Jease$.$InCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				},
				{
					$Duration: 800,
					$Delay: 20,
					$Clip: 12,
					$SlideOut: true,
					$Assembly: 260,
					$Easing: {
						$Clip: $Jease$.$OutCubic,
						$Opacity: $Jease$.$Linear
					},
					$Opacity: 2
				}
			];

			var jssor_1_options = {
				$AutoPlay: 1,
				$SlideshowOptions: {
					$Class: $JssorSlideshowRunner$,
					$Transitions: jssor_1_SlideshowTransitions,
					$TransitionsOrder: 1
				},
				$ArrowNavigatorOptions: {
					$Class: $JssorArrowNavigator$
				},
				$ThumbnailNavigatorOptions: {
					$Class: $JssorThumbnailNavigator$,
					$SpacingX: 5,
					$SpacingY: 5
				}
			};

			var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

			/*#region responsive code begin*/

			var MAX_WIDTH = 730;

			function ScaleSlider() {
				var containerElement = jssor_1_slider.$Elmt.parentNode;
				var containerWidth = containerElement.clientWidth;

				if (containerWidth) {

					var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

					jssor_1_slider.$ScaleWidth(expectedWidth);
				} else {
					window.setTimeout(ScaleSlider, 30);
				}
			}

			ScaleSlider();

			$Jssor$.$AddEvent(window, "load", ScaleSlider);
			$Jssor$.$AddEvent(window, "resize", ScaleSlider);
			$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
			/*#endregion responsive code end*/
		};
	</script>
	<!--java carrusel fin-->
	<!--style carrusel inicio-->
	<style>
		/*jssor slider loading skin spin css*/
		.jssorl-009-spin img {
			animation-name: jssorl-009-spin;
			animation-duration: 1.6s;
			animation-iteration-count: infinite;
			animation-timing-function: linear;
		}

		@keyframes jssorl-009-spin {
			from {
				transform: rotate(0deg);
			}

			to {
				transform: rotate(360deg);
			}
		}

		/*jssor slider arrow skin 106 css*/
		.jssora106 {
			display: block;
			position: absolute;
			cursor: pointer;
		}

		.jssora106 .c {
			fill: #fff;
			opacity: .3;
		}

		.jssora106 .a {
			fill: none;
			stroke: #000;
			stroke-width: 350;
			stroke-miterlimit: 10;
		}

		.jssora106:hover .c {
			opacity: .5;
		}

		.jssora106:hover .a {
			opacity: .8;
		}

		.jssora106.jssora106dn .c {
			opacity: .2;
		}

		.jssora106.jssora106dn .a {
			opacity: 1;
		}

		.jssora106.jssora106ds {
			opacity: .3;
			pointer-events: none;
		}

		/*jssor slider thumbnail skin 101 css*/
		.jssort101 .p {
			position: absolute;
			top: 0;
			left: 0;
			box-sizing: border-box;
			background: #000;
		}

		.jssort101 .p .cv {
			position: relative;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			border: 2px solid #000;
			box-sizing: border-box;
			z-index: 1;
		}

		.jssort101 .a {
			fill: none;
			stroke: #fff;
			stroke-width: 400;
			stroke-miterlimit: 10;
			visibility: hidden;
		}

		.jssort101 .p:hover .cv,
		.jssort101 .p.pdn .cv {
			border: none;
			border-color: transparent;
		}

		.jssort101 .p:hover {
			padding: 2px;
		}

		.jssort101 .p:hover .cv {
			background-color: rgba(0, 0, 0, 6);
			opacity: .35;
		}

		.jssort101 .p:hover.pdn {
			padding: 0;
		}

		.jssort101 .p:hover.pdn .cv {
			border: 2px solid #fff;
			background: none;
			opacity: .35;
		}

		.jssort101 .pav .cv {
			border-color: #fff;
			opacity: .35;
		}

		.jssort101 .pav .a,
		.jssort101 .p:hover .a {
			visibility: visible;
		}

		.jssort101 .t {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			border: none;
			opacity: .6;
		}

		.jssort101 .pav .t,
		.jssort101 .p:hover .t {
			opacity: 1;
		}
	</style>
	<!--style carrusel fin-->
<!--Fin Nuevo para galeria de fotos-->	
</head>

<body>

	<?php echo $integration->getBlockHtml('porto_header'); ?>
 
    <div id="autosUsados">

        <div class="load-semi" style="display:none;" id="carga">
            <img src="complementos/img/loading.svg" width="80" height="80" alt=""> 
        </div>

        <div class="car-details" style="margin:0 auto;">
            <div class="container">

                <!-- BANNER RRSS MOBILE -->
                <div class="bton-seg02" style="display: none;">        
                    <div class="col-6 col-sm-3 cotiza-30">
                        <a href="<?php echo $nombre_pagina; ?>?<?php echo $mi_url; ?>" style="cursor: pointer;" class="volverF">  
                        <h2><i class="fa fa-angle-double-left flecha01" aria-hidden="true"></i> Volver</h2></a>
                    </div>
                    <div class="col-6 col-sm-6 Compartir">
                        <ul class="Compartir-list">
                            <li>
                                <div id="dFacebook">
                                    <a onClick="javascript:redes(1);" class="facebook" style="cursor: pointer;">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div id="dTwitter">
                                    <a onClick="javascript:redes(2);" class="twitter" style="cursor: pointer;">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div id="dWhatsApp">
                                    <a onClick="javascript:redes(4);" class="Whatsapp" style="cursor: pointer;">
                                        <i class="fa fa-whatsapp"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div> 
                    <div class="col-4 col-sm-3 volver-40">
                        <a href="#cotiza0002">
                            <i class="fa fa-envelope flecha01" aria-hidden="true"></i><h2>Cotizar</h2>
                        </a>
                    </div>
                </div>

                <!-- TITULO + PRECIO -->
                <div class="row">
                    <!-- TITULO + DETALLES -->
                    <div class="col-12 col-md-8 option-bar">                    
                        <div class="col-12">
                            <div class="section-heading">
                                <i class="fa fa-car"></i>
                                <h2 class="h2ficha"><div id="dTituloAuto"></div></h2>
                                <h4>Detalles del veh&iacute;culo</h4>  
                            </div>
                        </div>
                        <div class=" col-12">
                            <ul class="auto-detalle-list">
                                <li><span>Color: </span><div class="CarD" id="dColor"></div></li>
                                <li><span>Transmisi&oacute;n:</span><div  class="CarD" id="dTransmicion"></div></li>
                                <li><span>A&ntilde;o:</span><div class="CarD"  id="dAno"></div></li>
                                <li><span>Kms:</span><div class="CarD" id="dKms"></div></li>
                                <li><span>Combustible:</span><div class="CarD" id="dCombustible"></div></li>
                                <li><span>Cilindrada:</span><div class="CarD" id="dCilindrada"><?php echo $pCilindrada; ?></div></li>                             
                            </ul> 
                        </div>                    
                    </div>

                    <!-- VOLVER + PRECIO -->
                    <div class="col-12 col-md-4">
                        <div class="car-sidebar-right">

                            <!-- VOLVER -->
                            <div class="bton-seg01">
                                <div class="col-6 volver-30">
                                    <a href="<?php echo $nombre_pagina; ?>?<?php echo $mi_url; ?>" style="cursor: pointer;"> 
                                        <i class="fa fa-angle-double-left flecha01" aria-hidden="true"></i> <h2>Volver</h2>
                                    </a>
                                </div>
                            </div>
							
                            <!-- PRECIO -->
                            <div class="car-detail-block mrg-precio mrg-precio003">
                                <h2 class="title">Precio</h2>
                                <div class="car-details-header-price">
                                    <h3 id="dPrecio"></h3>
                                </div>
                                <?php if($activafinanciamiento==1){?>                
                                <div class="divCuota">
                                    <div class="cuotaDiv CuotaC"><?php echo $pNumcuota; ?> cuotas</div>
                                    <div class="precio2 CuotaP"><?php echo "$".str_replace(",",".",number_format($pCuota)); ?></div>
                                </div>
                                <div class="divPie cuotaPie">
                                    <strong>PIE</strong> <?php echo "$".str_replace(",",".",number_format($pPieminimo)); ?>  /  <strong>CAE</strong> <?php echo $pCae; ?>
                                </div>         
                                <?php if($pVfmg){?> 
                                <div class="valorF">
                                    <strong>VFMG</strong> <?php echo "$".str_replace(",",".",number_format($pVfmg)); ?>        
                                </div>
                                <?php } ?>
                                <div class="costoTC">
                                    <strong>CTC</strong> <?php echo $pctc; ?>       
                                </div>
                                <?php }?>  
                                <div class="boxiva boxificha"><small><?php echo $pLegal_precio; ?></small></div>      
                            </div>

                            <!-- PRECIO EXTRA -->        
                            <div class="car-detail-block mrg-precio mrg-precio01">
                                <h2 class="title">Precio</h2>
                                <div class="car-details-header-price">
                                    <h3 id="dPrecios"></h3>
                                </div>
                                <?php if($activafinanciamiento==1){?>                
                                    <div class="divCuota">
                                        <div class="cuotaDiv CuotaC"><?php echo $pNumcuota; ?> cuotas</div>
                                        <div class="precio2 CuotaP"><?php echo "$".str_replace(",",".",number_format($pCuota)); ?></div>
                                    </div>
                                    <div class="divPie cuotaPie">
                                        <strong>PIE</strong> <?php echo "$".str_replace(",",".",number_format($pPieminimo)); ?>  /  <strong>CAE</strong> <?php echo $pCae; ?>
                                    </div>
                                    <?php if($pVfmg){?> 
                                        <div class="valorF">
                                            <strong>VFMG</strong> <?php echo "$".str_replace(",",".",number_format($pVfmg)); ?>        
                                        </div>
                                        <?php } ?>
                                    <?php }?>          
                                <div class="boxiva boxificha"><small><?php echo $pLegal_precio; ?></small></div>              
                            </div>
                        </div>                
                    </div>
                </div>

                <!-- CARRUSEL + FORM -->                            
                <div class="row">
                    <!-- CARRUSEL -->                        
                    <div class="col-12 col-md-8">

						<!-- car-detail-slider start colocar codigo dentro de este div-->
						<div class="car-detail-slider" id="galeria">
<!--Inicio Nuevo Etiquetas-->
							<?php
							if ($pEtiqueta != "" && $pEtiqueta != "0") { 
								
								$name_array = explode('-',$pColorC);

								$count = count($name_array);
								
								if($count <=1){
								?>
								<div class="ribbon-wrapper-Ficha">
									<div class="ribbon-css-Ficha" style="color: <?php echo $fontcolor ?>;background-color: <?php echo $pColorC ?>"><?php echo $pTituloC ?></div>
								</div>
								<?php
								}else{?>
								<div class="ribbon-wrapper-Ficha">
									<div class="ribbon-css-Ficha <?php echo $pColorC ?>"><?php echo $pTituloC ?></div>
								</div>	
							<?php }

							} ?>
<!--Fin Nuevo Etiquetas-->
<!--Inicio Nuevo Carrusel de fotografias-->							
							<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:730px;height:648px;overflow:hidden;visibility:hidden;">

								<div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
									<img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="complementos/image/spin.svg" />
								</div>

								<div class="box-multimedia">
									<ul class="M-list imglist">

										<?php
										if ($pvideo) { ?>
											<li>
												<div class="bton-video"><a class="fancybox-media" href="<?php echo $pvideo ?>">
														<i class="fa fa-film"></i>
													</a>
												</div>
											</li>
										<?php
										} ?>

										<?php
										if ($p360) { ?>

											<li>
												<div class="bton-360">
													<a class="fancybox fancybox.iframe" href="<?php echo $p360 ?>">
														<i><img src="complementos/img/360.svg" alt="" /></i>
													</a>
												</div>
											</li>
										<?php
										} ?>

									</ul>
								</div>
	
								<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:730px;height:548px;overflow:hidden;">
									<?php
//Inicio Nuevo URL de fotografias									
                                    for ($i = 0; $i < count($pcarrFotos); $i++) {
                                        for ($j = 0; $j < count($pcarrFotos[$i]["arrFotos"]); $j++) {

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
												
                                            ?>

											<a href="<?php echo $fotoUrlS ?>" data-fancybox='images' data-caption="<?php echo $pAlt ?>" data-width='1024' data-height='768'>
												<img src="<?php echo $fotoUrlS ?>" data-u="image" alt="<?php echo $pAlt ?>" />
												<img src="<?php echo $fotoUrlS ?>" data-u="thumb" alt="<?php echo $pAlt ?>" />
											</a>
									<?php
										}
									}
//Fin Nuevo URL de fotografias
									?>
								</div>

								<div data-u="thumbnavigator" class="jssort101" style="position:absolute;left:0px;bottom:0px;width:730px;height:100px;background-color:#000;" data-autocenter="1" data-scale-bottom="0.75">
									<div data-u="slides">
										<div data-u="prototype" class="p" style="width:120px;height:90px;">
											<div data-u="thumbnailtemplate" class="t"></div>
											<svg viewbox="0 0 16000 16000" class="cv">
												<circle class="a" cx="8000" cy="8000" r="3238.1"></circle>
												<line class="a" x1="6190.5" y1="8000" x2="9809.5" y2="8000"></line>
												<line class="a" x1="8000" y1="9809.5" x2="8000" y2="6190.5"></line>
											</svg>
										</div>
									</div>
								</div>

								<!-- Arrow Navigator -->
								<div data-u="arrowleft" class="jssora106" style="width:55px;height:55px;top:162px;left:30px;" data-scale="0.75">
									<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
										<circle class="c" cx="8000" cy="8000" r="6260.9"></circle>
										<polyline class="a" points="7930.4,5495.7 5426.1,8000 7930.4,10504.3 "></polyline>
										<line class="a" x1="10573.9" y1="8000" x2="5426.1" y2="8000"></line>
									</svg>
								</div>

								<div data-u="arrowright" class="jssora106" style="width:55px;height:55px;top:162px;right:30px;" data-scale="0.75">
									<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
										<circle class="c" cx="8000" cy="8000" r="6260.9"></circle>
										<polyline class="a" points="8069.6,5495.7 10573.9,8000 8069.6,10504.3 "></polyline>
										<line class="a" x1="5426.1" y1="8000" x2="10573.9" y2="8000"></line>
									</svg>
								</div>

							</div>

						</div>
						<!-- car-detail-slider end colocar codigo dentro de este div-->
						<!--controlador carrusel inicio-->

	                    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	                    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

						<script type="text/javascript">
							jssor_1_slider_init();
						</script>
						<!--controlador carrusel fin-->
<!--Fin Nuevo Carrusel de fotografias-->	

                        <div class="textDes">“Precios, equipamiento e información sujetos a cambio sin previo aviso. Las imágenes son ilustrativas y pueden no coincidir con los productos exhibidos y ofrecidos en concesionarios. Contacte un vendedor para verificar los datos publicados” </div>
                    
					</div>

                    <div class="col-12 col-md-4">
                        <!-- BANNER PROMO -->                
                        <div class="car-detail-block bannerpromo" style="display: none;">
                            <a href="#">
                                <img src="complementos/image/banner-promo.jpg" width="640" height="auto" alt="" class="img-responsive">
                            </a>
                        </div>  
                        <!-- FORM COTIZACION -->              
                        <div class="share mrg-b-30" id="cotiza0002">
                            <h2 class="title">COTIZA</h2>
                            <form id="form-cotizador" action="ficha.php?<?php echo "eIdAuto=".$eIdAuto."&".$mi_url; ?>" method="post">
                                <input type="hidden" class="form-control" name="IdAuto" id="IdAuto" value="<?php echo $eIdAuto ?>">
                                <input type="hidden" id="Marca" name="Marca" value="<?php echo $pMarca ?>" />
                                <input type="hidden" id="Modelo" name="Modelo" value="<?php echo $pModelo ?>" />
                                <input type="hidden" id="Ano" name="Ano" value="<?php echo $pAnoFab ?>" />
                                <input type="hidden" id="clienteid" name="clienteid" value="<?php echo $pCliente ?>" />
                                <input type="hidden" id="precio" name="precio" value="<?php echo $vpPrecio ?>" />
                                <input type="hidden" id="tipo_mail" name="tipo_mail" value="1" />
                                <input type="hidden" id="URLactual" name="URLactual" value="<?php echo isset($_SERVER["HTTPS"])&&$_SERVER["HTTPS"]=="on"?"https://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?".$pNomUrl:"http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?".$pNomUrl; ?>" />
                                <input type="hidden" name="fono1automotora" id="fono1automotora" value="<?php echo $vpFonos1 ?>">
                                <input type="hidden" name="fono2automotora" id="fono2automotora" value="<?php echo $vpFonos2 ?>">
                                <input type="hidden" id="Tabla" name="Tabla" value="1" />
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nombre" id="nombre"  placeholder="Nombre" value="<?php echo isset($_POST["nombre"])?$_POST["nombre"]:"";?>">
                                        <div class="alerta" id="nombre001" style=" <?php echo isset($validaNombre)&&!empty($validaNombre)?"display:block":""; ?>">
                                            <p class="alert01"><i class="fa fa-info-circle color01"></i><?php echo $validaNombre;?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="phono" class="form-control" value="<?php echo isset($_POST["telefono"])?$_POST["telefono"]:"";?>" id="telefono" placeholder="Teléfono" name="telefono" >
                                        <div class="alerta" id="telefono001" style=" <?php echo isset($validaFono)&&!empty($validaFono)?"display:block":""; ?>">
                                            <p class="alert01"><i class="fa fa-info-circle color01"></i><?php echo $validaFono;?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" value="<?php echo isset($_POST["email"])?$_POST["email"]:"";?>" id="email" placeholder="E-mail" name="email">
                                            <div class="alerta" id="email001" style=" <?php echo isset($validaEmail)&&!empty($validaEmail)?"display:block":""; ?>">
                                                <p class="alert01"><i class="fa fa-info-circle color01"></i><?php echo $validaEmail;?></p>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" id="mensaje" name="mensaje" placeholder="Mensaje"><?php echo isset($_POST["mensaje"])?$_POST["mensaje"]:"";?></textarea>
                                        <div class="alerta" id="mesaje001" style=" <?php echo isset($validaMensaje)&&!empty($validaMensaje)?"display:block":""; ?>">
                                            <p class="alert01"><i class="fa fa-info-circle color01"></i><?php echo $validaMensaje;?></p>
                                        </div>
                                    </div>
                                    <div class="search-block">
                                        <div class="checkbox checkbox-theme checkbox-circle">
                                            <input id="checkbox1" name="checkbox1" value="1" style="display:block; opacity:0; z-index:10000000;" type="checkbox" <?php echo isset($_POST["checkbox1"])?"checked":""; ?> >
                                            <label for="checkbox1">COTIZA TU CR&Eacute;DITO</label>
                                        </div>
                                        <div class="form-group cajaCotizaCredito" style=" <?php echo isset($_POST['checkbox1'])?'display: block;':'display: none'; ?>">
                                            <div class="form-group">
                                                <input class="form-control" id="pie" name="pie" placeholder="Pie" value="<?php echo isset($_POST["pie"])?$_POST["pie"]:"";?>">
                                                <input type="hidden" name="pie_limpio" id="pie_limpio">
                                                <div class="alerta" id="pie001" style=" <?php echo isset($validapie)&&!empty($validapie)?"display:block":""; ?>">
                                                    <p class="alert01"><i class="fa fa-info-circle color01"></i><?php echo $validapie; ?></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <p class="c01"> Cuotas</p>
                                                <div style="margin-top:0;margin-left:2px;">
                                                    <input id="checkbox2" name="num_cuotas[]" type="checkbox" value="12" <?php echo isset($_POST["num_cuotas"][0])?"checked":""; ?>>
                                                    <label for="checkbox2">12</label>
                                                    <input id="checkbox3" name="num_cuotas[]" type="checkbox" value="24" <?php echo isset($_POST["num_cuotas"][1])?"checked":""; ?>>
                                                    <label for="checkbox3">24</label>
                                                    <input id="checkbox4" name="num_cuotas[]" type="checkbox" value="36" <?php echo isset($_POST["num_cuotas"][2])?"checked":""; ?>>
                                                    <label for="checkbox4">36</label>
                                                    <input id="checkbox5" name="num_cuotas[]" type="checkbox" value="48" <?php echo isset($_POST["num_cuotas"][3])?"checked":""; ?>>
                                                    <label for="checkbox5">48</label>
                                                    <input id="checkbox6" name="num_cuotas[]" type="checkbox" value="60" <?php echo isset($_POST["num_cuotas"][4])?"checked":""; ?>>
                                                    <label for="checkbox6">60</label>
                                                </div>
                                                <div class="alerta" id="cuotas001" style=" <?php echo isset($validacuotas)&&!empty($validacuotas)?"display:block":""; ?>">
                                                    <p class="alert01"><i class="fa fa-info-circle color01"></i><?php echo $validacuotas; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="caja100">
                                            <div class="checkbox checkbox-theme checkbox-circle">
                                                <input id="checkbox7" name="checkbox7" style="display:block; opacity:0; z-index:10000000;"  type="checkbox" <?php echo isset($_POST["checkbox7"])?"checked":""; ?>>
                                                <label for="checkbox7">DEJA TU AUTO EN PARTE DE PAGO</label>
                                            </div>
                                            <div class="caja100 cajaAutoPago" style=" <?php echo isset($_POST['checkbox7'])?'display: block;':'display: none'; ?>">
                                                <input type="text" class="form-control" id="autopago" name="autopago" value="<?php echo isset($_POST["autopago"])?$_POST["autopago"]:"";?>" placeholder="Automóvil, marca, modelo, versión, año, kilometraje, etc">
                                            </div>
                                            <div class="alerta" id="pago001" style=" <?php echo isset($validaautopago)&&!empty($validaautopago)?"display:block":""; ?>">
                                                <p class="alert01"><i class="fa fa-info-circle color01"></i><?php echo $validaautopago; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-default btn-submit col-12" type="submit">Enviar</button>
                                    </div>
                                </div>            
                            </form>
                        </div>                
                    </div>   

                </div>

                <!-- DESCRIPCION + UBICACION -->
                <div class="row">
                    <!-- DESCRIPCION + EQUIPAMIENTO -->
                    <div class="col-12 col-md-8">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#equip">Equipamiento</a></li>
                            <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#descr">Descripción</a></li> -->
                        </ul>                        
                        <div class="tab-content">
                            <div id="equip" class="tab-pane active">
                                <div class="car-detail-block features">
                                    <div id="tab2default">
                                        <div class="row">
                                            <div class="boxLista">
                                                <ul class="col-12" id="dCaracteristicas"></ul>
                                            </div>                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="descr" class="tab-pane">
                                <div class="car-detail-block">
                                    <div id="dDescripcion"></div>
                                </div>
                            </div>
                        </div>                 
                    </div>

                    <!-- UBICACION -->
                    <div class="col-12 col-md-4">
                        <div class="car-detail-block">
                            <h2 class="title">Ubicación</h2>
                            <div class="col-12 Phono2017">
                            <div id="dTelefono1"></div>
                            <div id="dTelefono2"></div>
                        </div>
                        <!-- Inicio nuevo mapa-->
                        <!-- <div id="mapid" style="width: 100%; height: 350px;"></div> -->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3329.8332949004616!2d-70.7870935!3d-33.4275903!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5f21ea64b57b2134!2sGama%20Leasing!5e0!3m2!1sen!2scl!4v1592359030395!5m2!1sen!2scl" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        <!--FIN MAPA-->
                    </div>
                </div>

                <!-- SUGERIDOS -->                        
                <div class="row">
                    <div style="max-width:1300px; margin:0 auto;">
                        <div class="recent-car-content">
                            <div class="margin-b-15">
                                <div class="col-md-12">
                                    <div class="section-heading">
                                        <h2>Sugeridos</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="mssimilares"></div>
                        </div>
                    </div>                        
                </div>

<!--Inicio Nuevo whatsapp-->	
				<?php if ($vpWhatsapp != NULL || $vpWhatsapp !='') { ?>
					<div class="flotante">
						<a href="https://api.whatsapp.com/send?phone=<?php echo $vpWhatsapp ?>&amp;text=¡Hola! me interesa el siguiente vehículo.&nbsp;<?php echo $link; ?>" role="button" aria-pressed="true">
							<img src="complementos/image/whatsapp.png" width="100" alt="">
						</a>
					</div>
				<?php } ?>   				
<!--Fin Nuevo whatsapp-->	

                <div class="row col-12">
                    <div class="col-12 col-lg-8">
                        <div class="Compartir C2" style="display: none">
                            <ul class="Compartir-list">
                                <li>
                                    <div id="dFacebook">
                                        <a onClick="javascript:redes(1);" class="facebook" style="cursor: pointer;">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div id="dTwitter">
                                        <a onClick="javascript:redes(2);" class="twitter" style="cursor: pointer;">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>                                
                    </div>                           
                </div>

            </div>                        
        </div>
        
        
        <input id="pagina" name="pag" value="<?php echo (isset($_GET["pag"])&&$_GET["pag"])?$_GET["pag"]:""; ?>" type="hidden">
        <input id="micategoria" name="micategoria" type="hidden" value="<?php echo (isset($_GET["cat"])&&$_GET["cat"])?$_GET["cat"]:"";  ?>">
        <input id="mimarca" name="mimarca" type="hidden" value="<?php echo (isset($_GET["mar"])&&$_GET["mar"])?$_GET["mar"]:"";  ?>">
        <input id="mimodelo" name="mimodelo" type="hidden" value="<?php echo (isset($_GET["mod"])&&$_GET["mod"])?$_GET["mod"]:"";  ?>">
        <input id="mianoh" name="mianoh" type="hidden" value="<?php echo (isset($_GET["anoh"])&&$_GET["anoh"])?$_GET["anoh"]:"";  ?>">
        <input id="miprecio" name="miprecio" type="hidden" value="<?php echo (isset($_GET["prec"])&&$_GET["prec"])?$_GET["prec"]:"";  ?>">
        <input id="micombustible" name="micombustible" type="hidden" value="<?php echo (isset($_GET["comb"])&&$_GET["comb"])?$_GET["comb"]:"";  ?>">
        <input id="mitransmision" name="mitransmision" type="hidden" value="<?php echo (isset($_GET["trans"])&&$_GET["trans"])?$_GET["trans"]:"";  ?>">
        <input id="misucursal" name="misucursal" type="hidden" value="<?php echo (isset($_GET["suc"])&&$_GET["suc"])?$_GET["suc"]:"";  ?>">
        <input id="miorden" name="miorden" type="hidden" value="<?php echo (isset($_GET["ord"])&&$_GET["ord"])?$_GET["ord"]:"";  ?>">

        <input type="hidden" id="pAuto" name="pAuto" value="<?php echo $pAuto ?>" />
        <input type="hidden" id="pCliente" name="pCliente" value="<?php echo $pCliente ?>" />
        <input type="hidden" id="eIdAuto" name="eIdAuto" value="<?php echo $eIdAuto ?>" />
        <input type="hidden" id="pcAuto" name="pcAuto" value="<?php echo $pcAuto ?>" />
        <input type="hidden" id="pUrl" name="pUrl" value="<?php echo $pUrl ?>" />
        <input type="hidden" id="vpPrecio" name="vpPrecio" value="<?php echo $vpPrecio ?>" />
        <input type="hidden" id="pEmail" name="pEmail" value="<?php echo $pEmail ?>" />
        <input type="hidden" id="pNombre" name="pNombre" value="<?php echo $pNombre ?>" />
        <input type="hidden" id="pMarca" name="pMarca" value="<?php echo $pMarca ?>" />
        <input type="hidden" id="pModelo" name="pModelo" value="<?php echo $pModelo ?>" />
        <input type="hidden" id="pAnoFab" name="pAnoFab" value="<?php echo $pAnoFab ?>" />
        <input type="hidden" id="pNomUrl" name="pNomUrl" value="<?php echo $pNomUrl ?>" />
        <input type="hidden" id="ptitulo" name="ptitulo" value="<?php echo $ptitulo ?>" />
        <input type="hidden" id="pCodigo" name="pCodigo" value="<?php echo $pCodigo ?>" />
        <input type="hidden" id="pNombre" name="pNombre" value="<?php echo $pNombre ?>" />
        <input type="hidden" id="pDireccion" name="pDireccion" value="<?php echo $pDireccion ?>" />
        <input type="hidden" id="vpFonos1" name="vpFonos1" value="<?php echo $vpFonos1 ?>" />
        <input type="hidden" id="vpFonos2" name="vpFonos2" value="<?php echo $vpFonos2 ?>" />
        <input type="hidden" id="idfacebook" name="idfacebook" value="<?php echo $idfacebook ?>" />
    </div>
    
    <div style="clear:both"></div>
<?php echo $integration->getBlockHtml('footer_block'); ?>
</body>
</html>

<!--SCRIPT NUEVO MAPA -->
<script>
    var mymap = L.map('mapid').setView(['<?php echo $lat;?>', '<?php echo $long;?>'], 40);
    var logo = '<?php echo $plogo;?>'
    var calle = '<?php echo $pCalle;?>'
    var comuna = '<?php echo $pComuna;?>'
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 17,
    attribution: '<a href="https://www.autosusados.cl/">AutosUsados &copy</a>',
    id: 'mapbox.streets'
    }).addTo(mymap);
    L.marker(['<?php echo $lat;?>', '<?php echo $long;?>']).addTo(mymap)
    .bindPopup('<div style=" width:60px; display: inline-block;"><img src="http://www.fachadas.autosusados.cl' + logo + '" style=" width:72px; height:50px; display:block; vertical-align:top;"></div><div style=" width:160px; display: inline-block; vertical-align:top; margin:0px 0px 0px 20px;">' + calle + comuna + '</div>').openPopup();
    var popup = L.popup();
</script>
<!--FIN SCRIPT NUEVO MAPA-->

<?php include("complementos/js-footer-ficha.php"); ?>
<!--Colocar codigo recaptcha-->
<script src="https://www.google.com/recaptcha/api.js?render=6LfGLsQUAAAAAAMgyHbaJoAKxXunaWfeY3ABDGO2"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6LfGLsQUAAAAAAMgyHbaJoAKxXunaWfeY3ABDGO2', {
            action: 'ficha'
        }).then(function(token) {});
    });
</script>
<?php

class correos
{
    function guarda_correo($autoid, $txtNombre, $txtEmail, $txtFono, $txtMensaje, $clienteid, $precio, $marca, $modelo, $ano, $Tabla, $txtrut,
    $pie,$num_cuotas,$autopago,$mcontacto)
    {

        $parametros = "autoid=" . $autoid . "&txtNombre=" . $txtNombre . "&txtEmail=" . $txtEmail . "&txtFono=" . $txtFono . "&txtMensaje=" . $txtMensaje
        . "&clienteid=" . $clienteid . "&precio=" . $precio . "&marca=" . $marca . "&modelo=" . $modelo . "&ano=" . $ano . "&Tabla=" . $Tabla
        . "&rut=" . $txtrut. "&pie=" . $pie. "&cuotas=" . $num_cuotas. "&autopago=" . $autopago. "&mcontacto=" . $mcontacto. "&tipo=20";
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

<?php //get_footer(); ?>