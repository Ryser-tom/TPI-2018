/**
 * Author: Tom Ryser
 * Date: 22.05.2018
 * Version : 1.0
 * Title : validate-login
 * Description : contains the functions to check the integrity of the data before sending the form on the page login.
 */

//This function allows to initialize the jquery validator plugin
$.validator.setDefaults( {
			submitHandler: function () {
				form.submit();
			}
		} );
		//This function allows you to define which form to check, which field and which rules to use for jquery validator
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