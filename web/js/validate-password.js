$.validator.setDefaults( {
			submitHandler: function () {
				form.submit();
			}
		} );
		$( document ).ready( function () {
			$( "#updatePasswordForm" ).validate( {
				rules: {
					actualPassword: {
						required: true
					},
					newPassword: {
						required: true,
						minlength: 8
					},
					confirmPassword: {
						required: true,
						equalTo: "#newPassword"
					},
				},
				messages: {
					actualPassword: {
						required: "Veuillez entrer votre mot de passe actuel"
					},
					newPassword: {
						required: "Veuillez entrer un nouveau mot de passe",
						minlength: "Le mot de passe doit contenir au minimum 8 charactère"
					},
					confirmPassword: {
						required: "Veuillez confirmer votre nouveau mot de passe",
						equalTo: "Veuillez entrer le même mot de passe qu'au dessu"
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