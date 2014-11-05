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
	editMode = false;
}



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

$(".edit-icon-exo").click(function() {
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

$(".edit-icon-theme").click(function() {
	clickedIndex = $(this).data('modif-theme-id');
	
	disableEditMode();
	
	$("#theme-" + clickedIndex).removeClass('hidden');
	$("#theme-" + clickedIndex).focus();
	$("#edit-valid-theme-" + clickedIndex).removeClass('hidden');
	$("#edit-abort-theme-" + clickedIndex).removeClass('hidden');
	$("#edit-icon-theme-" + clickedIndex).addClass('hidden');
	$("#titre-theme-" + clickedIndex).addClass('hidden');
	editMode = true;
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
    
    var ajax = $.ajax({
        type: "post",
        url: "../controleur/index.php?section=gestion_cours",
        dataType: "html",
        data: donnees,
        success: function() {
        	$("#titre-theme-" + clickedIndex).text(donnees["titre-theme"]);
        },
        error: function() {
        	alert('erreur');
        }
    });
    disableEditMode();
}


/**********************************************/
