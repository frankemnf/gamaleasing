/**
 ** PLANTILLA: 	FICHA RESPONSIVE NÂ°1(DESPLIEGA FICHA ABAJO DE LA MINIFICHA)
 ** VERSION: 	1.0
 ** AUTOR: 		EQUIPO DE DISEÃ‘O AGENCIA DESTACADOS
 ** DESCRIPCION:PLANTILLA DE MINIFICHAS Y FICHA RESPONSIVE, SOLO MODIFICAR CSS E IMAGENES COMO LOGOTIPO E IMAGENES NO DISPONIBLES.
 ** URL AUTOR:	http://www.agencia.destacados.cl/
 ** Copyright 2013 Destacados.cl
 **/


//////////////////////////////////////////////////////////////////////////////////////
//aaaaa
var respJS;
var totalJS;
var maxPorPagina = 1000;
var PaginaActual = 0;


function CargaDestacdos(ClienteId, EstadoId, MaxVeh) {

	$.ajax({
		type: "POST",
		url: "serviciosAU/jgetAutosDestacadosNew.php",
		data: "ClienteId=" + ClienteId + "&EstadoId=" + EstadoId + "&maximo=" + MaxVeh,
		dataType: "json",
		success: function (msresp) {

			var mselem = $("#mssimilares");
			mselem.empty(); // vacia datos para proxima entrada

			var msitem21 = '';


			$.each(msresp, function (msk, msv) {
//Inicio Nuevo Cambiar URL Fotografías
				if (msv.FotUrl == ''){

					mscodigo = msv.NFoto.replace("-1.jpg", "-2.jpg");

					msimg_src = 'http://www.autosusados.cl/fotos/' + msv.Clienteid + '/' + mscodigo;

				}else{

					msimg_src = msv.FotUrl;

				}
//Fin Nuevo Cambiar URL Fotografías				
				msimg_alt = msv.Marca + ' ' + msv.Modelo + ', ' + msv.Ano;
				msimg_precio = msv.Moneda + ' ' + msv.Precio;
				msimg_km = msv.Kilometros;

				if (msimg_km == '') {

					msimg_km = '-';

				}

				msimg_version = msv.Version;
				msimg_agno = msv.Ano;

//Inicio Nuevo Cambiar Combustibles y transmision				
				var mCombustible;

				if (msv.Combustible == 1) {

					mCombustible = 'Gasolina';

				}
				if (msv.Combustible == 2) {

					mCombustible = 'Diesel';

				}
				if (msv.Combustible == 3) {

					mCombustible = 'GNC';

				}
				if (msv.Combustible == 4) {

					mCombustible = 'Electrico';

				}
				if (msv.Combustible == 5) {

					mCombustible = 'Híbrido';

				}				
				if (msv.Combustible == "") {

					mCombustible = '';

				}

				var mTransmision;

				if (msv.Transmision == 0) {

					mTransmision = 'Automático';

				}
				if (msv.Transmision == 1) {

					mTransmision = 'Mecánico';

				}
				if (msv.Transmision == 2) {

					mTransmision = 'Mixto';

				}
				if (msv.Transmision == 3) {

					mTransmision = 'Secuencial';

				}
				if (msv.Transmision == "") {

					mTransmision = '';

				}
//Fin Nuevo Cambiar Combustibles y transmision

				msitem21 = msitem21 + '<div class="col-md-3  col-xs-6  caja-auto clearfix">';

				msitem21 = msitem21 + '    <div class="thumbnail car-box" style="padding: 0px 0px 4px 0px!important">';

//Inicio Nuevo Cambiar Etiquetas				
				if (msv.Etiqueta != "" && msv.Etiqueta != "0") {
					var str = msv.ColorC;
					var res = str.split("-");
					var n = res.length;
					if(n <= 1){
						msitem21 = msitem21 + '<div class="ribbon-wrapper"><div class="ribbon-css" style="color: ' + msv.fontcolor + ';background-color: ' + msv.ColorC + ';">' + msv.Titulo + '</div></div>';
					}else{
						msitem21 = msitem21 + '<div class="ribbon-wrapper"><div class="ribbon-css ' + msv.ColorC + '">' + msv.Titulo + '</div></div>';
					}
				}
//Fin Nuevo Cambiar Etiquetas

				msitem21 = msitem21 + '		   <a href="ficha.php?' + msv.Marca + ' ' + msv.Modelo + '&eIdAuto=' + msv.Autoid + '"><img src="' + msimg_src + '" alt="' + msimg_alt + '" onerror="this.onerror=null;this.src=\'complementos/image/noimage.jpg\';" /></a>';

				msitem21 = msitem21 + '        <div class="caption car-content">';

				msitem21 = msitem21 + '            <div class="header b-items-cars-one-info-header s-lineDownLeft">';
				msitem21 = msitem21 + '                <h3>';

				msitem21 = msitem21 + '                    <a href="ficha.php?' + msv.Marca + ' ' + msv.Modelo + '&eIdAuto=' + msv.Autoid + '">' + msv.Marca + ' ' + msv.Modelo + '</a>';

				msitem21 = msitem21 + '                    <span>' + msimg_precio + '';
				msitem21 = msitem21 + '                    </span>';
				msitem21 = msitem21 + '                </h3>';
				msitem21 = msitem21 + '            </div>';

				msitem21 = msitem21 + '            <div class="car-tags">';
				msitem21 = msitem21 + '                <ul>';
				msitem21 = msitem21 + '                    <li>' + msv.Ano + '</li>';
				msitem21 = msitem21 + '                    <li>' + mCombustible + '</li>';
				msitem21 = msitem21 + '                    <li>' + mTransmision + '</li>';
				msitem21 = msitem21 + '                    <li>' + msimg_km + ' Kms</li>';
				msitem21 = msitem21 + '                </ul>';
				msitem21 = msitem21 + '            </div>';

				msitem21 = msitem21 + '            <div class="details-button">';

				msitem21 = msitem21 + '                <a href="ficha.php?' + msv.Marca + ' ' + msv.Modelo + '&eIdAuto=' + msv.Autoid + '">VER MÁS</a>';

				msitem21 = msitem21 + '            </div>';
				/*
				msitem21 = msitem21 + '            <div class="details-button2">';
				msitem21 = msitem21 + '                <a href="financiamiento.php">FINANCIAMIENTO</a>';
				msitem21 = msitem21 + '            </div>';
				*/
				msitem21 = msitem21 + '        </div>';

				msitem21 = msitem21 + '    </div>';

				msitem21 = msitem21 + '</div>';


			})

			mselem.append(msitem21);
			$('#mssimilares').html(msitem21);
		}

	});
}

