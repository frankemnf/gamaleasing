<?php
$pagina         = isset($_GET["pag"]) ? $_GET["pag"] : 1;
$mi_marca       = isset($_GET["mar"]) ? $_GET["mar"] : "";
$mi_categoria   = isset($_GET["cat"]) ? $_GET["cat"] : "";
$mi_modelo      = isset($_GET["mod"]) ? $_GET["mod"] : "";
$mi_anodesde    = isset($_GET["anod"]) ? $_GET["anod"] : "";
$mi_anohasta    = isset($_GET["anoh"]) ? $_GET["anoh"] : "";
$mi_precio      = isset($_GET["prec"]) ? $_GET["prec"] : "";
$mi_combustible = isset($_GET["comb"]) ? $_GET["comb"] : "";
$mi_transmision = isset($_GET["trans"]) ? $_GET["trans"] : "";
$mi_sucursal    = isset($_GET["suc"]) ? $_GET["suc"] : "";
$mifiltro       = isset($_GET["ord"]) ? $_GET["ord"] : "";
$mipromo        = isset($_GET["prom"]) ? $_GET["prom"] : "";
$mikilo         = isset($_REQUEST["Kilometro"]) ? $_REQUEST["Kilometro"] : "";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title> GAMA | Seminuevos </title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://gamaleasing.cl/pub/media/custom.css" />
    <link rel="stylesheet" type="text/css"
href="https://gamaleasing.cl/pub/static/frontend/Smartwave/porto_child/es_ES/css/styles-m.css">

    <link rel="stylesheet" type="text/css"
href="https://gamaleasing.cl/pub/static/frontend/Smartwave/porto_child/es_ES/css/styles-l.css">
    
    <link rel="stylesheet" type="text/css" media="all" href="https://gamaleasing.cl/pub/media/styles.css">
    
    <link rel="stylesheet" type="text/css" media="all" href="https://gamaleasing.cl/pub/static/frontend/Smartwave/porto_child/es_ES/Smartwave_Dailydeals/css/style.css">
    
    <link rel="stylesheet" type="text/css" href="https://gamaleasing.cl/pub/static/frontend/Smartwave/porto_child/es_ES/css/print.css">
    
    <link rel="stylesheet" type="text/css" href="https://gamaleasing.cl/pub/static/version1596423307/frontend/Smartwave/porto_child/es_ES/fancybox/css/jquery.fancybox.css">
    
    <link rel="stylesheet" type="text/css" media="all" href="https://gamaleasing.cl/pub/media/bootstrap/bootstrap.min.css">
    
    <?php include("complementos/head-index.php"); ?>




    <?php

        
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

//echo $specialAssets['headContent'];
//echo $specialAssets['headAdditional'];

//echo $integration->getBlockHtml('head.additional');

?>

<style type="text/css">
.custom-block .links{
    height: auto !important;
}
</style>
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
        function funcionContador(AutoId, TipoId, Cant) {
            return false;
            $.ajax({
                type: 'POST',
                url: "serviciosAU/ServicioContar.ashx",
                data: 'AutoId=' + AutoId + '&TipoId=' + TipoId + '&Cant=' + Cant,
                success: function(data) {
                    console.log("conteo.");
                }
            });

        }
    </script>
</head>

<style>
    .page-header.type6.header-newskin {
        border-bottom: 0;
        margin-bottom: 50px;
    }
    .page-header.type6 .navigation {
        margin: -120px 0 0;
    }
    .page-header.type6.header-newskin .header.content {
        padding: 0;
    }
    a.logo {
        margin: 15px 0 35px;
    }
    .footer-middle .block-content .logo_footer img {
        width: 190px;
    }
    @media only screen and (max-width: 768px) {
        .nav-toggle {
            float: right;
            margin-top: 20px;
        }
        .nav-toggle:before {
            color: #FF5F00;
        }
        .page-header.type6.header-newskin {
            margin: 0;
        }
        .page-header.type6.header-newskin {
            border-top: 0;
        }
    }
    @media only screen and (max-width: 480px) {
        .ocultar-m {
            display: none;
        }
    }

    @media only screen and (min-width: 481px) {
        .ocultar-d {
            display: none;
        }
    }
</style>

