$("#start").change(function() {
	$("#end").attr({
		"min" : $("#start").val()
	});
  });

$.validator.setDefaults( {
			submitHandler: function () {
				form.submit();
			}
		} );

		$.validator.addMethod( "lettersonly", function( value, element ) {
			return this.optional( element ) || /^[a-z]+$/i.test( value );
		}, "Letters only please" ); 

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