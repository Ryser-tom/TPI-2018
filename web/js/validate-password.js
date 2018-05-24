/**
 * Author: Tom Ryser
 * Date: 22.05.2018
 * Version : 1.0
 * Title : validate-password
 * Description : contains the functions to check the integrity of the data before sending the form on the page changePassword.
 */

//This function allows to initialize the jquery validator plugin
$.validator.setDefaults( {
			submitHandler: function () {
				form.submit();
			}
		} );
		//This function allows you to define which form to check, which field and which rules to use for jquery validator
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