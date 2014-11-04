$(document).ready(function() {
	
	$(".note").change(function() {
		var checkbox_bonus = "input[name=bonus_suivi" + $(this).attr('value') + "]";
		if (!$(checkbox_bonus).is(':checked')) 
		{
			var option = "select[id=note" + $(this).attr('value') + "]";
		    $(option).val(0);
		    
		    $('#modal_popup').modal();  
			$('#modal_popup').find('h4').html('<span style="color:red;">Erreur</span>');
			$('#modal_popup').find('p').html('<span>Vous devez indiquer avoir suivi le bonus avant de lui donner une note</span>');  
			$('#modal_popup').modal('show');
			
            return false;
		}
		else
		{
			var form_note = "form[name=form_add_note" + $(this).attr('value') + "]";
			$(form_note).submit();
			
            return false;
		}
	});
	
	$(".ajouter_remarque").click(function() {
		var checkbox_bonus = "input[name=bonus_suivi" + $(this).attr('value') + "]";
		if (!$(checkbox_bonus).is(':checked')) 
		{
			$('#modal_popup').modal();  
			$('#modal_popup').find('h4').html('<span style="color:red;">Erreur</span>');
			$('#modal_popup').find('p').html('<span>Vous devez indiquer avoir suivi le bonus avant de donner une remarque</span>');  
			$('#modal_popup').modal('show');
			
            return false;
		}
	});
	
	$(".soumettre_remarque").click(function() {
		var remarque = "textarea[id=remarque" + $(this).attr('id') + "]";
		
		if (!$(remarque).val()) 
		{
			var message = "div[id=message" + $(this).attr('id') + "]";
			$(message).append('<label for="erreur" style="color:red;">Erreur&nbsp;:&nbsp;</label><label for="message_erreur">Vous devez remplir la remarque avant de valider</label>');
			
            return false;
		}
		else
		{
			var form_remarque = "form[name=form_add_remarque" + $(this).attr('id') + "]";
			$(form_remarque).submit();		
			
            return false;
		}
	});
});
