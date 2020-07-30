require(['jquery', 'jquery/jquery.validate', 'jquery/jquery.rut'], function($, jqueryvalid, jrut){ 

	console.log($('body').attr('class'));

	if ($('#leasing_operativo_tab .btn-primary').length > 0) {

		
		$("#leasing_operativo_tab form").validate();


		$('.banner_home .form_right form .step_one .btn_action .btn-primary').click( function(e){
			e.preventDefault();
			$('.rut-err').remove();

			if ($.Rut.validar($('#leasing_operativo_tab [name="rut"]').val())) {

				$("#leasing_operativo_tab form").valid();
				if ($('.banner_home .form_right form .step_one .input-group > label.error:visible').length < 1) {

					$(this).parent().parent().parent().parent().removeClass('step_one_active');
				    $(this).parent().parent().parent().parent().addClass('step_two_active');
				    $('.banner_home .form_right .tab-content p.steps').html('2.Datos contacto <small>2/2</small>');

			    };
			    
			}
			else{
				$('#leasing_operativo_tab [name="rut"]').after('<label for="nombre" generated="true" class="error rut-err" style="display: block;">Debe ingresar un RUT válido</label>');
			}
		});


		$('#leasing_operativo_tab .step_two .btn-primary').click( function(e){

			e.preventDefault();
			$('.rut-err').remove();


			if ($("#leasing_operativo_tab form").valid()) {
					
					if ($.Rut.validar($('#leasing_operativo_tab [name="rut_contacto"]').val())) {

						var rut_empresa = $('#leasing_operativo_tab [name="rut"]').val();
						var razon_social = $('#leasing_operativo_tab [name="razon_social"]').val();
						var tipo_vehiculo = $('#leasing_operativo_tab [name="tipo_vehiculo"]').val();
						var unidades = $('#leasing_operativo_tab [name="unidades"]').val();
						var industria = $('#leasing_operativo_tab [name="indistria"]').val();
						var nombre = $('#leasing_operativo_tab [name="nombre"]').val();
						var rut_contacto = $('#leasing_operativo_tab [name="rut_contacto"]').val();
						var telefono = $('#leasing_operativo_tab [name="telefono"]').val();
						var email = $('#leasing_operativo_tab [name="email"]').val();


					
						var data = {
						rut_empresa : rut_empresa,
						razon_social : razon_social,
						tipo_vehiculo : tipo_vehiculo,
						unidades : unidades,
						industria : industria,
						nombre : nombre,
						rut_contacto : rut_contacto,
						telefono : telefono,
						email : email
					}

					$.ajax({
				        type: 'post',
				        url: '/softec_customform/email/sendhome',
				        data: data,
				        success: function () {
				          // $('#leasing_operativo_tab .btn-primary').text('Enviado');
				          // $('#leasing_operativo_tab .btn-primary').addClass('disabled');

				          $('#leasing_operativo_tab .alert-gama').fadeIn();

				        $('#leasing_operativo_tab [name="rut"]').val('');
						$('#leasing_operativo_tab [name="razon_social"]').val('');
						$('#leasing_operativo_tab [name="tipo_vehiculo"]').val('');
						$('#leasing_operativo_tab [name="unidades"]').val('');
						$('#leasing_operativo_tab [name="indistria"]').val('');
						$('#leasing_operativo_tab [name="nombre"]').val('');
						$('#leasing_operativo_tab [name="rut_contacto"]').val('');
						$('#leasing_operativo_tab [name="telefono"]').val('');
						$('#leasing_operativo_tab [name="email"]').val('');

						$('.banner_home .form_right .tab-content p.steps').html('1.Datos Empresa  <small>1/2</small>');
						$('.form_right .step_two_active').addClass('step_one_active');
						$('.form_right .step_two_active').removeClass('step_two_active');

				          setTimeout(function(){ $('#leasing_operativo_tab .alert-gama').hide(); }, 3000);
				        }
				      });

				}

			}
			else{
				$('#leasing_operativo_tab [name="rut_contacto"]').after('<label for="nombre" generated="true" class="error rut-err" style="display: block;">Debe ingresar un RUT válido</label>');
			}

		});

	};


	if ($('.form_denuncias').length > 0) {

		

		
	 	 
		// $(".form_denuncias").validate();
			$(".form_denuncias").validate({ // initialize the plugin
	        rules: {
	            'tipo_denuncia[]': {
	                required: true
	            }
	        },
	        messages: {
	            'tipo_denuncia[]': {
	                required: "Debes seleccionar al menos 1 opción."
	            }
	        }
	    });
 
		$('.form_denuncias .content .action_buton .btn-primary').click( function(e){
			

			e.preventDefault();

			$('.rut-err').remove();

			var ext = $('.form_denuncias [name="file"]').val().split('.').pop().toLowerCase();

			if ($('.form_denuncias [name="file"]').val() != '' && $.inArray(ext, ['doc','pdf','ppt','docx','gif','png','jpg','jpeg']) > 0) {
				if ($(".form_denuncias").valid()) {
					// if (true) {


					var form = $('.form_denuncias')[0]; // You need to use standard javascript object here
					var formData = new FormData(form)

					var rut =  $('.form_denuncias [name="rut"]').val();
					var nombre_completo =  $('.form_denuncias [name="nombre_completo"]').val();
					var correo_electronico =  $('.form_denuncias [name="correo_electronico"]').val();
					var telefono_contacto =  $('.form_denuncias [name="telefono_contacto"]').val();
					
					var tipo_personal =  $('.form_denuncias [name="tipo_personal"]').val();
					var conocimiento =  $('.form_denuncias [name="conocimiento"]').val();
					var detalle =  $('.form_denuncias [name="detalle"]').val();
					var otros_asuntos =  $('.form_denuncias [name="otros_asuntos"]').val();
					var file =  $('.form_denuncias [name="file"]').val();
				 
					var tipo_denuncia = '';
				    $.each($('.form_denuncias [name="tipo_denuncia[]"]:checked'), function(){
				        tipo_denuncia = tipo_denuncia+' - '+$(this).val();
				    });


					
						var data_ = {
						rut : rut,
						nombre_completo : nombre_completo,
						correo_electronico : correo_electronico,
						telefono_contacto : telefono_contacto,
						tipo_personal : tipo_personal,
						conocimiento : conocimiento,
						detalle : detalle,
						otros_asuntos : otros_asuntos,
						file : file,
						tipo_denuncia : tipo_denuncia
					}

					console.log(data_);

					$.ajax({
				        type: 'POST',
				        contentType: false,
					         cache: false,
					   processData:false,
				        url: '/softec_customform/email/senddenuncia',
				        data: formData,
				        success: function () {
				          // $('.form_denuncias .content .action_buton .btn-primary').text('Enviado');
				          // $('.form_denuncias .content .action_buton .btn-primary').addClass('disabled');

				          $('.form_denuncias [name="rut"]').val('');
						$('.form_denuncias [name="nombre_completo"]').val('');
						$('.form_denuncias [name="correo_electronico"]').val('');
						$('.form_denuncias [name="telefono_contacto"]').val('');
						$('.form_denuncias [name="tipo_personal"]').val('');
						$('.form_denuncias [name="conocimiento"]').val('');
						$('.form_denuncias [name="detalle"]').val('');
						$('.form_denuncias [name="otros_asuntos"]').val('');

				          $('.form_denuncias .alert-gama').fadeIn();
					          setTimeout(function(){ $('.form_denuncias .alert-gama').hide(); }, 3000);

				        }
				      });
				}
		 	}
		 	else{
		 		$('.form_denuncias [name="file"]').after('<label for="nombre" generated="true" class="error rut-err" style="display: block;">Extensión de archivo no válida</label>');
		 	}

		});

	};


	if ($('.form_contact').length > 0) {


		$(".form_contact form").validate();
	 
		$('.form_contact form .btn_orange').click( function(e){

			e.preventDefault();

			if ($(".form_contact form").valid()) {
				// if (true) {

					var nombre =  $('.form_contact [name="nombre"]').val();
					var apellido =  $('.form_contact [name="apellido"]').val();
					var telefono =  $('.form_contact [name="telefono"]').val();
					var correo =  $('.form_contact [name="correo"]').val();
					
					var comentario =  $('.form_contact [name="comentario"]').val();
			 

					if ($('.form_contact [name="terminos"]').is(':checked')) {
						var terminos = 'Aceptado';
					}
					else{
						var terminos = 'No Aceptado';
					}
				 


					
						var data_a = {
						nombre : nombre,
						apellido : apellido,
						telefono : telefono,
						correo : correo,
						comentario : comentario,
						terminos : terminos
					}

					$.ajax({
				        type: 'post',
				        url: '/softec_customform/email/sendcontacto',
				        data: data_a,
				        success: function () {
				          // $('.form_contact form .btn_orange').text('Enviado');
				          // $('.form_contact form .btn_orange').addClass('disabled');

				          $('.form_contact [name="nombre"]').val('');
						$('.form_contact [name="apellido"]').val('');
						$('.form_contact [name="telefono"]').val('');
						$('.form_contact [name="correo"]').val('');
						$('.form_contact [name="comentario"]').val('');

				          $('.form_contact .alert-gama').fadeIn();
				          setTimeout(function(){ $('.form_contact .alert-gama').hide(); }, 3000);


				        }
				      });

				}

		});

	};


	





})

// define([
//     'jquery'
// ], function ($) {
//     'use strict';

//     return function (config) {
//         console.log($('body').attr('class'));
//         // add your jQuery script here
//     }
// });