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
    
	// Setup form validation on the #register-form element
    $("#inscription").validate({
    
        // Specify the validation rules
        rules: {
        	nom: "required",
        	prenom: "required",
        	mdp: "required",
        	pseudo: "required",
        	cle: "required",
            mail: {
            	required: true,
            	email: true
            },
            confirmation: {
            	equalTo: '#mdp',
            	required: true
            }
            
        },
        
        // Specify the validation error messages
        messages: {
        	pseudo: "Champs requis",
        	mdp: "Champs requis",
        	nom: "Champs requis",
        	prenom: "Champs requis",
            mail: {
            	required: "Champs requis",
            	email: "Adresse email invalide"
            },
        	cle: "Champs requis",
            confirmation: {
            	equalTo: "Confirmation invalide",
            	required: "Champs requis"
            }
        },
        
        submitHandler: function(form) {
            form.submit();
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