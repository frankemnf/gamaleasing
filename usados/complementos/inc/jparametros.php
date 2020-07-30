<script language="javascript" type="application/javascript">

$('#dTituloAuto').html('<?php echo $pAuto?>');
$('#dPrecio').html('<?php echo $vpPrecio;?>');
$('#dPrecios').html('<?php echo $vpPrecio;?>');
$('#dColor').html('<?php echo $pColor?>');
$('#dAno').html('<?php echo $pAnoFab?>');
$('#dKms').html('<?php echo $pKilometros?>');
$('#dTelefono1').html('<?php echo '<a onclick="javascript:llama();" href="tel:'.$vpFonos1.'">'.$vpFonos1.'</a>';?>');
$('#dTelefono2').html('<?php echo '<a onclick="javascript:llama();" href="tel:'.$vpFonos2.'">'.$vpFonos2.'</a>';?>');

$('#htel1').attr({
		'title': 'Fono Contacto',
		'href': '<?php echo $vpcFonos1?>',
	});
	
$('#htel2').attr({
		'title': 'Fono Contacto',
		'href': '<?php echo $vpcFonos2?>',
	});

$('#dDescripcion').html('<?php echo $pDescripcion?>');
$('#dDescripcions').html('<?php echo $pDescripcion?>');

$('#dTransmicion').html('<?php echo $pTransmicion?>');

$('#dCaracteristicas').html('<?php echo $mhtmlCaractini?>');

//Inicio Nuevo comentar esta linea inicio
//$('#galeria').html('<?php //echo $mhtml?>');
//Fin Inicio comentar esta linea fin

$('#BannerFinanciamineto').html('<?php echo $pBannerFin?>');

$("#dCombustible").html('<?php echo $nombre_combustible;?>');


</script>
<input type="hidden" id="contact" name="contact" />
