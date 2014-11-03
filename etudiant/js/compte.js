$(document).ready(function() {	
	$('#form_info_perso').validate({    
	    rules: {
	        nom: {
	            minlength: 3,
	            maxlength: 15,
	            required: true,
	        },
	        prenom: {
	            minlength: 3,
	            maxlength: 15,
	            required: true,
	        },
	        email: {
	            required: true,
	            email: true
	        },
	        pseudo: {
	            minlength: 3,
	            maxlength: 15,
	            required: true,
	        }
	    },
	    messages: {
	    	nom: {
	    		required: "Champ requis",
	    		minlength: jQuery.format("Minimum {0} caractères"),
	    		maxlength: jQuery.format("Maximum {0} caractères")
	    	},
		    prenom: {
				required: "Champ requis",
				minlength: jQuery.format("Minimum {0} caractères"),
				maxlength: jQuery.format("Maximum {0} caractères")
			},
		    email: {
				required: "Champ requis",
				email: jQuery.format("Email invalide")
			},
		    pseudo: {
				required: "Champ requis",
				minlength: jQuery.format("Minimum {0} caractères"),
				maxlength: jQuery.format("Maximum {0} caractères")
			}
	    },
	    highlight: function(element) {
	        var id_attr = "#" + $( element ).attr("id") + "1";
	        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	        $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');         
	    },
	    unhighlight: function(element) {
	        var id_attr = "#" + $( element ).attr("id") + "1";
	        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	        $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');         
	    },
	    errorElement: 'span',
	    errorClass: 'help-block',
	    errorPlacement: function(error, element) {
	        if(element.length) {
	            error.insertAfter(element);
	        } else {
	        error.insertAfter(element);
	        }
	    } 
	});

	$('#form_mdp').validate({    
	    rules: {
	        nouveau_pwd: {
	            minlength: 7,
	            maxlength: 15,
	            required: true
	        },
	        confirm_pwd: {
	            minlength: 7,
	            maxlength: 15,
	            required: true,
	            equalTo: "#nouveau_pwd"
	        }
	    },
	    messages: {
		    nouveau_pwd: {
				required: "Champ requis",
				minlength: jQuery.format("Minimum {0} caractères"),
				maxlength: jQuery.format("Maximum {0} caractères")
			},
		    confirm_pwd: {
				required: "Champ requis",
				minlength: jQuery.format("Minimum {0} caractères"),
				maxlength: jQuery.format("Maximum {0} caractères"),
				equalTo: "Nouveau mot de passe et confirmation mot de passe différents"
			}
	    },
	    highlight: function(element) {
	        var id_attr = "#" + $( element ).attr("id") + "1";
	        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	        $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');         
	    },
	    unhighlight: function(element) {
	        var id_attr = "#" + $( element ).attr("id") + "1";
	        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	        $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');         
	    },
	    errorElement: 'span',
	    errorClass: 'help-block',
	    errorPlacement: function(error, element) {
	        if(element.length) {
	            error.insertAfter(element);
	        } else {
	        error.insertAfter(element);
	        }
	    } 
	 });
});