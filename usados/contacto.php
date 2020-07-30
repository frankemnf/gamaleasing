<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="utf-8">
    <title>Contacto </title>
    <?php include("complementos/head-index.php"); ?>
    <style>
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
            display: block;
        }

        body {
            background: #F8F9FA!important;
        }
    </style>
</head>

<body>
    <?php //include("menu.php"); ?>
    <div id="">

        <div id="contact">

            <div class="container mt-5 mb-5">

                <!--h2>CONTACTO</h2-->

                <div class="col-md-6 left pt-5">

                    <h2 class="text-center">Formulario de Contacto</h2>

                    <form name="htmlform" method="post" action="envio_correo.php" style="background: #fff; padding: 30px; box-shadow: 0 13.5px 13.5px rgba(0, 0, 0, 0.11)">

                        <label for="nombre">Nombre *</label>
                        <input id="nombre" type="text" name="nombre" placeholder="Indique su nombre">
                        <div class="alert01" id="nombre01">
                            <p><i class="fa fa-info-circle color01"></i> Debe ingresar Nombre</p>
                        </div>

                        <label for="apellido">Apellido *</label>
                        <input id="apellido" type="text" name="apellido" placeholder="Indique su apellido">
                        <div class="alert01" id="apellido01">
                            <p><i class="fa fa-info-circle color01"></i> Debe ingresar apellido</p>
                        </div>

                        <label for="email">Email *</label>
                        <input id="email" type="text" name="email" placeholder="Indique su email">
                        <div class="alert01" id="email01">
                            <p><i class="fa fa-info-circle color01"></i> Debe ingresar email</p>
                        </div>

                        <label for="tel-1">Télefono *</label>
                        <input id="telefono" type="text" name="telefono" placeholder="Indique su telefono" required>
                        <div class="alert01" id="telefono01">
                            <p><i class="fa fa-info-circle color01"></i> Debe ingresar telefono</p>
                        </div>
                        <div class="alert01" id="telefono02">
                            <p><i class="fa fa-info-circle color01"></i> Debe ingresar 9 digitos telefono</p>
                        </div>
                        <div class="alert01" id="telefono03">
                            <p><i class="fa fa-info-circle color01"></i> Debe ingresar solo numeros telefono</p>
                        </div>

                        <label for="apellido">Asunto *</label>
                        <input id="asunto" type="text" name="apellido" placeholder="Vender mi auto, Busco un auto, etc...">
                        <div class="alert01" id="asunto01">
                            <p><i class="fa fa-info-circle color01"></i> Debe ingresar Asunto</p>
                        </div>

                        <button type="button" class="submit" id="enviar">ENVIAR</button>
                    </form>

                </div>



                <div class="col-md-6 right pt-5">

                    <div class="info">
                    
                        <h2 class="mb-3 text-center">Visítanos</h2>

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63404.40797558602!2d-70.50957126970137!3d-33.36365840622639!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662cbf5305b2d15%3A0xb78b0e7dd50df748!2sLo%20barnechea!5e0!3m2!1ses!2scl!4v1582031505343!5m2!1ses!2scl" width="100%" height="500" frameborder="0" style="border:0;" allowfullscreen=""></iframe>

                    </div>


                </div>

            </div>

        </div>

    </div>

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

        function ocultar(){
            $('div.alert01').hide()
        }

        $(document).ready(function(e) {
            ocultar()
            $('#correo').change(function() {
                $("#email01").hide();

                if (!$("#correo").val()) {
                    $("#email01").show();
                }
                // Expresion regular para validar el correo
                var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

                // Se utiliza la funcion test() nativa de JavaScript
                if (regex.test($('#correo').val().trim())) {

                } else {
                    $("#email01").show();
                }
            });
            // fin change

            $("#enviar").click(function() {

                var nombre = $("#nombre").val();
                var apellido = $("#apellido").val();
                var correo = $("#email").val();
                var telefono = $("#telefono").val();

                if (nombre == "") {
                    $("#nombre01").show();
                } else {
                    $("#nombre01").hide();
                }
                if (apellido == "") {
                    $("#apellido01").show();
                } else {
                    $("#apellido01").hide();
                }
                if (correo == "") {
                    $("#email01").show();
                } else {
                    $("#email01").hide();
                }
                if (telefono == "") {
                    $("#telefono01").show();
                } else {
                    $("#telefono01").hide();
                    if (telefono.length != 9) {
                        $("#telefono02").show();
                    } else {
                        $("#telefono02").hide();
                        if (isNaN(telefono)) {
                            $("#telefono03").show();
                        } else {
                            $("#telefono03").hide();
                        }
                    }
                }

                if (nombre != '' && apellido != '' && correo != '' && telefono != '') {
                    $.ajax({
                        type: "POST",
                        url: "send_correo.php",
                        data: {
                            nombre: nombre,
                            apellido: apellido,
                            telefono: telefono,
                            email: correo
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data == 1) {
                                window.location.href = "gracias.php"
                            }
                        }
                    });
                }

            });

        });
    </script>
</body>

</html>