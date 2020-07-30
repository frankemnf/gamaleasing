// JavaScript Document

var URLactual = window.location;
//alert(URLactual);


function envia_contacto(){
	
	var txtNombre 	= $('#nombre').val();
	var txtEmail	= $('#email').val();
	var txtFono 	= $('#telefono').val();
	var txtMensaje 	= $('#mensaje').val();
	
	var NombreAuto 	= $('#pAuto').val(); //nombreAuto;
	var ClienteId	= $('#pCliente').val();
	//var ClienteId	= '574';
	var AutoId 		= $('#eIdAuto').val(); //autoid;
	var res 		= $('#pcAuto').val();
	var urlAuto		= 'http://www.autosusados.cl/fotos/' + ClienteId + '/0101' + AutoId + '-1-2-3.jpg';
	//var urlFicha    = '<?php echo $pUrl ?>'+'/ficha.php?' + res;
	var pUrl		= $('#pUrl').val();

	var urlFicha    = pUrl + '/ficha.php';
	
	var Precio		= $('#vpPrecio').val();
	var EmailC		= $('#pEmail').val();
	var NombreC		= $('#pNombre').val();
	var valor		= $('#contact').val();
	
	var txtMarca	= $('#pMarca').val();
	var txtModelo	= $('#pModelo').val();
	var txtAno		= $('#pAnoFab').val();
	var fono1automotora=$('#vpFonos1').val();
	var fono2automotora=$('#vpFonos2').val();
	
	var txtPrecio	= $('#vpPrecio').val();


	var tipo_mail  = 1;
	
	 var num_cuotas = $('input[name="num_cuotas"]:checked').map(function(){
            return $(this).val();

        }).get();

        var pie = $("#pie").val();
        var pie_final = "";

        for (var i = 0; i < pie.length; i++) {
            pie_final = pie_final + pie.substr(i, 1).replace(".", "");
        }

        pie = pie_final;

        var autopago = $("#autopago").val();    $("#nombre001").css("display","none");
    $("#telefono001").css("display","none");
    $("#email001").css("display","none");
    $("#mesaje001").css("display","none");    $("#pie001").css("display","none");
    $("#cuotas001").css("display","none");
    $("#pago001").css("display","none");
	
	
	if ($('#checkbox1').prop('checked')){
            //console.log("cuotas=" + num_cuotas);
            

            if (pie == ""){
                //alert("Favor Ingresar Pie");
                $("#pie001").css("display","block");
                document.getElementById("pie").focus();
                return false;
            } else {
                if (isNaN(pie)){
                    
                    //alert('Debe ingresar solo Números al Pie');
                    $("#pie001 > p").html('<i class="fa fa-info-circle color01"></i> Debe ingresar solo numeros');
                    $("#pie001").css("display","block");
                    document.getElementById('pie').focus();
                    return false;
                }
            }
            
            if (num_cuotas == ""){
                $("#cuotas001").css("display","block");
                $("#cuotas001").find('p').html('<i class="fa fa-info-circle color01"></i> Debe seleccionar al menos una cuota');
                //document.getElementById("pie").focus();
                //alert("Favor seleccione al menos una cuota.");
                return false;
            }
            //console.log('checked=' + num_cuotas);
        }                        if ($('#checkbox7').prop('checked')){            if(autopago==""){                $("#pago001").css("display","block");                document.getElementById('autopago').focus();
                return false;            }        }        
    
		
	if(txtNombre == ""){
		//alert("Favor Ingresar Nombre");
		$("#nombre001").css("display","block");
		document.getElementById("nombre").focus();
	}else if (txtFono == ""){
		//alert("Favor Ingresar telefono");
		$("#telefono001").css("display","block");
		document.getElementById("telefono").focus();
	}else if (txtEmail == ""){
		//alert("Favor Ingresar email");
		$("#email001").css("display","block");
		document.getElementById("email").focus();
	}else if (!isEmailAddress(document.getElementById('email'))){
	    $("#email001").css("display","block");
		document.getElementById("email").focus();
	}else if (txtMensaje == ""){
	    $("#mesaje001").css("display","block");
		//alert("Favor Ingresar mensaje");
		document.getElementById("mensaje").focus();
	}else{
		
		URLactual = URLactual +"&eIdAuto="+AutoId;
		
		
		var envia	=objetoAjax();
		envia.open ('POST',"encriptador_prueba.php", true);
		envia.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		envia.send("txtNombre="+txtNombre+"&txtEmail="+txtEmail.toLowerCase()+"&txtMensaje="+txtMensaje+"&txtFono="+txtFono+"&Precio="+txtPrecio+"&ClienteID="+ClienteId+"&Marca="+txtMarca+"&Modelo="+txtModelo+"&Ano="+txtAno+"&IdAuto="+AutoId+"&Tabla=1&tipo_mail="+tipo_mail+"&URLactual="+URLactual+"&fono1automotora="+fono1automotora+"&fono2automotora="+fono2automotora + "&num_cuotas=" + num_cuotas + "&pie=" + pie + "&autopago=" + autopago);
	
		$("#carga").css("display", "block");
		envia.onreadystatechange = function() 
		{
			if (envia.readyState==4)
			{  		
				dat					= envia.responseText;
				//alert(dat);
				if(dat == 1)
				{
				    $(".fondo-g").css("display", "block");
				    $(".banner-gracia").css("display", "block");
				    
					//alert("Su correo fue enviado con exito, pronto nos comunicaremos con usted.");
					//document.getElementById('carga-automotoras').innerHTML=dat;
					//location.href = "app/inicio/inicio.php";
					$("#carga").css("display", "none");
					
					$('#nombre').val('');
	                $('#email').val('');
	                $('#telefono').val('');
	                $('#mensaje').val('');
	                $('#pie').val('');
	                $('#autopago').val('');
	                $('#checkbox1').prop('checked', false);
	                $('#checkbox7').prop('checked', false);
					$('.cajaCotizaCredito').css("display", "none");
					$('.cajaAutoPago').css("display", "none");
					
					
					funcionContador(AutoId, 7, 1);
					//envia_contactophp();
					
					if(ClienteId == 41 || ClienteId == 138 || ClienteId == 279 || ClienteId == 281 || ClienteId == 288 || ClienteId == 377 || ClienteId == 545 || ClienteId == 546 ){
					
					    fanalytic();
					    
					}
	
				}else{
					
					alert("Su correo no pudo ser enviado, favor intentar nuevamente gracias.");
					$("#carga").css("display", "none");
	
				}
				
				$("#nombre001").css("display","none");
                $("#telefono001").css("display","none");
                $("#email001").css("display","none");
                $("#mesaje001").css("display","none");
				
			}
		}

	}
}


