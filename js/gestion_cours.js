clickedIndex = -1;
editMode = false;
/** Arborescence à gauche **/
$(".icon").click(function() {
	clickedIndex = $(this).data('id');
	$( ".icon" ).each(function( index ) 
	{
		if (index != clickedIndex)
		{
			$(this).removeClass('glyphicon-minus-sign');
			$(this).addClass('glyphicon-plus-sign');
		}
	});
	
	
	if ($(this).hasClass('glyphicon-plus-sign'))
	{
		$(this).removeClass('glyphicon-plus-sign');
		$(this).addClass('glyphicon-minus-sign');
	}
	else if ($(this).hasClass('glyphicon-minus-sign'))
	{
		$(this).removeClass('glyphicon-minus-sign');
		$(this).addClass('glyphicon-plus-sign');
	}
});



/**********************************************/
function resetColors()
{
	$('.panel').removeClass('focus-color-bg');
}

$(".accordion-theme").click(function() {
	resetColors();
	clickedIndex = $(this).data('id-theme');
	$('#T' + clickedIndex).addClass('focus-color-bg');
});


function disableEditMode()
{
	$( ".base" ).each(function( index ) 
	{
		if (index != clickedIndex)
		{
			$(this).removeClass('hidden');
		}
	});
			
	$( ".base-hidden" ).each(function( index ) 
	{
		if (index != clickedIndex)
		{
			$(this).addClass('hidden');
		}
	});
	
	$("#icon-cours").removeClass('hidden');
	editMode = false;
}


/** Cours **/

/*
$(".header-cours").hover(function() 
		{
			if (!editMode)
				$("#icon-cours").removeClass('hidden');	
				  	}, function() 
				  	{
				  		$("#icon-cours").addClass('hidden');
				 }
		);
*/

$(".edit-cours").click(function() {
	clickedIndex = $(this).data('id-cours');
	disableEditMode();
	
	$("#input-cours").removeClass('hidden');
	$("#input-cours").focus();
	$(".button-group").removeClass('hidden');
	$("#valid-cours").removeClass('hidden');
	$("#abort-cours").removeClass('hidden');
	$("#icon-cours").addClass('hidden');
	$("#titre-cours").addClass('hidden');
	editMode = true;
});

$(".valid-cours").click(function() {
	changeCoursTitle();
});

$(".add-theme").click(function() {
	$("#id-cours").val($(this).data('id-cours'));
});

$(".abort-cours").click(function() {
	$("#input-cours").val($("#titre-cours").text().trim());
	disableEditMode();
});

$(".input-cours").keyup(function (e) {
	  
	  if (e.which == 13) 
	  {
		  changeCoursTitle();
	  }
	  else if (e.which == 27)
	  {
		  $("#input-cours").val($("#titre-cours").text().trim());
		  disableEditMode();
	  }
});



function changeCoursTitle()
{
	var donnees = {};
	donnees["id-cours"] = clickedIndex;
    donnees["titre-cours"] = $("#input-cours").val();
    donnees["type"] = "edit";
    
    var ajax = $.ajax({
        type: "post",
        url: "../controleur/index.php?section=gestion_cours",
        dataType: "html",
        data: donnees,
        success: function() {
        	$("#titre-cours").text(donnees["titre-cours"]);
        	$("#cours-accordion-"+clickedIndex).html(donnees["titre-cours"]);
        	$("#cours-accordion-"+clickedIndex).attr("title", donnees["titre-cours"]);
        	$("#icon-cours").removeClass('hidden');
        	alertSuccess('Cours modifié');

        },
        error: function() {
        	alert('erreur');
        }
    });
    disableEditMode();
}

$(".delete-cours").click(function() {
	$("#cours-delete").val($(this).data('id-cours'));
});
/** Exercices **/

$(".header-exo").hover(function() 
		{
			if (!editMode)
				$("#edit-icon-exo-" + $(this).data('modif-exo-id')).removeClass('hidden');	
				  	}, function() 
				  	{
				  		$("#edit-icon-exo-" + $(this).data('modif-exo-id')).addClass('hidden');
				 }
		);

$(".edit-exo").click(function() {
	clickedIndex = $(this).data('modif-exo-id');
	
	disableEditMode();
	
	$("#exo-" + clickedIndex).removeClass('hidden');
	$("#exo-" + clickedIndex).focus();
	$("#edit-valid-exo-" + clickedIndex).removeClass('hidden');
	$("#edit-abort-exo-" + clickedIndex).removeClass('hidden');
	$("#edit-icon-exo-" + clickedIndex).addClass('hidden');
	$("#titre-exo-" + clickedIndex).addClass('hidden');
	editMode = true;
});

$(".add-fichier-exo").click(function() {
	$("#exercice-fichier").val($(this).data('id-exo'));	
});

$(".delete-exo-confirm").click(function() {
	deleteExercise();	
});

$(".delete-exo").click(function() {
	clickedIndex = $(this).data('modif-exo-id');
	disableEditMode();
});

$(".validate-icon-exo").click(function() {
	changeExerciseTitle();
});