function salto(Marca, Modelo, Moneda, Precio, Clienteid, Autoid, Codigo) {

	document.getElementById('eIdAuto').value = Autoid;

	var tauto = Marca + ' ' + Modelo;

	funcionContador(Autoid, 9, 1);

	document.getElementById("vpagina").value = 1;

	document.getElementById("enviar").method = "post";
	document.getElementById("enviar").action = 'ficha.php?' + tauto + '&eIdAuto=' + Autoid;
	document.getElementById("enviar").submit();
}

function saltoDes(Marca, Modelo, Moneda, Precio, Clienteid, Autoid, Codigo) {

	document.getElementById('eIdAuto').value = Autoid;

	var tauto = Marca + ' ' + Modelo;

	funcionContador(Autoid, 9, 1);

	document.getElementById("vpagina").value = 2;

	document.getElementById("enviar").method = "post";
	document.getElementById("enviar").action = 'ficha.php?' + tauto + '&eIdAuto=' + Autoid;
	document.getElementById("enviar").submit();
}


//FILTROS DE BUSQUEDA
function BuscarAutos(x) {

	var clienteid = $('#misucursal').val() ? $('#misucursal').val() : $('#clienteid').val();
	var catid = $('#micategoria').val();
	var marcaid = $('#mimarca').val();
	var modeloid = $('#mimodelo').val();
	var anodesde = $('#mianod').val();
	var anohasta = $('#mianoh').val();
	var preciohasta = $('#miprecio').val();
	var sucursal = $('#ddlSucursal2').val();
	var transmision = $("#mitransmision").val();
	var clienteunico = $("#clienteiduno").val();
	var promocion = $('#mipromo').val();
	var kilo = $('#mikm').val();
	var Bencina = $('#micombustible').val();
	var pagina = $('#pagina').val();
	var por_pagina = parseInt($("#por_pagina").val());

	console.log("miclienteid=" + clienteid);
	var orden = $('#miorden').val() ? $('#miorden').val() : "";
	/*if (sucursal != -1){
		clienteid = sucursal;
    }*/

	var pag = $('#vpagina').val();
	console.log("pag = " + pag);

	console.log("aqui");

	console.log("catid = " + catid);
	console.log("marcaid = " + marcaid);
	console.log("modeloid = " + modeloid);
	console.log("anodesde = " + anodesde);
	console.log("preciohasta = " + preciohasta);
	console.log("transmision = " + transmision);
	console.log("Bencina = " + Bencina);
	console.log("clienteids = " + clienteid);

	$("#carga").css("display", "block");

	$.ajax({

		type: "GET",
		url: "serviciosAU/jgetCargaSeminuevosGrillaNew3.php",
		dataType: "json",
		//data: "marcaid=" + marcaid + '&catid=' + catid + "&clienteid=" + clienteid + '&modeloid=' + modeloid + '&anodesde=' + anodesde + '&preciohasta=' + preciohasta + '&transmision=' + transmision + '&kilometraje=' + kilometraje,
		data: "marcaid=" + marcaid + '&catid=' + catid + "&clienteunico=" + clienteunico + "&clienteid=" + clienteid + '&modeloid=' + modeloid + '&anodesde=' + anodesde + '&anohasta=' + anohasta + '&preciohasta=' + preciohasta + '&transmision=' + transmision + '&bencina=' + Bencina + "&pag=" + pagina + "&por_pagina=" + por_pagina + "&orden=" + orden + "&etiqueta=" + promocion + "&kilo=" + kilo,
		success: function (resp) {
			respJS = resp
			total = resp.length;
			totalJS = total;
			PaginaActual = 0;
			$('#vpagina').val('');

			$("#carga").css("display", "none");

//Inicio Nuevo Cambiar imagen sin resultados
			if (resp.length == 0 || resp.length == '') {
				$('#grid_auto').html('<div class="container"><div class="justify-content-center"><div class="col align-self-center"><img src="imagenes/sinresultados.png" width="300" class="img-fluid" style="margin-right: auto; margin-left: auto"></div></div></div>');
			} else {

				loadMiniFicha(true);
			}
//Fin Nuevo Cambiar imagen sin resultados

		},
		error: function (xhr, ajaxOptions, thrownError) {

		}
	});
}