function envia_comparte(){
	
	
	var nombred		= document.getElementById('nombredc').value;
	var maild		= document.getElementById('miEmaildc').value;
	
	var nombrep		= document.getElementById('nomAmigoc').value;
	var mailp		= document.getElementById('AmiEmailc').value;

	var txtMensaje 	= $('#mensajeCom').val();

	var NombreAuto 	= $('#pAuto').val(); //nombreAuto;
	var ClienteId	= $('#pCliente').val();
	var AutoId 		= $('#eIdAuto').val(); //autoid;
	var urlAuto		= 'http://www.autosusados.cl/fotos/' + ClienteId + '/0101' + AutoId + '-1-2-3.jpg';
	var res 		= $('#pcAuto').val();
	var pUrl		= $('#pUrl').val();

	var urlFicha    = pUrl + '/ficha.php';
	var Precio		= $('#vpPrecio').val();
	var EmailC		= $('#pEmail').val();
	var NombreC		= $('#pNombre').val();
	var valor		= $('#contact').val();
	var fono1automotora=('#vpFonos1').val();
	var fono2automotora=('#vpFonos2').val();
	
	var tipo_mail   = 2;
	
	if(nombred == ""){
		//alert("Favor Ingresar su Nombre");
		document.getElementById("nombredc").focus();
	}else if (maild == ""){
		alert("Favor Ingresar su mail");
		document.getElementById("miEmaildc").focus();
	}else if (!isEmailAddress(document.getElementById('miEmaildc'))){
		document.getElementById("miEmaildc").focus();
	}else if (nombrep == ""){
		alert("Favor Ingresar el nombre de su amigo");
		document.getElementById("nomAmigoc").focus();
	}else if (mailp == ""){
		alert("Favor Ingresar mail de su amigo");
		document.getElementById("AmiEmailc").focus();
	}else if (!isEmailAddress(document.getElementById('AmiEmailc'))){
		document.getElementById("AmiEmailc").focus();
	}else if (txtMensaje == ""){
		alert("Favor Ingresar mensaje");
		document.getElementById("mensajeCom").focus();
	}else{

		URLactual = URLactual +"&eIdAuto="+AutoId;
		
		var envia	=objetoAjax();
		envia.open ('POST',"encriptador_prueba.php", true);
		envia.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		envia.send("nombred="+nombred+"&maild="+maild+"&nombrep="+nombrep+"&mailp="+mailp+"&IdAuto="+AutoId+"&mensaje="+txtMensaje+"&clienteid="+ClienteId+"&Tabla=1&tipo_mail="+tipo_mail+"&URLactual="+URLactual);
	
		$("#carga").css("display", "block");
	
		envia.onreadystatechange = function() 
		{
			if (envia.readyState==4)
			{  		
				dat					= envia.responseText;
				//alert(dat);
				if(dat == 1)
				{
					alert("Su correo fue enviado con exito.");
					//document.getElementById('carga-automotoras').innerHTML=dat;
					//location.href = "app/inicio/inicio.php";
					$("#carga").css("display", "none");
					
					funcionContador(AutoId, 8, 1);
					
				}else{
					
					alert("Su correo no pudo ser enviado, favor intentar nuevamente gracias.");
					$("#carga").css("display", "none");
				}
			}
		}
	
	}
}


