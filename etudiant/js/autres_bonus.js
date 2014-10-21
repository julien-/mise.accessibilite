$(document).ready(function() {
	$(".note").change(function() {
		var checkbox_bonus = "input[name=bonus_suivi" + $(this).attr('value') + "]";
		if (!$(checkbox_bonus).is(':checked')) 
		{
		    var option = "select[id=note" + $(this).attr('value') + "]";
		    $(option).val(0);
		    $("#bloc_page").append('<div class="erreur">Vous devez indiquer avoir suivi le bonus avant de lui donner une note</div>');
            //cache l'erreur
            $('.erreur').delay(5000).fadeOut();
            //Supprime l'erreur
            setTimeout(function() {
                $('.erreur').remove();
            }, 4000);
            return false;
		}
		else
		{
			var form_note = "form[name=form_add_note" + $(this).attr('value') + "]";
			$(form_note).submit();
            return false;
		}
	});
	
	$("#ajouter_remarque").click(function() {
		var checkbox_bonus = "input[name=bonus_suivi" + $(this).attr('value') + "]";
		if (!$(checkbox_bonus).is(':checked')) 
		{
			$("#bloc_page").append('<div class="erreur">Vous devez indiquer avoir suivi le bonus avant de donner une remarque</div>');
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
		var remarque = "input[id=remarque]";
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