//FORMATO MINIFICHA (GRID Y LIST)
function loadMiniFicha(bol) {
	var ls = $("#navgrid");
	var formato = $('#tipo_grid').val();
	var item21 = '';
	var pagina = PaginaActual + 1;
	var validaPag;

	validaPag = (totalJS / maxPorPagina) + 1;

	var inicio;
	var termino;

	var misucursal = $("#misucursal").val() != 'undefined' && $("#misucursal").val() ? "&suc=" + $("#misucursal").val() : "";
	var mimarca = $("#ddlMarca2").val() != 'undefined' && $("#ddlMarca2").val() ? "&mar=" + $("#ddlMarca2").val() : "";
	var micategoria = $("#micategoria").val() != 'undefined' && $("#micategoria").val() ? "&cat=" + $("#micategoria").val() : "";
	var mimodelo = $("#mimodelo").val() != 'undefined' && $("#mimodelo").val() ? "&mod=" + $("#mimodelo").val() : "";
	var mianodesde = $("#mianod").val() != 'undefined' && $("#mianod").val() ? "&anod=" + $("#mianod").val() : "";
	var mianohasta = $("#mianoh").val() != 'undefined' && $("#mianoh").val() ? "&anoh=" + $("#mianoh").val() : "";
	var miprecio = $("#miprecio").val() != 'undefined' && $("#miprecio").val() ? "&prec=" + $("#miprecio").val() : "";
	var micombustible = $("#micombustible").val() != 'undefined' && $("#micombustible").val() ? "&comb=" + $("#micombustible").val() : "";
	var mitransmision = $("#mitransmision").val() != 'undefined' && $("#mitransmision").val() ? "&trans=" + $("#mitransmision").val() : "";
	var nombrepagina = $("#nombrepag").val() != 'undefined' && $("#nombrepag").val() ? $("#nombrepag").val() : "";
	var miorden = $("#miorden").val() != 'undefined' && $('#miorden').val() ? "&ord=" + $('#miorden').val() : "";
	var mipromo = $("#mipromo").val() != 'undefined' && $('#mipromo').val() ? "&prom=" + $('#mipromo').val() : "";
	var mikm = $("#mikm").val() != 'undefined' && $('#mikm').val() ? "&Kilometro=" + $('#mikm').val() : "";

	var mipagina = "&pag=" + $("#pagina").val();

	if (pagina <= validaPag) {

		if (pagina > 1) {
			inicio = (pagina - 1) * maxPorPagina;
		}
		else {
			inicio = 0;
		}
		termino = pagina * maxPorPagina;

		if ((inicio <= totalJS) && (bol)) {
			ls.empty();
		}



		if (formato == 'grid') {
			item21 = '<div id="navgrid" class="grilla_autos row">';

			for (var i = 0; i < totalJS; i++) {

				if ((i >= inicio) && (i < termino)) {

					mscodigo1 = respJS[i].NFoto.replace("-0", "-1");
					mscodigo = mscodigo1.replace("-1.jpg", "-3.jpg");


					item21 = item21 + '<div class="col-12 col-sm-6 col-md-3 caja-auto clearfix">';
					item21 = item21 + '    <div class="thumbnail car-box" style="padding: 0px 0px 4px 0px!important">';

//Inicio Nuevo Cambiar etiquetas					
					if (respJS[i].EtiquetaN != "" && respJS[i].EtiquetaN != "SinEtiqueta") {
						var str = respJS[i].ColorC;
						var res = str.split("-");
						var n = res.length;
						if(n <= 1){
							item21 = item21 + ' <div class="ribbon-wrapper"><div class="ribbon-css" style="color: ' + respJS[i].fontcolor + ';background-color: ' + respJS[i].ColorC + ';">' + respJS[i].Titulo + '</div></div>';
						}else{
							item21 = item21 + '	<div class="ribbon-wrapper"><div class="ribbon-css ' + respJS[i].ColorC + '">' + respJS[i].Titulo + '</div></div>';
						}
					}
//Fin Nuevo Cambiar etiquetas
//Inicio Nuevo Cambiar url fotos
					item21 = item21 + '      <a onclick="funcionContador(' + respJS[i].Autoid + ',6,1);" href="ficha.php?' + respJS[i].Marca + ' ' + respJS[i].Modelo + '&eIdAuto=' + respJS[i].Autoid + mipagina + misucursal + micategoria + mimarca + mimodelo + mianodesde + mianohasta + miprecio + micombustible + mitransmision + miorden + mipromo + mikm + '">';
					
					if (respJS[i].FotUrl != ''){
						item21 = item21 + '      <img src="' + respJS[i].FotUrl + '" class="img-responsive" alt="' + respJS[i].Marca + ' ' + respJS[i].Modelo + ' ' + respJS[i].Ano + '" onerror="this.onerror=null;this.src=\'complementos/image/noimage.jpg\';"/>';
					}else{
						item21 = item21 + '      <img src="http://www.autosusados.cl/sinwm/' + respJS[i].Clienteid + '/' + mscodigo + '" class="img-responsive" alt="' + respJS[i].Marca + ' ' + respJS[i].Modelo + ' ' + respJS[i].Ano + '" onerror="this.onerror=null;this.src=\'complementos/image/noimage.jpg\';"/>';
					}
					item21 = item21 + '      </a>';
//Fin Nuevo Cambiar url fotos
					item21 = item21 + '        	 <div class="caption car-content">';

					msimg_precio = (respJS[i].Precio != "0") ? respJS[i].Moneda + " " + respJS[i].Precio : "-";

					item21 = item21 + '            <div class="header b-items-cars-one-info-header s-lineDownLeft">';
					item21 = item21 + '                <h3>';
					item21 = item21 + '                    <a onclick="funcionContador(' + respJS[i].Autoid + ',6,1);" href="ficha.php?' + respJS[i].Marca + ' ' + respJS[i].Modelo + '&eIdAuto=' + respJS[i].Autoid + mipagina + misucursal + micategoria + mimarca + mimodelo + mianodesde + mianohasta + miprecio + micombustible + mitransmision + miorden + mipromo + mikm + '">' + respJS[i].Marca + ' ' + respJS[i].Modelo + '</a>';
					item21 = item21 + '                    <span>' + msimg_precio + '</span>';
					item21 = item21 + '                </h3>';
					item21 = item21 + '            </div>';

//Inicio Nuevo Cambiar combustible y transmision					
					var mCombustible;

					if (respJS[i].Combustible == 1) {

						mCombustible = 'Gasolina';

					}
					if (respJS[i].Combustible == 2) {

						mCombustible = 'Diesel';

					}
					if (respJS[i].Combustible == 3) {

						mCombustible = 'GNC';

					}
					if (respJS[i].Combustible == 4) {

						mCombustible = 'Electrico';

					}
					if (respJS[i].Combustible == 5) {

						mCombustible = 'Híbrido';

					}
					if (respJS[i].Combustible == "") {

						mCombustible = '';

					}

					var mTransmision;

					if (respJS[i].Transmision == "0" && respJS[i].Transmision != "") {

						mTransmision = 'Automático';

					}
					if (respJS[i].Transmision == 1) {

						mTransmision = 'Mecánico';

					}
					if (respJS[i].Transmision == 2) {

						mTransmision = 'Mixto';

					}
					if (respJS[i].Transmision == 3) {

						mTransmision = 'Secuencial';

					}
					if (respJS[i].Transmision == "") {

						mTransmision = '';

					}
//Fin Nuevo Cambiar combustible y transmision

					var kmnew = respJS[i].Kilometros;

					if (kmnew == '') {

						kmnew = '-';

					}

					if (respJS[i].Clienteid == 601 || respJS[i].Clienteid == 603 || respJS[i].Clienteid == 605 || respJS[i].Clienteid == 609 || respJS[i].Clienteid == 612 || respJS[i].Clienteid == 608 || respJS[i].Clienteid == 606 || respJS[i].Clienteid == 610) {
						item21 = item21 + '        <div class="DescripBox" style="font-size: 11px; padding: 5px; color: #505050; text-transform:uppercase; height:30px;">' + (respJS[i].Descripcion ? respJS[i].Descripcion.substring(0, 37) + "..." : "") + '</div>';
					}

					item21 = item21 + '            <div class="car-tags">';
					item21 = item21 + '                <ul>';
					item21 = item21 + '                    <li>' + respJS[i].Ano + '</li>';
					item21 = item21 + '                    <li>' + mCombustible + '</li>';
					item21 = item21 + '                    <li>' + mTransmision + '</li>';
					item21 = item21 + '                    <li>' + kmnew + ' Kms</li>';
					item21 = item21 + '                </ul>';
					item21 = item21 + '            </div>';

					item21 = item21 + '            <div class="details-button">';
					item21 = item21 + '                <a onclick="funcionContador(' + respJS[i].Autoid + ',6,1);" href="ficha.php?' + respJS[i].Marca + ' ' + respJS[i].Modelo + '&eIdAuto=' + respJS[i].Autoid + mipagina + misucursal + micategoria + mimarca + mimodelo + mianodesde + mianohasta + miprecio + micombustible + mitransmision + miorden + mipromo + mikm + '">VER MÁS</a>';
					item21 = item21 + '            </div>';

					item21 = item21 + '        </div>';  //caption car-content

					item21 = item21 + '		</div>';  //thumbnail car-box                   
					item21 = item21 + '</div>';  //caja-auto clearfix

				}
			}

			item21 = item21 + '</div>';

			item21 = item21 + '<div class="clear"></div>';


			var paginador = parseInt($("#paginador").val());
			var inicio = 0;
			var pagina = parseInt($("#pagina").val());
			var por_pagina = parseInt($("#por_pagina").val());
			var stock = respJS[0].Total_autos;
			var fin = 0;

			$('#total_resultado').html(stock);

			if ((pagina - Math.floor(paginador / 2)) > 0) {
				inicio = (pagina - Math.floor(paginador / 2));
			} else {
				inicio = 1;
			}

			if ((inicio + Math.floor(paginador / 2) + Math.floor(paginador / 2)) <= Math.ceil(stock / por_pagina)) {
				fin = (inicio + Math.floor(paginador / 2) + Math.floor(paginador / 2));
			} else {
				fin = Math.ceil(stock / por_pagina);
			}

			console.log("final=" + fin);

			item21 = item21 + '<div aria-label="Page navigation" class="nav-pag">';
			item21 = item21 + '  <ul class="pagination justify-content-center" style="margin: 20px 0">';
			item21 = item21 + '    <li class="page-item">';
			item21 = item21 + '      <a class="page-link" href="' + nombrepagina + '?pag=' + ((pagina - 1 > 0) ? pagina - 1 : pagina) + misucursal + micategoria + mimarca + mimodelo + mianohasta + miprecio + micombustible + mitransmision + miorden + mipromo + '" aria-label="Previous">';
			item21 = item21 + '        <span aria-hidden="true">&laquo;</span>';
			item21 = item21 + '      </a>';
			item21 = item21 + '    </li>';

			for (var p = inicio; p <= fin; p++) {
				item21 = item21 + '    <li class="page-item ' + ((pagina == p) ? 'active' : '') + '"><a class="page-link active" href="' + nombrepagina + '?pag=' + p + misucursal + micategoria + mimarca + mimodelo + mianohasta + miprecio + micombustible + mitransmision + miorden + mipromo + '">' + p + '</a></li>';
			}

			item21 = item21 + '    <li class="page-item">';
			item21 = item21 + '      <a class="page-link" href="' + nombrepagina + '?pag=' + ((pagina + 1 <= fin) ? pagina + 1 : pagina) + misucursal + micategoria + mimarca + mimodelo + mianohasta + miprecio + micombustible + mitransmision + miorden + mipromo + '" aria-label="Next">';
			item21 = item21 + '        <span aria-hidden="true">&raquo;</span>';
			item21 = item21 + '      </a>';
			item21 = item21 + '    </li>';
			item21 = item21 + '  </ul>';
			item21 = item21 + '</div>';

			$('#grid_auto').html(item21);
			PaginaActual = pagina;

		}

	}

}

