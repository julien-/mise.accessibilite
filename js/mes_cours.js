$('.interactive-table').DataTable( {
			"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 3 ] }],
		    language: {
		    	processing:     "Traitement en cours...",
		        search:         "Rechercher&nbsp;:",
		        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
		        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
		        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
		        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
		        infoPostFix:    "",
		        loadingRecords: "Chargement en cours...",
		        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
		        emptyTable:     "Aucune donnée disponible dans le tableau",
		        paginate: {
		            first:      "Premier",
		            previous:   "Pr&eacute;c&eacute;dent",
		            next:       "Suivant",
		            last:       "Dernier"
		        },
		        aria: {
		            sortAscending:  ": activer pour trier la colonne par ordre croissant",
		            sortDescending: ": activer pour trier la colonne par ordre décroissant"
		        }
		        
			        
		    }
		} );

function getQuerystring(key, default_) {
       if (default_==null) default_="";
       key = key.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
       var regex = new RegExp("[\\?&]"+key+"=([^&#]*)");
       var qs = regex.exec(window.location.href);
       if(qs == null) return null; else return qs[1];
   }



$(window).load(function(){
	/*if(getQuerystring('exo_sel') !== null){
	    $('#ajoutFichier').modal('show');
	}
*/
});

//Gestion des thèmes d'un cours
function TABthemes_selon_SELECTcours() {
    var nb_theme_visible = $(".trTHEMES_" + $("#liste_cours").val()).length;
    $("#id_cours_sel").val($("#liste_cours option:selected").val());    //récupère dans le formulaire pour l'ajout de themes,  l'id_cours (pour un $_POST)
    $('#soumis2').attr('title', "Nouveau thème du cours de " + $("#liste_cours option:selected").text()); //Modifie le titre du bouton d'ajout de themes selon le choix de la liste déroulante
    if (nb_theme_visible > 0)
    {
        $("#themes").show();   //affiche la partie GESTION THEME
        $("#tab_themes").show();    //on affiche le tableau
        $("#msg_themes").text("");  //Aucun message à afficher
        $("#exo").show();   //affiche la partie GESTION EXERCICES

        $("#tab_themes tr:not(.titre)").hide(); //cache tous les tr du tableau sauf les titres
        $(".trTHEMES_" + $("#liste_cours").val()).show(); //montre les bons tr (ayant le meme id que la liste déroulante)

//        //si changement de cours, changement des themes aussi donc on se met sur le 1er
//        var nomclass = "theme_du_cours_" + $("#id_cours_sel").val();
//        $("#liste_themes option." + nomclass + ":first").attr('selected', true);
    }
    else
    {
        //affiche que le formulaire d'ajout
        $("#themes").show();
        $("#tab_themes").hide();
        $("#msg_themes").text("Veuillez créer un thème au cours séléctionné, pour pouvoir en gérer ensuite ses exercices.");
        $("#exo").hide();   //cache la partie GESTION EXERCICES

    }
}

//Gestion des exercices d'un thème (appartenant à un cours)
function TABexo_selon_SELECTthemes() {

    var nb_theme_visible = $(".trTHEMES_" + $("#liste_cours").val()).length;
    var nb_exo_visible = $(".trEXO_" + $("#liste_themes").val()).length;
    $("#id_them_sel").val($("#liste_themes option:selected").val());    //récupère dans le formulaire pour l'ajout d'exo l'id_theme (pour un $_POST)

    if (nb_theme_visible === 0)
        nb_exo_visible = 0; //fixe à ZERO sinon garde l'ancienne valeur du theme precedent (meme si caché)

    var nb = parseInt($("#nbexo_idtheme" + $("#id_them_sel").val()).html()) + 1;
    
    $("#nbmax_exo").val(nb); // récupère le numéro du prochain exercice à créer

    $('#soumisajouexo').attr('title', "Nouvel exercice de " + $("#liste_themes option:selected").text()); //Modifie le titre du bouton ajout_exo selon le choix de la liste déroulante

    //garde que les thèmes appartenant au cours choisi dans "liste_cours"
    $("#liste_themes option").show();
    $("#liste_themes option:not(.theme_du_cours_" + $("#id_cours_sel").val() + ")").hide();

    if (nb_exo_visible > 0)
    {
        $("#exo").show();   //affiche la partie GESTION EXO
        $("#tab_exo").show();    //on affiche le tableau
        $("#msg_exo").text("");  //Aucun message à afficher

        $("#tab_exo tr:not(.titre)").hide(); //cache tous les tr du tableau sauf les titres
        $(".trEXO_" + $("#liste_themes").val()).show(); //montre les bons tr (ayant le meme id que la liste déroulante)

    }
    else
    {

        if (nb_theme_visible > 0)
        {
            if (nb_exo_visible === 0)
            {
                //affiche que le formulaire d'ajout
                $("#exo").show();
                $("#tab_exo").hide();
                $("#msg_exo").text("Veuillez créer un exercice au thème séléctionné, pour que les élèves puissent s'évaluer.");
            }
        }

    }
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}



