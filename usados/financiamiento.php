<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="utf-8">
    <title>Financiamiento </title>
    <?php include("complementos/head-index.php"); ?>

</head>
<style>
body {
    background: #F8F9FA;
}

.form-control {
    font-size: 1.5rem !important;
    width: 100%;
    height: 50px;
    padding: 5px 10px;
    color: #000;
    letter-spacing: 1px;
    background: #eee;
    border: 0px solid #eee;
    margin-bottom: 10px;
    -webkit-transition: all .1s ease-in-out;
    -moz-transition: all .1s ease-in-out;
    -ms-transition: all .1s ease-in-out;
    -o-transition: all .1s ease-in-out;
    transition: all .1s ease-in-out;
}

.titulo {
    padding-bottom: 20px;
    font-size: 3.5em;
    font-weight: 700;
    color: #00305d;
}

.submit {
    width: 100%;
    padding: 15px 0;
    font-size: 2em;
    font-weight: 700;
    letter-spacing: 1px;
    background: #e4291b;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #FFF;
    border: 2px solid #e4291b;
}

/*-----------------Alerta----------------------------*/

.alerta {
    display: none;
}

.color01 {
    color: #B80505;
    font-size: 15px;
    margin-right: 5px;
}

p.alert01 {
    color: #b85151 !important;
    font-size: 12px;
}
</style>