//PAGINACION GRID
function paginacionGrid() {

	$(".paginacion").jPages({
		containerID: "navgrid",
		perPage: 40,
		startPage: 1,
		startRange: 1,
		midRange: 5,
		endRange: 1,
		//first       : false,
		previous: "â€¹â€¹",
		next: "â€ºâ€º",
		animation: "fadeInUp",
		//last        : false
		callback: function (pages, items) {
			$('html').animate({ scrollTop: 0 }, 'slow');//IE, FF
			$('body').animate({ scrollTop: 0 }, 'slow');//chrome, don't know if safary works
		}
	});
}

//PAGINACION LIST
function paginacionList() {

	$(".paginacion").jPages({
		containerID: "navlist",
		perPage: 16,
		startPage: 1,
		startRange: 1,
		midRange: 5,
		endRange: 1,
		//first       : false,
		previous: "â€¹â€¹",
		next: "â€ºâ€º",
		animation: "fadeInUp",
		//last        : false
		callback: function (pages, items) {
			$('html').animate({ scrollTop: 0 }, 'slow');//IE, FF
			$('body').animate({ scrollTop: 0 }, 'slow');//chrome, don't know if safary works
		}
	});
}

//Inicio Nuevo Carga de menu del buscador
listarAnno();
listarPrecioMax();
listarTransmision();
listarBencina();
listarSucursales();
listarorden();
listarEtiquetas();
//Fin Nuevo Carga de menu del buscador

