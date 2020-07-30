
<?php require_once("complementos/inc/similares.php"); ?>    

<?php require_once("complementos/inc/jparametros.php"); ?>

<!--Colocar Url de autosusados a estos js-->
<script src="complementos/js/ajax.js" type="text/javascript"></script>
<script type="text/javascript" src="complementos/js/ficha.js"></script>
<script>
$(document).ready(function(e){
    $('input:checkbox[id=checkbox1]').click(function(e){
				
                if ($('.cajaCotizaCredito').is(":visible")){
                    $(".cajaCotizaCredito").hide();
                    $("#pie").val("");
                    $("input[name=num_cuotas]").prop('checked', false);
                } else {
                    $(".cajaCotizaCredito").show();
                }

    });
	
	$('input:checkbox[id=checkbox7]').click(function(e){

                if ($('.cajaAutoPago').is(":visible")){
                    $(".cajaAutoPago").hide();
                    $("#autopago").val("");
                } else {
                    $(".cajaAutoPago").show();
                }

     });


});
</script>

<!-------Fancybox------->
<!--<script src='complementos/js/ryxren.js'></script>
<script  src="complementos/js/index.js"></script>-->
<!-------Fin Fancybox------->

<!--Fin Colocar Url de autosusados a estos js-->
<div class="loading" style="display:none" id="carga"></div>

<script type="text/javascript">
function redes(x){
	
	if(x == 1){//facebook
		
		var urlfacebook = 'http://www.facebook.com/sharer.php?u=';
		var url_actual = '<?php echo $pUrl?>/ficha.php?<?php echo $pNomUrl?>&eIdAuto=<?php echo $eIdAuto?>';
		
        var encodeurl_actual = encodeURIComponent(url_actual);

		
        var respuesta = urlfacebook + encodeurl_actual;

		var tittle_actual = '<?php echo $ptitulo?>';
		var url_actual = '<?php echo $pUrl?>/ficha.php?<?php echo $pNomUrl?>&eIdAuto=<?php echo $eIdAuto?>';

		var fotomuestra = 'http://www.autosusados.cl/fotos/<?php echo $pCliente?>/<?php echo $pCodigo?>-1-1-3.jpg';
		var hNombreCliente = '<?php echo $pNombre?>';
		var Descripcion = '<?php echo $pAuto?> Lo Vende: <?php echo $pNombre?>. Ubicado en : <?php echo $pDireccion?>. Fonos : <?php echo $vpFonos1?> - <?php echo $vpFonos2?>';
		
        FB.init({
            appId: '<?php echo $idfacebook ?>',
            xfbml: true,
            version: 'v2.1'
        });

        FB.ui(
		        {
		            method: 'feed',
		            name: tittle_actual,
		            link: url_actual,
		            caption: '<?php echo $pUrl?>',
		            picture: fotomuestra,
		            description: hNombreCliente,
		            message: Descripcion
		        }
		    );
		//window.open(respuesta, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
		
		funcionContador('<?php echo $eIdAuto?>', 1, 1);
			
	}
	if(x == 2){//twitter
		

		var urltwitter = 'https://twitter.com/intent/tweet?text=';
		var tittle_actual = '<?php echo $ptitulo?>';
		var url_actual = '<?php echo $pUrl?>/ficha.php';
		
		url_actual = url_actual + '?eIdAuto=<?php echo $eIdAuto?>';
		
        var encodeurl_actual = encodeURIComponent(url_actual.replace(" ", "-"));

        var encodetittle = encodeURIComponent(tittle_actual);


        var respuesta = urltwitter + encodetittle + "&url=" + encodeurl_actual + "&via=AutosUsados_cl";
		
		funcionContador('<?php echo $eIdAuto?>', 2, 1);
		
		window.open(respuesta, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
		
	}


	if(x == 3){//google+

		var urlgoogle = 'https://plus.google.com/share?url=';
		var tittle_actual = '<?php echo $ptitulo?>';
		var url_actual = '<?php echo $pUrl?>/ficha.php?<?php echo $pNomUrl?>&eIdAuto=<?php echo $eIdAuto?>';
		
        var encodeurl_actual = encodeURIComponent(url_actual.replace(" ", "-"));

        var encodetittle = encodeURIComponent(tittle_actual);


        var respuesta = urlgoogle + encodeurl_actual + "/" + encodetittle;
		
		respuesta = encodeURIComponent(respuesta.replace(" ", "-"));


//		return respuesta;
//		window.open(respuesta, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');

        url_actual = url_actual + '?' + tittle_actual;

        var url;

        url = 'https://plus.google.com/share?';
        url += '&url=' + encodeURIComponent(url_actual.replace(" ", "-"));
        //alert("url = " + url);
		
		funcionContador('<?php echo $eIdAuto?>', 3, 1);
		
        window.open(trim(url), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');

		
	}
	if(x == 4){//whatsapp
	
		var urlwhatsapp = 'whatsapp://send?text=';
		var tittle_actual = '<?php echo $ptitulo?>';
		var url_actual = '<?php echo $pUrl?>/ficha.php?<?php echo $pNomUrl?>&eIdAuto=<?php echo $eIdAuto?>';
		
        var encodeurl_actual = encodeURIComponent(url_actual.replace(" ", "-"));

        var encodetittle = encodeURIComponent(tittle_actual);


        var respuesta = urlwhatsapp + encodetittle + " " + encodeurl_actual;

		funcionContador('<?php echo $eIdAuto?>', 4, 1);
		
//		alert("respuesta = " + respuesta);
//		alert("encodetittle = " + encodetittle);
//		alert("encodeurl_actual = " + encodeurl_actual);
		//alert("respuesta = " + respuesta);
		
		window.open(respuesta, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
		
	}
}
function llama(){
	
	funcionContador('<?php echo $eIdAuto?>', 5, 1);
}

function trim(cadena){
       cadena=cadena.replace(/^\s+/,'').replace(/\s+$/,'');
       return(cadena);
}
</script>

<script>

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '<?php echo $idfacebook ?>',
      xfbml      : true,
      version    : 'v2.3'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<script type="text/javascript" language="javascript">
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo $idfacebook ?>";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


</script> 
<script type="text/javascript" >
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = "//platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);
        }
    } (document, "script", "twitter-wjs"));
</script>
<script type="text/javascript">    if (typeof wabtn4fg === "undefined") { wabtn4fg = 1; h = document.head || document.getElementsByTagName("head")[0], s = document.createElement("script"); s.type = "text/javascript"; s.src = "complementos/dist/whatsapp-button.js"; h.appendChild(s); }</script>
<!--Fin cambiar todo este texto hasta el final del archivo-->