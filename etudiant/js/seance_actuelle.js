$(document).ready(function() {
	$(".compris").click(function() {
		var fait = "input[id=fait" + $(this).attr('value') + "]";
		if (!$(fait).is(':checked')) 
		{
			var compris = "input[id=compris" + $(this).attr('value') + "]";
			$(compris).attr('checked', false);
			
			$("#bloc_page").append('<div class="erreur">Vous devez avoir fait l\'exercice pour le comprendre</div>');
            //cache l'erreur
            $('.erreur').delay(5000).fadeOut();
            //Supprime l'erreur
            setTimeout(function() {
                $('.erreur').remove();
            }, 4000);
            return false;
		}
	});
	
	$(".assimile").click(function() {
		var compris = "input[id=compris" + $(this).attr('value') + "]";
		if (!$(compris).is(':checked')) 
		{
			var assimile = "input[id=assimile" + $(this).attr('value') + "]";
			$(assimile).attr('checked', false);
			
			$("#bloc_page").append('<div class="erreur">Vous devez avoir fait et compris l\'exercice pour l\'assimiler</div>');
            //cache l'erreur
            $('.erreur').delay(5000).fadeOut();
            //Supprime l'erreur
            setTimeout(function() {
                $('.erreur').remove();
            }, 4000);
            return false;
		}
	});
	
	$("#soumis_remarque").click(function() {
		var remarque = "input[name=remarque]";
		if (!$(remarque).val()) 
		{
			$("#bloc_page").append('<div class="erreur">Vous devez remplir la remarque avant de valider</div>');
            //cache l'erreur
            $('.erreur').delay(5000).fadeOut();
            //Supprime l'erreur
            setTimeout(function() {
                $('.erreur').remove();
            }, 4000);
            return false;
		}
	});
});