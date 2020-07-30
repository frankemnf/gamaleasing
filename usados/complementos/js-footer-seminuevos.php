<script type="text/javascript" src="complementos/js/jquery.destacados3.js"></script>
<!-- CDN Actualizados -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
$(document).ready(function(e) {

    $("#clear").click(function() {
        console.log("entre ");
        $('select').each(function() {
            $(this).val($(this).find("option[selected]").val());
        });

        $("#micategoria").val('');
        $("#mimarca").val('');
        $("#mimodelo").val('');
        $("#mipromo").val('');
        $('#miprecio').val('');
        $('#micombustible').val('');
        $("#mitransmision").val('');
        $('#misucursal').val('');
        $("#mianod").val('');
        $("#mianoh").val('');
        $("#miKilometro").val('');
        $("#misucursal").val('');

        BuscarAutos();
    });

    $("#ddlCategoria2").change(function(e) {

        $("#mimarca").val("");

        $("#mimodelo").val("");

        $("#mianod").val("");

        $("#mianoh").val("");

        $("#miprecio").val("");

        $("#micombustible").val("");

        $("#mitransmision").val("");

        $("#misucursal").val("");

        $("#miorden").val("");

        $("#mipromo").val("");

        var categoria = $(this).val() != 'undefined' && $(this).val() ? $(this).val() : "";

        $("#micategoria").val(categoria);

        var arreglo = [];
        var i = 0;

        if ($("#micategoria").val() != 'undefined' && $("#micategoria").val() != '') {

            arreglo[i] = "cat=" + $("#micategoria").val();

            i = i + 1;
        }
        if ($("#mimarca").val() != 'undefined' && $("#mimarca").val() != '') {

            arreglo[i] = "mar=" + $("#mimarca").val();
            i = i + 1;
        }
        if ($("#mimodelo").val() != 'undefined' && $("#mimodelo").val() != '') {

            arreglo[i] = "mod=" + $("#mimodelo").val();
            i = i + 1;
        }
        if ($("#mipromo").val() != 'undefined' && $("#mipromo").val() != '') {

            arreglo[i] = "prom=" + $("#mipromo").val();
            i = i + 1;
        }
        if ($("#mianod").val() != 'undefined' && $("#mianod").val() != '') {

            arreglo[i] = "anod=" + $("#mianod").val();
            i = i + 1;
        }
        if ($("#mianoh").val() != 'undefined' && $("#mianoh").val() != '') {

            arreglo[i] = "anoh=" + $("#mianoh").val();
            i = i + 1;
        }
        if ($("#miprecio").val() != 'undefined' && $("#miprecio").val() != '') {

            arreglo[i] = "prec=" + $("#miprecio").val();
            i = i + 1;
        }
        if ($("#mikm").val() != 'undefined' && $("#mikm").val() != '') {

            arreglo[i] = "kilometro=" + $("#mikm").val();
            i = i + 1;
        }
        if ($("#micombustible").val() != 'undefined' && $("#micombustible").val() != '') {

            arreglo[i] = "comb=" + $("#micombustible").val();
            i = i + 1;
        }
        if ($("#mitransmision").val() != 'undefined' && $("#mitransmision").val() != '') {

            arreglo[i] = "trans=" + $("#mitransmision").val();
            i = i + 1;
        }
        if ($("#misucursal").val() != 'undefined' && $("#misucursal").val() != '') {

            arreglo[i] = "suc=" + $("#misucursal").val();
            i = i + 1;
        }
        if ($("#miorden").val() != 'undefined' && $("#miorden").val() != '') {

            arreglo[i] = "ord=" + $("#miorden").val();
            i = i + 1;
        }

        parametros = "";
        for (var j = 0; j < arreglo.length; j++) {

            if (arreglo[j] != 'undefined' && arreglo[j] != '') {
                if (j == 0) {
                    parametros = "?" + arreglo[j];
                } else {
                    parametros += "&" + arreglo[j];
                }
            }

        }

        var res = window.location.href.split("//");

        var onlyUrl = res[0] + "//" + window.location.host + window.location.pathname + parametros;

        history.pushState(null, "", onlyUrl);
        
        BuscarAutos();
        listarMarcas();
		listarModelos();
		listarAnno();
		listarPrecioMax();
		listarTransmision();
		listarBencina();
		listarSucursales();
		listarorden();
		listarEtiquetas();

    });

    $("#ddlMarca2").change(function(e) {

        var categoria = $("#ddlCategoria2").val() != 'undefined' && $("#ddlCategoria2").val() ? $("#ddlCategoria2").val() : "";

        $("#micategoria").val(categoria);

        $("#mimodelo").val("");

        var anodesde = $("#ddlAnod").val() != 'undefined' && $("#ddlAnod").val() ? $("#ddlAnod").val() : "";

        $("#mianod").val(anodesde);

        var anohasta = $("#ddlAnoh").val() != 'undefined' && $("#ddlAnoh").val() ? $("#ddlAnoh").val() : "";

        $("#mianoh").val(anohasta);

        var precio = $("#ddlPrecio2").val() != 'undefined' && $("#ddlPrecio2").val() ? $("#ddlPrecio2").val() : "";

        $("#miprecio").val(precio);

        var combustible = $("#ddlBencina").val() != 'undefined' && $("#ddlBencina").val() ? $("#ddlBencina").val() : "";

        $("#micombustible").val(combustible);

        var transmision = $("#ddlTransmision").val() != 'undefined' && $("#ddlTransmision").val() ? $("#ddlTransmision").val() : "";

        $("#mitransmision").val(transmision);

        var sucursal = $("#ddlSucursal2").val() != 'undefined' && $("#ddlSucursal2").val() ? $("#ddlSucursal2").val() : "";

        $("#misucursal").val(sucursal);

        var orden = $("#orden").val() != 'undefined' && $("#orden").val() ? $("#orden").val() : "";

        $("#miorden").val(orden);

        var prom = $("#promocion").val() != 'undefined' && $("#promocion").val() ? $("#promocion").val() : "";

        $("#mipromo").val(prom);

        var marca = $(this).val() != 'undefined' && $(this).val() ? $(this).val() : "";

        $("#mimarca").val(marca);

        var arreglo = [];
        var i = 0;

        if ($("#micategoria").val() != 'undefined' && $("#micategoria").val() != '') {

            arreglo[i] = "cat=" + $("#micategoria").val();

            i = i + 1;
        }
        if ($("#mimarca").val() != 'undefined' && $("#mimarca").val() != '') {

            arreglo[i] = "mar=" + $("#mimarca").val();
            i = i + 1;
        }
        if ($("#mimodelo").val() != 'undefined' && $("#mimodelo").val() != '') {

            arreglo[i] = "mod=" + $("#mimodelo").val();
            i = i + 1;
        }
        if ($("#mipromo").val() != 'undefined' && $("#mipromo").val() != '') {

            arreglo[i] = "prom=" + $("#mipromo").val();
            i = i + 1;
        }
        if ($("#mianod").val() != 'undefined' && $("#mianod").val() != '') {

            arreglo[i] = "anod=" + $("#mianod").val();
            i = i + 1;
        }
        if ($("#mianoh").val() != 'undefined' && $("#mianoh").val() != '') {

            arreglo[i] = "anoh=" + $("#mianoh").val();
            i = i + 1;
        }
        if ($("#miprecio").val() != 'undefined' && $("#miprecio").val() != '') {

            arreglo[i] = "prec=" + $("#miprecio").val();
            i = i + 1;
        }
        if ($("#mikm").val() != 'undefined' && $("#mikm").val() != '') {

            arreglo[i] = "kilometro=" + $("#mikm").val();
            i = i + 1;
        }
        if ($("#micombustible").val() != 'undefined' && $("#micombustible").val() != '') {

            arreglo[i] = "comb=" + $("#micombustible").val();
            i = i + 1;
        }
        if ($("#mitransmision").val() != 'undefined' && $("#mitransmision").val() != '') {

            arreglo[i] = "trans=" + $("#mitransmision").val();
            i = i + 1;
        }
        if ($("#misucursal").val() != 'undefined' && $("#misucursal").val() != '') {

            arreglo[i] = "suc=" + $("#misucursal").val();
            i = i + 1;
        }
        if ($("#miorden").val() != 'undefined' && $("#miorden").val() != '') {

            arreglo[i] = "ord=" + $("#miorden").val();
            i = i + 1;
        }

        parametros = "";
        for (var j = 0; j < arreglo.length; j++) {

            if (arreglo[j] != 'undefined' && arreglo[j] != '') {
                if (j == 0) {
                    parametros = "?" + arreglo[j];
                } else {
                    parametros += "&" + arreglo[j];
                }
            }

        }

        var res = window.location.href.split("//");

        var onlyUrl = res[0] + "//" + window.location.host + window.location.pathname + parametros;

        history.pushState(null, "", onlyUrl);            

        BuscarAutos();

        listarModelos();

    });

    $("#ddlModelo2").change(function(e) {

        var categoria = $("#ddlCategoria2").val() != 'undefined' && $("#ddlCategoria2").val() ? $("#ddlCategoria2").val() : "";

        $("#micategoria").val(categoria);

        var marca = $("#ddlMarca2").val() != 'undefined' && $("#ddlMarca2").val() ? $("#ddlMarca2").val() : "";

        $("#mimarca").val(marca);

        var anodesde = $("#ddlAnod").val() != 'undefined' && $("#ddlAnod").val() ? $("#ddlAnod").val() : "";

        $("#mianod").val(anodesde);

        var anohasta = $("#ddlAnoh").val() != 'undefined' && $("#ddlAnoh").val() ? $("#ddlAnoh").val() : "";

        $("#mianoh").val(anohasta);

        var precio = $("#ddlPrecio2").val() != 'undefined' && $("#ddlPrecio2").val() ? $("#ddlPrecio2").val() : "";

        $("#miprecio").val(precio);

        var combustible = $("#ddlBencina").val() != 'undefined' && $("#ddlBencina").val() ? $("#ddlBencina").val() : "";

        $("#micombustible").val(combustible);

        var transmision = $("#ddlTransmision").val() != 'undefined' && $("#ddlTransmision").val() ? $("#ddlTransmision").val() : "";

        $("#mitransmision").val(transmision);

        var sucursal = $("#ddlSucursal2").val() != 'undefined' && $("#ddlSucursal2").val() ? $("#ddlSucursal2").val() : "";

        $("#misucursal").val(sucursal);

        var orden = $("#orden").val() != 'undefined' && $("#orden").val() ? $("#orden").val() : "";

        $("#miorden").val(orden);

        var prom = $("#promocion").val() != 'undefined' && $("#promocion").val() ? $("#promocion").val() : "";

        $("#mipromo").val(prom);

        var modelo = $(this).val() != 'undefined' && $(this).val() ? $(this).val() : "";

        $("#mimodelo").val(modelo);

        var arreglo = [];
        var i = 0;

        if ($("#micategoria").val() != 'undefined' && $("#micategoria").val() != '') {

            arreglo[i] = "cat=" + $("#micategoria").val();

            i = i + 1;
        }
        if ($("#mimarca").val() != 'undefined' && $("#mimarca").val() != '') {

            arreglo[i] = "mar=" + $("#mimarca").val();
            i = i + 1;
        }
        if ($("#mimodelo").val() != 'undefined' && $("#mimodelo").val() != '') {

            arreglo[i] = "mod=" + $("#mimodelo").val();
            i = i + 1;
        }
        if ($("#mipromo").val() != 'undefined' && $("#mipromo").val() != '') {

            arreglo[i] = "prom=" + $("#mipromo").val();
            i = i + 1;
        }
        if ($("#mianod").val() != 'undefined' && $("#mianod").val() != '') {

            arreglo[i] = "anod=" + $("#mianod").val();
            i = i + 1;
        }
        if ($("#mianoh").val() != 'undefined' && $("#mianoh").val() != '') {

            arreglo[i] = "anoh=" + $("#mianoh").val();
            i = i + 1;
        }
        if ($("#miprecio").val() != 'undefined' && $("#miprecio").val() != '') {

            arreglo[i] = "prec=" + $("#miprecio").val();
            i = i + 1;
        }
        if ($("#mikm").val() != 'undefined' && $("#mikm").val() != '') {

            arreglo[i] = "kilometro=" + $("#mikm").val();
            i = i + 1;
        }
        if ($("#micombustible").val() != 'undefined' && $("#micombustible").val() != '') {

            arreglo[i] = "comb=" + $("#micombustible").val();
            i = i + 1;
        }
        if ($("#mitransmision").val() != 'undefined' && $("#mitransmision").val() != '') {

            arreglo[i] = "trans=" + $("#mitransmision").val();
            i = i + 1;
        }
        if ($("#misucursal").val() != 'undefined' && $("#misucursal").val() != '') {

            arreglo[i] = "suc=" + $("#misucursal").val();
            i = i + 1;
        }
        if ($("#miorden").val() != 'undefined' && $("#miorden").val() != '') {

            arreglo[i] = "ord=" + $("#miorden").val();
            i = i + 1;
        }

        parametros = "";
        for (var j = 0; j < arreglo.length; j++) {

            if (arreglo[j] != 'undefined' && arreglo[j] != '') {
                if (j == 0) {
                    parametros = "?" + arreglo[j];
                } else {
                    parametros += "&" + arreglo[j];
                }
            }

        }

        var res = window.location.href.split("//");

        var onlyUrl = res[0] + "//" + window.location.host + window.location.pathname + parametros;

        history.pushState(null, "", onlyUrl);            

        BuscarAutos();

    });

    $("#ddlSucursal2").change(function(e) {

        var categoria = $("#ddlCategoria2").val() != 'undefined' && $("#ddlCategoria2").val() ? $("#ddlCategoria2").val() : "";

        $("#micategoria").val(categoria);

        var marca = $("#ddlMarca2").val() != 'undefined' && $("#ddlMarca2").val() ? $("#ddlMarca2").val() : "";

        $("#mimarca").val(marca);

        var modelo = $("#ddlModelo2").val() != 'undefined' && $("#ddlModelo2").val() ? $("#ddlModelo2").val() : "";

        $("#mimodelo").val(modelo);

        var anodesde = $("#ddlAnod").val() != 'undefined' && $("#ddlAnod").val() ? $("#ddlAnod").val() : "";

        $("#mianod").val(anodesde);

        var anohasta = $("#ddlAnoh").val() != 'undefined' && $("#ddlAnoh").val() ? $("#ddlAnoh").val() : "";

        $("#mianoh").val(anohasta);

        var precio = $("#ddlPrecio2").val() != 'undefined' && $("#ddlPrecio2").val() ? $("#ddlPrecio2").val() : "";

        $("#miprecio").val(precio);

        var combustible = $("#ddlBencina").val() != 'undefined' && $("#ddlBencina").val() ? $("#ddlBencina").val() : "";

        $("#micombustible").val(combustible);

        var transmision = $("#ddlTransmision").val() != 'undefined' && $("#ddlTransmision").val() ? $("#ddlTransmision").val() : "";

        $("#mitransmision").val(transmision);

        var orden = $("#orden").val() != 'undefined' && $("#orden").val() ? $("#orden").val() : "";

        $("#miorden").val(orden);

        var prom = $("#promocion").val() != 'undefined' && $("#promocion").val() ? $("#promocion").val() : "";

        $("#mipromo").val(prom);

        var sucursal = $(this).val() != 'undefined' && $(this).val() ? $(this).val() : "";

        $("#misucursal").val(sucursal);

        var arreglo = [];
        var i = 0;

        if ($("#micategoria").val() != 'undefined' && $("#micategoria").val() != '') {

            arreglo[i] = "cat=" + $("#micategoria").val();

            i = i + 1;
        }
        if ($("#mimarca").val() != 'undefined' && $("#mimarca").val() != '') {

            arreglo[i] = "mar=" + $("#mimarca").val();
            i = i + 1;
        }
        if ($("#mimodelo").val() != 'undefined' && $("#mimodelo").val() != '') {

            arreglo[i] = "mod=" + $("#mimodelo").val();
            i = i + 1;
        }
        if ($("#mipromo").val() != 'undefined' && $("#mipromo").val() != '') {

            arreglo[i] = "prom=" + $("#mipromo").val();
            i = i + 1;
        }
        if ($("#mianod").val() != 'undefined' && $("#mianod").val() != '') {

            arreglo[i] = "anod=" + $("#mianod").val();
            i = i + 1;
        }
        if ($("#mianoh").val() != 'undefined' && $("#mianoh").val() != '') {

            arreglo[i] = "anoh=" + $("#mianoh").val();
            i = i + 1;
        }
        if ($("#miprecio").val() != 'undefined' && $("#miprecio").val() != '') {

            arreglo[i] = "prec=" + $("#miprecio").val();
            i = i + 1;
        }
        if ($("#mikm").val() != 'undefined' && $("#mikm").val() != '') {

            arreglo[i] = "kilometro=" + $("#mikm").val();
            i = i + 1;
        }
        if ($("#micombustible").val() != 'undefined' && $("#micombustible").val() != '') {

            arreglo[i] = "comb=" + $("#micombustible").val();
            i = i + 1;
        }
        if ($("#mitransmision").val() != 'undefined' && $("#mitransmision").val() != '') {

            arreglo[i] = "trans=" + $("#mitransmision").val();
            i = i + 1;
        }
        if ($("#misucursal").val() != 'undefined' && $("#misucursal").val() != '') {

            arreglo[i] = "suc=" + $("#misucursal").val();
            i = i + 1;
        }
        if ($("#miorden").val() != 'undefined' && $("#miorden").val() != '') {

            arreglo[i] = "ord=" + $("#miorden").val();
            i = i + 1;
        }

        parametros = "";
        for (var j = 0; j < arreglo.length; j++) {

            if (arreglo[j] != 'undefined' && arreglo[j] != '') {
                if (j == 0) {
                    parametros = "?" + arreglo[j];
                } else {
                    parametros += "&" + arreglo[j];
                }
            }

        }

        var res = window.location.href.split("//");

        var onlyUrl = res[0] + "//" + window.location.host + window.location.pathname + parametros;

        history.pushState(null, "", onlyUrl);            

        BuscarAutos();

    });

    $("#ddlAnod").change(function(e) {

        var categoria = $("#ddlCategoria2").val() != 'undefined' && $("#ddlCategoria2").val() ? $("#ddlCategoria2").val() : "";

        $("#micategoria").val(categoria);

        var marca = $("#ddlMarca2").val() != 'undefined' && $("#ddlMarca2").val() ? $("#ddlMarca2").val() : "";

        $("#mimarca").val(marca);

        var modelo = $("#ddlModelo2").val() != 'undefined' && $("#ddlModelo2").val() ? $("#ddlModelo2").val() : "";

        $("#mimodelo").val(modelo);

        var precio = $("#ddlPrecio2").val() != 'undefined' && $("#ddlPrecio2").val() ? $("#ddlPrecio2").val() : "";

        $("#miprecio").val(precio);

        var combustible = $("#ddlBencina").val() != 'undefined' && $("#ddlBencina").val() ? $("#ddlBencina").val() : "";

        $("#micombustible").val(combustible);

        var transmision = $("#ddlTransmision").val() != 'undefined' && $("#ddlTransmision").val() ? $("#ddlTransmision").val() : "";

        $("#mitransmision").val(transmision);

        var sucursal = $("#ddlSucursal2").val() != 'undefined' && $("#ddlSucursal2").val() ? $("#ddlSucursal2").val() : "";

        $("#misucursal").val(sucursal);

        var orden = $("#orden").val() != 'undefined' && $("#orden").val() ? $("#orden").val() : "";

        $("#miorden").val(orden);

        var prom = $("#promocion").val() != 'undefined' && $("#promocion").val() ? $("#promocion").val() : "";

        $("#mipromo").val(prom);

        var anohasta = $("#ddlAnoh").val() != 'undefined' && $("#ddlAnoh").val() ? $("#ddlAnoh").val() : "";

        $("#mianoh").val(anohasta);

        var anodesde = $(this).val() != 'undefined' && $(this).val() ? $(this).val() : "";

        $("#mianod").val(anodesde);

        var arreglo = [];
        var i = 0;

        if ($("#micategoria").val() != 'undefined' && $("#micategoria").val() != '') {

            arreglo[i] = "cat=" + $("#micategoria").val();

            i = i + 1;
        }
        if ($("#mimarca").val() != 'undefined' && $("#mimarca").val() != '') {

            arreglo[i] = "mar=" + $("#mimarca").val();
            i = i + 1;
        }
        if ($("#mimodelo").val() != 'undefined' && $("#mimodelo").val() != '') {

            arreglo[i] = "mod=" + $("#mimodelo").val();
            i = i + 1;
        }
        if ($("#mipromo").val() != 'undefined' && $("#mipromo").val() != '') {

            arreglo[i] = "prom=" + $("#mipromo").val();
            i = i + 1;
        }
        if ($("#mianod").val() != 'undefined' && $("#mianod").val() != '') {

            arreglo[i] = "anod=" + $("#mianod").val();
            i = i + 1;
        }
        if ($("#mianoh").val() != 'undefined' && $("#mianoh").val() != '') {

            arreglo[i] = "anoh=" + $("#mianoh").val();
            i = i + 1;
        }
        if ($("#miprecio").val() != 'undefined' && $("#miprecio").val() != '') {

            arreglo[i] = "prec=" + $("#miprecio").val();
            i = i + 1;
        }
        if ($("#mikm").val() != 'undefined' && $("#mikm").val() != '') {

            arreglo[i] = "kilometro=" + $("#mikm").val();
            i = i + 1;
        }
        if ($("#micombustible").val() != 'undefined' && $("#micombustible").val() != '') {

            arreglo[i] = "comb=" + $("#micombustible").val();
            i = i + 1;
        }
        if ($("#mitransmision").val() != 'undefined' && $("#mitransmision").val() != '') {

            arreglo[i] = "trans=" + $("#mitransmision").val();
            i = i + 1;
        }
        if ($("#misucursal").val() != 'undefined' && $("#misucursal").val() != '') {

            arreglo[i] = "suc=" + $("#misucursal").val();
            i = i + 1;
        }
        if ($("#miorden").val() != 'undefined' && $("#miorden").val() != '') {

            arreglo[i] = "ord=" + $("#miorden").val();
            i = i + 1;
        }

        parametros = "";
        for (var j = 0; j < arreglo.length; j++) {

            if (arreglo[j] != 'undefined' && arreglo[j] != '') {
                if (j == 0) {
                    parametros = "?" + arreglo[j];
                } else {
                    parametros += "&" + arreglo[j];
                }
            }

        }

        var res = window.location.href.split("//");

        var onlyUrl = res[0] + "//" + window.location.host + window.location.pathname + parametros;

        history.pushState(null, "", onlyUrl);            

        BuscarAutos();

    });

    $("#ddlAnoh").change(function(e) {

        var categoria = $("#ddlCategoria2").val() != 'undefined' && $("#ddlCategoria2").val() ? $("#ddlCategoria2").val() : "";

        $("#micategoria").val(categoria);

        var marca = $("#ddlMarca2").val() != 'undefined' && $("#ddlMarca2").val() ? $("#ddlMarca2").val() : "";

        $("#mimarca").val(marca);

        var modelo = $("#ddlModelo2").val() != 'undefined' && $("#ddlModelo2").val() ? $("#ddlModelo2").val() : "";

        $("#mimodelo").val(modelo);

        var precio = $("#ddlPrecio2").val() != 'undefined' && $("#ddlPrecio2").val() ? $("#ddlPrecio2").val() : "";

        $("#miprecio").val(precio);

        var combustible = $("#ddlBencina").val() != 'undefined' && $("#ddlBencina").val() ? $("#ddlBencina").val() : "";

        $("#micombustible").val(combustible);

        var transmision = $("#ddlTransmision").val() != 'undefined' && $("#ddlTransmision").val() ? $("#ddlTransmision").val() : "";

        $("#mitransmision").val(transmision);

        var sucursal = $("#ddlSucursal2").val() != 'undefined' && $("#ddlSucursal2").val() ? $("#ddlSucursal2").val() : "";

        $("#misucursal").val(sucursal);

        var orden = $("#orden").val() != 'undefined' && $("#orden").val() ? $("#orden").val() : "";

        $("#miorden").val(orden);

        var prom = $("#promocion").val() != 'undefined' && $("#promocion").val() ? $("#promocion").val() : "";

        $("#mipromo").val(prom);

        var anodesde = $("#ddlAnod").val() != 'undefined' && $("#ddlAnod").val() ? $("#ddlAnod").val() : "";

        $("#mianoh").val(anodesde);

        var anohasta = $(this).val() != 'undefined' && $(this).val() ? $(this).val() : "";

        $("#mianoh").val(anohasta);

        var arreglo = [];
        var i = 0;

        if ($("#micategoria").val() != 'undefined' && $("#micategoria").val() != '') {

            arreglo[i] = "cat=" + $("#micategoria").val();

            i = i + 1;
        }
        if ($("#mimarca").val() != 'undefined' && $("#mimarca").val() != '') {

            arreglo[i] = "mar=" + $("#mimarca").val();
            i = i + 1;
        }
        if ($("#mimodelo").val() != 'undefined' && $("#mimodelo").val() != '') {

            arreglo[i] = "mod=" + $("#mimodelo").val();
            i = i + 1;
        }
        if ($("#mipromo").val() != 'undefined' && $("#mipromo").val() != '') {

            arreglo[i] = "prom=" + $("#mipromo").val();
            i = i + 1;
        }
        if ($("#mianod").val() != 'undefined' && $("#mianod").val() != '') {

            arreglo[i] = "anod=" + $("#mianod").val();
            i = i + 1;
        }
        if ($("#mianoh").val() != 'undefined' && $("#mianoh").val() != '') {

            arreglo[i] = "anoh=" + $("#mianoh").val();
            i = i + 1;
        }
        if ($("#miprecio").val() != 'undefined' && $("#miprecio").val() != '') {

            arreglo[i] = "prec=" + $("#miprecio").val();
            i = i + 1;
        }
        if ($("#mikm").val() != 'undefined' && $("#mikm").val() != '') {

            arreglo[i] = "kilometro=" + $("#mikm").val();
            i = i + 1;
        }
        if ($("#micombustible").val() != 'undefined' && $("#micombustible").val() != '') {

            arreglo[i] = "comb=" + $("#micombustible").val();
            i = i + 1;
        }
        if ($("#mitransmision").val() != 'undefined' && $("#mitransmision").val() != '') {

            arreglo[i] = "trans=" + $("#mitransmision").val();
            i = i + 1;
        }
        if ($("#misucursal").val() != 'undefined' && $("#misucursal").val() != '') {

            arreglo[i] = "suc=" + $("#misucursal").val();
            i = i + 1;
        }
        if ($("#miorden").val() != 'undefined' && $("#miorden").val() != '') {

            arreglo[i] = "ord=" + $("#miorden").val();
            i = i + 1;
        }

        parametros = "";
        for (var j = 0; j < arreglo.length; j++) {

            if (arreglo[j] != 'undefined' && arreglo[j] != '') {
                if (j == 0) {
                    parametros = "?" + arreglo[j];
                } else {
                    parametros += "&" + arreglo[j];
                }
            }

        }

        var res = window.location.href.split("//");

        var onlyUrl = res[0] + "//" + window.location.host + window.location.pathname + parametros;

        history.pushState(null, "", onlyUrl);            

        BuscarAutos();

    });

    $("#ddlPrecio2").change(function(e) {

        var categoria = $("#ddlCategoria2").val() != 'undefined' && $("#ddlCategoria2").val() ? $("#ddlCategoria2").val() : "";

        $("#micategoria").val(categoria);

        var marca = $("#ddlMarca2").val() != 'undefined' && $("#ddlMarca2").val() ? $("#ddlMarca2").val() : "";

        $("#mimarca").val(marca);

        var modelo = $("#ddlModelo2").val() != 'undefined' && $("#ddlModelo2").val() ? $("#ddlModelo2").val() : "";

        $("#mimodelo").val(modelo);

        var anodesde = $("#ddlAnod").val() != 'undefined' && $("#ddlAnod").val() ? $("#ddlAnod").val() : "";

        $("#mianod").val(anodesde);

        var anohasta = $("#ddlAnoh").val() != 'undefined' && $("#ddlAnoh").val() ? $("#ddlAnoh").val() : "";

        $("#mianoh").val(anohasta);

        var combustible = $("#ddlBencina").val() != 'undefined' && $("#ddlBencina").val() ? $("#ddlBencina").val() : "";

        $("#micombustible").val(combustible);

        var transmision = $("#ddlTransmision").val() != 'undefined' && $("#ddlTransmision").val() ? $("#ddlTransmision").val() : "";

        $("#mitransmision").val(transmision);

        var sucursal = $("#ddlSucursal2").val() != 'undefined' && $("#ddlSucursal2").val() ? $("#ddlSucursal2").val() : "";

        $("#misucursal").val(sucursal);

        var orden = $("#orden").val() != 'undefined' && $("#orden").val() ? $("#orden").val() : "";

        $("#miorden").val(orden);

        var prom = $("#promocion").val() != 'undefined' && $("#promocion").val() ? $("#promocion").val() : "";

        $("#mipromo").val(prom);

        var precio = $(this).val() != 'undefined' && $(this).val() ? $(this).val() : "";

        $("#miprecio").val(precio);

        var arreglo = [];
        var i = 0;

        if ($("#micategoria").val() != 'undefined' && $("#micategoria").val() != '') {

            arreglo[i] = "cat=" + $("#micategoria").val();

            i = i + 1;
        }
        if ($("#mimarca").val() != 'undefined' && $("#mimarca").val() != '') {

            arreglo[i] = "mar=" + $("#mimarca").val();
            i = i + 1;
        }
        if ($("#mimodelo").val() != 'undefined' && $("#mimodelo").val() != '') {

            arreglo[i] = "mod=" + $("#mimodelo").val();
            i = i + 1;
        }
        if ($("#mipromo").val() != 'undefined' && $("#mipromo").val() != '') {

            arreglo[i] = "prom=" + $("#mipromo").val();
            i = i + 1;
        }
        if ($("#mianod").val() != 'undefined' && $("#mianod").val() != '') {

            arreglo[i] = "anod=" + $("#mianod").val();
            i = i + 1;
        }
        if ($("#mianoh").val() != 'undefined' && $("#mianoh").val() != '') {

            arreglo[i] = "anoh=" + $("#mianoh").val();
            i = i + 1;
        }
        if ($("#miprecio").val() != 'undefined' && $("#miprecio").val() != '') {

            arreglo[i] = "prec=" + $("#miprecio").val();
            i = i + 1;
        }
        if ($("#mikm").val() != 'undefined' && $("#mikm").val() != '') {

            arreglo[i] = "kilometro=" + $("#mikm").val();
            i = i + 1;
        }
        if ($("#micombustible").val() != 'undefined' && $("#micombustible").val() != '') {

            arreglo[i] = "comb=" + $("#micombustible").val();
            i = i + 1;
        }
        if ($("#mitransmision").val() != 'undefined' && $("#mitransmision").val() != '') {

            arreglo[i] = "trans=" + $("#mitransmision").val();
            i = i + 1;
        }
        if ($("#misucursal").val() != 'undefined' && $("#misucursal").val() != '') {

            arreglo[i] = "suc=" + $("#misucursal").val();
            i = i + 1;
        }
        if ($("#miorden").val() != 'undefined' && $("#miorden").val() != '') {

            arreglo[i] = "ord=" + $("#miorden").val();
            i = i + 1;
        }

        parametros = "";
        for (var j = 0; j < arreglo.length; j++) {

            if (arreglo[j] != 'undefined' && arreglo[j] != '') {
                if (j == 0) {
                    parametros = "?" + arreglo[j];
                } else {
                    parametros += "&" + arreglo[j];
                }
            }

        }

        var res = window.location.href.split("//");

        var onlyUrl = res[0] + "//" + window.location.host + window.location.pathname + parametros;

        history.pushState(null, "", onlyUrl);            

        BuscarAutos();

    });

    $("#ddlBencina").change(function(e) {

        var categoria = $("#ddlCategoria2").val() != 'undefined' && $("#ddlCategoria2").val() ? $("#ddlCategoria2").val() : "";

        $("#micategoria").val(categoria);

        var marca = $("#ddlMarca2").val() != 'undefined' && $("#ddlMarca2").val() ? $("#ddlMarca2").val() : "";

        $("#mimarca").val(marca);

        var modelo = $("#ddlModelo2").val() != 'undefined' && $("#ddlModelo2").val() ? $("#ddlModelo2").val() : "";

        $("#mimodelo").val(modelo);

        var anodesde = $("#ddlAnod").val() != 'undefined' && $("#ddlAnod").val() ? $("#ddlAnod").val() : "";

        $("#mianod").val(anodesde);

        var anohasta = $("#ddlAnoh").val() != 'undefined' && $("#ddlAnoh").val() ? $("#ddlAnoh").val() : "";

        $("#mianoh").val(anohasta);

        var precio = $("#ddlPrecio2").val() != 'undefined' && $("#ddlPrecio2").val() ? $("#ddlPrecio2").val() : "";

        $("#miprecio").val(precio);

        var transmision = $("#ddlTransmision").val() != 'undefined' && $("#ddlTransmision").val() ? $("#ddlTransmision").val() : "";

        $("#mitransmision").val(transmision);

        var sucursal = $("#ddlSucursal2").val() != 'undefined' && $("#ddlSucursal2").val() ? $("#ddlSucursal2").val() : "";

        $("#misucursal").val(sucursal);

        var prom = $("#promocion").val() != 'undefined' && $("#promocion").val() ? $("#promocion").val() : "";

        $("#mipromo").val(prom);

        var orden = $("#orden").val() != 'undefined' && $("#orden").val() ? $("#orden").val() : "";

        $("#miorden").val(orden);

        var combustible = $(this).val() != 'undefined' && $(this).val() ? $(this).val() : "";

        $("#micombustible").val(combustible);

        var arreglo = [];
        var i = 0;

        if ($("#micategoria").val() != 'undefined' && $("#micategoria").val() != '') {

            arreglo[i] = "cat=" + $("#micategoria").val();

            i = i + 1;
        }
        if ($("#mimarca").val() != 'undefined' && $("#mimarca").val() != '') {

            arreglo[i] = "mar=" + $("#mimarca").val();
            i = i + 1;
        }
        if ($("#mimodelo").val() != 'undefined' && $("#mimodelo").val() != '') {

            arreglo[i] = "mod=" + $("#mimodelo").val();
            i = i + 1;
        }
        if ($("#mipromo").val() != 'undefined' && $("#mipromo").val() != '') {

            arreglo[i] = "prom=" + $("#mipromo").val();
            i = i + 1;
        }
        if ($("#mianod").val() != 'undefined' && $("#mianod").val() != '') {

            arreglo[i] = "anod=" + $("#mianod").val();
            i = i + 1;
        }
        if ($("#mianoh").val() != 'undefined' && $("#mianoh").val() != '') {

            arreglo[i] = "anoh=" + $("#mianoh").val();
            i = i + 1;
        }
        if ($("#miprecio").val() != 'undefined' && $("#miprecio").val() != '') {

            arreglo[i] = "prec=" + $("#miprecio").val();
            i = i + 1;
        }
        if ($("#mikm").val() != 'undefined' && $("#mikm").val() != '') {

            arreglo[i] = "kilometro=" + $("#mikm").val();
            i = i + 1;
        }
        if ($("#micombustible").val() != 'undefined' && $("#micombustible").val() != '') {

            arreglo[i] = "comb=" + $("#micombustible").val();
            i = i + 1;
        }
        if ($("#mitransmision").val() != 'undefined' && $("#mitransmision").val() != '') {

            arreglo[i] = "trans=" + $("#mitransmision").val();
            i = i + 1;
        }
        if ($("#misucursal").val() != 'undefined' && $("#misucursal").val() != '') {

            arreglo[i] = "suc=" + $("#misucursal").val();
            i = i + 1;
        }
        if ($("#miorden").val() != 'undefined' && $("#miorden").val() != '') {

            arreglo[i] = "ord=" + $("#miorden").val();
            i = i + 1;
        }

        parametros = "";
        for (var j = 0; j < arreglo.length; j++) {

            if (arreglo[j] != 'undefined' && arreglo[j] != '') {
                if (j == 0) {
                    parametros = "?" + arreglo[j];
                } else {
                    parametros += "&" + arreglo[j];
                }
            }

        }

        var res = window.location.href.split("//");

        var onlyUrl = res[0] + "//" + window.location.host + window.location.pathname + parametros;

        history.pushState(null, "", onlyUrl);            

        BuscarAutos();

    });

    $("#ddlTransmision").change(function(e) {

        var categoria = $("#ddlCategoria2").val() != 'undefined' && $("#ddlCategoria2").val() ? $("#ddlCategoria2").val() : "";

        $("#micategoria").val(categoria);

        var marca = $("#ddlMarca2").val() != 'undefined' && $("#ddlMarca2").val() ? $("#ddlMarca2").val() : "";

        $("#mimarca").val(marca);

        var modelo = $("#ddlModelo2").val() != 'undefined' && $("#ddlModelo2").val() ? $("#ddlModelo2").val() : "";

        $("#mimodelo").val(modelo);

        var anodesde = $("#ddlAnod").val() != 'undefined' && $("#ddlAnod").val() ? $("#ddlAnod").val() : "";

        $("#mianod").val(anodesde);

        var anohasta = $("#ddlAnoh").val() != 'undefined' && $("#ddlAnoh").val() ? $("#ddlAnoh").val() : "";

        $("#mianoh").val(anohasta);

        var precio = $("#ddlPrecio2").val() != 'undefined' && $("#ddlPrecio2").val() ? $("#ddlPrecio2").val() : "";

        $("#miprecio").val(precio);

        var combustible = $("#ddlBencina").val() != 'undefined' && $("#ddlBencina").val() ? $("#ddlBencina").val() : "";

        $("#micombustible").val(combustible);

        var sucursal = $("#ddlSucursal2").val() != 'undefined' && $("#ddlSucursal2").val() ? $("#ddlSucursal2").val() : "";

        $("#misucursal").val(sucursal);

        var prom = $("#promocion").val() != 'undefined' && $("#promocion").val() ? $("#promocion").val() : "";

        $("#mipromo").val(prom);

        var orden = $("#orden").val() != 'undefined' && $("#orden").val() ? $("#orden").val() : "";

        $("#miorden").val(orden);

        var transmision = $(this).val() != 'undefined' && $(this).val() ? $(this).val() : "";

        $("#mitransmision").val(transmision);

        var arreglo = [];
        var i = 0;

        if ($("#micategoria").val() != 'undefined' && $("#micategoria").val() != '') {

            arreglo[i] = "cat=" + $("#micategoria").val();

            i = i + 1;
        }
        if ($("#mimarca").val() != 'undefined' && $("#mimarca").val() != '') {

            arreglo[i] = "mar=" + $("#mimarca").val();
            i = i + 1;
        }
        if ($("#mimodelo").val() != 'undefined' && $("#mimodelo").val() != '') {

            arreglo[i] = "mod=" + $("#mimodelo").val();
            i = i + 1;
        }
        if ($("#mipromo").val() != 'undefined' && $("#mipromo").val() != '') {

            arreglo[i] = "prom=" + $("#mipromo").val();
            i = i + 1;
        }
        if ($("#mianod").val() != 'undefined' && $("#mianod").val() != '') {

            arreglo[i] = "anod=" + $("#mianod").val();
            i = i + 1;
        }
        if ($("#mianoh").val() != 'undefined' && $("#mianoh").val() != '') {

            arreglo[i] = "anoh=" + $("#mianoh").val();
            i = i + 1;
        }
        if ($("#miprecio").val() != 'undefined' && $("#miprecio").val() != '') {

            arreglo[i] = "prec=" + $("#miprecio").val();
            i = i + 1;
        }
        if ($("#mikm").val() != 'undefined' && $("#mikm").val() != '') {

            arreglo[i] = "kilometro=" + $("#mikm").val();
            i = i + 1;
        }
        if ($("#micombustible").val() != 'undefined' && $("#micombustible").val() != '') {

            arreglo[i] = "comb=" + $("#micombustible").val();
            i = i + 1;
        }
        if ($("#mitransmision").val() != 'undefined' && $("#mitransmision").val() != '') {

            arreglo[i] = "trans=" + $("#mitransmision").val();
            i = i + 1;
        }
        if ($("#misucursal").val() != 'undefined' && $("#misucursal").val() != '') {

            arreglo[i] = "suc=" + $("#misucursal").val();
            i = i + 1;
        }
        if ($("#miorden").val() != 'undefined' && $("#miorden").val() != '') {

            arreglo[i] = "ord=" + $("#miorden").val();
            i = i + 1;
        }

        parametros = "";
        for (var j = 0; j < arreglo.length; j++) {

            if (arreglo[j] != 'undefined' && arreglo[j] != '') {
                if (j == 0) {
                    parametros = "?" + arreglo[j];
                } else {
                    parametros += "&" + arreglo[j];
                }
            }

        }

        var res = window.location.href.split("//");

        var onlyUrl = res[0] + "//" + window.location.host + window.location.pathname + parametros;

        history.pushState(null, "", onlyUrl);            

        BuscarAutos();

    });

    $("#orden").change(function(e) {

        var categoria = $("#ddlCategoria2").val() != 'undefined' && $("#ddlCategoria2").val() ? $("#ddlCategoria2").val() : "";

        $("#micategoria").val(categoria);

        var marca = $("#ddlMarca2").val() != 'undefined' && $("#ddlMarca2").val() ? $("#ddlMarca2").val() : "";

        $("#mimarca").val(marca);

        var modelo = $("#ddlModelo2").val() != 'undefined' && $("#ddlModelo2").val() ? $("#ddlModelo2").val() : "";

        $("#mimodelo").val(modelo);

        var anodesde = $("#ddlAnod").val() != 'undefined' && $("#ddlAnod").val() ? $("#ddlAnod").val() : "";

        $("#mianod").val(anodesde);

        var anohasta = $("#ddlAnoh").val() != 'undefined' && $("#ddlAnoh").val() ? $("#ddlAnoh").val() : "";

        $("#mianoh").val(anohasta);

        var precio = $("#ddlPrecio2").val() != 'undefined' && $("#ddlPrecio2").val() ? $("#ddlPrecio2").val() : "";

        $("#miprecio").val(precio);

        var combustible = $("#ddlBencina").val() != 'undefined' && $("#ddlBencina").val() ? $("#ddlBencina").val() : "";

        $("#micombustible").val(combustible);

        var transmision = $("#ddlTransmision").val() != 'undefined' && $("#ddlTransmision").val() ? $("#ddlTransmision").val() : "";

        $("#mitransmision").val(transmision);

        var sucursal = $("#ddlSucursal2").val() != 'undefined' && $("#ddlSucursal2").val() ? $("#ddlSucursal2").val() : "";

        $("#misucursal").val(sucursal);

        var prom = $("#promocion").val() != 'undefined' && $("#promocion").val() ? $("#promocion").val() : "";

        $("#mipromo").val(prom);

        var orden = $(this).val() != 'undefined' && $(this).val() ? $(this).val() : "";

        $("#miorden").val(orden);

        var arreglo = [];
        var i = 0;

        if ($("#micategoria").val() != 'undefined' && $("#micategoria").val() != '') {

            arreglo[i] = "cat=" + $("#micategoria").val();

            i = i + 1;
        }
        if ($("#mimarca").val() != 'undefined' && $("#mimarca").val() != '') {

            arreglo[i] = "mar=" + $("#mimarca").val();
            i = i + 1;
        }
        if ($("#mimodelo").val() != 'undefined' && $("#mimodelo").val() != '') {

            arreglo[i] = "mod=" + $("#mimodelo").val();
            i = i + 1;
        }
        if ($("#mipromo").val() != 'undefined' && $("#mipromo").val() != '') {

            arreglo[i] = "prom=" + $("#mipromo").val();
            i = i + 1;
        }
        if ($("#mianod").val() != 'undefined' && $("#mianod").val() != '') {

            arreglo[i] = "anod=" + $("#mianod").val();
            i = i + 1;
        }
        if ($("#mianoh").val() != 'undefined' && $("#mianoh").val() != '') {

            arreglo[i] = "anoh=" + $("#mianoh").val();
            i = i + 1;
        }
        if ($("#miprecio").val() != 'undefined' && $("#miprecio").val() != '') {

            arreglo[i] = "prec=" + $("#miprecio").val();
            i = i + 1;
        }
        if ($("#mikm").val() != 'undefined' && $("#mikm").val() != '') {

            arreglo[i] = "kilometro=" + $("#mikm").val();
            i = i + 1;
        }
        if ($("#micombustible").val() != 'undefined' && $("#micombustible").val() != '') {

            arreglo[i] = "comb=" + $("#micombustible").val();
            i = i + 1;
        }
        if ($("#mitransmision").val() != 'undefined' && $("#mitransmision").val() != '') {

            arreglo[i] = "trans=" + $("#mitransmision").val();
            i = i + 1;
        }
        if ($("#misucursal").val() != 'undefined' && $("#misucursal").val() != '') {

            arreglo[i] = "suc=" + $("#misucursal").val();
            i = i + 1;
        }
        if ($("#miorden").val() != 'undefined' && $("#miorden").val() != '') {

            arreglo[i] = "ord=" + $("#miorden").val();
            i = i + 1;
        }

        parametros = "";
        for (var j = 0; j < arreglo.length; j++) {

            if (arreglo[j] != 'undefined' && arreglo[j] != '') {
                if (j == 0) {
                    parametros = "?" + arreglo[j];
                } else {
                    parametros += "&" + arreglo[j];
                }
            }

        }

        var res = window.location.href.split("//");

        var onlyUrl = res[0] + "//" + window.location.host + window.location.pathname + parametros;

        history.pushState(null, "", onlyUrl);            

        BuscarAutos();

    });

    $("#promocion").change(function(e) {

        var categoria = $("#ddlCategoria2").val() != 'undefined' && $("#ddlCategoria2").val() ? $("#ddlCategoria2").val() : "";

        $("#micategoria").val(categoria);

        var marca = $("#ddlMarca2").val() != 'undefined' && $("#ddlMarca2").val() ? $("#ddlMarca2").val() : "";

        $("#mimarca").val(marca);

        var modelo = $("#ddlModelo2").val() != 'undefined' && $("#ddlModelo2").val() ? $("#ddlModelo2").val() : "";

        $("#mimodelo").val(modelo);

        var anodesde = $("#ddlAnod").val() != 'undefined' && $("#ddlAnod").val() ? $("#ddlAnod").val() : "";

        $("#mianod").val(anodesde);

        var anohasta = $("#ddlAnoh").val() != 'undefined' && $("#ddlAnoh").val() ? $("#ddlAnoh").val() : "";

        $("#mianoh").val(anohasta);

        var precio = $("#ddlPrecio2").val() != 'undefined' && $("#ddlPrecio2").val() ? $("#ddlPrecio2").val() : "";

        $("#miprecio").val(precio);

        var combustible = $("#ddlBencina").val() != 'undefined' && $("#ddlBencina").val() ? $("#ddlBencina").val() : "";

        $("#micombustible").val(combustible);

        var transmision = $("#ddlTransmision").val() != 'undefined' && $("#ddlTransmision").val() ? $("#ddlTransmision").val() : "";

        $("#mitransmision").val(transmision);

        var sucursal = $("#ddlSucursal2").val() != 'undefined' && $("#ddlSucursal2").val() ? $("#ddlSucursal2").val() : "";

        $("#misucursal").val(sucursal);

        var orden = $("#orden").val() != 'undefined' && $("#orden").val() ? $("#orden").val() : "";

        $("#miorden").val(orden);

        var prom = $(this).val() != 'undefined' && $(this).val() ? $(this).val() : "";

        $("#mipromo").val(prom);

        var arreglo = [];
        var i = 0;

        if ($("#micategoria").val() != 'undefined' && $("#micategoria").val() != '') {

            arreglo[i] = "cat=" + $("#micategoria").val();

            i = i + 1;
        }
        if ($("#mimarca").val() != 'undefined' && $("#mimarca").val() != '') {

            arreglo[i] = "mar=" + $("#mimarca").val();
            i = i + 1;
        }
        if ($("#mimodelo").val() != 'undefined' && $("#mimodelo").val() != '') {

            arreglo[i] = "mod=" + $("#mimodelo").val();
            i = i + 1;
        }
        if ($("#mipromo").val() != 'undefined' && $("#mipromo").val() != '') {

            arreglo[i] = "prom=" + $("#mipromo").val();
            i = i + 1;
        }
        if ($("#mianod").val() != 'undefined' && $("#mianod").val() != '') {

            arreglo[i] = "anod=" + $("#mianod").val();
            i = i + 1;
        }
        if ($("#mianoh").val() != 'undefined' && $("#mianoh").val() != '') {

            arreglo[i] = "anoh=" + $("#mianoh").val();
            i = i + 1;
        }
        if ($("#miprecio").val() != 'undefined' && $("#miprecio").val() != '') {

            arreglo[i] = "prec=" + $("#miprecio").val();
            i = i + 1;
        }
        if ($("#mikm").val() != 'undefined' && $("#mikm").val() != '') {

            arreglo[i] = "kilometro=" + $("#mikm").val();
            i = i + 1;
        }
        if ($("#micombustible").val() != 'undefined' && $("#micombustible").val() != '') {

            arreglo[i] = "comb=" + $("#micombustible").val();
            i = i + 1;
        }
        if ($("#mitransmision").val() != 'undefined' && $("#mitransmision").val() != '') {

            arreglo[i] = "trans=" + $("#mitransmision").val();
            i = i + 1;
        }
        if ($("#misucursal").val() != 'undefined' && $("#misucursal").val() != '') {

            arreglo[i] = "suc=" + $("#misucursal").val();
            i = i + 1;
        }
        if ($("#miorden").val() != 'undefined' && $("#miorden").val() != '') {

            arreglo[i] = "ord=" + $("#miorden").val();
            i = i + 1;
        }

        parametros = "";
        for (var j = 0; j < arreglo.length; j++) {

            if (arreglo[j] != 'undefined' && arreglo[j] != '') {
                if (j == 0) {
                    parametros = "?" + arreglo[j];
                } else {
                    parametros += "&" + arreglo[j];
                }
            }

        }

        var res = window.location.href.split("//");

        var onlyUrl = res[0] + "//" + window.location.host + window.location.pathname + parametros;

        history.pushState(null, "", onlyUrl);

        BuscarAutos();

    });

    $("#buscar").click(function() {

        var arreglo = [];
        var i = 0;

        if ($("#micategoria").val() != 'undefined' && $("#micategoria").val() != '') {

            arreglo[i] = "cat=" + $("#micategoria").val();

            i = i + 1;
        }
        if ($("#mimarca").val() != 'undefined' && $("#mimarca").val() != '') {

            arreglo[i] = "mar=" + $("#mimarca").val();
            i = i + 1;
        }
        if ($("#mimodelo").val() != 'undefined' && $("#mimodelo").val() != '') {

            arreglo[i] = "mod=" + $("#mimodelo").val();
            i = i + 1;
        }
        if ($("#mipromo").val() != 'undefined' && $("#mipromo").val() != '') {

            arreglo[i] = "prom=" + $("#mipromo").val();
            i = i + 1;
        }
        if ($("#mianod").val() != 'undefined' && $("#mianod").val() != '') {

            arreglo[i] = "anod=" + $("#mianod").val();
            i = i + 1;
        }
        if ($("#mianoh").val() != 'undefined' && $("#mianoh").val() != '') {

            arreglo[i] = "anoh=" + $("#mianoh").val();
            i = i + 1;
        }
        if ($("#miprecio").val() != 'undefined' && $("#miprecio").val() != '') {

            arreglo[i] = "prec=" + $("#miprecio").val();
            i = i + 1;
        }
        if ($("#mikm").val() != 'undefined' && $("#mikm").val() != '') {

            arreglo[i] = "kilometro=" + $("#mikm").val();
            i = i + 1;
        }
        if ($("#micombustible").val() != 'undefined' && $("#micombustible").val() != '') {

            arreglo[i] = "comb=" + $("#micombustible").val();
            i = i + 1;
        }
        if ($("#mitransmision").val() != 'undefined' && $("#mitransmision").val() != '') {

            arreglo[i] = "trans=" + $("#mitransmision").val();
            i = i + 1;
        }
        if ($("#misucursal").val() != 'undefined' && $("#misucursal").val() != '') {

            arreglo[i] = "suc=" + $("#misucursal").val();
            i = i + 1;
        }
        if ($("#miorden").val() != 'undefined' && $("#miorden").val() != '') {

            arreglo[i] = "ord=" + $("#miorden").val();
            i = i + 1;
        }

        parametros = "";
        for (var j = 0; j < arreglo.length; j++) {

            if (arreglo[j] != 'undefined' && arreglo[j] != '') {
                if (j == 0) {
                    parametros = "?" + arreglo[j];
                } else {
                    parametros += "&" + arreglo[j];
                }
            }

        }

        var res = window.location.href.split("//");

        var onlyUrl = res[0] + "//" + window.location.host + window.location.pathname + parametros;

        history.pushState(null, "", onlyUrl);

        BuscarAutos();
    });

});
</script>