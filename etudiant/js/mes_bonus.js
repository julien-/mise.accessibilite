$(document).ready(function() {
	$("#soumis_bonus").click(function() {
			var remarque = "input[id=titrebonus]";
			if (!$(remarque).val()) 
			{
				$("#bloc_page").append('<div class="erreur">Vous devez remplir le titre du bonus avant de valider</div>');
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