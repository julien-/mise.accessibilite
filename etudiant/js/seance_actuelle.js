$(document).ready(function() {	
	$(".compris").click(function() {
		var fait = "input[id=fait" + $(this).attr('value') + "]";
		if (!$(fait).is(':checked')) 
		{
			var compris = "input[id=compris" + $(this).attr('value') + "]";
			$(compris).attr('checked', false);
			
			$('#modal_popup').modal();  
			$('#modal_popup').find('h4').html('<span style="color:red;">Erreur</span>');
			$('#modal_popup').find('p').html('<span>Vous devez avoir fait l\'exercice pour le comprendre</span>');  
			$('#modal_popup').modal('show');
			
            return false;
		}
	});
	
	$(".assimile").click(function() {
		var compris = "input[id=compris" + $(this).attr('value') + "]";
		if (!$(compris).is(':checked')) 
		{
			var assimile = "input[id=assimile" + $(this).attr('value') + "]";
			$(assimile).attr('checked', false);
			
			$('#modal_popup').modal();  
			$('#modal_popup').find('h4').html('<span style="color:red;">Erreur</span>');
			$('#modal_popup').find('p').html('<span>Vous devez avoir fait et compris l\'exercice pour l\'assimiler</span>');  
			$('#modal_popup').modal('show');
			
			return false;
		}
	});
	
	$("#soumis_remarque").click(function() {
		var remarque = "textarea[name=remarque]";
		if (!$(remarque).val()) 
		{
			$('#modal_popup').modal();  
			$('#modal_popup').find('h4').html('<span style="color:red;">Erreur</span>');
			$('#modal_popup').find('p').html('<span>Vous devez remplir la remarque avant de valider</span>');  
			$('#modal_popup').modal('show');
			
            return false;
		}
	});
});

