/**
 * Author: Tom Ryser
 * Date: 22.05.2018
 * Version : 1.0
 * Title : validate-updateVehicle
 * Description : contains the functions to check the integrity of the data before sending the form on the page updateVehicle.
 */

//function to change the minimum date of the "end" input to match the date selected in the "start" input
$("#start").change(function() {
	$("#end").attr({
		"min" : $("#start").val()
	});
  });
//This function allows to initialize the jquery validator plugin
$.validator.setDefaults( {
			submitHandler: function () {
				form.submit();
			}
		} );
		//This function allows to add a check to the jquery validator plugin
		$.validator.addMethod( "lettersonly", function( value, element ) {
			return this.optional( element ) || /^[a-z]+$/i.test( value );
		}, "Letters only please" ); 

		//This function allows you to define which form to check, which field and which rules to use for jquery validator
		$( document ).ready( function () {
			$( "#updateVehicle" ).validate( {
				rules: {
					numberPlate: {
						required: true,
					},
					mark: {
						required: true,
						lettersonly: true
					},
					model: {
						required: true
					},
					nbPlaces: {
						required: true,
						number: true
					},
					color: {
						required: true,
						lettersonly: true
					},
					start: {
						required: true
					},
					end: {
						required: false
					},
				},
				messages: {
					numberPlate: {
						required: "Veuillez entrer le numéro d'immatriculation du véhicule"
					},
					mark: {
						required: "Veuillez séléctionner une marque de véhicule",
						lettersonly: "la marque ne peux contenir que des lettres"
					},
					model: {
						required: "Veuillez séléctionner un model de véhicule"
					},
					nbPlaces: {
						required: "Veuillez entrer un nombre de place(s)",
						number: "veuillez entrer des chiffres"
					},
					color: {
						required: "Veuillez entrer le nom de la couleur du véhicule",
						lettersonly: "la couleur ne peux pas contenir de chiffres",
					},
					start: {
						required: "Veuillez indiquer une date à la quelle vôtre véhicule sera disponible.",
					},
					end: {
					},
				},
				errorElement: "em",
				//This function allows you to choose where and what to display for jquery validator error messages
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( "form-group" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( "form-group" ).addClass( "has-success" ).removeClass( "has-error" );
                }
            } );
		} );