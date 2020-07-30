// JScript source code
// JavaScript Document

muestraSimilares();

function muestraSimilares(){
	
	var msCliente = $('#vClienteid').val();
	var msPrecio = $('#vPrecio').val();
	
	var msrPrecio = msPrecio.replace(".", "");
	
	msrPrecio = msrPrecio.replace(".", "");

	console.log("msCliente  = " + msCliente);
	console.log("msrPrecio  = " + msrPrecio);
	
	var misucursal=$("#misucursal").val()!='undefined'&&$("#misucursal").val()?"&suc="+$("#misucursal").val():"";
	var mimarca=$("#mimarca").val()!='undefined'&&$("#mimarca").val()?"&mar="+$("#mimarca").val():"";
	var micategoria=$("#micategoria").val()!='undefined'&&$("#micategoria").val()?"&cat="+$("#micategoria").val():"";
	var mimodelo=$("#mimodelo").val()!='undefined'&&$("#mimodelo").val()?"&mod="+$("#mimodelo").val():"";
	var mianohasta=$("#mianoh").val()!='undefined'&&$("#mianoh").val()?"&anoh="+$("#mianoh").val():"";
	var miprecio=$("#miprecio").val()!='undefined'&&$("#miprecio").val()?"&prec="+$("#miprecio").val():"";
	var micombustible=$("#micombustible").val()!='undefined'&&$("#micombustible").val()?"&comb="+$("#micombustible").val():"";
	var mitransmision=$("#mitransmision").val()!='undefined'&&$("#mitransmision").val()?"&trans="+$("#mitransmision").val():"";
	var mipagina="&pag="+$("#pagina").val();
	
	$.ajax({
		type: "POST",
		url: "serviciosAU/InvocaAutosSimilaresNew.php",
		data: "Cliente=" + msCliente + "&Precio=" + msrPrecio,
		dataType:"json",
		success: function(msresp){

			var mselem = $("#mssimilares"); 
			mselem.empty(); // vacia datos para proxima entrada
			
			msitem21 = '';
			console.log("autos similares3.js==============...");
			var contador=1;
			$.each(msresp, function (msk, msv) {

				if(contador<=4){

					msitem21 = msitem21 + '<div class="cuadroAuto col-12 col-md-3">';

//Inicio Nuevo Cambiar url foto					
					console.log("FotUrl= " + msv.FotUrl);

					if(msv.FotUrl != '' ){	
						/*
						mscodigo1 = msv.NFoto.replace("-0", "-1");
						mscodigo = mscodigo1.replace("-1.jpg", "-3.jpg");
						mscodigo ="http://www.autosusados.cl/fotos/" + msCliente + "/" + mscodigo; 
						*/
						mscodigo = msv.FotUrl;
					
					}else{
						mscodigo="complementos/image/noimage.jpg";
					}
//Fin Nuevo Cambiar url foto	

					console.log("mscodigo= " + mscodigo);

					msimg_src = mscodigo;
					msimg_alt = msv.Marca + ' ' + msv.Modelo + ', ' + msv.AnoFab;
					msimg_precio = (msv.Valor!=0&&msv.Valor)?msv.Moneda + ' ' + msv.Valor:'-';
					msimg_km = msv.Kilometros;
				
					if(msimg_km == ''){
						
						msimg_km = '-';
						
					}

					msimg_version = msv.Version;
					msimg_agno = msv.AnoFab;
				
					msitem21 = msitem21 + '	<div class="caja-auto clearfix" style="margin-left: 10px!important; ">';                
					msitem21 = msitem21 + '		<div class="thumbnail car-box" style="padding: 0px 0px 4px 0px!important">'; 

					console.log("Etiqueta= " + msv.Etiqueta);

//Inicio Nuevo Cambiar Etiquetas					
				                  
					if(msv.Etiqueta != "" && msv.Etiqueta != "0"){
						
						var str = msv.ColorC;
						var res = str.split("-");
						var n = res.length;
						console.log("n= " + n);
						if(n <= 1){
							msitem21 = msitem21 + ' <div class="ribbon-wrapper"><div class="ribbon-css" style="color: ' + msv.fontcolor + ';background-color: ' + msv.ColorC + ';">' + msv.Titulo + '</div></div>';
						}else{
							msitem21 = msitem21 + '	<div class="ribbon-wrapper"><div class="ribbon-css ' + msv.ColorC + '">' + msv.Titulo + '</div></div>';
						}
					}

//Inicio Nuevo Cambiar Etiquetas

					msitem21 = msitem21 + '			<a href="ficha.php?'+ msv.Marca +' '+ msv.Modelo + '&eIdAuto=' + msv.AutoID + mipagina+ misucursal+micategoria+mimarca+mimodelo+mianohasta+miprecio+micombustible+mitransmision +'"><img src="' + msimg_src + '" alt="' + msimg_alt + '" /></a>';
					msitem21 = msitem21 + '        	<div class="caption car-content">';
					msitem21 = msitem21 + '				<div class="header b-items-cars-one-info-header s-lineDownLeft">';
					msitem21 = msitem21 + '                <h3>';
					msitem21 = msitem21 + '                    <a href="ficha.php?'+msv.Marca +' '+ msv.Modelo + '&eIdAuto=' + msv.AutoID + mipagina+ misucursal+micategoria+mimarca+mimodelo+mianohasta+miprecio+micombustible+mitransmision +'">' + msv.Marca + ' ' + msv.Modelo + '</a>';
					msitem21 = msitem21 + '                    <span>' + msimg_precio + '</span>';
					msitem21 = msitem21 + '                </h3>';
					msitem21 = msitem21 + '            </div>';

//Inicio Nuevo Combustible y transmision

					var mCombustible;				
					if(msv.Combustible == 1){					
						mCombustible = 'Gasolina';					
					}else if(msv.Combustible == 2){					
						mCombustible = 'Diesel';					
					}else if(msv.Combustible == 3){					
						mCombustible = 'GNC';					
					}else if(msv.Combustible == 4){					
						mCombustible = 'Electrico';	
					}else if(msv.Combustible == 5){					
						mCombustible = 'Híbrido';									
					}else if(msv.Combustible == ""){					
						mCombustible = '';					
					}

					var mTransmision;				
					if(msv.Transmision == 0){					
						mTransmision = 'Automatico';					
					}else if(msv.Transmision == 1){					
						mTransmision = 'Mecanico';					
					}else if(msv.Transmision == 2){					
						mTransmision = 'Mixto';					
					}else if(msv.Transmision == 3){					
						mTransmision = 'Secuencial';					
					}else if(msv.Transmision == ""){					
						mTransmision = '';					
					}
//Fin Nuevo Combustible y transmision

					msitem21 = msitem21 + '            <div class="car-tags" style="height: 40px!important;">';
					msitem21 = msitem21 + '					<ul>';
					msitem21 = msitem21 + '                    <li>' + msv.AnoFab + '</li>';
					msitem21 = msitem21 + '                    <li>' + mCombustible + '</li>';
					msitem21 = msitem21 + '                    <li>' + mTransmision + '</li>';
					msitem21 = msitem21 + '                    <li>' + msimg_km + ' Kms</li>';
					msitem21 = msitem21 + '                	</ul>';
					msitem21 = msitem21 + '            </div>';                            
					msitem21 = msitem21 + '            <div class="details-button">';
					msitem21 = msitem21 + '                <a href="ficha.php?'+ msv.Marca +' '+ msv.Modelo + '&eIdAuto=' + msv.AutoID + mipagina+ misucursal+micategoria+mimarca+mimodelo+mianohasta+miprecio+micombustible+mitransmision +'">Detalles</a>';
					msitem21 = msitem21 + '            </div>';
								
					msitem21 = msitem21 + '        </div>';  //caption car-content
							
					msitem21 = msitem21 + '    </div>';  //thumbnail car-box
						
					msitem21 = msitem21 + '	</div>';  //caja-auto clearfix

					msitem21 = msitem21 + '</div>';  //cuadro-auto
				
				
					contador++;
				
				}
			})
			
			mselem.append(msitem21);
			$('#mssimilares').html(msitem21);
		}
		
	});
}

