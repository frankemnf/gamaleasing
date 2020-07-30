
<?php

$clienteid=$_REQUEST["clienteid"];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.autosusados.cl/get/etiquetas/".$clienteid."",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Accept: */*",
    "Authorization: Bearer 88022924501"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

echo $response;

?>