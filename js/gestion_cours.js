clickedIndex = -1;

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
}


/** Exercices **/
$(".edit-icon-exo").click(function() {
	clickedIndex = $(this).data('modif-exo-id');
	
	disableEditMode();
	
	$("#exo-" + clickedIndex).removeClass('hidden');
	$("#edit-valid-exo-" + clickedIndex).removeClass('hidden');
	$("#edit-abort-exo-" + clickedIndex).removeClass('hidden');
	$("#exo-" + clickedIndex).focus();
	$("#edit-icon-exo-" + clickedIndex).addClass('hidden');
	$("#titre-exo-" + clickedIndex).addClass('hidden');
});

$(".validate-icon-exo").click(function() {
	changeExerciseTitle();
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
    
    var ajax = $.ajax({
        type: "post",
        url: "../controleur/index.php?section=gestion_cours",
        dataType: "html",
        data: donnees,
        success: function() {
        	$("#titre-exo-" + clickedIndex).text(donnees["titre-exo"]);
        },
        error: function() {
        	alert('erreur');
        }
    });
    disableEditMode();
}

/**********************************************/