function listarCategorias() {

	var clienteid = $('#clienteid').val();

	var rCat = $('#micategoria').val();
	console.log("rCat = " + rCat);
	console.log("clienteid = " + clienteid);

	$.ajax({
		type: "POST",
		url: "serviciosAU/jgetCategoriaCliente.php",
		dataType: "json",
		data: "clienteid=" + clienteid,
		success: function (resp, obje) {

			item21 = '<option value="">Categoría</option>';
			for (var i = 0; i < resp.length; i++) {

				if (rCat == resp[i].CATEGORIAID) {

					item21 = item21 + '<option value="' + resp[i].CATEGORIAID + '" selected>' + resp[i].Nombre + '</option>';

				} else {

					item21 = item21 + '<option value="' + resp[i].CATEGORIAID + '">' + resp[i].Nombre + '</option>';

				}

			}

			$('#ddlCategoria2').html(item21);
		}
	});
}

function listarorden() {

	var ordenhtml = '';
	ordenhtml = ordenhtml + '<option value="">Seleccione Orden</option>';
	ordenhtml = ordenhtml + '<option value="modelo" ' + ($("#miorden").val() == "modelo" ? "selected" : "") + '>Marca</option>';
	ordenhtml = ordenhtml + '<option value="preciomax" ' + ($("#miorden").val() == "preciomax" ? "selected" : "") + '>Precio de mayor a menor</option>';
	ordenhtml = ordenhtml + '<option value="preciomin" ' + ($("#miorden").val() == "preciomin" ? "selected" : "") + '>Precio de menor a mayor</option>';
	ordenhtml = ordenhtml + '<option value="anomax" ' + ($("#miorden").val() == "anomax" ? "selected" : "") + '>Año máximo a mínimo</option>';
	ordenhtml = ordenhtml + '<option value="anomin" ' + ($("#miorden").val() == "anomin" ? "selected" : "") + '>Año mínimo a máximo</option>';

	$("#orden").html(ordenhtml);
}

