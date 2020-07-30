<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">

<!-- CSS librerias -->
<link rel="stylesheet" type="text/css" href="complementos/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="complementos/css/font-awesome-4.5.0/css/font-awesome.min.css">

<!-- Estilo Fichas Autos Usados - En algunos casos solo se copia este -->
<link rel="stylesheet" type="text/css" href="complementos/css/style-fichas.css?v0.3">

<!-- Google fuente -->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700|Oleo+Script:400,700" rel="stylesheet">


<!-- Google js -->
<script src="complementos/js/jquery.min.js"></script> 
    
    
<!-- fichas  Autos usados -->   
<?php require_once("complementos/inc/headficha.php"); ?>
<title></title>
<link rel="shortcut icon" href="<?php echo $icon?>">

<script>
$(document).ready(function(e){
	
	$("#opcion1").click(function(e){
		e.preventDefault();
		$("#opcion2").parent().removeClass("active");
		$(this).parent().addClass("active");
		$("#tab6default").hide();
		$("#tab2default").show();
		//iniciomapa(calle,comuna);	
	});
	
	$("#opcion2").click(function(e){
		e.preventDefault();
		$("#opcion1").parent().removeClass("active");
		$(this).parent().addClass("active");
		$("#tab2default").hide();
		$("#tab6default").show();
			
	});
});
</script>
<!-- FIN MAPA-->