$(document).ready(function() {
	
	//triggered when modal is about to be shown
	$('#ajoutFichier').on('show.bs.modal', function(e) {

		
	    //get data-id attribute of the clicked element
	    var bookId = $(e.relatedTarget).data('book-id');
	        
	    var NumExoSel = parseInt(getParameterByName("exo_sel"));
	    if (!isNaN(NumExoSel))
	        $("#active_popup").click();

	    $("#tab_fichiers tr:not(.titre)").hide(); //cache tous les tr du tableau sauf les titres
	    $(".trFICHIER" + bookId).show(); //montre les bons tr (ayant le meme id que la liste déroulante)

	    //Mise en ligne/Hors ligne de fichier
	    $(".fichierenligne").change(function() {
	        //modiifie la valeur à 0 ou 1 le champ caché coche_+"ID DU FICHIER"
	        $("#coche_" + $(this).attr("id")).val($(this).is(":checked") ? 1 : 0);

	        $("#form_online_" + $(this).attr("id")).submit();
	    });
	    var nb_exo_visible = $(".trFICHIER" + bookId).length;
	    
	    if (nb_exo_visible == 0)
    	{
	    	$("#tab_fichiers tr").hide(); //cache tous les tr du tableau 
	    	$("#no-files").text("Aucun fichier n'a été ajouté pour cet exercice");
    	}
	    else
	    	$("#no-files").text("");
	    	
	    $.ajax({
	       url : 'index.php?section=mes_cours',
	       type : 'GET', // Le type de la requête HTTP, ici devenu POST
	       data :{exo_sel: bookId}, // On fait passer nos variables, exactement comme en GET, au script more_com.php
	       success: function( data ) {
	    	   $(e.currentTarget).find('input[name="fichierID"]').val(bookId);
	       }
	    });
	});
	
    //Possibilité d'annuler une suppression
    $('.img_sup_cours').click(function() {
        return confirm("La suppression de ce cours supprimera ses THEMES, EXERCICES et toute PROGRESSION d'étudiant à ceux-ci.\n\nEtes vous sûr de vouloir supprimer ce cours?");
    });
    $('.img_sup_theme').click(function() {
        return confirm("La suppression de ce thèeme supprimera ses EXERCICES et toute PROGRESSION d'étudiant à ceux-ci.\n\nEtes vous sûr de vouloir supprimer ce thème?");
    });
    $('.soumissupexo').click(function() {
        return confirm("La suppression de cet exercice supprimera les FICHIERS et les PROGRESSIONS d'étudiants de celui-ci.\n\nEtes vous sûr de vouloir supprimer cet exercice?");
    });

    //Gestion des listes déroulants :
    var nb_cours_total = $("#tab_cours tr:not(.titre)").length;

    if (nb_cours_total > 0)
    {
        
        TABthemes_selon_SELECTcours();  //liste déroulante des cours
        TABexo_selon_SELECTthemes(); //liste déroulante des themes

        //changement de la liste déroulante des cours
        $("#liste_cours").change(function() {
            TABthemes_selon_SELECTcours();
            //si changement de cours, changement des themes aussi donc on se met sur le 1er
            var nomclass = "theme_du_cours_" + $("#id_cours_sel").val();
			//deselectionne les anciens selected
			$("#liste_themes option").attr('selected', false);
			//selectionne les nouveaux
            $("#liste_themes option." + nomclass + ":first").attr('selected', true);
            TABexo_selon_SELECTthemes();
			//SELECTION PAR DEFAUT (1er de la liste déroulante)
            //Liste déroulante pas encore séléctionné mais il faut quand meme afficher les bons résultats)
            //permet de garder le meme element dans la liste déroulante après une requete
            //(créé une variable SESSION pour garder après les requetes
            $.post("../admin/mes_cours.php", {"id_cours_sel": $("#liste_cours option:selected").val(), "id_them_sel": $("#liste_themes option:selected").val()});
        });
        //changement de la liste déroulante des themes
        $("#liste_themes").change(function() {
            TABexo_selon_SELECTthemes();
            //SELECTION PAR DEFAUT (1er de la liste déroulante)
            //Liste déroulante pas encore séléctionné mais il faut quand meme afficher les bons résultats)
            //permet de garder le meme element dans la liste déroulante après une requete
            //(créé une variable SESSION pour garder après les requetes
            $.post("../admin/mes_cours.php", {"id_cours_sel": $("#liste_cours option:selected").val(), "id_them_sel": $("#liste_themes option:selected").val()});
        });
    }
    else
    {
        $("#tab_cours").hide(); //cache tous les tr du tableau sauf les titres
        $("#msg_cours").text("Veuillez créer un cours, pour en gérer ses thèmes et exercices.");
        $("#themes").hide();//on cache le tableau themes
        $("#exo").hide();//on cache le tableau exo

    }
//##############
//    POPUP
//##############    
    //Affichage des popups


});