function listarAnno() {

	var elem = $("#mianoh"); elem.empty();
	var ano = (new Date).getFullYear();
	var mes = (new Date).getMonth();
	var rano = $('#mianoh').val();
	console.log("rano = " + rano);

	if (mes >= 6) {
		ano = ano + 1;
	}

	var mlis21 = '';
	mlis21 = mlis21 + '<option value="">Año Hasta</option>';

	for (var i = ano, l = 1960; i >= l; i = i - 1) {

		if (rano == i) {

			mlis21 = mlis21 + '<option value=' + i + ' selected>' + i + '</option>';

		} else {

			mlis21 = mlis21 + '<option value=' + i + '>' + i + '</option>';

		}
	}

	$('#ddlAnoh').html(mlis21);

}

//Inicio Nuevo Cambiar promociones
//Inicio Carga promociones
function listarEtiquetas() {
	//alert($("#mipromo").val());
	var codigo = $("#mipromo").val();
	var clienteid = $('#clienteid').val();

	$.ajax({
		type: "POST",
		url: "serviciosAU/jgetEtiquetas.php",
		dataType: "json",
		data:{clienteid:clienteid},
		success: function (data) {
			$("#promocion").html('<option value="">Seleccione Promocion</option>');
			$.each(data, function (i, v) {
				if (parseInt(v.VCHETIQUETA) == parseInt(codigo)) {
					$("#promocion").append('<option value=' + v.VCHETIQUETA + ' selected>' + v.VCHETIQUETA_TITULO + '</option>');
				} else {
					$("#promocion").append('<option value=' + v.VCHETIQUETA + '>' + v.VCHETIQUETA_TITULO + '</option>');
				}
			});
		}, error: function (data) {
		}
	});
}
//FIN Carga promociones
//Inicio Nuevo Cambiar promociones

