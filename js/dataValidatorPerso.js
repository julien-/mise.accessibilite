$(document).ready(function() {
	
	// Setup form validation on the #register-form element
    $("#connexion").validate({
    
        // Specify the validation rules
        rules: {
            pseudo: "required",
            mdp: "required"
        },
        
        // Specify the validation error messages
        messages: {
        	pseudo: "Champs requis",
        	mdp: "Champs requis"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    
    $('#inscription').bootstrapValidator({
        
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	cle: {
                validators: {
                    notEmpty: {
                        message: 'Veuillez entrer une clé'
                    }
                }
            },
        	nom: {
                validators: {
                    notEmpty: {
                        message: 'Veuillez entrer votre nom'
                    }
                }
            },
	        prenom: {
	            validators: {
	                notEmpty: {
	                    message: 'Veuillez entrer votre prenom'
	                }
	            }
	        },
            pseudo: {
                validators: {
	                notEmpty: {
	                    message: 'Veuillez entrer un pseudo'
	                }
                }
	        },
            mail: {
                validators: {
	                notEmpty: {
	                    message: 'Veuillez entrer une adresse e-mail'
	                },
                    emailAddress: {
                    	live: 'enabled',
                        message: 'Adresse non valide'
                    }
                }
	        },
	        mdp: {
	            validators: {
	                notEmpty: {
	                    message: 'Veuillez entrer un mot de passe'
	                },
	                identical: {
	                    field: 'confirmation',
	                    message: 'Le mot de passe et sa confirmation sont diff&eacute;rents'
	                }
	            }
	        },
	        confirmation: {
	            validators: {
	                notEmpty: {
	                    message: 'Veuillez re-taper votre mot de passe'
	                },
	                identical: {
	                    field: 'mdp',
	                    message: 'Le mot de passe et sa confirmation sont diff&eacute;rents'
	                }
	            }
	        }
        }
    });
    
    $('#loginForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            pseudo: {
                validators: {
                    notEmpty: {
                        message: 'The username is required'
                    }
                }
            },
            mdp: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    }
                }
            }
        }
    });
    
});