<body>
    <?php //include("menu.php"); ?>

    <section class="mt-5 pt-5 mb-5 pb-5" style="padding-top: 50px; padding-bottom: 50px">
        <div class="container mt-5 pt-5 mb-5 pb-5">
            <div class="col-md-8">
                <h2 class="titulo text-center pt-5 pb-5">Formulario de Financiamiento</h2>
                <form style="background: #fff; padding: 30px; box-shadow: 0 13.5px 13.5px rgba(0, 0, 0, 0.11)"
                    action="send_financiamiento.php" method="post" id="cotizarform" class="contact-form">
                    <!-- Datos Personales | Primera Parte del FORM -->
                    <div class="form-row mt-3">
                        <div class="col-md-12">
                            <h2 class="pl-5 pb-3">Datos Personales</h2>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nombre y Apellido" id="nombre"
                                    name="nombre">
                                <div class="alerta" id="nombre01">
                                    <p class="alert01"><i class="fa fa-info-circle color01"></i>Debe ingresar su Nombre
                                        y Apellido</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Correo Electrónico" id="email"
                                    name="email">
                                <div class="alerta" id="email01">
                                    <p class="alert01"><i class="fa fa-info-circle color01"></i>Debe ingresar su Email
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="RUT" id="rut" name="rut">
                                <div class="alerta" id="rut01">
                                    <p class="alert01"><i class="fa fa-info-circle color01"></i>Debe ingresar su RUT</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Número de Teléfono" id="telefono"
                                    name="telefono">
                                <div class="alerta" id="telefono01">
                                    <p class="alert01"><i class="fa fa-info-circle color01"></i>Debe ingresar su
                                        Teléfono</p>
                                </div>
                            </div>
                        </div><!-- FIN Datos Personales | Primera Parte del FORM -->

                        <!-- Datos Financiamiento | Segunda Parte del FORM -->
                        <div class="col-md-12 mt-5">
                            <h2 class="pl-5 pb-3">Datos del Financiamiento</h2>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Monto del Crédito" id="creditom"
                                    name="creditom">
                                <div class="alerta" id="creditom01">
                                    <p class="alert01"><i class="fa fa-info-circle color01"></i>Debe ingresar un Monto
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" type="number" name="cuotas" id="cuotas">
                                    <option value="0">Seleccione cantidad de cuotas</option>
                                    <option value="6">6</option>
                                    <option value="12">12</option>
                                    <option value="18">18</option>
                                    <option value="24">24</option>
                                    <option value="36">36</option>
                                    <option value="48">48</option>
                                </select>
                                <div class="alerta" id="cuotas01">
                                    <p class="alert01"><i class="fa fa-info-circle color01"></i>Debe seleccionar una
                                        cuota</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3 mb-4  text-center">
                            <h2 class="btn btn-outline-danger" style="font-size: 2rem" data-toggle="collapse"
                                href="#collapseExample" role="button" aria-expanded="false"
                                aria-controls="collapseExample" onclick="javascript:carga();">
                                ¿Desea entregar vehículo como parte de pago?
                            </h2>
                        </div>

                        <div class="collapse" id="collapseExample">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Marca del Vehículo"
                                            id="marca" name="marca">
                                        <div class="alerta" id="marca01">
                                            <p class="alert01"><i class="fa fa-info-circle color01"></i>Debe ingresar
                                                una Marca de Vehículo</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Modelo del Vehículo"
                                            id="modelo" name="modelo">
                                        <div class="alerta" id="modelo01">
                                            <p class="alert01"><i class="fa fa-info-circle color01"></i>Debe ingresar un
                                                Modelo de Vehículo</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Año del Vehículo"
                                            id="anio" name="anio">
                                        <div class="alerta" id="anio01">
                                            <p class="alert01"><i class="fa fa-info-circle color01"></i>Debe ingresar el
                                                Año del Vehículo</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" id="comentarios" placeholder="Mensaje" rows="3"
                                    name="comentarios"></textarea>
                            </div>
                            <div class="alerta" id="mensaje01">
                                <p class="alert01"><i class="fa fa-info-circle color01"></i>Debe ingresar comentario</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-5">
                                <button type="submit" name="submit" class="submit" required="required">Enviar
                                    Mensaje</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 mt-5 pt-5">
                <img class="img-fluid mt-5 pt-4" src="images/360x500.png" alt=""
                    style="box-shadow: 0 13.5px 13.5px rgba(0, 0, 0, 0.11)">
            </div>
        </div>
    </section>

    <?php include("footer.php"); ?>
    <script src="https://www.google.com/recaptcha/api.js?render=6Ld5nsUUAAAAAI_Tnqyn1rG352ylaDBqxOC_ceiJ"></script>
    <script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6Ld5nsUUAAAAAI_Tnqyn1rG352ylaDBqxOC_ceiJ', {
            action: 'contacto'
        }).then(function(token) {});
    });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
    var bactiva = 0;

    function carga() {
        bactiva = 1;
    }

    $(document).ready(function(e) {

        $('#email').change(function() {

            $("#email01").hide();

            if (!$("#email").val()) {

                return false;

            }
            // Expresion regular para validar el correo

            var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

            // Se utiliza la funcion test() nativa de JavaScript

            if (regex.test($('#email').val().trim())) {

            } else {

                $("#email01").show();

            }

        }); // fin change

        $("#rut").change(function() {

            $("#rutvalido").hide();

            $("#rut01").hide();

            $.ajax({

                type: "POST",

                url: "validacion.php",

                dataType: "json",

                data: {
                    rut: $(this).val()
                },

                success: function(data) {

                    $.each(data, function(i, v) {

                        if (v.valido == "no") {

                            $("#rut01").show();

                            $("#rut").val("");

                        } else {

                            $("#rut").val(v.rut);

                        }

                    });

                }

            });

        }); // fin change


        $(".boton-gracia").click(function() {

            $(".banner-gracia").hide();

            $(".fondo-g").hide();

        });


        $("#cotizarform").submit(function(e) {

            e.preventDefault();

            var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

            $("#nombre01").hide();

            $("#rut01").hide();

            $("#email01").hide();

            $("#telefono01").hide();

            $("#creditom01").hide();

            $("#cuotas01").hide();

            $("#mensaje01").hide();

            $("#anio01").hide();

            $("#marca01").hide();

            $("#modelo01").hide();

            if ($("#nombre").val() == "") {

                $("#nombre01").show();

                document.getElementById('nombre').focus();

                return false;

            }

            if ($("#rut").val() == "") {

                $("#rut01").show();

                document.getElementById('rut').focus();

                return false;

            }

            if ($("#email").val() == "") {

                $("#email01").show();

                document.getElementById('email').focus();

                return false;

            } else {

                if (regex.test($('#email').val().trim())) {

                } else {

                    $("#email01").show();

                    return false;

                }

            }

            if ($("#telefono").val() == "") {

                $("#telefono01").show();

                document.getElementById('telefono').focus();

                return false;

            } else if (isNaN($("#telefono").val())) {

                $("#telefono01").show();

                document.getElementById('telefono').focus();

                return false;

            }

            if ($("#creditom").val() == "") {

                $("#creditom01").show();

                document.getElementById('creditom').focus();

                return false;

            } else if (isNaN($("#creditom").val())) {

                $("#creditom01").show();

                document.getElementById('creditom').focus();

                return false;

            }


            if ($("#cuotas").val() == "0") {

                $("#cuotas01").show();

                document.getElementById('cuotas').focus();

                return false;

            } else if (isNaN($("#cuotas").val())) {

                $("#cuotas01").show();

                document.getElementById('cuotas').focus();

                return false;

            }

            if (bactiva == "1") {

                if ($("#marca").val() == "") {

                    $("#marca01").show();

                    document.getElementById('marca').focus();

                    return false;

                }

                if ($("#modelo").val() == "") {

                    $("#modelo01").show();

                    document.getElementById('modelo').focus();

                    return false;

                }
                if ($("#anio").val() == "") {

                    $("#anio01").show();

                    document.getElementById('anio').focus();

                    return false;

                } else if (isNaN($("#anio").val())) {

                    $("#anio01").show();

                    document.getElementById('anio').focus();

                    return false;

                }

            }

            if ($("#comentarios").val() == "") {

                $("#mensaje01").show();

                document.getElementById('comentarios').focus();

                return false;
            }

            $.ajax({

                type: "POST",

                url: "send_financiamiento.php",

                dataType: "json",

                data: $(this).serialize(),

                success: function(data) {

                    if (data == "1") {

                        window.location.href = "gracias-financiamiento.php";

                    } else {

                        alert("No se pudó enviar el correo, hable con su admimistrador.");

                    }

                }

            });

        });

    });
    </script>
</body>

</html>