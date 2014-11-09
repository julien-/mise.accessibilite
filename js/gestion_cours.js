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
        	$("#icon-cours").removeClass('hidden');
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
        },
        error: function() {
        	alert('erreur');
        }
    });
    disableEditMode();
}


/**********************************************/
