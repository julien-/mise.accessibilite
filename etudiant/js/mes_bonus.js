$(document).ready(function() {
	
	$(".collaborateurs").change(function() {
		var nom_etu = $('#collaborateurs' + $(this).attr('value') + ' option:selected').text();
		var id_etu = $('#collaborateurs' + $(this).attr('value') + ' option:selected').val();
		if (nom_etu != "") 
		{
			var div_collaborateurs = "div[id=liste_collaborateurs" + $(this).attr('value') + "]";
			$(div_collaborateurs).append('<i id="collaborateur'+id_etu+'" class="glyphicon glyphicon-user" title="'+nom_etu+'"></i><a class="remove" id="remove_collaborateur'+id_etu+'" value="'+id_etu+'"><i class="glyphicon glyphicon-remove" title="retirer '+nom_etu+'"></i></a>&nbsp;&nbsp;');
			
			var div_cachee_collaborateurs = "div[id=donnees_cachees" + $(this).attr('value') + "]";
			
			var input = document.createElement('input');
			input.setAttribute('id', 'input_collaborateur'+id_etu+'');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'Etudiant[]');
            input.setAttribute('value', id_etu);
            
            $(div_cachee_collaborateurs).append(input);		
		}
	});
	
	$("#bloc_page").on('click','.remove', function(){
		var icon = "i[id=collaborateur" + $(this).attr('value') + "]";
		var lien = "a[id=remove_collaborateur" + $(this).attr('value') + "]";
		var input = "input[id=input_collaborateur" + $(this).attr('value') + "]";
		$(icon).remove();
		$(lien).remove();
		$(input).remove();
	});
	
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