$(".add-exercice").click(function() {
	$("#id_theme").val($(this).data('id-theme'));
});

$(".abort-icon-exo").click(function() {
	$("#exo-" + clickedIndex).val($("#titre-exo-" + clickedIndex).text().trim());
	disableEditMode();
});

$(".input-exo").keyup(function (e) {
	  
	  if (e.which == 13) 
	  {
		  changeExerciseTitle();
	  }
	  else if (e.which == 27)
	  {
		  $("#exo-" + clickedIndex).val($("#titre-exo-" + clickedIndex).text().trim());
		  disableEditMode();
	  }
});

function changeExerciseTitle()
{
	var donnees = {};
	donnees["id-exo"] = clickedIndex;
    donnees["titre-exo"] = $("#exo-" + clickedIndex).val();
    donnees["type"] = "edit";
    
    var ajax = $.ajax({
        type: "post",
        url: "../controleur/index.php?section=gestion_cours",
        dataType: "html",
        data: donnees,
        success: function() {
        	$("#titre-exo-" + clickedIndex).text(donnees["titre-exo"]);
        	$("#exo-accordion-" + clickedIndex).html(donnees["titre-exo"]);
        	$("#exo-accordion-"+clickedIndex).attr("title", donnees["titre-exo"]);
        	alertSuccess('Exercice modifié');
        },
        error: function() {
        	alert('erreur');
        }
    });
    disableEditMode();
}

function deleteExercise()
{
	var donnees = {};
	donnees["id-exo"] = clickedIndex;
	donnees["type"] = "delete";
    
    var ajax = $.ajax({
        type: "post",
        url: "../controleur/index.php?section=gestion_cours",
        dataType: "html",
        data: donnees,
        success: function() {
        	$("#E" + clickedIndex).addClass("hidden");
        	alertSuccess('Exercice supprimé');
        },
        error: function() {
        	alert('erreur');
        }
    });
    disableEditMode();
}

/** Themes **/
$(".header-theme").hover(function() 
{
	if (!editMode)
		$("#edit-icon-theme-" + $(this).data('modif-theme-id')).removeClass('hidden');	

		  	}, function() 
		  	{
		  		$("#edit-icon-theme-" + $(this).data('modif-theme-id')).addClass('hidden');
		 }
);


$(".edit-theme").click(function() {
	clickedIndex = $(this).data('modif-theme-id');

	$("#theme-" + clickedIndex).removeClass('hidden');
	$("#theme-" + clickedIndex).focus();
	$("#edit-valid-theme-" + clickedIndex).removeClass('hidden');
	$("#edit-abort-theme-" + clickedIndex).removeClass('hidden');
	$("#edit-icon-theme-" + clickedIndex).addClass('hidden');
	$("#titre-theme-" + clickedIndex).addClass('hidden');
	editMode = true;
});

$(".delete-theme-confirm").click(function() {
	deleteTheme();	
});

$(".delete-theme").click(function() {
	clickedIndex = $(this).data('modif-theme-id');
	disableEditMode();
});


$(".validate-icon-theme").click(function() {
	changeThemeTitle();
});

$(".abort-icon-theme").click(function() {
	$("#theme-" + clickedIndex).val($("#titre-theme-" + clickedIndex).text().trim());
	disableEditMode();
});

$(".input-theme").keyup(function (e) {
	  
	  if (e.which == 13) 
	  {
		  changeThemeTitle();
	  }
	  else if (e.which == 27)
	  {
		  $("#theme-" + clickedIndex).val($("#titre-theme-" + clickedIndex).text().trim());
		  disableEditMode();
	  }
});

function changeThemeTitle()
{
	var donnees = {};
	donnees["id-theme"] = clickedIndex;
    donnees["titre-theme"] = $("#theme-" + clickedIndex).val();
    donnees["type"] = "edit";
    
    var ajax = $.ajax({
        type: "post",
        url: "../controleur/index.php?section=gestion_cours",
        dataType: "html",
        data: donnees,
        success: function() {
        	$("#titre-theme-" + clickedIndex).text(donnees["titre-theme"]);
        	$("#theme-accordion-" + clickedIndex).html(donnees["titre-theme"]);
        	$("#theme-accordion-"+clickedIndex).attr("title", donnees["titre-theme"]);
        	alertSuccess('Thème modifié');
        },
        error: function() {
        	alert('erreur');
        }
    });
    disableEditMode();
}

function deleteTheme()
{
	var donnees = {};
	donnees["id-theme"] = clickedIndex;
	donnees["type"] = "delete";
    
    var ajax = $.ajax({
        type: "post",
        url: "../controleur/index.php?section=gestion_cours",
        dataType: "html",
        data: donnees,
        success: function() {
        	$("#T" + clickedIndex).addClass("hidden");
        	$("#panel-theme-accordion-" + clickedIndex).addClass("hidden");
        	alertSuccess('Thème supprimé');
        },
        error: function() {
        	alert('erreur');
        }
    });
    disableEditMode();
}

/** Fichiers **/

