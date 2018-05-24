/**
 * Author: Tom Ryser
 * Date: 22.05.2018
 * Version : 1.0
 * Title : validate-adminUpdateUser
 * Description : contains the functions to check the integrity of the data before sending the form on the page adminUpdateUser.
 */

//This function allows to initialize the jquery validator plugin
$.validator.setDefaults( {
			submitHandler: function () {
				form.submit();
			}
		} );

		//This function allows you to define which form to check, which field and which rules to use for jquery validator
		$.validator.addMethod( "lettersonly", function( value, element ) {
			return this.optional( element ) || /^[a-z]+$/i.test( value );
		}, "Letters only please" ); 

		$( document ).ready( function () {
			$( "#adminUpdateUserForm" ).validate( {
				rules: {
					firstName: {
						required: true
					},
					lastName: {
						required: true
					},
					email: {
						required: true,
						email: true
					},
					mobile: {
						required: true,
						rangelength: [4, 12]
					},
					birthDate: {
						required: true,
						date: true
					},
					password: {
						required: false,
						minlength: 8
					},
				},
				messages: {
					firstName: {
						required: "Veuillez entrer votre prénom"
					},
					lastName: {
						required: "Veuillez entrer votre nom"
					},
					email: {
						required: "Veuillez entrer votre email",
						mail: "vous devez entrer un email valide"
					},
					mobile: {
						required: "Veuillez entrer votre numéro de natel",
						rangelength: "veuillez entrer un nombre composé de 4 à 12 chiffres",
					},
					birthDate: {
						required: "Veuillez entrer votre date de naissance",
						date: "vous devez entrer une date"
					},
					password: {
						required: "Veuillez entrer votre mot de passe",
						minlength: "Le mot de passe doit contenir au minimum 8 charactère"
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