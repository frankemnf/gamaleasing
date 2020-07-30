var map;
var img='';

function iniciomapa(calle,comuna){
			var address =calle+', '+comuna;
			var geocoder = new google.maps.Geocoder();
			console.log(address);
			geocoder.geocode({ 'address': address}, geocodeResult);
		}






function geocodeResult(results, status){
	
		if(logo!=''){
		
			img='<img src="http://www.autosusados.cl/'+logo+'" style=" width:72px; height:50px; display:inline-block; vertical-align:top;  padding:10px 0px 0px 0px;">';	
			
		}
		
		
	
		// Verificamos el estatus
		if (status == 'OK') {
			// Si hay resultados encontrados, centramos y repintamos el mapa
			// esto para eliminar cualquier pin antes puesto
			var mapOptions = {
				center: results[0].geometry.location,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map($("#map").get(0), mapOptions);
			
			var infowindow = new google.maps.InfoWindow({
				  content:img+'<div style=" display:inline-block; vertical-align:top; margin:0px 0px 0px 5px; width:150px; padding:10px 0px 0px 0px;">'+calle+', '+comuna+'</div>'
			  });
			
			// fitBounds acercará el mapa con el zoom adecuado de acuerdo a lo buscado
			map.fitBounds(results[0].geometry.viewport);
			// Dibujamos un marcador con la ubicación del primer resultado obtenido
			var markerOptions = { position: results[0].geometry.location }
			var marker = new google.maps.Marker(markerOptions);
			marker.setMap(map);
			
			infowindow.open(map,marker);
			
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker);
			  });
			
				
			  
		} else {
			// En caso de no haber resultados o que haya ocurrido un error
			// lanzamos un mensaje con el error
			console.log("Geocoding no tuvo éxito debido a: " + status);
		}
	}
	
	
	