function salto(Marca,Modelo,Moneda,Precio,Clienteid,Autoid,Codigo){

	document.getElementById('eIdAuto').value = Autoid;
	
	document.getElementById('vpagina').value = "seminuevos.html";
	
	var tauto = Marca + ' ' + Modelo;
	
	funcionContador(Autoid, 9, 1);
	
	document.getElementById("enviar").action = 'ficha.php?' + tauto + '&eIdAuto=' + Autoid;
	document.getElementById('enviar').method = 'post';
	document.getElementById('enviar').submit();
}

function funcionContador(AutoId, TipoId, Cant) {

	$.ajax({
		type: 'POST',
		url: "serviciosAU/ServicioContar.php",
		dataType:"json",
		data: 'AutoId=' + AutoId + '&TipoId=' + TipoId + '&Cant=' + Cant
	});

}

function volver() {



	if ($("#vpagina").val() != "") {

		var volver = $("#vpagina").val();

	} else {

		var volver = "index.html";

	}

	//document.getElementById("vpagina").value = volver;
	document.getElementById("vpagina").value = "seminuevos.html";

	//document.getElementById('enviar').action = volver;
	document.getElementById('enviar').action = "seminuevos.html";
	document.getElementById('enviar').method = 'post';
	document.getElementById('enviar').submit();

}


