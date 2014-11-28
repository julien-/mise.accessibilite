$(document).ready(function() {	
	
	$("#enseignant").click(function() {
		if ($("#enseignant").is(':checked')) 
		{
			$('#cle').append('<div id="div_cle" class="form-group"><div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8"><input type="text" name="cle" class="form-control" placeholder="Clé enseignant"/></div></div>');		
		}
		else
		{
			$('#div_cle').remove();
		}
	});
	
	$('#form_inscription').validate({
	    rules: {
	    	nom_minuscules: {
	            required: true,
	        },
	        prenom: {
	            required: true,
	        },
	        email: {
	            required: true,
	            email: true
	        },
	        pseudo: {
	            minlength: 3,
	            maxlength: 20,
	            required: true,
	        },
	        password: {
	            minlength: 7,
	            maxlength: 20,
	            required: true
	        },
	        confirm_password: {
	            minlength: 7,
	            maxlength: 20,
	            required: true,
	            equalTo: "#password"
	        }
	    },
	    messages: {
	    	nom_minuscules: {
	    		required: "Champ requis",
	    	},
		    prenom: {
				required: "Champ requis",
			},
		    email: {
				required: "Champ requis",
				email: jQuery.format("Email invalide")
			},
		    pseudo: {
				required: "Champ requis",
				minlength: jQuery.format("Minimum {0} caractères"),
				maxlength: jQuery.format("Maximum {0} caractères")
			},
			password: {
				required: "Champ requis",
				minlength: jQuery.format("Minimum {0} caractères"),
				maxlength: jQuery.format("Maximum {0} caractères")
			},
		    confirm_password: {
				required: "Champ requis",
				minlength: jQuery.format("Minimum {0} caractères"),
				maxlength: jQuery.format("Maximum {0} caractères"),
				equalTo: "Mot de passe et confirmation du mot de passe différents"
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