<!DOCTYPE html>
<html lang="en">
<head>
    <title> GAMA | Seminuevos </title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/favicon.png" />

<?php include("complementos/head-index.php"); ?> 

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/*
require("../wp-config.php");

require("../wp-blog-header.php");

$wp->init(); $wp->parse_request(); $wp->query_posts();

$wp->register_globals(); $wp->send_headers();

get_header();
*/


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


// echo $integration->getBlockHtml('requireJs');
?>
<?php echo $integration->getBlockHtml('head.additional'); ?>
</head>
<body onLoad="CargaDestacdos('533','0,3,6,7,8','4');">

<?php echo $integration->getBlockHtml('porto_header'); ?>



<div id="autosUsados">

<div class="recent-car content-area">
    <div class="container">
        <div class="recent-car-content">
            <div class="row margin-b-15">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Destacados</h2>
                    </div>
                </div>
            </div>

            <div class="row" id="mssimilares">
            </div>
            
        </div>
      
    </div>
    
</div>
</div>   

<?php echo $integration->getBlockHtml('footer_block'); ?>
</body>

</html>
 <?php include("complementos/js-footer-index.php"); ?> 

 <?php //get_footer(); ?>