function redes(x){
	
	if(x == 1){//facebook
		
		var urlfacebook = 'http://www.facebook.com/sharer.php?u=';
		var pUrl		= $('#pUrl').val();
		var eIdAuto		= $('#eIdAuto').val(); //autoid;
		var pNomUrl		= $('#pNomUrl').val(); //autoid;
		var ClienteId	= $('#pCliente').val();
		
		var url_actual = pUrl+'ficha.php?'+pNomUrl+'&eIdAuto='+eIdAuto;
		
        var encodeurl_actual = encodeURIComponent(url_actual);

		
        var respuesta = urlfacebook + encodeurl_actual;
		
		var ptitulo	= $('#ptitulo').val(); //autoid;

		var tittle_actual = ptitulo;
		var pCliente = $('#pCliente').val();
		var pCodigo = $('#pCodigo').val();
		
		var fotomuestra = 'http://www.autosusados.cl/fotos/' + pCliente + '/' + pCodigo + '-1-1-3.jpg';
		
		var hNombreCliente = $('#pNombre').val();
		var pNombre = $('#pNombre').val();
		var pAuto = $('#pAuto').val();
		
		var pDireccion = $('#pDireccion').val();
		var vpFonos1 = $('#vpFonos1').val();
		var vpFonos2 = $('#vpFonos2').val();
		
		var Descripcion = pAuto + ' Lo Vende: ' + pNombre + '. Ubicado en : ' + pDireccion + '. Fonos : ' + vpFonos1 + ' - ' + vpFonos2;

		var idfacebook = $('#idfacebook').val();
		
        FB.init({
            appId: idfacebook,
            xfbml: true,
            version: 'v2.1'
        });

        FB.ui(
		        {
		            method: 'feed',
		            name: tittle_actual,
		            link: url_actual,
		            caption: pUrl,
		            picture: fotomuestra,
		            description: hNombreCliente,
		            message: Descripcion
		        }
		    );
		//window.open(respuesta, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
		
		funcionContador(eIdAuto, 1, 1);
			
	}
	if(x == 2){//twitter
		

		var urltwitter = 'https://twitter.com/intent/tweet?text=';
		var ptitulo	= $('#ptitulo').val(); //autoid;

		var tittle_actual = ptitulo;

		var pUrl		= $('#pUrl').val();
		var url_actual = pUrl + 'ficha.php';
		
		var eIdAuto		= $('#eIdAuto').val();
		
		url_actual = url_actual + '?eIdAuto=' + eIdAuto;
		
        var encodeurl_actual = encodeURIComponent(url_actual.replace(" ", "-"));

        var encodetittle = encodeURIComponent(tittle_actual);


        var respuesta = urltwitter + encodetittle + "&url=" + encodeurl_actual + "&via=ValenzuelaDelar";
		
		funcionContador(eIdAuto, 2, 1);
		
		window.open(respuesta, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
		
	}

	if(x == 3){//google+

		var urlgoogle = 'https://plus.google.com/share?url=';
		var ptitulo	= $('#ptitulo').val(); //autoid;

		var tittle_actual = ptitulo;

		var pUrl		= $('#pUrl').val();
		var pNomUrl		= $('#pNomUrl').val();
		var eIdAuto		= $('#eIdAuto').val();

		var url_actual = pUrl + 'ficha.php?' + pNomUrl + '&eIdAuto=' + eIdAuto;
		
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
		
		funcionContador(eIdAuto, 3, 1);
		
        window.open(trim(url), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');

		
	}
	if(x == 4){//whatsapp
	
		var urlwhatsapp = 'whatsapp://send?text=';
		var ptitulo	= $('#ptitulo').val(); //autoid;

		var tittle_actual = ptitulo;
		var pUrl		= $('#pUrl').val();
		var pNomUrl		= $('#pNomUrl').val();
		var eIdAuto		= $('#eIdAuto').val();

		var url_actual = pUrl + 'ficha.php?' + pNomUrl + '&eIdAuto=' + eIdAuto;
		
        var encodeurl_actual = encodeURIComponent(url_actual.replace(" ", "-"));

        var encodetittle = encodeURIComponent(tittle_actual);


        var respuesta = urlwhatsapp + encodetittle + " " + encodeurl_actual;

		funcionContador(eIdAuto, 4, 1);
		
//		alert("respuesta = " + respuesta);
//		alert("encodetittle = " + encodetittle);
//		alert("encodeurl_actual = " + encodeurl_actual);
		//alert("respuesta = " + respuesta);
		
		window.open(respuesta, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
		
	}
}

function regresar(){

    var devolver		= $('#vpagina').val();
    
    console.log("devolver = " + devolver);
    
//    if(devolver == '' || devolver == ''){
    
//        window.history.back(-1);
    
//    }else{
    
	    document.getElementById("enviar").method = "post";
	    document.getElementById("enviar").action = 'seminuevos.php';
	    document.getElementById("enviar").submit();

//   }

//	document.getElementById("enviar").method = "post";
//	document.getElementById("enviar").action = 'seminuevos.php';
//	document.getElementById("enviar").submit();
	
}

function llama(){
	var eIdAuto		= $('#eIdAuto').val();
	
	funcionContador(eIdAuto, 5, 1);
}

function trim(cadena){
       cadena=cadena.replace(/^\s+/,'').replace(/\s+$/,'');
       return(cadena);
}

var idfacebook = $('#idfacebook').val();


window.fbAsyncInit = function() {
FB.init({
  appId      : idfacebook,
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

(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
po.src = 'https://apis.google.com/js/plusone.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();

(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=" + idfacebook;
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


(function (d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (!d.getElementById(id)) {
		js = d.createElement(s);
		js.id = id;
		js.src = "//platform.twitter.com/widgets.js";
		fjs.parentNode.insertBefore(js, fjs);
	}
} (document, "script", "twitter-wjs"));


if (typeof wabtn4fg === "undefined") { wabtn4fg = 1; h = document.head || document.getElementsByTagName("head")[0], s = document.createElement("script"); s.type = "text/javascript"; s.src = "complementos/dist/whatsapp-button.js"; h.appendChild(s); }

function fanalytic(){

    /* <![CDATA[ */
    var google_conversion_id = 944932197;
    var google_conversion_language = "en";
    var google_conversion_format = "3";
    var google_conversion_color = "ffffff";
    var google_conversion_label = "JKDVCIKjkGAQ5YrKwgM";
    var google_remarketing_only = false;
    /* ]]> */

}