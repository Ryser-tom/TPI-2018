$.validator.setDefaults( {
			submitHandler: function () {
			}
		} );
		$( document ).ready( function () {
			$( "#signupForm" ).validate( {
				rules: {
					email: {
						required: true,
						email: true
					},
					password: {
						required: true
					},
				},
				messages: {
					email: {
						required: "Veuillez entrer un Email",
						email: "vous devez entrer un email valide"
					},
					password: {
						required: "Veuillez entrer un mot de passe"
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