//LISTA LAS MARCAS
function listarMarcas() {
	var clienteid = $('#clienteid').val();
	var indice;
	var catid = $("#micategoria").val();
	var rMarca = $("#mimarca").val();

	indice = $('#ddlCategoria2').val();

	//var rMarca = $('#eMarca').val();
	console.log("rMarca = " + rMarca);
	console.log("indice = " + indice);
	console.log("clienteid = " + clienteid);

	$.ajax({
		type: "POST",
		url: "serviciosAU/jgetMarcasCliente.php",
		dataType: "json",
		data: "catid=" + catid + "&clienteid=" + clienteid,
		success: function (resp, obje) {

			item21 = '<option value="">Marca</option>';
			for (var i = 0; i < resp.length; i++) {

				if (rMarca == resp[i].MarcaID) {

					item21 = item21 + '<option value="' + resp[i].MarcaID + '" selected>' + resp[i].Nombre + '</option>';

				} else {

					item21 = item21 + '<option value="' + resp[i].MarcaID + '">' + resp[i].Nombre + '</option>';

				}
			}
			$('#ddlMarca2').html(item21);
		},
		// error cuando no hay un tipo de vehiculo
		error: function (xhr, ajaxOptions, thrownError) {
			//alert(xhr.statusText);
			//alert(thrownError);
		}
	});
}

//LISTA LOS MODELOS
function listarModelos() {

	var catid = $('#micategoria').val();
	var clienteid = $('#clienteid').val();
	var marcaid = $("#mimarca").val();

	$('#ddlModelo2').html('<option value="">Modelo</option>');

	var rModelo = $('#mimodelo').val();
	console.log("rModelo = " + rModelo);
	console.log("catid = " + catid);
	console.log("clienteid = " + clienteid);
	console.log("marcaid = " + marcaid);

	$.ajax({
		type: "POST",
		url: "serviciosAU/jgetModelosCliente.php",
		dataType: "json",
		data: "marcaid=" + marcaid + '&catid=' + catid + "&clienteid=" + clienteid,
		success: function (resp, obje) {

			item21 = '<option value="">Modelo</option>';
			for (var i = 0; i < resp.length; i++) {

				if (rModelo == resp[i].ModeloID) {

					item21 = item21 + '<option value="' + resp[i].ModeloID + '" selected>' + resp[i].Nombre + '</option>';

				} else {

					item21 = item21 + '<option value="' + resp[i].ModeloID + '">' + resp[i].Nombre + '</option>';

				}

			}

			$('#ddlModelo2').html(item21);
		}
	});
}
//LISTA LOS MODELOS