$(".header-fichier").hover(function() 
		{
			if (!editMode)
				$("#icon-fichier-" + $(this).data('fichier-id')).removeClass('hidden');	
				  	}, function() 
				  	{
				  		$("#icon-fichier-" + $(this).data('fichier-id')).addClass('hidden');
				 }
		);

$(".edit-fichier").click(function() {

	clickedIndex = $(this).data('id-fichier');
	$("#input-fichier-" + clickedIndex).removeClass('hidden');
	$("#input-fichier-" + clickedIndex).focus();
	$("#edit-valid-fichier-" + clickedIndex).removeClass('hidden');
	$("#edit-abort-fichier-" + clickedIndex).removeClass('hidden');
	$("#icon-fichier-" + clickedIndex).addClass('hidden');
	$("#desc-fichier-" + clickedIndex).addClass('hidden');
	editMode = true;
});

$(".validate-icon-fichier").click(function() {
	changeFichierDesc();
});

$(".abort-icon-fichier").click(function() {
	$("#input-fichier-" + clickedIndex).val($("#desc-fichier-" + clickedIndex).text().trim());
	disableEditMode();
});

$(".input-fichier").keyup(function (e) {
	  
	  if (e.which == 13) 
	  {
		  changeFichierDesc();
	  }
	  else if (e.which == 27)
	  {
		$("#input-fichier-" + clickedIndex).val($("#desc-fichier-" + clickedIndex).text().trim());
		disableEditMode();
	  }
});

function changeFichierDesc()
{
	var donnees = {};
	donnees["id-fichier"] = clickedIndex;
    donnees["desc-fichier"] = $("#input-fichier-" + clickedIndex).val();
    donnees["type"] = "edit";
    
    var ajax = $.ajax({
        type: "post",
        url: "../controleur/index.php?section=gestion_cours",
        dataType: "html",
        data: donnees,
        success: function() {
        	$("#desc-fichier-" + clickedIndex).text(donnees["desc-fichier"]);
        	$("#desc-fichier-" + clickedIndex).removeClass('hidden');
        	alertSuccess('Description du fichier modifiée');
        },
        error: function() {
        	alert('erreur');
        }
    });
    disableEditMode();
}

$(".online-fichier").click(function() {
	var donnees = {};
	donnees["id-fichier"] = $(this).data('fichier-id');
	$('#online-fichier-' + donnees["id-fichier"]).addClass('hidden');
	$('#icon-online-fichier-' + donnees["id-fichier"]).removeClass('hidden');
	if ($(this).is(":checked"))
	{
		donnees['online'] = 1;
	}
	else
	{
		donnees['online'] = 0;
	}
	donnees['type'] = 'online';
	
	var ajax = $.ajax({
	    type: "post",
	    url: "../controleur/index.php?section=gestion_cours",
	    dataType: "html",
	    data: donnees,
	    success: function() {
	    	$('#online-fichier-' + donnees["id-fichier"]).removeClass('hidden');
	    	
	    	if (donnees['online'])
	    		alertSuccess('Fichier en ligne');
	    	else
	    		alertSuccess('Fichier hors ligne');
	    	$('#icon-online-fichier-' + donnees["id-fichier"]).addClass('hidden');
	    },
	    error: function() {
	    	alert('erreur');
	    }
	});
});

$(".delete-fichier-confirm").click(function() {
	deleteFichier();	
});

$(".delete-fichier").click(function() {
	
	clickedIndex = $(this).data('id-fichier');
	
	disableEditMode();
});

function deleteFichier()
{
	var donnees = {};
	donnees["id-fichier"] = clickedIndex;
	donnees["type"] = "delete";
    
    var ajax = $.ajax({
        type: "post",
        url: "../controleur/index.php?section=gestion_cours",
        dataType: "html",
        data: donnees,
        success: function() {
        	$("#bloc-fichier-" + clickedIndex).addClass("hidden");
        	alertSuccess('Fichier supprimé');
        },
        error: function() {
        	alert('erreur');
        }
    });
    disableEditMode();
}

/**********************************************/


/** Nouvelle gestion de l'ajout d'exos */

$(".field-new-exo").click(function() {
	clickedIndex = $(this).data('id-theme');
	$('#group-icon-new-' + clickedIndex).removeClass('hidden');
});

$(".validate-icon-new").click(function() {
	addExo()
});

function addExo()
{
	alert(clickedIndex);
	var donnees = {};
	donnees["titre_exo"] = $("#field-new-exo-" + clickedIndex).val();
	donnees["id_theme"] = clickedIndex;
    var ajax = $.ajax({
        type: "post",
        url: "../requetes/rq_add_exercice.php?ajax=ajax",
        dataType: "html",
        data: donnees,
        success: function(data) {
        	alertSuccess('Exercice ajouté');
        	$(data).insertBefore('.new_row');
        	alert(data);
        	$('#group-icon-new-' + clickedIndex).addClass('hidden');
        },
        error: function() {
        	alert('erreur');
        }
    });
    disableEditMode();
}


$(document).on('click','tr', function(){
	alert('lll');
});