<body onLoad="listarMarcas(); BuscarAutos('grid'); listarCategorias();">

    <?php echo $integration->getBlockHtml('porto_header'); ?>


    <div id="myCarousel" class="carousel slide ocultar-m" data-ride="carousel">
        <!-- Indicators -->
        <!-- <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol> -->

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="imagenes/Banner-Web-Usados.png" alt="Gama Leasin - Seminuevos">
            </div>
        </div>

        <!-- Left and right controls -->
        <!-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a> -->
    </div>

    <div id="myCarousel" class="carousel slide ocultar-d" data-ride="carousel">
        <!-- Indicators -->
        <!-- <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol> -->

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="imagenes/Banner-usados-Mobile.png" alt="Los Angeles">
            </div>
        </div>

        <!-- Left and right controls -->
        <!-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a> -->
    </div>

    <div id="autosUsados">
        <!--AQUI VA EL ID DEL CLIENTE DE LA FICHA-->
        <input id="clienteid" name="clienteid" value="533" type="hidden">
        <!--AQUI VA EL ID DEL CLIENTE DE LA FICHA PARA LA PARTE DE LOS BUSCADORES-->

        <input id="paginador" name="paginador" value="4" type="hidden">
        <input id="por_pagina" name="por_pagina" value="20" type="hidden">
        <input id="clienteiduno" type="hidden" value="533" name="clienteiduno">
        <input id="nombrepag" type="hidden" value="<?php echo str_replace("/", "", basename($_SERVER["PHP_SELF"])); ?>" name="nombrepag">

        <input id="pagina" name="pag" value="<?php echo $pagina; ?>" type="hidden">
        <input id="micategoria" name="micategoria" type="hidden" value="<?php echo $mi_categoria; ?>">
        <input id="mimarca" name="mimarca" type="hidden" value="<?php echo $mi_marca; ?>">
        <input id="mimodelo" name="mimodelo" type="hidden" value="<?php echo $mi_modelo; ?>">
        <input id="mianod" name="mianod" type="hidden" value="<?php echo $mi_anodesde; ?>">
        <input id="mianoh" name="mianoh" type="hidden" value="<?php echo $mi_anohasta; ?>">
        <input id="miprecio" name="miprecio" type="hidden" value="<?php echo $mi_precio; ?>">
        <input id="micombustible" name="micombustible" type="hidden" value="<?php echo $mi_combustible; ?>">
        <input id="mitransmision" name="mitransmision" type="hidden" value="<?php echo $mi_transmision; ?>">
        <input id="misucursal" name="misucursal" type="hidden" value="<?php echo $mi_sucursal; ?>">
        <input id="miorden" name="miorden" type="hidden" value="<?php echo $mifiltro; ?>">
        <input id="mipromo" name="mipromo" type="hidden" value="<?php echo $mipromo; ?>">
        <input id="mikm" name="mikm" type="hidden" value="<?php echo $mikilo; ?>">

        <div class="load-semi" style="display:none;" id="carga">
            <img src="complementos/img/loading.svg" width="80" height="80" alt="">
        </div>

        <div class="recent-car content-area">
            <div class="container p-3 bg-light border col-11 filtro001">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="col-6 col-sm-3 select-f">
                        <select id='ddlCategoria2' class="form-control bajo001">
                            <option value=''>Categoría</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-3 select-f">
                        <select id='ddlMarca2' class="form-control bajo001">
                            <option value=''>Marca</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-3 select-f">
                        <select id='ddlModelo2' class="form-control bajo001">
                            <option value=''>Modelo</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-3 select-f">
                        <select id='ddlAnoh' class="form-control bajo001">
                            <option value=''>Año Hasta</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-3 select-f">
                        <select id='ddlPrecio2' class="form-control bajo001">
                            <option value=''>Precio</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-3 select-f">
                        <select id='ddlBencina' class="form-control bajo001">
                            <option value="">Combustible</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-3 select-f">
                        <select id='ddlTransmision' class="form-control bajo001">
                            <option value="">Transmisión</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-3 select-f">
                        <select id='ddlSucursal2' class="form-control bajo001 ttt">
                            <option value=''>Sucursales</option>
                        </select>
                    </div>

                    <div class="cant-resultados col-md-6 hidden-sm-down">Mostrando <span id="total_resultado"></span> resultados.</div>

                    <div class="col-6 col-sm-3 select-f">
                        <div class="selOrden">
                            <select class="form-control SelOption" id="promocion" name="promocion"></select>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3 select-f">
                        <div class="selOrden">
                            <select class="form-control SelOption" id="orden" name="orden"></select>
                        </div>
                    </div>

                </div>

                <input id="tipo_grid" name="tipo_grid" type="hidden" value="grid" />
                <div class="clearfix"></div>
            </div>
            <div>
                <div class="recent-car-content container">
                    <div class="box_mini_fichas" id="grid_auto" onclick="funcionContador(2,6,1);"></div>
                </div>
            </div>
        </div>
        <form id="enviar" name="enviar" method="post" />
        </form>
    </div>

    <?php echo $integration->getBlockHtml('footer_block'); ?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php include("complementos/js-footer-seminuevos.php"); ?>

<?php //get_footer(); 
?>

</html>