// Carga Precio Max
function listarPrecioMax() {
	var elem = $("#miprecio"); elem.empty();
	var item21 = "";

	var rPrecio = $('#miprecio').val();
	console.log("rPrecio = " + rPrecio);

	$.ajax({
		type: "POST",
		url: "serviciosAU/jgetPrecioMax.php",
		dataType: "json",

		success: function (resp, obje) {

			for (var i = 0; i < resp.length; i++) {

				if (i == 0) {

					item21 = '<option value="1">Precio</option>';
				}

				if (rPrecio == resp[i].PrecioID) {

					item21 = item21 + '<option value="' + resp[i].PrecioID + '" selected>' + resp[i].PrecioNombre + '</option>';

				} else {

					item21 = item21 + '<option value="' + resp[i].PrecioID + '">' + resp[i].PrecioNombre + '</option>';

				}

			}

			$('#ddlPrecio2').html(item21);

		}
	});

}
//FIN Carga Precios Max

// Carga Transmision
function listarTransmision() {

	var elem = $("#mitransmision"); elem.empty();
	var item21 = "";

	var rTransm = '';
	rTransm = $("#mitransmision").val();
	console.log("rTransm = " + rTransm);


	$.ajax({
		type: "POST",
		url: "serviciosAU/jgetTransmision.php",
		dataType: "json",

		success: function (resp, obje) {

			console.log("length = " + resp.length);

			for (var j = 0; j < resp.length; j++) {

				console.log("j = " + j);

				if (j == 0) {

					item21 = '<option value="" selected>Transmisión</option>';
				}

				if (resp[j].TransmisionID == 0 || resp[j].TransmisionID == 1) {

					console.log("rTransm = " + rTransm);
					console.log("resp = " + resp[j].TransmisionID);

					if (parseInt(rTransm) == parseInt(resp[j].TransmisionID)) {

						item21 = item21 + '<option value="' + resp[j].TransmisionID + '" selected >' + resp[j].TransmisionNombre + '</option>';

					} else {

						item21 = item21 + '<option value="' + resp[j].TransmisionID + '">' + resp[j].TransmisionNombre + '</option>';

					}

				}
			}

			$('#ddlTransmision').html(item21);
		}
	});

}
//FIN Carga Transmision

//Inicio Nuevo Cambiar combustible
// Carga Bencina
function listarBencina() {

	var elem = $("#micombustible"); elem.empty();
	var item21 = "";

	var rBencina = $('#micombustible').val();
	console.log("rBencina = " + rBencina);

	$.ajax({
		type: "POST",
		url: "serviciosAU/jgetBencina.php",
		dataType: "json",

		success: function (resp, obje) {

			for (var i = 0; i < resp.length; i++) {

				if (i == 0) {

					item21 = '<option value="">Combustible</option>';
				}

				if (rBencina == resp[i].BencinaID) {

					item21 = item21 + '<option value="' + resp[i].BencinaID + '" selected>' + resp[i].BencinaNombre + '</option>';

				} else {

					item21 = item21 + '<option value="' + resp[i].BencinaID + '">' + resp[i].BencinaNombre + '</option>';

				}

			}

			$('#ddlBencina').html(item21);
		}
	});

}
//FIN Carga Bencina
//Inicio Nuevo Cambiar combustible

// Carga Sucursales
function listarSucursales() {

	var Cliente = $('#clienteiduno').val();

	var elem = $("#ddlSucursal2"); elem.empty();
	var item21 = "";
	var rSucursal = $('#misucursal').val();
	console.log("rSucursal = " + rSucursal);

	$.ajax({
		type: "POST",
		url: "serviciosAU/InvocaSucursalesCliente.php",
		dataType: "json",
		data: "Cliente=" + Cliente,
		success: function (resp, obje) {

			item21 = '<option value="">Sucursales</option>';

			for (var i = 0; i < resp.length; i++) {

				if (rSucursal == resp[i].SucursalID) {

					item21 = item21 + '<option value="' + resp[i].SucursalID + '" selected>' + resp[i].SucursalNombre + '</option>';

				} else {

					item21 = item21 + '<option value="' + resp[i].SucursalID + '">' + resp[i].SucursalNombre + '</option>';

				}
			}

			$('#ddlSucursal2').html(item21);
		}
	});

}
//FIN Carga Sucursales

function funcionContador(AutoId, TipoId, Cant) {

	$.ajax({
		type: 'POST',
		url: "serviciosAU/ServicioContar.php",
		dataType: "json",
		data: 'AutoId=' + AutoId + '&TipoId=' + TipoId + '&Cant=' + Cant
	});

}